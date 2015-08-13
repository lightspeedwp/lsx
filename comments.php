<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to lsx_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package lsx
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

if (have_comments()) : ?>

<?php lsx_comments_before(); ?>

<section id="comments">
	<h3><?php printf(_n('One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'lsx'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>

	<ol class="media-list">
		<?php wp_list_comments(array('walker' => new LSX_Walker_Comment)); ?>
	</ol>

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
	<nav>
		<ul class="pager">
			<?php if (get_previous_comments_link()) : ?>
			<li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'lsx')); ?></li>
		<?php endif; ?>
		<?php if (get_next_comments_link()) : ?>
		<li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'lsx')); ?></li>
	<?php endif; ?>
</ul>
</nav>
<?php endif; ?>

<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	<div class="alert alert-warning">
		<?php _e('Comments are closed.', 'lsx'); ?>
	</div>
<?php endif; ?>
</section><!-- /#comments -->

<?php lsx_comments_after(); ?>

<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	<section id="comments">
		<div class="alert alert-warning">
			<?php _e('Comments are closed.', 'lsx'); ?>
		</div>
	</section><!-- /#comments -->

<?php lsx_comments_after(); ?>

<?php endif; ?>

<?php 
	$comment_form_args = array(
		'comment_field' => '<p class="comment-form-comment"><textarea  id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	);
?>
<?php comment_form($comment_form_args);