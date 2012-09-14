<?php

/**
 * Sack off all the default widgets so we can create our own
 */
if (!function_exists("metro_unregister_default_wp_widgets")) {
	function metro_unregister_default_wp_widgets() {
		unregister_widget("WP_Widget_Categories");
	}
	add_action("widgets_init", "metro_unregister_default_wp_widgets", 1);
}


/**
 * Display a list of the categories as Tiles
 */
class MetroCategoriesWidget extends WP_Widget_Categories
{
	public function __construct()
	{
		parent::WP_Widget(false, "Categories", "description=List of categories that will be styled like Metro Tiles");
	}

	public function form($instance)
	{
		// Content for the widget form
		// I'll add a list of categories to exclude in here soon
	}

	public function update($new_instance, $old_instance)
	{
		// processes widget options to be saved
	}

	public function widget($args, $instance)
	{
		?>
<li id="categories" class="widget-container">
	<ul>
	<?php
		$args = array("orderby" => "name", "order" => "ASC");
		$categories = get_categories($args);
		foreach ($categories as $category)
		{
		$class_name = "";
		if ($category === end($categories)) $class_name .= "last";
	?>
		<li class="theme_background <?php echo $class_name; ?>">
			<a href="<?php echo get_category_link($category->term_id); ?>" title="View all posts in <?php echo $category->name; ?>">
				<span><?php echo $category->name; ?></span>
			</a>
		</li>
	<?php
		}
	?>
	</ul>
	<div class="clear"></div>
</li>
<?php
	}
}
register_widget("MetroCategoriesWidget");
