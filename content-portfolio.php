<?php
/**
 * The template used for displaying portfolio posts on the portfolio archive
 *
 * @package lsx
 */


$type_class = "";
$types = get_the_terms( get_the_ID(), 'jetpack-portfolio-type');
if ($types) {
	foreach ($types as $type) {
		$type_class .= $type->slug . " ";
	}
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($type_class); ?>>
	<div class="portfolio-content-wrapper">
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<div class="portfolio-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php lsx_thumbnail( 'thumbnail' ); ?>
				</a>
			</div>
		<?php endif; ?>
		
		<?php the_title( '<a class="portfolio-title" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span>', '</span></a>' ); ?>
	</div>
</article>
