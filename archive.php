<?php
/**
 * The template for displaying Archive pages.
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

			<?php
				$layout = get_theme_mod( 'lsx_layout', '2cr' );
				$layout = apply_filters( 'lsx_layout', $layout );

				if ( '1c' === $layout && ! is_post_type_archive( 'tribe_events' ) ) {
					lsx_breadcrumbs();
				}
			?>

			<?php lsx_content_top(); ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php lsx_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'partials/content', 'none' ); ?>

			<?php endif; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>

<?php get_footer();
