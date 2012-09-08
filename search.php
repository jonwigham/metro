<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

<?php if (have_posts()): ?>
	<h1 class="page-title"><?php _e("Search Results"); ?></h1>
	<p><?php printf(__("Your search for \"%s\" returned the following results:"), get_search_query()); ?></p>
	<?php get_template_part("loop"); ?>
<?php else : ?>
	<div class="post no-results not-found">
		<div class="entry-content">
			<h1 class="page-title"><?php _e("Search Results"); ?></h1>
	<p><?php printf(__("Sorry, but nothing matched your search for \"%s\". Please try again with some different keywords."), get_search_query()); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
