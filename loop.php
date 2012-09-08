<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?>

<?php if (!have_posts()): ?>
	<div class="post error404 not-found">
		<h1 class="entry-title"><?php _e("Not Found"); ?></h1>
		<div class="entry-content">
			<p><?php _e("Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post."); ?></p>
			<?php get_search_form(); ?>
		</div>
		<div class="padding_40"></div>
	</div>
<?php endif; ?>

<?php while (have_posts()): the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s'), the_title_attribute("echo=0")); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<?php if (is_archive() || is_search()): ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else: ?>
		<div class="entry-content">
			<?php the_content(__("Read more &raquo;")); ?>
			<?php wp_link_pages( array("before" => '<div class="page-link">' . __("Pages:"), "after" => "</div>")); ?>
		</div>
	<?php endif; ?>
		<div class="padding_10"></div>
		<div class="entry-meta secondary-color">
			<?php metro_post_gravatar(); ?>
			<?php metro_posted_on(); ?>
			<?php if (count(get_the_tag_list)): ?>
				<span class="tag-links">
					<?php metro_tag_links(); ?>
				</span>
			<?php endif; ?>

			<div class="clear"></div>
			<div class="post_options open">

				<script type="text/JavaScript">
				/* <![CDATA[ */
					outputAddThis("social_news_<?php the_ID(); ?>", "<?php the_permalink(); ?>", "<?php the_title(); ?>");
				/* ]]> */
				</script>

				<ul class="last hidden">
					<li class="last"><?php edit_post_link(__("Edit post")); ?></li>
				</ul>
			</div>
		</div>
		<div class="padding_40"></div>
	</div>
<?php if (!is_singular()): ?>
	<div class="comments-callout callout theme_background">
		<?php comments_popup_link(__("0"), __("1"), __("%")); ?>
		<span class="arrow"><img src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/callout-arrow-bottom-left.png" alt="&nbsp;" /></span>
	</div>
<?php endif; ?>
	<div class="clear"></div>

	<?php comments_template("", true); ?>

<?php endwhile; ?>
