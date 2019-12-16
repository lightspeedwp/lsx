<?php
/**
 * LSX functions and definitions - Config.
 *
 * @package    lsx
 * @subpackage 404-widget
 */

if ( ! function_exists( 'lsx_widget_area_404_init' ) ) :
	/**
	 * Add Widget.
	 *
	 * @package    lsx
	 * @subpackage 404-widget
	 */
	function lsx_widget_area_404_init() {
		register_sidebar(
			array(
				'name'          => esc_html__( '404 page', 'lsx' ),
				'id'            => 'sidebar-404',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

endif;

add_action( 'widgets_init', 'lsx_widget_area_404_init' );

if ( ! function_exists( 'my_search_placeholder' ) ) :
	/**
	 * Placeholder.
	 *
	 * @package    lsx
	 * @subpackage 404-widget
	 */
	function my_search_placeholder() {
		return __( 'lsdev.biz', 'lsx' );
	}

endif;

add_filter( 'search_placeholder_text', 'my_search_placeholder' );
