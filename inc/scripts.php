<?php
/**
 * Scripts and Styles file
 * See: http://jetpack.me/
 *
 * @package lsx
 */

/**
 * Enqueue scripts and styles.
 */
function lsx_scripts() {

	//wp_enqueue_style( 'lsx-style', get_stylesheet_uri() );

	
	wp_enqueue_style('lsx_main', get_template_directory_uri() . '/css/app.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');
	
	$style = get_theme_mod( 'lsx_color_scheme','default');
	wp_enqueue_style('lsx_color_scheme', get_template_directory_uri() . '/css/'.$style.'.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script('lsx_scripts', get_template_directory_uri() . '/js/scripts.min.js', false, 'c9f983e2965b9c7888dac272e56c4f4b', true);
	wp_register_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.7.0.min.js', false, null, false);
	wp_register_script('custom', get_template_directory_uri() . '/js/custom/general.js', false, null, false);
	wp_register_script('masonry', get_template_directory_uri().'/js/masonry.js', array('jquery'), null, true);
	wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('masonry');
	wp_enqueue_script('lsx_scripts');
	wp_enqueue_script('custom');
	wp_enqueue_style( 'genericons', get_stylesheet_directory_uri() . '/genericons/genericons.css' );
	if(is_child_theme()) {
	wp_enqueue_style( 'child-css', get_stylesheet_directory_uri() . '/custom.css' );
	
	}

	ob_start();
		wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav'));
		$output = htmlspecialchars(ob_get_contents());
	ob_end_clean();
		$menu_items = substr_count($output,'li class');
	if ($menu_items >= 7) {
		wp_enqueue_style('medium-break', get_template_directory_uri() . '//css/medium-nav-break.css', false);
	}
	//wp_enqueue_script( 'lsx-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
}
add_action( 'wp_enqueue_scripts', 'lsx_scripts' );