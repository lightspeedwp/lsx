<?php
/* Template Name: Front Page */

	get_header(); ?>
	
	<div id="primary" class="content-area <?php echo lsx_home_main_class(); ?>">
	
		<?php lsx_content_before(); ?>
		
		<main id="main" class="site-main container" role="main">

			<?php lsx_content_top(); ?>		
			
				<section id="home-widgets">
				
					<?php if ( ! dynamic_sidebar( 'home' ) ) : ?>
					
						<aside class="widget widget_text" id="text-2">
							<h3 class="widget-title"><?php _e( 'Welcome', 'lsx' ); ?></h3>
							<div class="textwidget"><?php _e( 'Add a text widget to your Homepage Column 1 sidebar.', 'lsx' ); ?></div>
						</aside>
					
					<?php endif; // end sidebar widget area ?>
					
				</section>		
				
			<?php lsx_content_bottom(); ?>
		
		</main><!-- #main -->
		
		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_sidebar( 'alt' ); ?>	
<?php get_footer(); ?>