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

		<?php if ( have_posts() ) : global $lsx_archive; $lsx_archive = 1; ?>

			<?php 
			$layout = get_theme_mod('lsx_layout','2cr');
			$layout = apply_filters( 'lsx_layout', $layout );
			if('1c' === $layout){
				lsx_breadcrumbs();
			}
			?>	

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php lsx_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; $lsx_archive = 0; ?>

		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<?php get_footer();