<?php
/**
 * @package Metro
 * @since Metro 1.0
 */

// Metro options
require_once(get_template_directory() . "/theme-options.php");

// Load up the widgets
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

		wp_enqueue_script("metro_addThis", "https://s7.addthis.com/js/300/addthis_widget.js");
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
		wp_deregister_script("metro_addThis");
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
			"name" => "Primary Widget Area",
			"id" => "primary-widget-area",
			"description" => "The primary widget area",
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
		if ($paged >= 2 || $page >= 2) $filtered_title .= " | " . 'Page ' . max($paged, $page);

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
		<span class="meta-prep meta-prep-author">Posted on</span>
		<a href="<?php echo get_permalink(); ?>" title="<?php echo esc_attr(get_the_time()); ?>" rel="bookmark"><span class="entry-date"><?php echo get_the_date(); ?></span></a>
		<span class="meta-sep">by</span>
		<span class="author vcard"><a class="url fn n" href="<?php echo get_author_posts_url(get_the_author_meta("ID")); ?>" title="View all posts by <?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></a></span>
		<span class="meta-sep">in</span> <?php echo get_the_category_list(", "); ?>
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
	<p class="last"><span class="entry-utility-prep entry-utility-prep-tag-links">Tags: </span> <?php echo $tags_list; ?></p>
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
				<p class="align_center last"><em class="comment-awaiting-moderation">This comment is awaiting moderation.</em></p>
			<?php endif; ?>

			<div class="comment-author vcard">
				<?php echo get_avatar($comment, 40); ?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="comment-meta commentmetadata">
				<span class="says">from</span> <cite class="fn"><?php echo get_comment_author_link(); ?></cite>
				<?php echo get_comment_date(); ?> at <?php echo get_comment_time(); ?> <?php edit_comment_link("(Edit)"); ?>
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
	<div class="navigation <?php echo $location; ?>">
		<div class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> Older Comments'); ?></div>
		<div class="nav-next"><?php next_comments_link('Newer Comments <span class="meta-nav">&rarr;</span>'); ?></div>
		<div class="clear"></div>
		<div class="padding_20"></div>
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

	$author = '<p class="comment-form-author"><label>Name</label><input id="author" name="author" type="text" size="30" class="field" /></p>';
	$email = '<p class="comment-form-email"><label>Email</label><input id="email" name="email" type="text" size="30" class="field" /></p>';
	$website = '<p class="comment-form-url"><label>Website</label><input id="url" name="url" type="text" size="30" class="field" /></p>';
	$comment = '<p class="comment-form-comment"><label>Comment</label><textarea name="comment" id="comment" rows="8" cols="45" class="field"></textarea></p>';

	$logged_in = '<p class="must-log-in">You must be <a href="' . wp_login_url(apply_filters("the_permalink", get_permalink($post_id))) . '">logged in</a> to post a comment.</p>';
	$logged_in_as = '<p class="logged-in-as secondary-color">Logged in as <a href="' . admin_url("profile.php") . '">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters("the_permalink", get_permalink($post_id))) . '" title="Log out of this account">Log out?</a></p>';

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
