<?php
/**
 * The template for displaying Archive pages
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<?php if (have_posts()) the_post(); ?>
	<h1 class="page-title">
	<?php if (is_day()): ?>
		<?php printf(__("Daily Archives: <span>%s</span>"), get_the_date()); ?>
	<?php elseif (is_month()): ?>
		<?php printf(__("Monthly Archives: <span>%s</span>"), get_the_date(_x("F Y", "monthly archives date format"))); ?>
	<?php elseif (is_year()): ?>
		<?php printf(__("Yearly Archives: <span>%s</span>"), get_the_date(_x("Y", "yearly archives date format"))); ?>
	<?php else : ?>
		<?php _e("Blog Archives"); ?>
	<?php endif; ?>
	</h1>

<?php
	rewind_posts();
	get_template_part("loop", "archive");
?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
