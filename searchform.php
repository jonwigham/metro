<?php
/**
 * The template for the sidebar search form.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?>

<form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<h4 class="widget-title"><?php _e("Search this site"); ?></h4>
	<div>
		<input type="text" value="" name="s" id="s" />
		<span><input type="image" src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/search.png" alt="Go &raquo;" class="submit" /></span>
		<div class="clear"></div>
		<div class="padding_10"></div>
	</div>
</form>
