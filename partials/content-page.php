<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package lsx
 */

?>

<?php lsx_entry_before(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_entry_top(); ?>

	<div class="entry-content">

		<?php lsx_entry_inside_top(); ?>

		<?php
			the_content();

			wp_link_pages( array(
				'before'      => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
				'after'       => '</div></div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php lsx_entry_bottom(); ?>

</article><!-- #post-## -->

<?php
lsx_entry_after();
