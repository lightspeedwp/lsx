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
	<?php } 

	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard';
	}
	$format_link = get_post_format_link($format);
	?>
	<div class="entry-meta">
		<a href="<?php echo esc_url($format_link) ?>" class="format-link genericon genericon-<?php echo $format ?>"></a>
		<?php lsx_post_meta(); ?>	
	</div><!-- .footer-meta -->

	<div class="entry-content">
		<?php
		if ( ! is_singular() ) {
			the_excerpt();
		} else {
			the_content(); 
		} ?>
		<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'lsx'), 'after' => '</p></nav>')); ?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php lsx_post_meta(); ?>	
	</footer><!-- .footer-meta -->
	
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>

	<?php lsx_post_nav(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after(); ?>