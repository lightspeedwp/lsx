<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

		<?php lsx_content_top(); ?>	
		
		<?php 
		$layout = get_theme_mod('lsx_layout','2cr');
		$layout = apply_filters( 'lsx_layout', $layout );
		if('1c' === $layout){
			lsx_breadcrumbs();
		}
		?>	

		<?php if ( have_posts() ) : global $lsx_archive; $lsx_archive = 1; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php lsx_get_template_part( 'content', get_post_type() ); ?>

			<?php endwhile; ?>

			<?php lsx_paging_nav(); ?>

		<?php else : ?>

			<?php lsx_get_template_part( 'content', 'none' ); ?>

		<?php endif; $lsx_archive = 0; ?>

		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<?php get_footer();