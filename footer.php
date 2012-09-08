<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>
		<div class="clear"></div>
	</div><!-- #main -->
</div><!-- .wrapper -->

<div id="footer" class="theme_background">
	<div class="wrapper">
		<div id="colophon">
			<?php get_sidebar("footer"); ?>
			<div id="site-info">
				&copy; <a href="<?php echo home_url("/"); ?>" title="<?php echo esc_attr(get_bloginfo("name", "display") ); ?>" rel="home"><?php bloginfo("name"); ?></a>.
				All rights reserved.
				Metro Theme created by Jon Wigham.
				<a href="<?php echo esc_url(__("http://wordpress.org/")); ?>"><?php printf(__("Proudly powered by %s"), "WordPress"); ?></a>.
			</div><!-- #site-info -->
		</div><!-- #colophon -->
	</div><!-- .wrapper -->
</div><!-- #footer -->

<?php wp_footer(); ?>
</body>
</html>