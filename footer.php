<?php
/**
 * The template for displaying the footer
 *
 * @package Metro
 * @since Metro 1.0
 */
?>
		<div class="clear"></div>
	</div>
</div>

<div id="footer" class="theme_background">
	<div class="wrapper">
		<div id="colophon">
			<?php get_sidebar("footer"); ?>
			<div id="site-info">
				&copy; <a href="<?php echo home_url("/"); ?>" title="<?php echo esc_attr(get_bloginfo("name", "display")); ?>" rel="home"><?php bloginfo("name"); ?></a>.
				<?php _e("All rights reserved.", "metro"); ?>
				<?php printf(__('Metro Theme created by %1$s.', "metro"), '<a href="http://' . 'www.routeofqueue.com" rel="external">Jon Wigham</a>'); ?>
				<?php printf(__('Proudly powered by %1$s.', "metro"), '<a href="http://www.wordpress.org" rel="external">WordPress</a>'); ?>
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>