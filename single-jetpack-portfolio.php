<?php
/**
 * The template for displaying single portfolio posts
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<section id="secondary" class="widget-area col-md-4" role="complementary">
		<?php lsx_portfolio_meta(); ?>
	</section><!-- #secondary -->

	<div id="primary" class="content-area single-portfolio col-sm-8">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

			<?php lsx_content_top(); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'portfolio-single' ); ?>

			<?php endwhile; ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_footer();