<?php
/**
 * Template Name: Metaplate
 *
 * @package lsx
 */
get_header() ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'page' ); ?>

	<?php endwhile; // end of the loop. ?>	
<?php get_footer();