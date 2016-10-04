<?php
/**
 * Template Name: Portfolio Archive
 *
 * @package lsx
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area portfolio-template col-sm-12">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

			<?php lsx_content_top(); ?>

			<?php if(have_posts()) { ?>
				<?php while(have_posts()) { the_post(); ?>
					<div class="entry-content">
						
						<?php the_content(); ?>
						
						<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
					</div><!-- .entry-content -->
				<?php } ?>
			<?php } ?>

			<?php
				if ( get_query_var( 'paged' ) ) :
					$paged = get_query_var( 'paged' );
				elseif ( get_query_var( 'page' ) ) :
					$paged = get_query_var( 'page' );
				else :
					$paged = 1;
				endif;

				$args = array(
					'post_type'      => 'jetpack-portfolio',
					'posts_per_page' => 99,
				);
				$project_query = new WP_Query ( $args );
				if ( post_type_exists( 'jetpack-portfolio' ) && $project_query -> have_posts() ) :
			?>
			
				<?php lsx_portfolio_sorter(); ?>

				<div class="filter-items-wrapper lsx-portfolio-wrapper">
					<div class="filter-items-container lsx-portfolio masonry">
						<?php while ( $project_query -> have_posts() ) : $project_query -> the_post(); ?>

							<?php if(has_post_thumbnail()) { ?>
								<?php get_template_part( 'content', 'portfolio' ); ?>
							<?php } ?>

						<?php endwhile; ?>
					</div>
				</div><!-- .portfolio-wrapper -->

			<?php else : ?>

				<section class="no-results not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'lsx' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<?php if ( current_user_can( 'publish_posts' ) ) : ?>

							<p><?php esc_html_e( 'Ready to publish your first project?', 'lsx' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=jetpack-portfolio' ) ) ?>"><?php esc_html_e( 'Get started here', 'lsx' ); ?></a></p>

						<?php else : ?>

							<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lsx' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>
					</div><!-- .page-content -->
				</section><!-- .no-results -->

			<?php endif; ?>	

			<div class="clearfix"></div>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>
	
<?php get_footer();