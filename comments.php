<?php
/**
 * The template for comments
 *
 * @package Metro
 * @since Metro 1.0
 */
?>

<?php if (post_password_required()): ?>
<div id="comments">
	<p class="nopassword"><?php echo _e("This post is password protected. Enter the password to view any comments.", "metro"); ?></p>
</div>
<?php return; endif; ?>

<div id="comments">

<?php if (have_comments()): ?>
	<h3 id="comments-title"><?php printf(_n(__('One Response to %2$s', "metro"), __('%1$s Responses to %2$s', "metro"), get_comments_number()), number_format_i18n(get_comments_number()), "<em>" . get_the_title() . "</em>"); ?></h3>

	<?php metro_comment_navigation("top"); ?>
	<ol class="commentlist">
		<?php wp_list_comments(array("callback" => "metro_comment")); ?>
	</ol>
	<?php metro_comment_navigation("bottom"); ?>

	<div id="comments_form">
		<?php comment_form(); ?>
	</div>

<?php else : // I.E. There are no Comments
    if ( comments_open() ) : // Comments are open, but there are none yet
        echo"<p>Be the first to write a comment.</p>";
?>
	<div id="comments_form">
		<?php comment_form();?>
	</div>
<?php
    else : // comments are closed
        echo"<p class='nocomments'>Comments are closed.</p>";
    endif;
endif;
 ?>

</div>

