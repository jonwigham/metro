<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<?php get_template_part("loop", "page"); ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
