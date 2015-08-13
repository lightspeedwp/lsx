<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->

	<div class="info-box-mobile">
		<?php lsx_portfolio_meta(); ?>
	</div>

	<div class="row">
		<div class="col-sm-12">
			<div class="entry-content">
			
				<?php if ( ! is_singular() ) {
					the_excerpt();
				} else {
					the_content(); 
				} ?>

				<?php lsx_portfolio_gallery(); ?>
				
				<?php lsx_post_nav(); ?>	
				
				<?php  
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					
					if ( class_exists( 'Jetpack_Likes' ) ) {
						$custom_likes = new Jetpack_Likes;
						echo $custom_likes->post_likes( '' );
					}				
				?>
				
				<?php lsx_portfolio_related_posts(); ?>
				
				<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
			</div><!-- .entry-content -->
		</div>
	</div>
		
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
	
	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after();