<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to lsx_comment() which is
 * located in the includes/template-tags.php file.
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
	<h3>
		<?php
			$count = get_comments_number();
			printf( esc_html( _n( 'One Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', $count, 'lsx' ) ), esc_html( number_format_i18n( $count ) ), get_the_title() );
		?>
	</h3>

	<ol class="media-list">
		<?php wp_list_comments(array('walker' => new LSX_Walker_Comment)); ?>
	</ol>

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
	<nav>
		<ul class="pager">
			<?php if (get_previous_comments_link()) : ?>
			<li class="previous"><?php previous_comments_link(esc_html__('&larr; Older comments', 'lsx')); ?></li>
		<?php endif; ?>
		<?php if (get_next_comments_link()) : ?>
		<li class="next"><?php next_comments_link(esc_html__('Newer comments &rarr;', 'lsx')); ?></li>
	<?php endif; ?>
</ul>
</nav>
<?php endif; ?>

<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	<div class="alert alert-warning">
		<?php esc_html_e('Comments are closed.', 'lsx'); ?>
	</div>
<?php endif; ?>
</section><!-- /#comments -->

<?php lsx_comments_after(); ?>

<?php endif; ?>

<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
	<section id="comments">
		<div class="alert alert-warning">
			<?php esc_html_e('Comments are closed.', 'lsx'); ?>
		</div>
	</section><!-- /#comments -->

<?php lsx_comments_after(); ?>

<?php endif; ?>

<?php
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	
	$comment_form_args = array(
		'comment_field' => '<p class="comment-form-comment"><textarea placeholder="'. esc_html__( 'Comment', 'lsx' ) .'" id="comment" class="form-control" name="comment" cols="45" rows="8"'. $aria_req . $html_req .'></textarea></p>',
		
		'fields' => array(
			'author' => '<p class="comment-form-author"><label for="author">'. esc_html__( 'Name', 'lsx' ) .'</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input class="form-control" placeholder="'. esc_html__( 'Name', 'lsx' ) .'" id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) .'" size="30"'. $aria_req . $html_req .'></p>',

			'email' => '<p class="comment-form-email"><label for="email">'. esc_html__( 'Email', 'lsx' ) .'</label> ' .
				( $req ? '<span class="required">*</span>' : '' ) .
				'<input class="form-control" placeholder="'. esc_html__( 'Email', 'lsx' ) .'" id="email" name="email" type="text" value="'. esc_attr(  $commenter['comment_author_email'] ) .'" size="30"' . $aria_req . $html_req . '></p>',

			'url' => '<p class="comment-form-url"><label for="url">'. esc_html__( 'Website', 'lsx' ) .'</label>' .
				'<input class="form-control" placeholder="'. esc_html__( 'Website', 'lsx' ) .'" id="url" name="url" type="text" value="'. esc_attr( $commenter['comment_author_url'] ) .'" size="30"></p>'
		)
	);
?>
<?php comment_form($comment_form_args);