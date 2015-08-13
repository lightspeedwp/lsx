<?php
/* Template Name: Archives */

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
						<h2><?php _e( 'The Last 30 Posts', 'lsx' ); ?></h3>
                        <ul>
                            <?php $loop = new WP_Query( array( 'posts_per_page' => 30 ) ); ?>
                            <?php if ( $loop->have_posts() ) { while ( $loop->have_posts() ) { $loop->the_post(); ?>
                                <?php $loop->is_home = false; ?>
                                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php the_time( get_option( 'date_format' ) ); ?> - <?php echo $post->comment_count; ?> <?php _e( 'comments', 'lsx' ); ?></li>
                            <?php } } wp_reset_postdata(); ?>
                        </ul>

                        <h2><?php _e( 'Categories', 'lsx' ); ?></h3>

                        <ul>
                            <?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ); ?>
                        </ul>

                        <h2><?php _e( 'Monthly Archives', 'lsx' ); ?></h3>

                        <ul>
                            <?php wp_get_archives( 'type=monthly&show_post_count=1' ); ?>
                        </ul>
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

<?php get_footer();