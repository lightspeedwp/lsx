<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<?php if ( is_single() ) { ?>

	<header class="page-header">
		<?php if ( lsx_get_option( 'single_thumbnails') && has_post_thumbnail() ) {
			the_post_thumbnail( 'thumbnail-single' );
		} ?>
		<h1 class="page-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->
	<?php } else { ?>
	<header class="entry-header">
		<?php if ( lsx_get_option( 'single_thumbnails') && has_post_thumbnail() ) {
			the_post_thumbnail( 'thumbnail-single' );
		} ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php if ( ! is_singular() ) {
			the_excerpt();
		} else {
			the_content(); 
		} ?>
		<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php if ( 'post' == get_post_type() ) : ?>
			
			<?php lsx_post_format(); ?>
			  
		<?php endif; ?>

		<?php lsx_post_meta(); ?>	
	</footer><!-- .footer-meta -->
	
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_post_nav(); ?>
	
	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after(); ?>