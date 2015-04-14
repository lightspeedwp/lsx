<?php
/* Template Name: Sitemap */

get_header(); ?>

	<div id="primary" class="content-area <?php echo lsx_main_class(); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php lsx_entry_before(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php lsx_entry_top(); ?>

					<header class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">

                        <?php lsx_sitemap_pages(); ?>

                        <h2><?php _e( 'Categories', 'lsx' ); ?></h2>
                        <ul>
                            <?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ); ?>
                        </ul>

                        <?php
                        $args = array(
							'public'				=> true,
							'_builtin' 				=> false                      	
                        );
                        $post_types = get_post_types($args , 'names');
						foreach($post_types as $post_type){
							lsx_sitemap_custom_post_type($post_type);
						}
                        ?>
                    	
					</div><!-- .entry-content -->
					<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

					<?php lsx_entry_bottom(); ?>
					
				</article><!-- #post-## -->

				<?php lsx_entry_after(); ?>

			<?php endwhile; // end of the loop. ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
