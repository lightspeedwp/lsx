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

	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
	</div><!-- .entry-content -->
	<?php edit_post_link( __( 'Edit', 'lsx' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>

	<?php lsx_entry_bottom(); ?>
	
</article><!-- #post-## -->

<?php lsx_entry_after();