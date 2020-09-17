<?php
/**
 * LSX functions and definitions - Scripts.
 *
 * @package    lsx
 * @subpackage scripts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_scripts' ) ) :

	/**
	 * Enqueue scripts, fonts and styles.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts() {
		lsx_scripts_add_styles();
		lsx_scripts_add_scripts();
	}

endif;

add_action( 'wp_enqueue_scripts', 'lsx_scripts', 5 );

if ( ! function_exists( 'lsx_admin_scripts' ) ) :

	/**
	 * Enqueue scripts (admin).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_admin_scripts() {
		wp_enqueue_script( 'lsx-admin', get_template_directory_uri() . '/assets/js/admin/lsx-admin.js', array( 'jquery' ), LSX_VERSION, true );
	}

endif;

add_action( 'admin_enqueue_scripts', 'lsx_admin_scripts' );

if ( ! function_exists( 'lsx_scripts_add_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts_add_styles() {
		wp_enqueue_style( 'lsx_fonts', get_template_directory_uri() . '/assets/css/lsx-fonts.css', array(), LSX_VERSION );

		wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/vendor/font-awesome.css', array(), LSX_VERSION );
		wp_style_add_data( 'fontawesome', 'rtl', 'replace' );

		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/vendor/bootstrap.css', array(), LSX_VERSION );
		wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

		wp_enqueue_style( 'lsx_main', get_template_directory_uri() . '/assets/css/lsx.css', array( 'lsx_fonts', 'fontawesome', 'bootstrap'/*, 'slick'*/ ), LSX_VERSION );
		wp_enqueue_style( 'lsx_gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.css', array( 'lsx_main' ), LSX_VERSION );

		wp_style_add_data( 'lsx_main', 'rtl', 'replace' );
	}

endif;

if ( ! function_exists( 'lsx_scripts_add_scripts' ) ) :

	/**
	 * Enqueue scripts.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts_add_scripts() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'platform', get_template_directory_uri() . '/assets/js/vendor/platform.min.js', array(), LSX_VERSION, true );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), LSX_VERSION, true );

		wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array( 'masonry' ), LSX_VERSION, true );
		wp_enqueue_script( 'scrolltofixed', get_template_directory_uri() . '/assets/js/vendor/jquery-scrolltofixed-min.js', array( 'jquery' ), LSX_VERSION, true );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/vendor/slick.min.js', array( 'jquery' ), LSX_VERSION, true );
		wp_enqueue_script( 'slick-lightbox', get_template_directory_uri() . '/assets/js/vendor/slick-lightbox.min.js', array( 'jquery', 'slick' ), LSX_VERSION, true );
		wp_enqueue_script( 'picturefill', get_template_directory_uri() . '/assets/js/vendor/picturefill.min.js', array(), LSX_VERSION, true );

		if ( defined( 'SCRIPT_DEBUG' ) ) {
			$prefix = 'src/';
			$suffix = '';
		} else {
			$prefix = '';
			$suffix = '.min';
		}
		wp_enqueue_script( 'lsx_script', get_template_directory_uri() . '/assets/js/' . $prefix . 'lsx' . $suffix . '.js', array( 'jquery', 'platform', 'bootstrap', 'masonry', 'imagesLoaded', 'scrolltofixed', 'slick', 'slick-lightbox', 'picturefill' ), LSX_VERSION, true );

		$param_array = array(
			'columns'            => apply_filters( 'lsx_archive_column_number', 3 ),
			'stickyMenuSelector' => apply_filters( 'lsx_sticky_menu_selector', 'header.navbar' ),
		);

		wp_localize_script( 'lsx_script', 'lsx_params', $param_array );
	}

endif;

if ( ! function_exists( 'lsx_scripts_child_theme' ) ) :

	/**
	 * Enqueue scripts and styles (for child theme).
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts_child_theme() {
		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/custom.css' ) ) {
			wp_enqueue_style( 'child-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', array( 'lsx_main' ), LSX_VERSION );
			wp_style_add_data( 'child-css', 'rtl', 'replace' );
		}
	}

endif;

add_action( 'wp_enqueue_scripts', 'lsx_scripts_child_theme', 1999 );
