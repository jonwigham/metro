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
				All rights reserved.
				Metro Theme created by <a href="<?php echo "http://www.routeofqueue.com"; ?>" rel="external">Jon Wigham</a>.
				Proudly powered by <a href="<?php echo "http://www.wordpress.org"; ?>" rel="external">WordPress</a>.
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>