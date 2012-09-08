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
	<h1 class="page-title"><?php printf(__('Search Results for: %s'), "<span>" . get_search_query() . "</span>"); ?></h1>
	<?php get_template_part("loop"); ?>
<?php else : ?>
	<div id="post-0" class="post no-results not-found">
		<h3 class="entry-title"><?php _e("Nothing Found"); ?></h3>
		<div class="entry-content">
			<p><?php _e("Sorry, but nothing matched your search criteria. Please try again with some different keywords."); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
