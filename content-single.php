<?php
/**
 * @package lsx
 */
?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<?php
	$format = get_post_format();
	if ( false === $format ) {
		$format = 'standard';
	}
	$format_link = get_post_format_link($format);
	$format = lsx_translate_format_to_fontawesome($format);
	?>

	<?php if ( is_single() ) { ?>
		<header class="page-header">
			<h1 class="page-title">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link has-thumb fa fa-<?php echo $format ?>"></a>
				<?php } else { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link fa fa-<?php echo $format ?>"></a>
				<?php } ?>

				<span><?php the_title(); ?></span>
			</h1>
		</header><!-- .entry-header -->
	<?php } else { ?>
		<header class="entry-header">
			<h1 class="entry-title">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link has-thumb fa fa-<?php echo $format ?>"></a>
				<?php } else { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link fa fa-<?php echo $format ?>"></a>
				<?php } ?>

				<span><?php the_title(); ?></span>
			</h1>
		</header><!-- .entry-header -->
	<?php } 

	if ( is_singular('post') ) { ?>
		<header class="single-header">
			<h1 class="single-title">
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link has-thumb fa fa-<?php echo $format ?>"></a>
				<?php } else { ?>
					<a href="<?php echo esc_url($format_link) ?>" class="format-link fa fa-<?php echo $format ?>"></a>
				<?php } ?>

				<span><?php the_title(); ?></span>
			</h1>
		</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-meta">
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
		<?php if ( has_tag() || ( function_exists( 'sharing_display' ) || class_exists( 'Jetpack_Likes' ) ) ) : ?>
			<div class="post-tags-wrapper">
				<?php if ( has_tag() ) : ?>
					<div class="post-tags">
						<span><?php _e('Tagged as:','lsx'); ?></span> <?php echo get_the_tag_list(''); ?>
					</div>
				<?php endif ?>

				<?php  
					if ( function_exists( 'sharing_display' ) ) {
						sharing_display( '', true );
					}
					
					if ( class_exists( 'Jetpack_Likes' ) ) {
						$custom_likes = new Jetpack_Likes;
						echo $custom_likes->post_likes( '' );
					}
				?>
			</div>
		<?php endif ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) : ?>
				<a class="comments-link post-meta-link" data-toggle="collapse" href="#comments-collapse"><strong><?php echo get_comments_number() ?></strong> <?php _e('Comments','lsx'); ?> <span class="fa fa-chevron-down"></span></a>

				<div class="collapse" id="comments-collapse">
					<?php 
						comments_template();
					?>
				</div>
		<?php endif; ?>
	</footer><!-- .footer-meta -->
	
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php lsx_entry_after();