<?php
/**
 * The template used for displaying portfolio posts on the portfolio archive
 *
 * @package lsx
 */


$type_class = "filter-item column-3 ";
$types = get_the_terms( get_the_ID(), 'jetpack-portfolio-type');
if ($types) {
	foreach ($types as $type) {
		$type_class .= $type->slug . " ";
	}
}
?>

<article id="post-<?php the_ID(); ?>" data-column="<?php echo 3; ?>" <?php post_class($type_class); ?>>
	<div class="portfolio-content-wrapper">
		<div class="portfolio-thumbnail">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php the_permalink(); ?>">
					<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
				</a>
			<?php endif; ?>
		</div>
		
		<?php the_title( '<a class="portfolio-title" href="' . esc_url( get_permalink() ) . '" rel="bookmark"><span>', '</span></a>' ); ?>
	</div>
</article>