<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
	$metro_options = get_option("metro_theme_options");
?>

<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
			<div class="padding_40"></div>
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while (have_posts()): the_post(); ?>

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
	<?php else : ?>
			<div class="entry-content">
				<?php the_content(__('Read more &raquo;')); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
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

				<div class="padding_20"></div>
				<div class="post_options open">

					<script type="text/JavaScript">
					/* <![CDATA[ */
						outputAddThis("social_news_<?php the_ID(); ?>", "<?php the_permalink(); ?>", "<?php the_title(); ?>");
					/* ]]> */
					</script>
					<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-4ef357301a6accdf"></script>

					<ul class="last hidden">
						<li class="last"><?php edit_post_link(__('Edit post')); ?></li>
					</ul>
				</div>
			</div><!-- .entry-utility -->
			<div class="padding_40"></div>
		</div><!-- #post-## -->
	<?php if (!is_singular()): ?>
		<div class="comments-callout callout theme_background">
			<?php comments_popup_link(__('0'), __('1'), __('%')); ?>
			<span class="arrow"><img src="<?php bloginfo("template_url"); ?>/images/themes/<?php echo $metro_options["css_theme"]; ?>/callout-arrow-bottom-left.png" alt="&nbsp;" /></span>
		</div>
	<?php endif; ?>
		<div class="clear"></div>

		<?php comments_template("", true); ?>

<?php endwhile; // End the loop. Whew. ?>
