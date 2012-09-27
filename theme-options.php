<?php
/**
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */

add_action("admin_init", "metro_options_init");
add_action("admin_menu", "metro_options_add_page");

/**
 * Init plugin options
 */
function metro_options_init()
{
	register_setting("metro_options", "metro_theme_options", "metro_options_validate");
}

/**
 * Load up the page
 */
function metro_options_add_page()
{
	$page = add_theme_page("Metro Theme Options", "Metro Theme Options", "edit_theme_options", "metro_options", "metro_options_do_page");
	add_action("admin_print_scripts-{$page}", "metro_options_assets");
}

/**
 * Load up the CSS/JS for the options page
 */
function metro_options_assets()
{
	wp_enqueue_script("prototype", "//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js");
	wp_enqueue_script("jscolor", get_stylesheet_directory_uri() . "/scripts/admin/jscolor/jscolor.js");
	wp_enqueue_script("admin", get_stylesheet_directory_uri() . "/scripts/admin/admin.js");

	wp_enqueue_style("admin", get_stylesheet_directory_uri() . "/styles/admin/admin.css");
}

/**
 * Create the options page
 */
function metro_options_do_page()
{
	if (!isset($_REQUEST["settings-updated"])) $_REQUEST["settings-updated"] = false;
?>

<div class="wrap">
<?php screen_icon(); echo "<h2>" . get_current_theme() . "Theme Options" . "</h2>"; ?>

<?php if (false !== $_REQUEST["settings-updated"]): ?>
	<div class="updated fade"><p><strong>Options saved</strong></p></div>
<?php endif; ?>

	<form method="post" action="options.php">

		<?php settings_fields("metro_options"); ?>
		<?php $options = get_option("metro_theme_options"); ?>

		<?php
			if ($options["current_metro_form_page"] == "")
			{
				$options["current_metro_form_page"] = "tab_colours";
			}
		?>

		<ul id="metro_tabs">
			<li id="tab_colours" class="<?php if ($options["current_metro_form_page"] == "tab_colours") echo "item_active"; ?>">Theme Colours</li>
			<li id="tab_social" class="<?php if ($options["current_metro_form_page"] == "tab_social") echo "item_active"; ?>">Social Media</li>
		</ul>
		<ul id="metro_content">
			<li id="content_colours" class="metro_content <?php if ($options["current_metro_form_page"] != "tab_colours") echo "hidden"; ?>">

				<h3>Choose your favourite shade and colour to make your theme your own!</h3>

				<table class="form-table">
				<tr id="metro_theme_option" valign="top">
					<th scope="row">
						Theme
					</th>
					<td class="answer narrow">
						<a href="javascript:;" onclick="setMetroOption(this, 'light');"><img src="<?php echo get_template_directory_uri(); ?>/images/admin/theme-light.png" alt="Light" class="<?php echo ($options["css_theme"] == "light") ? "img_active" : ""; ?>" /></a>
					</td>
					<td class="answer narrow">
						<a href="javascript:;" onclick="setMetroOption(this, 'dark');"><img src="<?php echo get_template_directory_uri(); ?>/images/admin/theme-dark.png" alt="Dark" class="<?php echo ($options["css_theme"] == "dark") ? "img_active" : ""; ?>" /></a>
					</td>
					<td class="other">
						<input type="hidden" name="metro_theme_options[css_theme]" class="row_answer" value="<?php echo $options["css_theme"]; ?>" />
					</td>
				</tr>
				<tr id="metro_accent_option" valign="top">
					<th scope="row">Accent Colour</th>
					<td colspan="3">
						<input class="regular-text color" id="metro_accent_colour" type="text" name="metro_theme_options[css_accent_colour]" value="<?php echo esc_attr($options["css_accent_colour"]); ?>" />
						<label class="description">6 character hex, please!</label>
					</td>
				</tr>
				<tr id="metro_accent_suggestions">
					<th>&nbsp;</th>
					<td colspan="3">
						<p class="note_title">A few suggested colours - click to choose one</p>
						<ul id="suggested_colours">
							<li><span>f3972b</span></li>
							<li><span>1ba1e2</span></li>
							<li><span>329932</span></li>
							<li><span>e671b8</span></li>
							<li><span>a100fe</span></li>
							<li><span>e61500</span></li>
							<li><span>00aba9</span></li>
						</ul>
					</td>
				</tr>
				</table>

			</li>
			<li id="content_social" class="metro_content <?php if ($options["current_metro_form_page"] != "tab_social") echo "hidden"; ?>">

				<h3>The social media accounts you link to here will appear as icons across the top of the site</h3>
				<p>We recommend not using more than 7 of these at once as the top of your site will get pretty cluttered!</p>

				<table class="form-table">
				<tr valign="top">
					<th scope="row">Twitter ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/twitter.png" alt="Twitter" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[twitter_id]" value="<?php echo esc_attr($options["twitter_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Facebook Profile</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/facebook.png" alt="Facebook" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[fb_url]" value="<?php echo esc_attr($options["fb_url"]); ?>" />
						<label class="description">Full URL to your profile</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Google+ URL</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/google-plus.png" alt="Google+" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[google_url]" value="<?php echo esc_attr($options["google_url"]); ?>" />
						<label class="description">Full URL to your profile</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">LinkedIn Profile</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/linkedin.png" alt="LinkedIn" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[linkedin_url]" value="<?php echo esc_attr($options["linkedin_url"]); ?>" />
						<label class="description">Full URL to your profile</label>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Flickr ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/flickr.png" alt="Flickr" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[flicker_id]" value="<?php echo esc_attr($options["flicker_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">YouTube ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/youtube.png" alt="Youtube" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[youtube_id]" value="<?php echo esc_attr($options["youtube_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Github ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/github.png" alt="Github" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[github_id]" value="<?php echo esc_attr($options["github_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">App.Net ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/app.net.png" alt="App.Net" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[app.net_id]" value="<?php echo esc_attr($options["app.net_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Steam ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/steam.png" alt="Steam" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[steam_id]" value="<?php echo esc_attr($options["steam_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">PSN ID</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/psn.png" alt="Playstation Network" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[psn_id]" value="<?php echo esc_attr($options["psn_id"]); ?>" />
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">XBOX Profile URL</th>
					<td>
						<img src="<?php echo get_template_directory_uri(); ?>/images/social/37x37/xbox.png" alt="XBOX Live" class="social_icon" />
						<input class="regular-text" type="text" name="metro_theme_options[xbox_url]" value="<?php echo esc_attr($options["xbox_url"]); ?>" />
					</td>
				</tr>
				</table>

			</li>
		</ul>

		<p id="metro_options_submit" class="">
			<input type="hidden" name="metro_theme_options[current_metro_form_page]" id="current_metro_form_page" value="<?php echo esc_attr($options["current_metro_form_page"]); ?>" />
			<input type="submit" class="button-primary" value="Save Options" />
			<span>&laquo; Don't forget to save these options!</span>
		</p>
	</form>
</div>
<?php
}

/**
* Sanitize and validate input. Accepts an array, return a sanitized array.
*/
function metro_options_validate($input)
{
	global $select_options, $radio_options;

	$input["twitter_id"] = wp_filter_nohtml_kses($input["twitter_id"]);
	$input["flicker_id"] = wp_filter_nohtml_kses($input["flicker_id"]);
	$input["youtube_id"] = wp_filter_nohtml_kses($input["youtube_id"]);
	$input["github_id"] = wp_filter_nohtml_kses($input["github_id"]);
	$input["fb_url"] = wp_filter_nohtml_kses($input["fb_url"]);
	$input["linkedin_url"] = wp_filter_nohtml_kses($input["linkedin_url"]);

	$input["css_accent_colour"] = wp_filter_nohtml_kses($input["css_accent_colour"]);

	return $input;
}
