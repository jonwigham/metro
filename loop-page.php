<?php
/**
 * The loop that displays a page
 *
 * @package Metro
 * @since Metro 1.0
 */
?>

<?php if (have_posts()) while (have_posts()) : the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="padding_40"></div>

	<?php comments_template("", true); ?>

<?php endwhile; ?>
