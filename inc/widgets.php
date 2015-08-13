<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function lsx_widget_area_init() {
	
	register_sidebar( array(
		'name'          => __( 'Home', 'lsx' ),
		'id'            => 'sidebar-home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lsx' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'lsx' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<div class="styler"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Call to Action', 'lsx' ),
		'id'            => 'sidebar-footer-cta',
		'before_widget' => '<div class="styler"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'lsx_widget_area_init' );

function lsx_sidebar_footer_params( $params ) {

    $sidebar_id = $params[0]['id'];

    if ( $sidebar_id == 'sidebar-footer' ) {

        $total_widgets = wp_get_sidebars_widgets();
        $sidebar_widgets = count($total_widgets[$sidebar_id]);

        $params[0]['before_widget'] = str_replace('class="styler', 'class="col-sm-' . floor(12 / $sidebar_widgets), $params[0]['before_widget']);
    }

    return $params;
}
add_filter( 'dynamic_sidebar_params', 'lsx_sidebar_footer_params' ); 