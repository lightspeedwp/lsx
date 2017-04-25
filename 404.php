<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package lsx
 */

get_header(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Whoops!', 'lsx' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'lsx' ); ?></p>
					<?php get_search_form(); ?>
					<br>
					<p><?php esc_html_e( 'Alternatively, you can check out the', 'lsx' ); ?> <a href="<?php echo site_url( '/sitemap/' ); ?>"><strong><?php esc_html_e( 'sitemap', 'lsx' ); ?></strong></a></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
