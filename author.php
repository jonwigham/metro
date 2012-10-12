<?php
/**
 * The template for displaying Author Archive pages
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
<?php get_header(); ?>

<div id="container"><div id="content">

	<?php if (have_posts()) the_post(); ?>

	<h1 class="page-title author"><?php echo _e("Author Archives", "metro"); ?>: <?php echo get_the_author(); ?></h1>

<?php if (get_the_author_meta("description")) : ?>
	<div id="entry-author-info">
		<div id="author-avatar">
			<?php echo get_avatar(get_the_author_meta("user_email"), "60"); ?>
		</div>
		<div id="author-description">
			<?php the_author_meta("description"); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="padding_20"></div>
<?php endif; ?>

<?php
	rewind_posts();
	get_template_part("loop", "author");
?>

</div></div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
