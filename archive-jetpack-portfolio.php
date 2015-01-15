<?php
get_header(); ?>

	<div id="primary" class="content-area portfolio-template col-sm-12">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<header class="page-header">
				<h1 class="page-title"><?php _e('Portfolio','lsx'); ?></h1>		
			</header><!-- .entry-header -->

			<?php
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				$posts_per_page = get_option( 'jetpack_portfolio_posts_per_page', '10' );
				$args = array(
					'post_type'      => 'jetpack-portfolio',
					'posts_per_page' => $posts_per_page,
					'paged'          => $paged,
				);
				$project_query = new WP_Query ( $args );
				if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :
			?>

				<div class="lsx-portfolio-wrapper">
					<div class="lsx-portfolio">
						<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>

							<?php get_template_part( 'content', 'portfolio' ); ?>

						<?php endwhile; ?>
					</div>
				</div><!-- .portfolio-wrapper -->

			<?php else : ?>

				<section class="no-results not-found">
					<header class="page-header">
						<h1 class="page-title"><?php _e( 'Nothing Found', 'lsx' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<?php if ( current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( __( 'Ready to publish your first project? <a href="%1$s">Get started here</a>.', 'lsx' ), esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ); ?></p>

						<?php else : ?>

							<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lsx' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>
					</div><!-- .page-content -->
				</section><!-- .no-results -->

			<?php endif; ?>	

			<div class="clearfix"></div>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->
	
	<script src="/js/imagesloaded.pkgd.min.js"></script>
	
<?php get_footer(); ?>