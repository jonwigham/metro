<?php
/**
 * The template for displaying Archive pages
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<?php if (have_posts()) the_post(); ?>
	<h1 class="page-title">
	<?php if (is_day()): ?>
		<?php echo _e("Daily Archives", "metro"); ?>: <span><?php echo get_the_date(); ?></span>
	<?php elseif (is_month()): ?>
		<?php echo _e("Monthly Archives", "metro"); ?>: <span><?php echo get_the_date("F Y"); ?></span>
	<?php elseif (is_year()): ?>
		<?php echo _e("Yearly Archives", "metro"); ?>: <span><?php echo get_the_date("Y"); ?></span>
	<?php else: ?>
		<?php echo _e("Blog Archives", "metro"); ?>
	<?php endif; ?>
	</h1>

<?php
	rewind_posts();
	get_template_part("loop", "archive");
?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
