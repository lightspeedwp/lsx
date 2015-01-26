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
			<a class="thumbnail pull-left" href="<?php the_permalink(); ?>">
				 <?php //lsx_thumbnail( 'thumbnail-single' ); ?>
				 <?php the_post_thumbnail('thumbnail-single'); ?>
			</a>
		</div>
	<?php } ?>

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
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false ))); ?>
			
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'lsx' ),
					'after'  => '</div>',
				) );
			?>		
		</div><!-- .entry-content -->
	<?php endif; ?>

	<?php lsx_entry_bottom(); ?>

	<footer class="footer-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			
			<?php lsx_post_format(); ?>
			  
		<?php endif; ?>

		<?php lsx_post_meta(); ?>	
	</footer><!-- .footer-meta -->

	<div class="clearfix"></div>

	<?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->

<?php lsx_entry_after(); ?>