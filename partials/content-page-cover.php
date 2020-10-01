<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lsx
 */

?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php //lsx_entry_top(); ?>

	<?php
	// On the cover page template, output the cover header.
	$cover_header_style   = '';
	$cover_header_classes = '';

	$color_overlay_style   = '';
	$color_overlay_classes = '';

	$image_url = ! post_password_required() ? get_the_post_thumbnail_url( get_the_ID(), 'full' ) : '';

	if ( $image_url ) {
		$cover_header_style  .= 'background-image: url( ' . esc_url( $image_url ) . ' );';
		$cover_header_classes = ' bg-image';
	}

	// Get the color used for the color overlay.
	$color_cover_color = get_theme_mod( 'lsx_cover_template_cover_background_color' );
	if ( $color_cover_color ) {
		$cover_header_style .= ' background-color: ' . esc_attr( $color_cover_color ) . ';';
	} else {
		$cover_header_style .= ' background-color: #27639e;';
	}

	// Get the color used for the color overlay.
	$color_overlay_color = get_theme_mod( 'lsx_cover_template_overlay_background_color' );
	if ( $color_overlay_color ) {
		$color_overlay_style = ' style="color: ' . esc_attr( $color_overlay_color ) . ';"';
	} else {
		$color_overlay_style = '';
	}

	// Get the fixed background attachment option.
	if ( get_theme_mod( 'lsx_cover_template_fixed_background', true ) ) {
		$cover_header_classes .= ' bg-attachment-fixed';
	}

	// Get the opacity of the color overlay.
	$color_overlay_opacity  = get_theme_mod( 'lsx_cover_template_overlay_opacity' );
	$color_overlay_opacity  = ( false === $color_overlay_opacity ) ? 80 : $color_overlay_opacity;
	$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;
	?>

	<div class="cover-header <?php echo esc_html( $cover_header_classes ); ?>" style="<?php echo wp_kses_post( $cover_header_style ); ?>">
		<div class="cover-header-inner-wrapper">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent<?php echo esc_attr( $color_overlay_classes ); ?>"<?php echo wp_kses_post( $color_overlay_style ); ?>></div>

					<header class="entry-header has-text-align-center">
						<div class="entry-header-inner section-inner">

							<?php

							if ( has_category() ) {
								?>

								<div class="entry-categories">
									<div class="entry-categories-inner">
										<?php the_category( ' ' ); ?>
									</div>
								</div>

								<?php
							}

							the_title( '<h1 class="entry-title">', '</h1>' );

							if ( is_page() ) {
								if ( has_excerpt() ) {
									?>

									<div class="the-excerpt-wrapper">

									<?php the_excerpt(); ?>

									</div>

									<?php
								}
								?>

								<div class="to-the-content-wrapper">

									<a href="#post-inner" class="to-the-content">
										<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
									</a>

								</div>

								<?php
							} else {

								if ( has_excerpt() ) {
									?>

									<div class="intro-text section-inner">
										<?php the_excerpt(); ?>
									</div>

									<?php
								}

								?>
								<div class="entry-meta">
									<?php lsx_post_meta_list_top(); ?>
								</div><!-- .entry-meta -->
								<?php

							}
							?>

						</div>
					</header>
			</div>
		</div>
	</div>

	<div id="post-inner" class="entry-content">

		<?php lsx_entry_inside_top(); ?>

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

	<footer class="footer-meta clearfix">
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
						$custom_likes = new Jetpack_Likes();
						echo wp_kses_post( $custom_likes->post_likes( '' ) );
					}
				}
				?>
		<?php endif ?>
	</footer><!-- .footer-meta -->

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php
lsx_entry_after();
