<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<?php if ( is_single() ) { ?>

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->
	<?php } else { ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>		
	</header><!-- .entry-header -->
	<?php } ?>

	<?php echo get_the_tag_list('<p>',', ','</p>'); ?>

	<div class="row">
		<div class="col-md-8">
			<div class="entry-content">
				<?php if ( ! is_singular() ) {
					the_excerpt();
				} else {
					the_content(); 
				} ?>
				<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
			</div><!-- .entry-content -->
		</div>

		<div class="col-md-4">
			<div class="portfolio-meta">
				<div class="portfolio-category">
					<span><span class="genericon genericon-category"></span>Category</span>
					<a href="#">Lorem Ipsum</a>
				</div>

				<div class="portfolio-client">
					<span><span class="genericon genericon-user"></span>Client</span>
					<span>Dolor Sit Amet</span>
				</div>

				<div class="portfolio-website">
					<span><span class="genericon genericon-link"></span>Website</span>
					<a href="#">http://www.loremipsum.com</a>
				</div>
			</div>
		</div>
	</div>
	
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_post_nav(); ?>
	
	<?php 
		$media = get_attached_media( 'image' );
		$media_array = array();
		$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
		
		if(!empty($media)){
			foreach($media as $media_item){
				if($post_thumbnail_id != $media_item->ID) {
					$media_array[] = $media_item->ID; 
				}
			}
		} 
		
		echo do_shortcode('[gallery ids="'.implode(',', $media_array).'"]');
	?>
	
	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after(); ?>