<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */

$sidebar_enabled = apply_filters( 'lsx_sidebar_enable', true );

if ( true !== $sidebar_enabled ) {
	return true;
}

$show_on_front = get_option( 'show_on_front' );

if ( 'page' === $show_on_front && is_front_page() ) {
	$layout  = '1c';
	$sidebar = 'home';
} else {
	$layout = get_theme_mod( 'lsx_layout', '2cr' );
	$layout = apply_filters( 'lsx_layout', $layout );

	if ( 'posts' === $show_on_front && is_home() ) {
		$sidebar = 'home';
	} else {
		$sidebar = 'sidebar-1';
	}
}

if ( '1c' !== $layout ) : ?>
	<?php lsx_sidebars_before(); ?>
	<div id="secondary" class="widget-area <?php echo esc_attr( lsx_sidebar_class() ); ?>" role="complementary">

		<?php lsx_sidebar_top(); ?>

		<?php if ( ! dynamic_sidebar( $sidebar ) ) : ?>

		<?php endif; ?>

		<?php lsx_sidebar_bottom(); ?>

	</div><!-- #secondary -->

	<?php lsx_sidebars_after(); ?>

<?php
endif;
