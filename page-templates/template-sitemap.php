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
						<h2><?php _e( 'Pages', 'lsx' ); ?></h2>
                        <ul>
                            <?php wp_list_pages( 'depth=0&sort_column=menu_order&title_li=' ); ?>
                        </ul>

                        <h2><?php _e( 'Categories', 'lsx' ); ?></h2>
                        <ul>
                            <?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ); ?>
                        </ul>

                        <h2><?php _e( 'Posts per category', 'lsx' ); ?></h2>
                        <?php
                            $cats = get_categories();
                            foreach ( $cats as $cat ) {
                                $loop = new WP_Query( array( 'cat' => intval( $cat->cat_ID ) ) );
                        ?>
                            <h3><?php echo esc_html( $cat->cat_name ); ?></h3>
                            <ul>
                                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php _e( 'Comments', 'lsx' ); ?> (<?php echo $post->comment_count; ?>)</li>
                                <?php endwhile;  ?>
                            </ul>
						
                        <?php } wp_reset_postdata(); ?>

                        <?php
                        $types = get_post_types();

                        foreach ( $types as $type ) {
                        	if ( $type != 'post' && $type != 'page' && $type != 'modal' && $type != 'client' && $type != 'slide' && $type != 'testimonial' && $type != 'pricing_package' && $type != 'nav_menu_item' && $type != 'revision' && $type != 'attachment' && $type != 'activity' && $type != 'airport' && $type != 'room' && $type != 'itinerary' && $type != 'day' && $type != 'attraction' ) {
	                        	$post_type = get_post_type_object( $type );
	                        	$args = array(
	                        			'post_type' => $type,
	                        			'posts_per_page' => -1
	                        		);

	                        	$loop = new WP_Query( $args );
	                        	?>
	                        	<?php 
	                        	if ( $loop->have_posts() ) { ?>
									<h2><?php echo $post_type->label; ?></h2>
									<ul>
		                                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		                                <?php endwhile;  ?>
		                            </ul>
	                        	<?php
	                        	wp_reset_postdata();
	                        	}
                        	}
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
