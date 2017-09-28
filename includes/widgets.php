<?php
/**
 * LSX functions and definitions - Widgets.
 *
 * @package    lsx
 * @subpackage widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_widget_area_init' ) ) :

	/**
	 * Register widgetized area and update sidebar with default widgets.
	 *
	 * @package    lsx
	 * @subpackage widgets
	 */
	function lsx_widget_area_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Home', 'lsx' ),
			'id'            => 'sidebar-home',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'lsx' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'lsx' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<div class="styler"><aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Call to Action', 'lsx' ),
			'id'            => 'sidebar-footer-cta',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

endif;

add_action( 'widgets_init', 'lsx_widget_area_init' );

if ( ! function_exists( 'lsx_sidebar_footer_params' ) ) :

	/**
	 * Register widgetized area and update sidebar with default widgets.
	 *
	 * @package    lsx
	 * @subpackage widgets
	 */
	function lsx_sidebar_footer_params( $params ) {
		$sidebar_id = $params[0]['id'];

		if ( 'sidebar-footer' === $sidebar_id ) {
			$total_widgets              = wp_get_sidebars_widgets();
			$sidebar_widgets            = count( $total_widgets[ $sidebar_id ] );
			$params[0]['before_widget'] = str_replace( 'class="styler', 'class="col-md-' . floor( 12 / $sidebar_widgets ), $params[0]['before_widget'] );
		}

		return $params;
	}

endif;

add_filter( 'dynamic_sidebar_params', 'lsx_sidebar_footer_params' );
