<?php
/**
 * Template used to display post content on single pages.
 *
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<div class="entry-meta">
		<?php lsx_post_meta(); ?>
	</div><!-- .footer-meta -->

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
				'after'       => '</div></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php if ( has_tag() || ( function_exists( 'sharing_display' ) || class_exists( 'Jetpack_Likes' ) ) ) : ?>
			<div class="post-tags-wrapper">
				<?php lsx_content_post_tags(); ?>

				<?php
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}

					if ( class_exists( 'Jetpack_Likes' ) ) {
						$custom_likes = new Jetpack_Likes;
						echo wp_kses_post( $custom_likes->post_likes( '' ) );
					}
				?>
			</div>
		<?php endif ?>

		<?php
			if ( comments_open() ) :
				$comments_number = get_comments_number();
				?>
				<a class="comments-link post-meta-link" data-toggle="collapse" href="#comments-collapse"><strong><?php echo esc_html( $comments_number ); ?></strong> <?php esc_html_e( 'Comments', 'lsx' ); ?> <span class="fa fa-chevron-down"></span></a>

				<div class="collapse" id="comments-collapse">
					<?php comments_template(); ?>
				</div>
				<?php
			endif;
		?>
	</footer><!-- .footer-meta -->

	<?php edit_post_link( esc_html__( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after();
