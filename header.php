<?php
/**
 * The Header for our theme.
 *
 * @package Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
	if (!isset($content_width)) $content_width = 900;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo("charset"); ?>" />
	<meta name="viewport" content="width=device-width" />

	<title><?php wp_title("|", true); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>" />

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />

<?php
	if (is_singular() && get_option('thread_comments')) wp_enqueue_script("comment-reply");
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
	<div id="header">
		<div id="social_login">
			<div id="site_login">
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
					<img src="<?php echo get_template_directory_uri(); ?>/images/guest.png" alt="Guest" />
				</div>
			<?php endif; ?>
			</div>
			<div id="social">
				<ul>
					<li><a href="<?php bloginfo("rss_url"); ?>" title="RSS" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/rss.png" alt="RSS" /></a></li>
				<?php if (esc_attr($metro_options["twitter_id"])): ?>
					<li><a href="https://twitter.com/#!/<?php echo esc_attr($metro_options["twitter_id"]); ?>" title="Twitter" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/twitter.png" alt="Twitter" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["fb_url"])): ?>
					<li><a href="<?php echo esc_attr($metro_options["fb_url"]); ?>" title="Facebook" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/facebook.png" alt="Facebook" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["google_url"])): ?>
					<li><a href="<?php echo esc_attr($metro_options["google_url"]); ?>" title="Google" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/google-plus.png" alt="Google+" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["linkedin_url"])): ?>
					<li><a href="<?php echo esc_attr($metro_options["linkedin_url"]); ?>" title="LinkedIn" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/linkedin.png" alt="LinkedIn" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["flicker_id"])): ?>
					<li><a href="http://www.flickr.com/photos/<?php echo esc_attr($metro_options["flicker_id"]); ?>" title="Flickr" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/flickr.png" alt="Flickr" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["youtube_id"])): ?>
					<li><a href="https://www.youtube.com/user/<?php echo esc_attr($metro_options["youtube_id"]); ?>" title="YouTube" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/youtube.png" alt="YouTube" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["github_id"])): ?>
					<li><a href="https://github.com/<?php echo esc_attr($metro_options["github_id"]); ?>" title="Github" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/github.png" alt="Github" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["app.net_id"])): ?>
					<li><a href="https://alpha.app.net/<?php echo esc_attr($metro_options["app.net_id"]); ?>" title="App.Net" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/app.net.png" alt="App.Net" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["steam_id"])): ?>
					<li><a href="http://steamcommunity.com/id/<?php echo esc_attr($metro_options["steam_id"]); ?>" title="Steam" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/steam.png" alt="Steam" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["psn_id"])): ?>
					<li><a href="http://us.playstation.com/publictrophy/index.htm?onlinename=<?php echo esc_attr($metro_options["psn_id"]); ?>" title="Playstation Network" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/psn.png" alt="Playstation Network" /></a></li>
				<?php endif; ?>
				<?php if (esc_attr($metro_options["xbox_gamertag"])): ?>
					<li><a href="http://live.xbox.com/Profile?GamerTag=<?php echo esc_attr($metro_options["xbox_gamertag"]); ?>" title="XBOX Live" rel="external"><img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/xbox.png" alt="XBOX Live" /></a></li>
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
						<?php wp_nav_menu("primary"); ?>
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
