<?php
/* Template Name: Timeline */

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

					<section id="archives" class="entry-content">
						
						<?php
		                	$loop = new WP_Query( array( 'posts_per_page' => '-1' ) );
							$dates_array 			= array();
							$year_array 			= array();
							$i 						= 0;
							$prev_post_ts    		= null;
							$prev_post_year  		= null;
							$distance_multiplier	=  9;
						?>

                        <?php while ( $loop->have_posts() ) { $loop->the_post();

							$post_ts    =  strtotime( $post->post_date );
							$post_year  =  date( 'Y', $post_ts );

							/* Handle the first year as a special case */
							if ( is_null( $prev_post_year ) ) {
								?>
								<h2 class="archive_year"><?php echo $post_year; ?></h2>
								<ul class="archives_list">
								<?php
							}
							else if ( $prev_post_year != $post_year ) {
								/* Close off the OL */
								?>
								</ul>
								<?php

								$working_year  =  $prev_post_year;

								/* Print year headings until we reach the post year */
								while ( $working_year > $post_year ) {
									$working_year--;
									?>
									<h2 class="archive_year"><?php echo $working_year; ?></h2>
									<?php
								}

								/* Open a new ordered list */
								?>
							<ul class="archives_list">
								<?php
							}

								/* Compute difference in days */
								if ( ! is_null( $prev_post_ts ) && $prev_post_year == $post_year ) {
									$dates_diff  =  ( date( 'z', $prev_post_ts ) - date( 'z', $post_ts ) ) * $distance_multiplier;
								}
								else {
									$dates_diff  =  0;
								}
							?>
								<li>
									<span class="date"><?php the_time( 'F j' ); ?><sup><?php the_time( 'S' ); ?></sup></span> <span class="linked"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span> <span class="comments icon comment_alt2_fill"><?php comments_popup_link( '0', '1', '%' ); ?></span>
								</li>
							<?php
									/* For subsequent iterations */
									$prev_post_ts    =  $post_ts;
									$prev_post_year  =  $post_year;
								} // End WHILE Loop

								wp_reset_postdata();

								/* If we've processed at least *one* post, close the ordered list */
								if ( ! is_null( $prev_post_ts ) ) {
							?>
							</ul>
					<?php } ?>

                    </section><!-- /.entry -->
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
