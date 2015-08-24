<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package lsx
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo lsx_main_class(); ?>">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Whoops!', 'lsx' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'lsx' ); ?></p>

					</div> <!-- .row -->
					<?php get_search_form(); ?>
					<br />

					<p><?php _e( 'Alternatively, you can check out the', 'lsx' ); ?> <a href="/sitemap"><strong><?php _e( 'sitemap', 'lsx' ); ?></strong></a></p>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();