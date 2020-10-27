<?php
/**
 * Template used to display post content.
 *
 * @package lsx
 */

?>

<?php lsx_entry_before(); ?>

<?php
	$no_thumb_post_types   = array(
		'audio'   => 'audio',
		'gallery' => 'gallery',
		'image'   => 'image',
		'link'    => 'link',
		'quote'   => 'quote',
		'video'   => 'video',
	);
	$no_thumb_post_formats = apply_filters( 'lsx_no_thumb_post_formats', $no_thumb_post_types );

	$has_thumb = has_post_thumbnail() && ! has_post_format( $no_thumb_post_formats );

	if ( $has_thumb ) {
		$thumb_class = 'has-thumb';
	} else {
		$thumb_class = 'no-thumb';
	}

	$blog_layout = apply_filters( 'lsx_blog_layout', 'default' );

	$image_class = '';

	$thumbnail_id = get_post_thumbnail_id( get_the_ID() );
	if ( empty( $thumbnail_id ) ) {
		$thumbnail_id = apply_filters( 'lsx_get_thumbnail_post_placeholder_id', $thumbnail_id, get_the_ID() );
	}
	$image_arr    = wp_get_attachment_image_src( $thumbnail_id, 'lsx-thumbnail-single' );
	$image_src    = '';

	if ( is_array( $image_arr ) ) {
		$image_src = $image_arr[0];
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'lsx-slot', $thumb_class ) ); ?>>
	<?php lsx_entry_top(); ?>

	<div class="entry-layout">
		<div class="entry-layout-content entry-layout-content-<?php echo has_post_thumbnail() ? '67' : '100'; ?>">
			<header class="entry-header">
				<?php if ( $has_thumb ) : ?>
					<div class="entry-image <?php echo esc_attr( $image_class ); ?>">
						<a class="thumbnail" href="<?php the_permalink(); ?>">
							<?php lsx_thumbnail( 'lsx-thumbnail-single' ); ?>
						</a>
					</div>
				<?php endif; ?>

				<?php
				$format = get_post_format();

				if ( false === $format ) {
					$format        = 'standard';
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
						<a href="<?php echo esc_url( $archive_link ); ?>" class="format-link has-thumb fa fa-<?php echo esc_attr( $format ); ?>"></a>
					<?php else : ?>
						<a href="<?php echo esc_url( $archive_link ); ?>" class="format-link fa fa-<?php echo esc_attr( $format ); ?>"></a>
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
					<?php lsx_post_meta_list_top(); ?>
				</div><!-- .entry-meta -->

				<?php lsx_post_meta_category(); ?>

			</header><!-- .entry-header -->

			<?php if ( has_post_format( array( 'quote' ) ) || apply_filters( 'lsx_blog_display_text_on_list', true ) ) : ?>

				<?php if ( lsx_post_format_force_content_on_list() && ! apply_filters( 'lsx_blog_force_content_on_list', false ) ) : ?>

					<div class="entry-summary">
						<?php
						if ( false === apply_filters( 'lsx_disable_content_excerpt', false ) ) {
							if ( ! has_excerpt() ) {
								$excerpt_more = '<p><a class="moretag" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read More', 'lsx' ) . '</a></p>';
								$content      = wp_trim_words( get_the_content(), 30 );
								$content      = '<p>' . $content . '</p>' . $excerpt_more;
								echo wp_kses_post( $content );
							} else {
								the_excerpt();
							}
						} else {
							$excerpt_more = '<p><a class="moretag" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read More', 'lsx' ) . '</a></p>';
							echo wp_kses_post( $excerpt_more );
						}
						?>

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

			<?php endif; ?>

			<div class="clearfix"></div>

			<?php $comments_number = get_comments_number(); ?>

			<?php if ( has_tag() || ! empty( $comments_number ) ) { ?>
				<div class="post-tags-wrapper">

					<?php lsx_content_post_tags(); ?>

					<?php if ( comments_open() && ! empty( $comments_number ) ) : ?>
						<div class="post-comments">
							<a href="<?php the_permalink(); ?>#comments">
								<?php
								if ( '1' === $comments_number ) {
									echo esc_html_x( 'One Comment', 'content.php', 'lsx' );
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
			<?php } ?>
		</div>

		<?php if ( has_post_thumbnail() ) : ?>

			<div class="entry-image hidden-xs">
				<a class="thumbnail" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo esc_url( $image_src ); ?>);">
					<?php lsx_thumbnail( 'lsx-thumbnail-single' ); ?>
				</a>
			</div>

		<?php endif; ?>
	</div>

	<?php lsx_entry_bottom(); ?>

	<div class="clearfix"></div>

	<div class="lsx-breaker"></div>
</article>

<?php
lsx_entry_after();
