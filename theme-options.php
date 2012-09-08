<?php
/**
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */

add_action("admin_init", "metro_options_init");
add_action("admin_menu", "metro_options_add_page");

/**
 * Init plugin options to white list our options
 */
function metro_options_init()
{
	register_setting("metro_options", "metro_theme_options", "metro_options_validate");
}

/**
 * Load up the menu page
 */
function metro_options_add_page()
{
	$page = add_theme_page(__("Metro Theme Options"), __("Metro Theme Options"), "edit_theme_options", "metro_options", "metro_options_do_page");
	add_action("admin_print_scripts-{$page}", "metro_options_assets");
}

/**
 * Load up the CSS/JS for the options page
 */
function metro_options_assets() {
	wp_enqueue_script("jscolor", get_bloginfo("stylesheet_directory") . "/scripts/jscolor/jscolor.js");
	wp_enqueue_style("admin", get_bloginfo("stylesheet_directory") . "/styles/admin.css");
}

/**
 * Create the options page
 */
function metro_options_do_page()
{
	global $select_options, $radio_options;

	add_action("admin_head-{$my_settings_page}", 'my_admin_head_script' );

	if (!isset($_REQUEST["settings-updated"])) $_REQUEST["settings-updated"] = false;
?>

<div class="wrap">
<?php screen_icon(); echo "<h2>" . get_current_theme() . __("Theme Options") . "</h2>"; ?>

<?php if (false !== $_REQUEST["settings-updated"]): ?>
	<div class="updated fade"><p><strong><?php _e("Options saved"); ?></strong></p></div>
<?php endif; ?>
	<form method="post" action="options.php">

		<h3>Social Media Options</h3>

		<?php settings_fields("metro_options"); ?>
		<?php $options = get_option("metro_theme_options"); ?>

		<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e("Twitter ID"); ?></th>
			<td><input class="regular-text" type="text" name="metro_theme_options[twitter_id]" value="<?php esc_attr_e($options["twitter_id"]); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Flickr ID"); ?></th>
			<td><input class="regular-text" type="text" name="metro_theme_options[flicker_id]" value="<?php esc_attr_e($options["flicker_id"]); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("YouTube ID"); ?></th>
			<td><input class="regular-text" type="text" name="metro_theme_options[youtube_id]" value="<?php esc_attr_e($options["youtube_id"]); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Github ID"); ?></th>
			<td><input class="regular-text" type="text" name="metro_theme_options[github_id]" value="<?php esc_attr_e($options["github_id"]); ?>" /></td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Facebook Profile"); ?></th>
			<td>
				<input class="regular-text" type="text" name="metro_theme_options[fb_url]" value="<?php esc_attr_e($options["fb_url"]); ?>" />
				<label class="description"><?php _e("Full URL to your profile"); ?></label>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("LinkedIn Profile"); ?></th>
			<td>
				<input class="regular-text" type="text" name="metro_theme_options[linkedin_url]" value="<?php esc_attr_e($options["linkedin_url"]); ?>" />
				<label class="description"><?php _e("Full URL to your profile"); ?></label>
			</td>
		</tr>
		</table>

		<h3>Template Options</h3>

		<table class="form-table">
		<tr valign="top">
			<th scope="row"><?php _e("Theme"); ?></th>
			<td>
				<select name="metro_theme_options[css_theme]">
					<option value="light"<?php if ($options["css_theme"] == "light") echo ' selected="selected"'; ?>>Light</option>
					<option value="dark"<?php if ($options["css_theme"] == "dark") echo ' selected="selected"'; ?>>Dark</option>
				</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row"><?php _e("Accent Colour"); ?></th>
			<td>
				<input class="regular-text color" type="text" name="metro_theme_options[css_accent_colour]" value="<?php esc_attr_e($options["css_accent_colour"]); ?>" />
				<label class="description"><?php _e("6 character hex, please!"); ?></label>
			</td>
		</tr>
		</table>

		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e("Save Options"); ?>" />
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

	// Our checkbox value is either 0 or 1
	if (!isset($input["option1"]))
	$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
	$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
	$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
	$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}