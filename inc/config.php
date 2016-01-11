<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

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
	'default-color' => 'FFF',
	) );	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array('image', 'video', 'gallery', 'audio', 'link', 'quote', 'aside') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lsx' ),
		'top-menu'=> __( 'Top Menu' , 'lsx' ),
		'social'=> __( 'Social Menu' , 'lsx' )
	) );	

	//Set the content width
	$content_width = 750;
	
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );	
	add_theme_support( 'html5', array( 'caption' ) );	
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

	if(
		is_page_template('page-templates/template-portfolio.php') ||
		is_page_template('page-templates/template-front-page.php') ||
		is_page_template('page-templates/template-full-width.php') ||
		is_post_type_archive('jetpack-portfolio') ||
		is_tax(array('jetpack-portfolio-type','jetpack-portfolio-tag')) ||
		is_singular('jetpack-portfolio')
	){
		$content_width = 1140;
	}
}
add_action('wp_head','lsx_process_content_width');


/**
 * Disable the comments form by default for the page post type.
 * @package	lsx
 * @subpackage config
 */
function lsx_page_comments_off( $data ) {

	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' && $data['post_title'] == __('Auto Draft','lsx') ) {
		$data['comment_status'] = 0;
		$data['ping_status'] = 0;
	}

	return $data;
}
add_filter( 'wp_insert_post_data', 'lsx_page_comments_off' );

/**
 * Disable the comments form by default for the page post type.
 * @package	lsx
 * @subpackage config
 */
function lsx_is_legacy($data) {

	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' && $data['post_title'] == __('Auto Draft','lsx') ) {
		$data['comment_status'] = 0;
		$data['ping_status'] = 0;
	}

	return $data;
}
add_filter( 'wp_insert_post_data', 'lsx_page_comments_off' );