<?php get_header(); ?>

	<div id="primary" class="content-area portfolio-template col-sm-12">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<header class="page-header">
				<?php if(is_post_type_archive()){ ?>
					<h1 class="page-title"><?php _e('Portfolio','lsx'); ?></h1>
				<?php } else { ?>
					<h1 class="page-title"><?php the_archive_title(); ?></h1>
				<?php } ?>	
			</header><!-- .entry-header -->

			
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

							<?php get_template_part( 'content', 'portfolio' ); ?>

						<?php endwhile; ?>
					</div>
				
				<br clear="all" />	
				</div><!-- .portfolio-wrapper -->
				
				<?php lsx_paging_nav(); ?>

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
	
<?php get_footer();