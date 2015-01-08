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
				 <?php the_post_thumbnail( 'thumbnail-single' ); ?>
			</a>
		</div>
	<?php } elseif( lsx_get_option( 'post_placeholder', false)) { ?>
	
		<div class="entry-image">
			<a class="thumbnail pull-left" href="<?php the_permalink(); ?>">
				 <img src="<?php echo lsx_get_option( 'post_placeholder'); ?>" alt="placeholder" />
			</a>
		</div>	
		
	<?php } else { 

		$width = lsx_get_option( 'thumb_width' );
		if ( ! $width ) $width = 750;

		$height = lsx_get_option( 'thumb_height' );
		if ( ! $height ) $height = 350;
		?>

		<div class="entry-image">
			<a class="thumbnail pull-left" href="<?php the_permalink(); ?>">
				 <img src="http://placehold.it/<?php echo $width; ?>x<?php echo $height; ?>" alt="placeholder" />
			</a>
		</div>
	<?php } ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php if ( is_sticky() ) { ?>
				<span class="label label-default label-sticky">Featured</span>
			<?php } ?>
		</h1>		
		<?php if ( 'post' == get_post_type() ) : ?>
			
			<?php lsx_post_format(); ?>
			  
		<?php endif; ?>
	</header><!-- .entry-header -->	



	<?php if ( is_search() || is_archive() || is_page_template( 'page-templates/template-blog.php' ) ) : // Only display Excerpts for Search and Archives ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>		
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lsx' ),
				'after'  => '</div>',
			) );
		?>		
	</div><!-- .entry-content -->
	<?php endif; ?>
	

	<footer class="footer-meta">

		<?php lsx_post_meta(); ?>		

	</footer><!-- .footer-meta -->

	<?php lsx_entry_bottom(); ?>

	<div class="clearfix"></div>

	<?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>
</article><!-- #post-## -->

<?php lsx_entry_after(); ?>