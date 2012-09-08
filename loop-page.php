<?php
/**
 * The loop that displays a page
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if (is_front_page()): ?>
			<h3 class="entry-title"><?php the_title(); ?></h3>
		<?php else: ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php comments_template("", true ); ?>

<?php endwhile; ?>
