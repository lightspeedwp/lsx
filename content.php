<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="entry-image">
			<a class="thumbnail" href="<?php the_permalink(); ?>">
				 <img <?php lsx_thumbnail('banner'); ?>>
			</a>
			
			<?php 
				$format = get_post_format();
				if ( false === $format ) {
					$format = 'standard';
				}
			?>
			<span class="genericon genericon-<?php echo $format ?>"></span>

			<br clear="all" />
		</div>
	<?php } ?>

		<div class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : ?>
				
				<?php lsx_post_format(); ?>
				  
			<?php endif; ?>

			<?php lsx_post_meta(); ?>	
		</div><!-- .footer-meta -->

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php if ( is_sticky() && has_post_thumbnail() ) { ?>
				<span class="label label-default label-sticky"><?php _e('Featured','lsx'); ?></span>
			<?php 
				} elseif ( is_sticky() && ! has_post_thumbnail() ) { ?>
					<span class="label label-default label-sticky no-thumb"><?php _e('Featured','lsx'); ?></span>
			<?php } ?>
		</h1>		
	</header><!-- .entry-header -->	

	<?php if ( !is_singular() ) : // Only display Excerpts for Search and Archives ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>		
		</div><!-- .entry-summary -->
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

	<div class="post-tags">
				<?php echo get_the_tag_list('<div class="post-tags"></div>'); ?>
			</div>

	<?php lsx_entry_bottom(); ?>


	<div class="clearfix"></div>

	<?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->

<?php lsx_entry_after(); ?>