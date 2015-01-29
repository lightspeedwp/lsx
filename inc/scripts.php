	<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Enqueue scripts and styles.
 *
 * @package 	lsx
 * @subpackage	scripts
 */
function lsx_scripts() {
	
	wp_enqueue_style('lsx_main', get_template_directory_uri() . '/css/app.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');
	
	$style = get_theme_mod( 'lsx_color_scheme','default');
	wp_enqueue_style('lsx_color_scheme', get_template_directory_uri() . '/css/'.$style.'.css', false, '48a2bd26791de3fa7cab2d2af5fec6a2');
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script('lsx_scripts', get_template_directory_uri() . '/js/scripts.min.js', false, 'c9f983e2965b9c7888dac272e56c4f4b', true);
	wp_register_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.7.0.min.js', false, null, false);
	wp_enqueue_script('isotope', get_template_directory_uri().'/js/jquery.isotope.min.js', array('jquery'), '1.3.110525', true);
	wp_enqueue_script('imagesLoaded', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array('jquery'));
	
	wp_register_script('custom', get_template_directory_uri() . '/js/custom/general.js', array('isotope'), null, false);
	
	//Set some parameters that we can use in the JS
	$is_portfolio = false;
	if(is_post_type_archive('jetpack-portfolio') || is_tax('jetpack-portfolio-type') || is_tax('jetpack-portfolio-tag') || is_page_template('page-templates/template-portfolio.php')){
		$is_portfolio = true;
	}
	$param_array = array(
			'is_portfolio' => $is_portfolio
	);
	wp_localize_script( 'custom', 'lsx_params', $param_array );
	
	wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('isotope');
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
		wp_enqueue_style('medium-break', get_template_directory_uri() . '/css/medium-nav-break.css', false);
	}
	//wp_enqueue_script( 'lsx-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	
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
	
	//Call the Google Fonts and then Enque them.
	wp_register_style('lsx-header-font', 'http://fonts.googleapis.com/css?family='.$header_font_location);
	wp_register_style('lsx-body-font', 'http://fonts.googleapis.com/css?family='.$body_font_location);
	wp_enqueue_style( 'lsx-header-font');
	wp_enqueue_style( 'lsx-body-font');
	
	wp_enqueue_style('lsx_font_scheme', esc_url( get_template_directory_uri() . '/css/'.$font.'.css'), false, '48a2bd26791de3fa7cab2d2af5fec6a4');
	
}
add_action( 'wp_enqueue_scripts', 'lsx_scripts' );