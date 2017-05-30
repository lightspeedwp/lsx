<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<?php
	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard';
	}
	$format_link = get_post_format_link($format);
	$format = lsx_translate_format_to_fontawesome($format);
	?>

	<?php if ( ! is_single() ) { ?>
		<header class="entry-header">
			<h1 class="entry-title">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link has-thumb fa fa-<?php echo esc_attr( $format ) ?>"></a>
				<?php } else { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link fa fa-<?php echo esc_attr( $format ) ?>"></a>
				<?php } ?>

				<span><?php the_title(); ?></span>
			</h1>
		</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-meta">
		<?php lsx_post_meta(); ?>	
	</div><!-- .footer-meta -->

	<div class="entry-content">
		<?php
		if ( ! is_singular() ) {
			the_excerpt();
		} else {
			the_content();

			wp_link_pages( array(
				'before' => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
				'after' => '</div></div>',
				'link_before' => '<span>',
				'link_after' => '</span>'
			) );
		} ?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php if ( has_tag() || class_exists( 'LSX_Sharing' ) || ( function_exists( 'sharing_display' ) || class_exists( 'Jetpack_Likes' ) ) ) : ?>
            <div class="post-tags-wrapper">
				<?php lsx_content_post_tags(); ?>

				<?php
					if ( class_exists( 'LSX_Sharing' ) ) {
						lsx_content_sharing();
					} else {
						if ( function_exists( 'sharing_display' ) ) {
							sharing_display( '', true );
						}

						if ( class_exists( 'Jetpack_Likes' ) ) {
							$custom_likes = new Jetpack_Likes;
							echo wp_kses_post( $custom_likes->post_likes( '' ) );
						}
					}
				?>
            </div>
		<?php endif ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) : ?>
				<a class="comments-link post-meta-link" data-toggle="collapse" href="#comments-collapse"><strong><?php echo esc_html( get_comments_number() ) ?></strong> <?php esc_html_e('Comments','lsx'); ?> <span class="fa fa-chevron-down"></span></a>

				<div class="collapse" id="comments-collapse">
					<?php 
						comments_template();
					?>
				</div>
		<?php endif; ?>
	</footer><!-- .footer-meta -->
	
	<?php edit_post_link( esc_html__( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after();