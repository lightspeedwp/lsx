<?php
/**
 * Template used to display post content.
 *
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<?php
	if ( has_post_thumbnail() ) {
		$thumb_class = 'has-thumb';
	} else {
		$thumb_class = 'no-thumb';
	}

	if ( ! is_singular() ) {
		$blog_layout = apply_filters( 'lsx_blog_layout', 'default' );
	} else {
		$blog_layout = 'default';
	}

	if ( 'list' === $blog_layout ) {
		$image_class = 'hidden-sm hidden-md hidden-ls';
	} else {
		$image_class = '';
	}

	$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
	$image_arr    = wp_get_attachment_image_src( $thumbnail_id, 'lsx-single-thumbnail' );

	if ( is_array( $image_arr ) ) {
		$image_src = $image_arr[0];
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $thumb_class ); ?>>
	<?php lsx_entry_top(); ?>

	<div class="entry-layout">
		<div class="entry-layout-content entry-layout-content-<?php echo has_post_thumbnail() ? '67' : '100'; ?>">
			<header class="entry-header">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="entry-image <?php echo esc_attr( $image_class ); ?>">
						<a class="thumbnail" href="<?php the_permalink(); ?>">
							<?php lsx_thumbnail( 'lsx-single-thumbnail' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<?php
					$format = get_post_format();

					if ( false === $format ) {
						$format = 'standard';
						$show_on_front = get_option( 'show_on_front', 'posts' );

						if ( 'page' === $show_on_front ) {
							$archive_link = get_permalink( get_option( 'page_for_posts' ) );
						} else {
							$archive_link = home_url();
						}
					} else {
						$archive_link = get_post_format_link( $format );
					}

					$format = lsx_translate_format_to_fontawesome( $format );
				?>

				<h1 class="entry-title">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php echo esc_url( $archive_link ) ?>" class="format-link has-thumb fa fa-<?php echo esc_attr( $format ) ?>"></a>
					<?php else : ?>
						<a href="<?php echo esc_url( $archive_link ) ?>" class="format-link fa fa-<?php echo esc_attr( $format ) ?>"></a>
					<?php endif; ?>

					<?php if ( has_post_format( array( 'link' ) ) ) : ?>
						<a href="<?php echo esc_url( lsx_get_my_url() ); ?>" rel="bookmark"><?php the_title(); ?> <span class="fa fa-external-link"></span></a>
					<?php else : ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
					<?php endif; ?>

					<?php if ( is_sticky() ) : ?>
						<span class="label label-default label-sticky"><?php esc_html_e( 'Featured', 'lsx' ); ?></span>
					<?php endif; ?>
				</h1>

				<div class="entry-meta">
					<?php lsx_post_meta(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<?php if ( ! is_singular() && ! has_post_format( array( 'video', 'audio', 'quote', 'link' ) ) && ! apply_filters( 'lsx_blog_force_content_on_list', false ) ) : // Only display Excerpts for Search and Archives ?>

				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->

			<?php elseif ( has_post_format( array( 'link' ) ) ) : ?>

			<?php elseif ( apply_filters( 'lsx_blog_force_content_on_list', false ) ) : ?>

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->

			<?php else : ?>

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

			<?php endif; ?>

			<div class="clearfix"></div>

			<?php
				$comments_number = get_comments_number();

				if ( has_tag() || ( comments_open() && ! empty( $comments_number ) ) ) :
					?>

					<div class="post-tags-wrapper">
						<?php lsx_content_post_tags(); ?>

						<?php if ( comments_open() && ! empty( $comments_number ) ) : ?>
							<div class="post-comments">
								<a href="<?php the_permalink() ?>#comments">
									<?php
										if ( '1' === $comments_number ) {
											echo esc_html( _x( 'One Comment', 'lsx' ) );
										} else {
											printf(
												/* Translators: %s: number of comments */
												esc_html( _nx(
													'%s Comment',
													'%s Comments',
													$comments_number,
													'content.php',
													'lsx'
												) ),
												esc_html( number_format_i18n( $comments_number ) )
											);
										}
									?>
								</a>
							</div>
						<?php endif ?>
					</div>

					<?php
				endif;
			?>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="entry-image hidden hidden-xs">
				<a class="thumbnail" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo esc_url( $image_src ); ?>);">
					<?php lsx_thumbnail( 'lsx-single-thumbnail' ); ?>
				</a>
			</div>

		<?php endif; ?>
	</div>

	<?php lsx_entry_bottom(); ?>

	<div class="clearfix"></div>

	<?php edit_post_link( esc_html__( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>

	<?php if ( ! is_singular() && ! is_single() ) : // Display full-width divider on Archives ?>
		<div class="lsx-breaker"></div>
	<?php endif; ?>
</article>

<?php lsx_entry_after();
