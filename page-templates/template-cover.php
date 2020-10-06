<?php
/**
 * Cover Template.
 *
 * Template Name: Cover Template
 * Template Post Type: post, page
 *
 * @package    lsx
 * @subpackage template
 */

get_header(); ?>

<?php //lsx_content_wrap_before(); ?>

<div id="primary" class="content-area col-sm-12">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			while ( have_posts() ) :
				the_post();
				?>

				<?php get_template_part( 'partials/content', 'page-cover' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

	<?php
	if ( is_singular( 'post' ) ) {
		lsx_post_nav();
	}
	?>
	<?php
	if ( comments_open() ) {
		comments_template();
	}
	?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php
get_footer();
