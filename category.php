<?php
/**
 * The template for displaying Category Archive pages
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<h1 class="page-title"><?php echo _e("Category Archives", "metro"); ?>: <?php echo single_cat_title("", false); ?></h1>
<?php
	$category_description = category_description();
	if (!empty($category_description)):
?>
	<div class="archive-meta"><?php echo $category_description; ?></div>
<?php endif; ?>

	<?php get_template_part("loop", "category"); ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
