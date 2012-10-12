<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

<?php if (have_posts()): ?>
	<h1 class="page-title"><?php _e("Search Results", "metro"); ?></h1>
	<p><?php printf(__('Your search for "%1$s" returned the following results:', "metro"), get_search_query()); ?></p>
	<?php get_template_part("loop"); ?>
<?php else : ?>
	<div class="post no-results not-found">
		<div class="entry-content">
			<h1 class="page-title"><?php _e("Search Results", "metro"); ?></h1>
			<p><?php printf(__('Sorry, but nothing matched your search for "%1$s". Please try again with some different keywords.', "metro"), get_search_query()); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
