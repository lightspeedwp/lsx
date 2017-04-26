<?php
/**
 * The template for displaying all pages.
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

			<?php lsx_content_top(); ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'page' ); ?>

				<?php endwhile; ?>

			<?php endif; ?>

			<?php lsx_content_bottom(); ?>

			<?php
				if ( comments_open() ) {
					comments_template();
				}
			?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<?php get_footer();
