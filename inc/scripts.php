<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Enqueue scripts and styles.
 *
 * @package 	lsx
 * @subpackage	scripts
 */
function lsx_scripts() {
	global $content_width;
	
	wp_enqueue_style('lsx_main_style', get_stylesheet_uri() , false, '23a2bd43791de3fa3cab2d2af5fec6a2');
	
	wp_enqueue_style('lsx_main', get_template_directory_uri() . '/css/app.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');
	
	$style = get_theme_mod( 'lsx_color_scheme','default');
	wp_enqueue_style('lsx_color_scheme', get_template_directory_uri() . '/css/color-scheme-'.$style.'.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array('jquery'), 'c9f983e2965b9c7888dac272e56c4f4b', false);
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.7.0.min.js', array('jquery'), null, false);
	wp_enqueue_script('mousewheel', get_template_directory_uri() . '/js/vendor/jquery.mousewheel.min.js', array('jquery'), null, false);
	wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/vendor/jquery.simplr.smoothscroll.min.js', array('jquery'), null, false);
	wp_enqueue_script('sticky', get_template_directory_uri() . '/js/vendor/jquery.sticky.js', array('jquery'), null, false);

	wp_enqueue_script('masonry');
	wp_enqueue_script('imagesLoaded', get_template_directory_uri().'/js/vendor/imagesloaded.pkgd.min.js', array('jquery','masonry'));	
	wp_enqueue_script('lsx_script', get_template_directory_uri() . '/js/lsx-script.js', array('masonry'), null, false);
	
	//Set some parameters that we can use in the JS
	$is_portfolio = false;
	if(is_post_type_archive('jetpack-portfolio') || is_tax('jetpack-portfolio-type') || is_tax('jetpack-portfolio-tag') || is_page_template('page-templates/template-portfolio.php')){
		$is_portfolio = true;
	}
	$param_array = array(
			'is_portfolio' => $is_portfolio
	);
	//Set the columns for the archives
	$param_array['columns'] = apply_filters('lsx_archive_column_number',3);
	wp_localize_script( 'lsx_script', 'lsx_params', $param_array );
	
	
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css' );
	
	if(is_child_theme() && file_exists(get_stylesheet_directory() . '/custom.css')) {
		wp_enqueue_style( 'child-css', get_stylesheet_directory_uri() . '/custom.css' );
	}

	ob_start();
		wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav'));
		$output = htmlspecialchars(ob_get_contents());
	ob_end_clean();
		$menu_items = substr_count($output,'li class');
	if ($menu_items >= 7) {
		wp_enqueue_style('medium-break', get_template_directory_uri() . '/css/medium-nav-break.css', false);
	}
	
	
	$font = get_theme_mod('lsx_font','raleway_open_sans');
	switch($font){
		case 'raleway_open_sans':
			$header_font_location = 'Raleway';
			$body_font_location = 'Open+Sans';
		break;

		case 'noto_serif_noto_sans':
			$header_font_location = 'Noto+Serif';
			$body_font_location = 'Noto+Sans';
		break;
		
		case 'noto_sans_noto_sans':
			$header_font_location = 'Noto+Sans';
			$body_font_location = 'Noto+Sans';
		break;		

		case 'alegreya_open_sans':
			$header_font_location = 'Alegreya';
			$body_font_location = 'Open+Sans';
		break;	
				
		//raleway_open_sans
		default:
			$header_font_location = 'Raleway'; 
			$body_font_location = 'Open+Sans';
		break;
	}
	
	$http_var = 'http';
	if(is_ssl()){ $http_var .= 's'; }
	
	//Call the Google Fonts and then Enque them.
	wp_register_style('lsx-header-font', $http_var.'://fonts.googleapis.com/css?family='.$header_font_location);
	wp_register_style('lsx-body-font', $http_var.'://fonts.googleapis.com/css?family='.$body_font_location);
	wp_enqueue_style( 'lsx-header-font');
	wp_enqueue_style( 'lsx-body-font');
	
	wp_enqueue_style('lsx_font_scheme', esc_url( get_template_directory_uri() . '/css/'.$font.'.css'), false, '48a2bd26791de3fa7cab2d2af5fec6a4');
	
}
add_action( 'wp_enqueue_scripts', 'lsx_scripts' );