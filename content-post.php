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

	if ( is_singular('post') && !has_post_thumbnail() ) { ?>
		<header class="single-header">
			<h1 class="single-title"><?php the_title(); ?></h1>		
		</header><!-- .entry-header -->
	<?php }

	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard';
	}
	$format_link = get_post_format_link($format);
	?>
	<div class="entry-meta">
		<?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php echo esc_url($format_link) ?>" class="format-link has-thumb genericon genericon-<?php echo $format ?>"></a>
		<?php } else { ?>
			<a href="<?php echo esc_url($format_link) ?>" class="format-link genericon genericon-<?php echo $format ?>"></a>
		<?php } ?>

		<?php lsx_post_meta(); ?>	
	</div><!-- .footer-meta -->

	<div class="entry-content">
		<?php
		if ( ! is_singular() ) {
			the_excerpt();
		} else {
			the_content(); 
		} ?>
	</div><!-- .entry-content -->

	<footer class="footer-meta">
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) : ?>
				<a class="comments-link post-meta-link" data-toggle="collapse" href="#comments-collapse"><strong><?php echo get_comments_number() ?></strong> <?php _e('Comments','lsx'); ?> <span class="genericon genericon-expand"></span></a>

				<div class="collapse" id="comments-collapse">
					<?php 
						comments_template();
					?>
				</div>
		<?php endif; ?>

		<div class="post-tags-wrapper">
			<div class="post-tags">
				<?php echo get_the_tag_list(''); ?>
			</div>
		</div>
	</footer><!-- .footer-meta -->
	
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>

	<div class="lsx-breaker">
	</div>

</article><!-- #post-## -->

<?php lsx_entry_after();