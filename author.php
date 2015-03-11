<?php
/**
 * The template for displaying Author pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lsx
 */

get_header(); ?>

	<section id="primary" class="content-area <?php echo lsx_main_class(); ?>">
		
		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>
			<?php
			global $post;
			$author_id = $post->post_author;
			if ( get_post_type() == 'post' ) {
				?>
					<div class="author-box well col-xs-12">
						<div class="image col-sm-2">
							<img class="pull-left img-circle" src="<?php echo lsx_get_avatar_url( $author_id, '80' ); ?>" alt="Author Image"/>
						</div>
						<div class="content col-sm-10">
							<h3><?php printf( __('Published by %s','lsx'), get_the_author_meta( 'display_name', $author_id )) ; ?></h3>
							<p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
						</div>						
					</div>
				<?php								
			};
			?>
			<header class="page-header">
				<h1 class="page-title">
					<?php printf( __( 'Posts by %s', 'lsx' ), get_the_author() ); ?>
				</h1>

			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</section><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>