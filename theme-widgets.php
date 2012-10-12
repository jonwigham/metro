<?php
/**
 * Extended widgets for the themes
 *
 * @package Metro
 * @since Metro 1.0
 */

/**
 * Display a list of the categories as Tiles
 */
class MetroCategoriesWidget extends WP_Widget_Categories
{
	public function __construct()
	{
		parent::WP_Widget(false, "* Metro Category Tiles", "description=List of categories that will be styled like Metro Tiles");
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
<li id="category_tiles" class="widget-container">
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
