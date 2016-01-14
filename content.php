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

<article id="post-<?php the_ID(); ?>" <?php post_class($thumb_class); ?>>

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
		?>

		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php echo esc_url($archive_link) ?>" class="format-link has-thumb genericon genericon-<?php echo $format ?>"></a>
		<?php } else { ?>
			<a href="<?php echo esc_url($archive_link) ?>" class="format-link genericon genericon-<?php echo $format ?>"></a>
		<?php } ?>

		<div class="entry-meta">
			<?php lsx_post_meta(); ?>	
		</div><!-- .footer-meta -->

		<h1 class="entry-title">
			<?php if ( has_post_format( array('link') ) ) { ?>
				<a href="<?php echo lsx_get_my_url(); ?>" rel="bookmark"><?php the_title(); ?> <span class="genericon genericon-external"></span></a>
			<?php } else { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php } ?>
			<?php if ( is_sticky() && has_post_thumbnail() ) { ?>
				<span class="label label-default label-sticky"><?php _e('Featured','lsx'); ?></span>
			<?php 
				} elseif ( is_sticky() && ! has_post_thumbnail() ) { ?>
					<span class="label label-default label-sticky no-thumb"><?php _e('Featured','lsx'); ?></span>
			<?php } ?>
		</h1>		
	</header><!-- .entry-header -->	

	<?php if ( !is_singular() && !has_post_format( array('video', 'audio', 'quote', 'link') ) ) : // Only display Excerpts for Search and Archives ?>
		<div class="entry-summary"> 
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php elseif ( has_post_format( array('link') ) ) : ?>

	<?php else : ?>
		<div class="entry-content">
			<?php the_content(sprintf(
				__( 'Continue reading %s', 'lsx' ),
				the_title( '<span class="screen-reader-text">', '</span>', false ))); ?>
			
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'lsx' ),
					'after'  => '</div>',
				) );
			?>

		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php if ( has_tag() ) { ?>
		<div class="post-tags-wrapper">
			<div class="post-tags">
				<?php echo get_the_tag_list(''); ?>
			</div>
		</div>
	<?php } ?>

	<?php lsx_entry_bottom(); ?>


	<div class="clearfix"></div>

	<?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>

	<?php if ( !is_singular() && !is_single() ) { // Display full-width divider on Archives ?>
		<div class="lsx-breaker"></div>
	<?php } ?>
</article><!-- #post-## -->

<?php lsx_entry_after();