<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Theme Configuration File
 * See: http://jetpack.me/
 *
 * @package lsx
 */

if ( ! function_exists( 'lsx_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lsx_setup() {
	global $content_width;
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lsx, use a find and replace
	 * to change 'lsx' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lsx', get_template_directory() . '/languages' );
	
	$args = array(
			'header-text' => array(
					'site-title',
					'site-description',
			),
			'size' => 'medium',
	);
	add_theme_support( 'site-logo', $args );

	
	add_theme_support( 'custom-background', array(
	// Background color default
	'default-color' => 'FFF',
	// Background image default
	) );	

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	/*
	 * Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array('image', 'video', 'gallery') );
	
	
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'type' => 'click',
		'posts_per_page' => get_option('posts_per_page',10),
	) );	
		

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lsx' ),
	) );	
	
	add_theme_support( 'content-width', array(
		'widths' => array(
			'1' => array(
				'label' => __( '1 Column', 'lsx' ),
				'value' => '1140',
			),
			'2' => array(
				'label' => __( '2 Column', 'lsx' ),
				'value' => '750',
			),
		)
	));
	
}
endif; // lsx_setup
add_action( 'after_setup_theme', 'lsx_setup' );


/**
 * $overwrite the $content_width var, based on the layout of the page.
 */
function lsx_process_content_width() {
	global $content_width;

	/**
	 * $content_width is a global variable used by WordPress for max image upload sizes
	 * and media embeds (in pixels).
	 *
	 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
	 * Default: 1140px is the default Bootstrap container width.
	 */
	
	$content_column_widths = get_theme_support('content-width');
	if(false != $content_column_widths){

		$layout = get_theme_mod('lsx_layout','2cr');
		if(
			is_page_template('page-templates/template-portfolio.php') ||
			is_page_template('page-templates/template-front-page.php') ||
			is_page_template('page-templates/template-full-width.php') ||
			is_post_type_archive('jetpack-portfolio') ||
			is_tax(array('jetpack-portfolio-type','jetpack-portfolio-tag'))
		){
			$layout = '1c';
		}

		if(stristr($layout, '1')){
			$content_width = $content_column_widths[0]['widths']['1']['value'];
		}elseif(stristr($layout, '2')){
			$content_width = $content_column_widths[0]['widths']['2']['value'];
		}

	}
	
}
add_action('wp_head','lsx_process_content_width');


function lsx_layout_selector( $class, $area = 'site' ) {
		
	$layout = get_theme_mod('lsx_layout');

	$default_size = 'sm';
	$size = apply_filters( 'lsx_bootstrap_column_size', $default_size );

	switch ( $layout ) {
		case '1c':
			$main_class = 'col-' . $size . '-12';
			$sidebar_class = 'col-' . $size . '-12';
			break;
		case '2cl':
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
		case '2cr':
			$main_class = 'col-' . $size . '-8 col-' . $size . '-push-4';
			$sidebar_class = 'col-' . $size . '-4 col-' . $size . '-pull-8';
			break;
		default:
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
	}

	if ( $class == 'main' ) {
		return $main_class;
	}

	if ( $class == 'sidebar' ) {
		return $sidebar_class;
	}
}

/**
 * .main classes
 */
function lsx_main_class() {
  	return lsx_layout_selector( 'main' );
}

function lsx_home_main_class() {
	return lsx_layout_selector( 'main', 'home' );
}

/**
 * Outputs the class for the main div on the index.php page only
 */
function lsx_index_main_class() {
	
	$show_on_front = get_option('show_on_front');
	if('page' == $show_on_front){
		return lsx_layout_selector( 'main', 'home' );
	}else{
		return lsx_layout_selector( 'main', 'site' );
	}
	
}

/**
 * .sidebar classes
 */
function lsx_sidebar_class() {
  	return lsx_layout_selector( 'sidebar' );
}

function lsx_home_sidebar_class() {
	return lsx_layout_selector( 'sidebar', 'home' );
}

/**
 * Disable the comments form by default for the page post type.
 */
function lsx_page_comments_off( $data ) {

	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' && $data['post_title'] == 'Auto Draft' ) {
		$data['comment_status'] = 0;
		$data['ping_status'] = 0;
	}

	return $data;
}
add_filter( 'wp_insert_post_data', 'lsx_page_comments_off' );