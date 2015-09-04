<?php
/**
 * The Template for displaying all single posts.
 *
 * @package lsx
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo lsx_main_class(); ?>">

		<?php lsx_content_before(); ?>
		
		<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_type() ); ?>

		<?php endwhile; // end of the loop. ?>
		
		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->			

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_sidebar( 'alt' ); ?>

<?php lsx_post_nav(); ?>

<?php get_footer();