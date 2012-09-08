<?php
/**
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */

// Metro options
require_once(get_template_directory() . "/theme-options.php");

// Tell WordPress to run metro_setup() when the 'after_setup_theme' hook is run
add_action("after_setup_theme", "metro_setup");

// Color picker for '#' value fields
wp_enqueue_script("jscolor.js", get_bloginfo("stylesheet_directory") . "/scripts/jscolor/jscolor.js");

// CSS for the admin/options page
add_action("admin_head", "admin_css");
function admin_css()
{
?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo("template_url"); ?>/styles/admin.css" />
<?php
}



if (!function_exists("metro_setup")):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override metro_setup() in a child theme, add your own metro_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 *
 * @since Metro 1.0
 */
function metro_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'twentyten' ),
	) );
}
endif;



/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override twentyten_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function twentyten_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'twentyten' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'twentyten' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'twentyten' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'twentyten' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'twentyten' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Fourth Footer Widget Area', 'twentyten' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'twentyten' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running twentyten_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'twentyten_widgets_init' );
















/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Metro 1.0
 */
if (!function_exists("metro_posted_on"))
{
	function metro_posted_on()
	{
		printf(__('<p class="last"><span class="meta-prep meta-prep-author">Posted on</span> %1$s <span class="meta-sep">by</span> %2$s in %3$s</p>'),
				sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
						get_permalink(),
						esc_attr(get_the_time()),
						get_the_date()
				),
				sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
						get_author_posts_url(get_the_author_meta('ID')),
						esc_attr(sprintf(__('View all posts by %s'), get_the_author())),
						get_the_author()
				),
				get_the_category_list(", ")
		);
	}
}


/**
 * Prints HTML with meta information for the post's categories
 *
 * @since Metro 1.0
 */
if (!function_exists("metro_tag_links"))
{
	function metro_tag_links()
	{
		if ($tags_list = get_the_tag_list('', ', '))
		{
			printf(__('<p class="last"><span class="%1$s">Tags: </span> %2$s</p>'),
					'entry-utility-prep entry-utility-prep-tag-links',
					$tags_list
			);
		}
	}
}


/**
 * Print the post author's avatar for the post-meta
 *
 * @since Metro 1.0
 */
if (!function_exists("metro_post_gravatar"))
{
	function metro_post_gravatar()
	{
		if ($author_email = get_the_author_email())
		{
			echo get_avatar($author_email, "40");
		}
	}
}


/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Metro 1.0
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
			<span class="arrow"><img src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/callout-arrow-top-left.png" alt="&nbsp;" /></span>
		</div>
	<?php endif; ?>

		<div id="comment-<?php comment_ID(); ?>" class="comment theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">

			<?php if ($comment->comment_approved == "0"): ?>
				<p class="align_center last"><em class="comment-awaiting-moderation"><?php _e("This comment is awaiting moderation."); ?></em></p>
			<?php endif; ?>

			<div class="comment-author vcard">
				<?php echo get_avatar($comment, 40); ?>
			</div>

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="comment-meta commentmetadata">
				<?php printf(__('<span class="says">from</span> %s'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
				<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()); ?><?php edit_comment_link(__("(Edit)"), " "); ?>
			</div>

		</div>

	<?php if ($comment->user_id > 0): ?>
		<div class="callout bottom-right theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">
			<span class="arrow"><img src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/callout-arrow-bottom-right.png" alt="&nbsp;" /></span>
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
			<span class="arrow"><img src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/callout-arrow-top-left.png" alt="&nbsp;" /></span>
		</div>

		<div id="comment-<?php comment_ID(); ?>" class="comment theme_background<?php if ($comment->user_id > 0) echo "_dark"; ?>">
			<p class="last"><?php _e( 'Pingback:', 'twentyten' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'twentyten' ), ' ' ); ?></p>
		</div>
<?php
			break;
		}
	}
}


/**
 * Print the post author's avatar for the post-meta
 *
 * @since Metro 1.0
 */
if (!function_exists("metro_comment_navigation"))
{
	function metro_comment_navigation($location)
	{
		if (get_comment_pages_count() > 1 && get_option("page_comments"))
		{
?>
			<div class="navigation <?php echo $location; ?>">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
				<div class="clear"></div>
				<div class="padding_20"></div>
			</div>
<?php
		}
	}
}


/**
 * Formatted comments form
 *
 * @since Metro 1.0
 */
function metro_comment_form($form_options)
{
	$label = "Name" . (($req) ? " (required)" : "");
	$author  = '<p class="comment-form-author">';
	$author .= '	<input id="author" name="author" type="text" value="' . esc_attr($commenter["comment_author"]) . '" size="30"' . $aria_req . ' placeholder="' . __($label) . '" />';
	$author .= '</p>';

	$label = "Email" . (($req) ? " (required, will not be published)" : "");
	$email  = '<p class="comment-form-email">';
	$email .= '	<input id="email" name="email" type="text" value="' . esc_attr($commenter["comment_author_email"]) . '" size="30"' . $aria_req . ' placeholder="' . __($label) . '" />';
	$email .= '</p>';

	$label = "Website" . (($req) ? " (required)" : "");
	$website  = '<p class="comment-form-url">';
	$website .= '	<input id="url" name="url" type="text" value="' . esc_attr($commenter["comment_author_url"]) . '" size="30"' . $aria_req . ' placeholder="' . __($label) . '" />';
	$website .= '</p>';

	$fields = array(
		"author" => $author,
		"email" => $email,
		"url" => $website
	);


	$label = "Comment" . (($req) ? " (required)" : "");
	$comment  = '<p class="comment-form-comment">';
	$comment .= '	<textarea name="comment" id="comment" aria-required="true" rows="8" cols="45" placeholder="' . __($label) . '"></textarea>';
	$comment .= '</p>';

	$logged_in  = '<p class="must-log-in">';
	$logged_in .= sprintf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url(apply_filters("the_permalink", get_permalink($post_id))));
	$logged_in .= '</p>';

	$logged_in_as  = '<p class="logged-in-as">';
	$logged_in_as .= sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>'), admin_url("profile.php"), $user_identity, wp_logout_url(apply_filters("the_permalink", get_permalink($post_id))));
	$logged_in_as .= '</p>';

	$form_options = array(
		"fields" => apply_filters("comment_form_default_fields", $fields),

		"comment_field" => $comment,
		"must_log_in" => $logged_in,
		"logged_in_as" => $logged_in_as,

		"comment_notes_before" => "",
		"comment_notes_after" => "",

		"id_form" => "form-comment",
		"id_submit" => "submit-comment",
		"title_reply" => __("leave your comment"),
		"cancel_reply_link" => __("cancel"),
		"label_submit" => __("submit"),
	);

	return $form_options;
}
add_filter("comment_form_defaults", "metro_comment_form");

