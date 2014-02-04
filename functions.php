<?php
/**
 * @package Metro
 * @since Metro 1.0
 */

/**
 * Smash up some language files
 */
load_theme_textdomain("metro", get_template_directory() . "/languages");
$locale = get_locale();
$locale_file = get_template_directory() . "/languages/{$locale}.php";
if (is_readable($locale_file)) require_once($locale_file);


/**
 * Include the options and widgets
 */
require_once(get_template_directory() . "/theme-options.php");
require_once("theme-widgets.php");


/**
 * Tell WordPress to run metro_setup() when the 'after_setup_theme' hook is run
 */
if (!function_exists("metro_setup"))
{
	function metro_setup()
	{
		$metro_options = get_option("metro_theme_options");
		wp_enqueue_style("metro_main", get_stylesheet_directory_uri() . "/styles/styles.php?theme=" . esc_attr($metro_options["css_theme"]) . "&amp;accent=" . esc_attr($metro_options["css_accent_colour"]));

		wp_enqueue_script("metro_main", get_stylesheet_directory_uri() . "/scripts/scripts.php");
		wp_enqueue_script("metro_prototype_cdn", "https://ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js");

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add default posts and comments RSS feed links to head
		add_theme_support("automatic-feed-links");

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			"primary" => "Primary Navigation"
		));
	}
}
add_action("after_setup_theme", "metro_setup");


/**
 * Admin options - we don't want the site's CSS/JS loading up in the admin CP
 */
if (!function_exists("metro_admin_init"))
{
	function metro_admin_init()
	{
		wp_deregister_style("metro_main");
		wp_deregister_script("metro_main");
		wp_deregister_script("metro_prototype_cdn");
	}
}
add_action("admin_init", "metro_admin_init");


/**
 * Register widgetized areas
 */
if (!function_exists("metro_widgets_init"))
{
	function metro_widgets_init()
	{
		// Area 1 - sidebar.
		register_sidebar(array(
			"name" => __("Primary widget area", "metro"),
			"id" => "primary-widget-area",
			"description" => __("The primary widget area", "metro"),
			"before_widget" => '<li id="%1$s" class="widget-container %2$s">',
			"after_widget" => "</li>",
			"before_title" => '<h4 class="widget-title">',
			"after_title" => "</h4>",
		) );
	}
}
add_action("widgets_init", "metro_widgets_init");



/**
 * Add a filter to the wp_title function so we can expand the contents of it
 */
if (!function_exists("metro_filter_wp_title"))
{
	function metro_filter_wp_title($title)
	{
		global $page, $paged;
		$filtered_title = "";

		// Add the blog name.
		$site_name = get_bloginfo("name");
		$filtered_title = $site_name . $title;

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo("description", "display");
		if ($site_description && (is_home() || is_front_page())) $filtered_title .= " | " . $site_description;

		// Add a page number if necessary:
		if ($paged >= 2 || $page >= 2) $filtered_title .= " | " . __("Page ", "metro") . max($paged, $page);

		// Return the modified title
		return $filtered_title;
	}
}
add_filter("wp_title", "metro_filter_wp_title");



/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if (!function_exists("metro_posted_on"))
{
	function metro_posted_on()
	{
?>
	<p class="last">
		<?php
			printf(
				__('<span class="%1$s">Posted on</span> %2$s <span class="%3$s">by</span> %4$s <span class="%5$s">in</span> %6$s', "metro"),
				"meta-prep meta-prep-author",
				sprintf(
					'<a href="%1$s" title="%2$s" rel="%3$s"><span class="%4$s">%5$s</span></a>',
					get_permalink(),
					esc_attr(get_the_time()),
					"bookmark",
					"entry-date",
					get_the_date()
				),
				"meta-sep",
				sprintf(
					'<span class="%1$s"><a class="%2$s" href="%3$s" title="View all posts by %4$s">%5$s</a></span>',
					"author vcard",
					"url fn n",
					get_author_posts_url(get_the_author_meta("ID")),
					get_the_author(),
					get_the_author()
				),
				"meta-sep",
				get_the_category_list(", ")
			);
		?>
	</p>
<?php
	}
}


/**
 * Prints HTML with meta information for the post's categories
 */
if (!function_exists("metro_tag_links"))
{
	function metro_tag_links()
	{
		if ($tags_list = get_the_tag_list('', ', '))
		{
?>
	<p class="last"><span class="entry-utility-prep entry-utility-prep-tag-links"><?php echo _e("Tags", "metro"); ?>: </span> <?php echo $tags_list; ?></p>
<?php
		}
	}
}


/**
 * Print the post author's avatar for the post-meta
 */
if (!function_exists("metro_post_gravatar"))
{
	function metro_post_gravatar()
	{
		if ($author_email = get_the_author_meta("email"))
		{
			echo get_avatar($author_email, "40");
		}
	}
}


/**
 * Template for comments and pingbacks - used as a callback by wp_list_comments() for displaying the comments.
 */
if (!function_exists("metro_comment"))
{
	function metro_comment($comment, $args, $depth)
	{
		$metro_options = get_option("metro_theme_options");

		$GLOBALS["comment"] = $comment;
		switch ($comment->comment_type)
		{
			case "":
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="clear"></div>

	<?php if ($comment->user_id < 1): ?>
		<div class="callout top-left theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">
			<span class="arrow"><img src="<?php echo get_template_directory_uri(); ?>/images/themes/<?php echo (esc_attr($metro_options["css_theme"]) != "") ? esc_attr($metro_options["css_theme"]) : "light"; ?>/callout-arrow-top-left.png" alt="&nbsp;" /></span>
		</div>
	<?php endif; ?>

		<div id="comment-<?php comment_ID(); ?>" class="comment theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">

			<?php if ($comment->comment_approved == "0"): ?>
				<p class="align_center last"><em class="comment-awaiting-moderation"><?php _e("This comment is awaiting moderation.", "metro"); ?></em></p>
			<?php endif; ?>

			<div class="comment-author vcard">
				<?php echo get_avatar($comment, 40); ?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="comment-meta commentmetadata">
			<?php
				printf(
					__('<span class="%1$s">from </span><cite class="%2$s">%3$s</cite> %4$s at %5$s ', "metro"),
					"says",
					"fn",
					get_comment_author_link(),
					get_comment_date(),
					get_comment_time()
				);
				edit_comment_link(__("(Edit)", "metro"));
			?>
			</div>

		</div>

	<?php if ($comment->user_id > 0): ?>
		<div class="callout bottom-right theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">
			<span class="arrow"><img src="<?php echo get_template_directory_uri(); ?>/images/themes/<?php echo (esc_attr($metro_options["css_theme"]) != "") ? esc_attr($metro_options["css_theme"]) : "light"; ?>/callout-arrow-bottom-right.png" alt="&nbsp;" /></span>
		</div>
	<?php endif; ?>
<?php
			break;

			case "pingback":
			case "trackback":
?>
	<li class="post pingback">
		<div class="clear"></div>

		<div class="callout top-left theme_background">
			<span class="arrow"><img src="<?php echo get_template_directory_uri(); ?>/images/themes/<?php echo (esc_attr($metro_options["css_theme"]) != "") ? esc_attr($metro_options["css_theme"]) : "light"; ?>/callout-arrow-top-left.png" alt="&nbsp;" /></span>
		</div>

		<div id="comment-<?php comment_ID(); ?>" class="comment theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">
			<p class="last">Pingback <?php comment_author_link(); ?><?php edit_comment_link("(Edit)"); ?></p>
		</div>
<?php
			break;
		}
	}
}


/**
 * Print the post author's avatar for the post-meta
 */
if (!function_exists("metro_comment_navigation"))
{
	function metro_comment_navigation($location)
	{
		if (get_comment_pages_count() > 1 && get_option("page_comments"))
		{
?>
	<div class="comment-nav navigation <?php echo $location; ?>">
		<div class="nav nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> ' . __("Older Comments", "metro")); ?></div>
		<div class="nav nav-next"><?php next_comments_link(__("Newer Comments", "metro") . ' <span class="meta-nav">&rarr;</span>'); ?></div>
		<div class="clear"></div>
	</div>
<?php
		}
	}
}


/**
 * Formatted comments form
 */
function metro_comment_form($form_options)
{
	global $post_id;

	$user = wp_get_current_user();
	$user_identity = !empty($user->ID) ? $user->display_name : "";

	$author = '<p class="comment-form-author"><label>' . __("Name", "metro") . '</label><input id="author" name="author" type="text" size="30" class="field" /></p>';
	$email = '<p class="comment-form-email"><label>' . __("Email", "metro") . '</label><input id="email" name="email" type="text" size="30" class="field" /></p>';
	$website = '<p class="comment-form-url"><label>' . __("Website", "metro") . '</label><input id="url" name="url" type="text" size="30" class="field" /></p>';
	$comment = '<p class="comment-form-comment"><label>' . __("Comment", "metro") . '</label><textarea name="comment" id="comment" rows="8" cols="45" class="field"></textarea></p>';

	$logged_in = sprintf(
		__('<p class="%1$s">You must be <a href="%2$s">logged in</a> to post a comment.</p>', "metro"),
		"must-log-in",
		wp_login_url(apply_filters("the_permalink", get_permalink($post_id)))
	);
	$logged_in_as = sprintf(
		__('<p class="%1$s">Logged in as <a href="%2$s">%3$s</a>. <a href="%4$s" title="Log out of this account">Log out?</a></p>', "metro"),
		"logged-in-as secondary-color",
		admin_url("profile.php"),
		$user_identity,
		wp_logout_url(apply_filters("the_permalink", get_permalink($post_id)))
	);

	$fields = array(
		"author" => $author,
		"email" => $email,
		"url" => $website
	);

	$form_options = array(
		"fields" => apply_filters("comment_form_default_fields", $fields),

		"comment_field" => $comment,
		"must_log_in" => $logged_in,
		"logged_in_as" => $logged_in_as,

		"comment_notes_before" => "",
		"comment_notes_after" => "",

		"id_form" => "form-comment",
		"id_submit" => "submit-comment",
		"title_reply" => "leave your comment",
		"cancel_reply_link" => "cancel",
		"label_submit" => "submit",
	);

	return $form_options;
}
add_filter("comment_form_defaults", "metro_comment_form");
