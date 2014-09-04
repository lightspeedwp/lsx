<?php
/* Template Name: Blog */

get_header(); ?>

	<div id="primary" class="content-area <?php echo lsx_post_main_class(); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php
			$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$args = array(
					'post_type' => 'post',
					'paged'	=> $paged
				);

			$query = new WP_Query( $args );

			?>

			<?php if ( $query->have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header><!-- .page-header -->

				<?php /* Start the Loop */ ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php // lsx_paging_nav(); ?>
				<?php if ( function_exists('wp_pagenavi') ) { ?>
					<?php wp_pagenavi( array( 'query' => $query ) ); ?>
				<?php } ?>

			<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
