<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<h1 class="page-title">Tag Archives: <span><?php echo single_tag_title("", false); ?></span></h1>
	<?php get_template_part("loop"); ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
