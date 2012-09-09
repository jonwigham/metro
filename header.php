<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo("charset"); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title>
	<?php
		global $page, $paged;
		wp_title("|", true, "right");

		// Add the blog name.
		bloginfo("name");

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo("description", "display");
		if ($site_description && (is_home() || is_front_page())) echo " | {$site_description}";

		// Add a page number if necessary:
		if ($paged >= 2 || $page >= 2) echo " | " . sprintf(__('Page %s'), max($paged, $page));
	?>
	</title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo("stylesheet_url"); ?>" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo("template_url"); ?>/styles/styles.php?theme=<?php echo $metro_options["css_theme"]; ?>&amp;accent=<?php echo $metro_options["css_accent_colour"]; ?>" />

	<script type="text/JavaScript" src="<?php bloginfo("template_url"); ?>/scripts/scripts.php"></script>
	<script type="text/JavaScript" src="https://s7.addthis.com/js/300/addthis_widget.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js"></script>

<?php
	if (is_singular() && get_option('thread_comments')) wp_enqueue_script("comment-reply");
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<div id="header">
		<div id="social_login">
			<div id="login">
			<?php if (is_user_logged_in()): ?>
				<?php
					global $current_user;

					$user = wp_get_current_user();
					$user_identity = ! empty( $user->ID ) ? $user->display_name : '';
				?>
				<div class="text">
					<span>Welcome <?php echo $user_identity; ?></span><br />
					<a href="<?php echo get_admin_url(); ?>" title="Admin">Admin</a>&nbsp;|&nbsp;<a href="<?php echo wp_logout_url(home_url()); ?>" title="Logout">Logout</a>
				</div>
				<div class="image theme_background">
					<a href="<?php echo get_admin_url(); ?>" title="Admin"><?php echo get_avatar($current_user->user_email, "40"); ?></a>
				</div>
			<?php else: ?>
				<div class="text">
					Welcome, guest!<br />
					<a href="<?php echo wp_login_url(); ?>" title="Login">Login</a>
				</div>
				<div class="image theme_background">
					<img src="<?php bloginfo("template_url"); ?>/images/guest.png" alt="Guest" />
				</div>
			<?php endif; ?>
			</div>
			<div id="social">
				<ul>
					<li><a href="<?php bloginfo("rss_url"); ?>" title="RSS" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/rss.png" alt="RSS" /></a></li>
				<?php if ($metro_options["twitter_id"]): ?>
					<li><a href="https://twitter.com/#!/<?php echo $metro_options["twitter_id"]; ?>" title="Twitter" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/twitter.png" alt="Twitter" /></a></li>
				<?php endif; ?>
				<?php if ($metro_options["fb_url"]): ?>
					<li><a href="<?php echo $metro_options["fb_url"]; ?>" title="Facebook" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/facebook.png" alt="Facebook" /></a></li>
				<?php endif; ?>
				<?php if ($metro_options["flicker_id"]): ?>
					<li><a href="https://www.flickr.com/photos/<?php echo $metro_options["flicker_id"]; ?>" title="Flickr" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/flickr.png" alt="Flickr" /></a></li>
				<?php endif; ?>
				<?php if ($metro_options["github_id"]): ?>
					<li><a href="https://github.com/<?php echo $metro_options["github_id"]; ?>" title="github" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/github.png" alt="github" /></a></li>
				<?php endif; ?>
				<?php if ($metro_options["youtube_id"]): ?>
					<li><a href="https://www.youtube.com/user/<?php echo $metro_options["youtube_id"]; ?>" title="YouTube" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/youtube.png" alt="YouTube" /></a></li>
				<?php endif; ?>
				<?php if ($metro_options["linkedin_url"]): ?>
					<li><a href="<?php echo $metro_options["linkedin_url"]; ?>" title="LinkedIn" rel="external"><img src="<?php bloginfo("template_url"); ?>/images/social/37x37/linkedin.png" alt="LinkedIn" /></a></li>
				<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="clear"></div>

		<div id="masthead">
			<div id="branding">
				<div class="padding_10"></div>
				<h2 id="site-description"><?php bloginfo("description"); ?></h2>
				<div id="site-title">
					<?php if (has_nav_menu("primary")): ?>
						<?php wp_nav_menu(); ?>
					<?php else: ?>
						<ul>
							<li class="current_page_item"><a href="<?php echo home_url("/"); ?>" title="<?php echo esc_attr(get_bloginfo("name", "display")); ?>"><?php bloginfo("name"); ?></a></li>
						</ul>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="main">
