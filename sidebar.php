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

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php esc_html_e( 'Archives', 'lsx' ); ?></h1>

				<ul>
					<?php
						wp_get_archives( array(
							'type' => 'monthly',
						) );
					?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php esc_html_e( 'Meta', 'lsx' ); ?></h1>

				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; ?>

		<?php lsx_sidebar_bottom(); ?>

	</div><!-- #secondary -->

	<?php lsx_sidebars_after(); ?>

<?php
endif;
