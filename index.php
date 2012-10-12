<?php
/**
 * The main template file.
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">
	<div class="padding_10"></div>

	<?php get_template_part("loop"); ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
