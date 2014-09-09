<?php

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function lsx_widgets_init() {
	
	$layout = lsx_get_option('home_layout','2c-l');
	$show_on_front = get_option('show_on_front');
	
	if(false != $show_on_front && 'page' == $show_on_front){
		register_sidebar( array(
			'name'          => __( 'Homepage Column 1', 'lsx' ),
			'id'            => 'hompage-col-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}	
	
	if('2c-r' == $layout || '2c-l' == $layout || '3c-,' == $layout || '3c-l' == $layout || '3c-r' == $layout ){
		register_sidebar( array(
			'name'          => __( 'Homepage Column 2', 'lsx' ),
			'id'            => 'hompage-col-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}	
	
	if('3c-,' == $layout || '3c-l' == $layout || '3c-r' == $layout ){
		register_sidebar( array(
		'name'          => __( 'Homepage Column 3', 'lsx' ),
			'id'            => 'hompage-col-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}	
	
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lsx' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar - Secondary', 'lsx' ),
		'id'            => 'sidebar-2',
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
}
add_action( 'widgets_init', 'lsx_widgets_init' );

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