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
	
	
	
	$infinite_scroll_args = array(
		'container' => 'main',
		'type' => 'click',
		'posts_per_page' => get_option('posts_per_page',10),
		'render'    => 'lsx_infinite_scroll_render'
	);
	
	$page_url = $_SERVER["REQUEST_URI"];
	$portfolio_archive_slug = get_theme_mod('lsx_portfolio_slug','portfolio');
	
	if(stristr($page_url, $portfolio_archive_slug)){
		$infinite_scroll_args['container'] = 'portfolio-infinite-scroll-wrapper';
	}
	
	add_theme_support( 'infinite-scroll', $infinite_scroll_args );

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
 * Overwrite the $content_width var, based on the layout of the page.
 * 
 * @package	lsx
 * @subpackage config
 * @category content_width
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


/*
 * ===================	Tiny MCE  ===================
 */

/**
 * Adds a Button to the second row of TinyMCE Buttons
 * 
 * @package	lsx
 * @subpackage config
 * @category TinyMCE
 * @param	$buttons array()
 * @return	$buttons array()
 */
function lsx_mce_buttons_2($buttons) {
	
	array_unshift($buttons, 'styleselect');
	return $buttons;
	
}
add_filter('mce_buttons_2', 'lsx_mce_buttons_2');


/**
 *  Callback function to filter the MCE settings
 *
 * @package	lsx
 * @subpackage config
 * @category TinyMCE
 * @param	$init_array array()
 * @return	$init_array array()
 */
function lsx_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
			// Each array child is a format with it's own settings
			array(
					'title' => 'Content Block',
					'block' => 'span',
					'classes' => 'content-block',
					'wrapper' => true,
						
			),
			array(
					'title' => 'Blue Button',
					'block' => 'span',
					'classes' => 'blue-button',
					'wrapper' => true,
			),
			array(
					'title' => 'Red Button',
					'block' => 'span',
					'classes' => 'red-button',
					'wrapper' => true,
			),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );
	return $init_array;

}
add_filter( 'tiny_mce_before_init', 'lsx_mce_before_init_insert_formats' );

/**
 *  Registers our themes editor stylesheet.
 *
 * @package	lsx
 * @subpackage config
 * @category TinyMCE
 * @param	$init_array array()
 * @return	$init_array array()
 */
function lsx_add_editor_styles() {
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );
}
add_action( 'init', 'lsx_add_editor_styles' );

