<?php
/* Template Name: Front Page */

	get_header(); ?>
	
	<div id="primary" class="content-area front-page col-sm-12">
	
		<?php lsx_content_before(); ?>
		
		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>		
			
			<?php if(have_posts()) : ?>
			
				<?php while ( have_posts() ) : the_post(); ?>
				
					<?php lsx_entry_before(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
							</div><!-- .entry-content -->
						
							<?php lsx_entry_bottom(); ?>
							
						</article><!-- #post-## -->
	
				<?php endwhile; // end of the loop. ?>			
			
			<?php endif; ?>
			
			<section id="home-widgets">
			
				<?php if ( ! dynamic_sidebar( 'sidebar-home' ) ) : ?>
				
					<?php if(is_customize_preview()) { ?>
						<aside class="widget widget_text" id="text-2">
							<h3 class="widget-title"><?php _e( 'Welcome', 'lsx' ); ?></h3>
							<div class="textwidget"><?php _e( 'Add a text widget to your Home sidebar.', 'lsx' ); ?></div>
						</aside>
					<?php } ?>
				
				<?php endif; // end sidebar widget area ?>
				
			</section>		
				
			<?php lsx_content_bottom(); ?>
		
		</main><!-- #main -->
		
		<?php lsx_content_after(); ?>

	</div><!-- #primary -->
<?php get_footer(); ?>