<?php
/**
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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $thumb_class ); ?>>
	<?php lsx_entry_top(); ?>

	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-image">
			<a class="thumbnail" href="<?php the_permalink(); ?>">
				 <?php lsx_thumbnail('lsx-single-thumbnail'); ?>
			</a>
		</div>
	<?php } ?>

	<?php 
		$format = get_post_format();
		if ( false === $format ) {
			$format = 'standard';
			$show_on_front = get_option('show_on_front','posts');
			if('page' == $show_on_front){
				$archive_link = get_permalink(get_option('page_for_posts'));
			}else{
				$archive_link = home_url();
			}
		}else{
			$archive_link = get_post_format_link($format);
		}
		$format = lsx_translate_format_to_fontawesome($format);
		?>

		<h1 class="entry-title">
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php echo esc_url($archive_link) ?>" class="format-link has-thumb fa fa-<?php echo esc_attr( $format ) ?>"></a>
			<?php } else { ?>
				<a href="<?php echo esc_url($archive_link) ?>" class="format-link fa fa-<?php echo esc_attr( $format ) ?>"></a>
			<?php } ?>

			<?php if ( has_post_format( array('link') ) ) { ?>
				<a href="<?php echo esc_url( lsx_get_my_url() ); ?>" rel="bookmark"><?php the_title(); ?> <span class="fa fa-external-link"></span></a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php } ?>

			<?php if ( is_sticky() ) { ?>
				<span class="label label-default label-sticky"><?php esc_html_e('Featured','lsx'); ?></span>
			<?php } ?>
		</h1>

		<div class="entry-meta">
			<?php lsx_post_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->	

	<?php if ( !is_singular() && !has_post_format( array('video', 'audio', 'quote', 'link') ) ) : // Only display Excerpts for Search and Archives ?>
		<div class="entry-summary"> 
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php elseif ( has_post_format( array('link') ) ) : ?>

	<?php else : ?>
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
					'after' => '</div></div>',
					'link_before' => '<span>',
					'link_after' => '</span>'
				) );
			?>
		</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php if ( has_tag() || ( comments_open() && ! empty( get_comments_number() ) ) ) : ?>
		<div class="post-tags-wrapper">
			<?php lsx_content_post_tags(); ?>
			
			<?php if ( comments_open() && ! empty( get_comments_number() ) ) : ?>
				<div class="post-comments">
					<a href="<?php the_permalink() ?>#comments">
						<?php
							$count = get_comments_number();
							printf( esc_html( _n( 'One Comment', '%1$s Comments', $count, 'lsx' ) ), esc_html( number_format_i18n( $count ) ) );
						?>
					</a>
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>

	<?php lsx_entry_bottom(); ?>

	<div class="clearfix"></div>

	<?php edit_post_link( esc_html__( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>

	<?php if ( !is_singular() && !is_single() ) { // Display full-width divider on Archives ?>
		<div class="lsx-breaker"></div>
	<?php } ?>
</article><!-- #post-## -->

<?php lsx_entry_after();