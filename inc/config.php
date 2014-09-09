<?php
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

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on lsx, use a find and replace
	 * to change 'lsx' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'lsx', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lsx' ),
	) );	

}
endif; // lsx_setup
add_action( 'after_setup_theme', 'lsx_setup' );

function lsx_layout_selector( $class, $area = 'site' ) {
	
	$page_layout = get_post_meta( get_the_ID(), 'lsx_layout', true );
	
	if ( $area == 'home' ) {
		$layout = lsx_get_option('home_layout');
	}elseif ( $area == 'post' ) {
		$layout = lsx_get_option('post_layout');
	} else {
		if ( $page_layout && $page_layout != "default" ) {
			$layout = $page_layout;
		} else {
			$layout = lsx_get_option('site_layout');	
		}
	}

	$default_size = 'sm';
	$size = apply_filters( 'lsx_bootstrap_column_size', $default_size );

	switch ( $layout ) {
		case '1col':
			$main_class = 'col-' . $size . '-12';
			break;
		case '2c-l':
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
		case '2c-r':
			$main_class = 'col-' . $size . '-8 col-' . $size . '-push-4';
			$sidebar_class = 'col-' . $size . '-4 col-' . $size . '-pull-8';
			break;
		case '3c-l':
			$main_class = 'col-' . $size . '-7';
			$sidebar_class = 'col-' . $size . '-3';
			$sidebar_class_alt = 'col-' . $size . '-2';
			break;
		case '3c-m':
			$main_class = 'col-' . $size . '-7 col-' . $size . '-push-2';
			$sidebar_class = 'col-' . $size . '-3 col-' . $size . '-push-2';
			$sidebar_class_alt = 'col-' . $size . '-2 col-' . $size . '-pull-10';
			break;
		case '3c-r':
			$main_class = 'col-' . $size . '-7 col-' . $size . '-push-5';
			$sidebar_class = 'col-' . $size . '-3 col-' . $size . '-pull-7';
			$sidebar_class_alt = 'col-' . $size . '-2 col-' . $size . '-pull-7';
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

	if ( $class == 'sidebar_alt' ) {
		return $sidebar_class_alt;
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

function lsx_post_main_class() {
	return lsx_layout_selector( 'main', 'post' );
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

function lsx_post_sidebar_class() {
	return lsx_layout_selector( 'sidebar', 'post' );
}
/**
 * .sidebar classes
 */
function lsx_sidebar_alt_class() {
  	return lsx_layout_selector( 'sidebar_alt' );
}

function lsx_home_sidebar_alt_class() {
	return lsx_layout_selector( 'sidebar_alt', 'home' );
}

function lsx_post_sidebar_alt_class() {
	return lsx_layout_selector( 'sidebar_alt', 'post' );
}

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 1140; }

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