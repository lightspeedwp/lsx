<?php get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area portfolio-template col-sm-12">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">

			<?php lsx_content_top(); ?>
			
			<?php if(is_tax()){ ?> 
				<div class="entry-content">		
					<?php the_archive_description(); ?>
				</div>
			<?php } ?>
			
			<?php
				if ( post_type_exists( 'jetpack-portfolio' ) && have_posts() ) :
			?>
				
				<?php if(!is_tax()){ lsx_portfolio_sorter(); } ?>

				<div class="filter-items-wrapper lsx-portfolio-wrapper">
					<div id="portfolio-infinite-scroll-wrapper" class="filter-items-container lsx-portfolio masonry">
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'partials/content', 'portfolio' ); ?>

						<?php endwhile; ?>
					</div>
				
				<br clear="all" />	
				</div><!-- .portfolio-wrapper -->
				
				<?php lsx_paging_nav(); ?>

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