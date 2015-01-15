<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<?php if ( ! has_post_thumbnail() ) { ?>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->
	<?php } ?>

	<?php echo get_the_tag_list('<p>',', ','</p>'); ?>

	<div class="row">
		<div class="col-sm-12">
			<div class="entry-content">
				<?php lsx_portfolio_meta(); ?>

				<?php if ( ! is_singular() ) {
					the_excerpt();
				} else {
					the_content(); 
				} ?>

				<?php lsx_portfolio_gallery(); ?>

				<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
			</div><!-- .entry-content -->
		</div>
	</div>
		
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_post_nav(); ?>
	
	<div class="row">
		<div class="col-md-12">	
			<?php echo do_shortcode('[jetpack-related-posts]'); ?>
		</div>
	</div>
	
	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after(); ?>