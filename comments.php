<?php
/**
 * The template for displaying Comments.
 *
 * @package lsx
 */

if ( post_password_required() ) {
	return;
}

$commenter = wp_get_current_commenter();
$req       = get_option( 'require_name_email' );
$aria_req  = ( $req ? " aria-required='true'" : '' );
$html_req  = ( $req ? " required='required'" : '' );

$comment_form_args = array(
	'comment_field' => '<p class="comment-form-comment"><textarea placeholder="' . esc_html__( 'Comment', 'lsx' ) . '" id="comment" class="form-control" name="comment" cols="45" rows="8"' . $aria_req . $html_req . '></textarea></p>',

	'fields' => array(
		'author' => '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'lsx' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input class="form-control" placeholder="' . esc_html__( 'Name', 'lsx' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . '></p>',

		'email' => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'lsx' ) . '</label> ' .
			( $req ? '<span class="required">*</span>' : '' ) .
			'<input class="form-control" placeholder="' . esc_html__( 'Email', 'lsx' ) . '" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $html_req . '></p>',

		'url' => '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'lsx' ) . '</label>' .
			'<input class="form-control" placeholder="' . esc_html__( 'Website', 'lsx' ) . '" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30"></p>',
	),
);

comment_form( $comment_form_args );

if ( have_comments() ) : ?>

	<?php lsx_comments_before(); ?>

	<section id="comments">
		<h3>
			<?php
				$comments_number = get_comments_number();

				if ( '1' === $comments_number ) {
					printf(
						/* Translators: %s: post title */
						esc_html_x( 'One Response to &ldquo;%s&rdquo;', 'comments.php', 'lsx' ) ,
						get_the_title()
					);
				} else {
					printf(
						/* Translators: 1: number of comments, 2: post title */
						esc_html( _nx(
							'%1$s Response to &ldquo;%2$s&rdquo;',
							'%1$s Responses to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments.php',
							'lsx'
						) ),
						esc_html( number_format_i18n( $comments_number ) ),
						get_the_title()
					);
				}
			?>
		</h3>

		<ol class="media-list">
			<?php
				wp_list_comments( array(
					'walker' => new LSX_Walker_Comment,
				) );
			?>
		</ol>

		<?php
			$comment_pages_count = get_comment_pages_count();
			if ( $comment_pages_count > 1 && get_option( 'page_comments' ) ) : ?>
			<nav>
				<ul class="pager">
					<?php if ( get_previous_comments_link() ) : ?>
						<li class="previous"><?php previous_comments_link( esc_html__( '&larr; Older comments', 'lsx' ) ); ?></li>
					<?php endif; ?>

					<?php if ( get_next_comments_link() ) : ?>
						<li class="next"><?php next_comments_link( esc_html__( 'Newer comments &rarr;', 'lsx' ) ); ?></li>
					<?php endif; ?>
				</ul>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
			<div class="alert alert-warning">
				<?php esc_html_e( 'Comments are closed.', 'lsx' ); ?>
			</div>
		<?php endif; ?>
	</section><!-- /#comments -->

	<?php lsx_comments_after(); ?>

<?php endif; ?>

<?php if ( ! have_comments() && ! comments_open() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

	<section id="comments">
		<div class="alert alert-warning">
			<?php esc_html_e( 'Comments are closed.', 'lsx' ); ?>
		</div>
	</section><!-- /#comments -->

	<?php lsx_comments_after(); ?>

<?php endif; ?>
