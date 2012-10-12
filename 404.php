<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<div class="post">
		<h1 class="entry-title"><?php echo _e("Not Found", "metro"); ?></h1>
		<div class="entry-content">
			<p><?php echo _e("Sorry, but the page you requested could not be found.", "metro"); ?></p>
			<p><?php echo _e("Try searching for something else instead...", "metro"); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
