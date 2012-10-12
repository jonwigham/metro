<?php
/**
 * The loop that displays posts.
 *
 * @package Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?>

<?php if (!have_posts()): ?>
	<div class="post error404 not-found">
		<h1 class="entry-title"><?php _e("Not Found", "metro"); ?></h1>
		<div class="entry-content">
			<p><?php echo _e("Sorry, but no results were found for the requested archive.", "metro"); ?></p>
			<p><?php echo _e("Try searching for something else instead...", "metro"); ?></p>
			<?php get_search_form(); ?>
		</div>
		<div class="padding_40"></div>
	</div>
<?php endif; ?>

<?php while (have_posts()): the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="Permalink to <?php echo the_title_attribute("echo=0"); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<?php if (is_archive() || is_search()): ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else: ?>
		<div class="entry-content">
			<?php the_content(__("Read more", "metro") ." &raquo;"); ?>
			<?php wp_link_pages( array("before" => '<div class="page-link">' . __("Pages:", "metro"), "after" => "</div>")); ?>
		</div>
	<?php endif; ?>
		<div class="padding_10"></div>
		<div class="entry-meta secondary-color">
			<?php metro_post_gravatar(); ?>
			<?php metro_posted_on(); ?>
			<?php if (count(get_the_tag_list())): ?>
				<div class="tag-links">
					<?php metro_tag_links(); ?>
				</div>
			<?php endif; ?>

			<div class="clear"></div>
			<div class="post_options open">

				<div class="post_social_container hidden">
					<div class="id">social_news_<?php the_ID(); ?></div>
					<div class="link"><?php the_permalink(); ?></div>
					<div class="title"><?php the_title(); ?></div>
				</div>

				<ul class="last hidden">
					<li class="last"><?php edit_post_link(__("Edit post", "metro")); ?></li>
				</ul>
			</div>
		</div>
		<div class="padding_40"></div>
	</div>
<?php if (!is_singular() && $post->comment_status == "open"): ?>
	<div class="comments-callout callout theme_background bottom-left">
		<?php comments_popup_link("0", "1", "%"); ?>
		<span class="arrow"><img src="<?php echo get_template_directory_uri(); ?>/images/themes/<?php echo (esc_attr($metro_options["css_theme"]) != "") ? esc_attr($metro_options["css_theme"]) : "light"; ?>/callout-arrow-bottom-left.png" alt="&nbsp;" /></span>
	</div>
<?php endif; ?>
	<div class="clear"></div>

	<?php comments_template("", true); ?>

<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1): ?>
	<div id="nav-below" class="navigation">
		<div class="nav nav-previous"><?php next_posts_link('<span class="meta-nav">&laquo;</span> ' . __("Older posts", "metro")); ?></div>
		<div class="nav nav-next"><?php previous_posts_link(__("Newer posts", "metro") . ' <span class="meta-nav">&raquo;</span>'); ?></div>
		<div class="clear"></div>
	</div>
<?php endif; ?>
