<?php
/**
 * Full Width Template.
 *
 * Template Name: Full Width
 *
 * @package    lsx
 * @subpackage template
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area col-sm-12">

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
				$comments_number = get_comments_number();

				if ( comments_open() && ! empty( $comments_number ) ) {
					comments_template();
				}
			?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

<?php get_footer();
