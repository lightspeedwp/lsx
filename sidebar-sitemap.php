<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */

$show_on_front = get_option( 'show_on_front' );

$layout = get_theme_mod( 'lsx_layout', '2cr' );
$layout = apply_filters( 'lsx_layout', $layout );

if ( 'posts' === $show_on_front && is_home() ) {
	$sidebar = 'home';
} else {
	$sidebar = 'sidebar-1';
}

if ( '1c' !== $layout ) : ?>

	<?php lsx_sidebars_before(); ?>

	<div id="secondary" class="widget-area <?php echo esc_attr( lsx_sidebar_class() ); ?>" role="complementary">

		<?php lsx_sidebar_top(); ?>

		<h2><?php esc_html_e( 'Categories', 'lsx' ); ?></h2>

		<aside id="categories" class="widget widget_categories">
			<?php
				echo wp_tag_cloud( array(
					'taxonomy' => 'category',
				) );
			?>
		</aside>

		<?php lsx_sitemap_taxonomy_clouds(); ?>

		<?php lsx_sidebar_bottom(); ?>

	</div><!-- #secondary -->

	<?php lsx_sidebars_after(); ?>

<?php endif;
