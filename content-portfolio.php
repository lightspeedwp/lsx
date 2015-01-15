<?php
/**
 * The template used for displaying portfolio posts on the portfolio archive
 *
 * @package lsx
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="portfolio-content-wrapper">
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<div class="portfolio-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail(); ?>
				</a>
			</div>
		<?php endif; ?>

		<header class="portfolio-entry-header">
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>
		</header>
	</div>
</article>
