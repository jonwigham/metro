<?php
/**
 * The template for the sidebar search form.
 *
 * @package Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?>

<form method="get" id="searchform" action="<?php echo home_url("/"); ?>">
	<h4 class="widget-title">Search this site</h4>
	<div>
		<input type="text" value="" name="s" id="s" />
		<span><input type="image" src="<?php echo get_template_directory_uri(); ?>/images/themes/<?php echo (esc_attr($metro_options["css_theme"]) != "") ? esc_attr($metro_options["css_theme"]) : "light"; ?>/search.png" alt="Go &raquo;" class="submit" /></span>
		<div class="clear"></div>
		<div class="padding_10"></div>
	</div>
</form>
