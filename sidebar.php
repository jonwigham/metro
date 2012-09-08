<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage Metro
 * @since Metro 1.0
 */
?>

<div id="sidebar" class="widget-area">
	<div class="padding_10"></div>
	<ul class="xoxo">

<?php if (!dynamic_sidebar("primary-widget-area")): ?>

	<li id="categories" class="widget-container">
		<ul>
		<?php
			$args=array(
				"orderby" => "name",
				"order" => "ASC"
			);
			$categories = get_categories($args);
			foreach ($categories as $category)
			{
				$class_name = "";
				if ($category === end($categories)) $class_name .= "last";
		?>
			<li class="theme_background <?php echo $class_name; ?>"><a href="<?php echo get_category_link($category->term_id); ?>" title="<?php sprintf( __( "View all posts in %s" ), $category->name ); ?>"><span><?php echo $category->name; ?></span></a></li>
		<?php
			}
		?>
		</ul>
		<div class="clear"></div>
	</li>

<?php
	$args = array(
		"numberposts" => 5
	);
	$recent_posts = wp_get_recent_posts($args);
	if (is_array($recent_posts) & count($recent_posts) > 0)
	{
?>
	<li id="recent_posts" class="widget-container bullets">
		<h4 class="widget-title"><?php _e("Recent posts"); ?></h4>
		<ul>
		<?php
			foreach ($recent_posts as $recent_post)
			{
				$class_name = "";
				if ($recent_post === end($recent_posts)) $class_name .= "last";
		?>
			<li class="<?php echo $class_name; ?>"><span class="arrow"></span><span><a href="<?php echo get_permalink($recent_post["ID"]); ?>" title="<?php echo esc_attr($recent_post["post_title"]); ?>"><?php echo $recent_post["post_title"]; ?></a></span></li>
		<?php
			}
		?>
		</ul>
	</li>
<?php
	}
?>

	<li id="search" class="widget-container widget_search">
		<?php get_search_form(); ?>
	</li>

<?php
	$args = array(
		"number" => 5,
		"status" => "approve"
	);
	$recent_comments = get_comments($args);
	if (is_array($recent_comments) & count($recent_comments) > 0)
	{
?>
	<li id="recent_comments" class="widget-container bullets">
		<h4 class="widget-title"><?php _e("Recent comments"); ?></h4>
		<ul>
		<?php
			foreach ($recent_comments as $recent_comment)
			{
				$comment_post = get_post($recent_comment->comment_post_ID);

				$class_name = "";
				if ($recent_comment === end($recent_comments)) $class_name .= "last";
		?>
			<li class="<?php echo $class_name; ?>"><span class="arrow"></span><span><?php echo $recent_comment->comment_author; ?> on <a href="<?php echo get_permalink($comment_post->ID); ?>#comment-<?php echo $recent_comment->comment_ID; ?>" title="<?php echo esc_attr($comment_post->post_title); ?>"><?php echo $comment_post->post_title; ?></a></span></li>
		<?php
			}
		?>
		</ul>
	</li>
<?php
	}
?>

<?php endif; // end primary widget area ?>
	</ul>
</div>
