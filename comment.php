<?php 
if(isset($GLOBALS['comment_depth'])){
	$depth = intval($GLOBALS['comment_depth']);
}else{
	$depth = 3;
}
?>

<?php echo get_avatar($comment, '64'); ?>
<div class="media-body">
  <h4 class="media-heading"><?php echo get_comment_author_link(); ?></h4>
  <time datetime="<?php echo comment_date('c'); ?>"><a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><?php printf(__('%1$s on %2$s', 'lsx'), get_comment_date(),  get_comment_time()); ?></a></time>
  <?php edit_comment_link(__('(Edit)', 'lsx'), '', ''); ?>

  <?php if ($comment->comment_approved == '0') : ?>
  <div class="alert alert-info">
    <?php _e('Your comment is awaiting moderation.', 'lsx'); ?>
  </div>
<?php endif; ?>

<?php comment_text(); ?>
<?php comment_reply_link(array('depth' => $depth,'max_depth' => $depth));