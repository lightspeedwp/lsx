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
		lsx_scripts_add_fonts();
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
		wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/vendor/font-awesome.css', array(), LSX_VERSION );
		wp_style_add_data( 'fontawesome', 'rtl', 'replace' );

		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/vendor/bootstrap.css', array(), LSX_VERSION );
		wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/vendor/slick.css', array(), LSX_VERSION, null );
		wp_enqueue_style( 'slick-lightbox', get_template_directory_uri() . '/assets/css/vendor/slick-lightbox.css', array( 'slick' ), LSX_VERSION, null );

		wp_enqueue_style( 'lsx_main_style', get_template_directory_uri() . '/style.css', array(), LSX_VERSION );
		wp_enqueue_style( 'lsx_main', get_template_directory_uri() . '/assets/css/lsx.css', array( 'lsx_main_style', 'fontawesome', 'bootstrap', 'slick', 'slick-lightbox' ), LSX_VERSION );
		wp_style_add_data( 'lsx_main', 'rtl', 'replace' );
	}

endif;

if ( ! function_exists( 'lsx_scripts_add_fonts' ) ) :

	/**
	 * Enqueue fonts.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts_add_fonts() {
		$font = array(
			'lora_noto_sans' => array(
				'header' => array(
					'title'          => 'Lora',
					'location'       => 'Lora:400,400i,700,700i',
					'cssDeclaration' => "'Lora', serif",
					'cssClass'       => 'wp-customizer-lora',
				),
				'body' => array(
					'title'          => 'Noto Sans',
					'location'       => 'Noto+Sans:400,400i,700,700i',
					'cssDeclaration' => "'Noto Sans', sans-serif",
					'cssClass'       => 'wp-customizer-noto-sans',
				),
			),
		);

		// Font styles.
		$font_styles = '
			@font-face {
				font-family: \'Lora\';
				font-style: normal;
				font-weight: 400;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/lora/Lora-Regular.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Lora\';
				font-style: italic;
				font-weight: 400i;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/lora/Lora-Italic.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Lora\';
				font-style: normal;
				font-weight: 700;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/lora/Lora-Bold.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Lora\';
				font-style: italic;
				font-weight: 700i;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/lora/Lora-BoldItalic.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Noto Sans\';
				font-style: normal;
				font-weight: 400;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/noto_sans/NotoSans-Regular.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Noto Sans\';
				font-style: italic;
				font-weight: 400i;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/noto_sans/NotoSans-Italic.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Noto Sans\';
				font-style: normal;
				font-weight: 700;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/noto_sans/NotoSans-Bold.ttf" ) format("truetype");
			}
			@font-face {
				font-family: \'Noto Sans\';
				font-style: italic;
				font-weight: 700i;
				src: url( "' . get_stylesheet_directory_uri() . '/assets/fonts/noto_sans/NotoSans-BoldItalic.ttf" ) format("truetype");
			}

			body{font-family:\'Noto Sans\',sans-serif}
			h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6{font-family:\'Lora\',serif}
			.content-area blockquote:before,.widget-area blockquote:before{font-family:\'Lora\',serif}
			.wc-social-login:before{font-family:\'Lora\',serif}
			.blog article.post .entry-title .label-sticky,.blog article.page .entry-title .label-sticky,.blog article.lsx-slot .entry-title .label-sticky,.archive article.post .entry-title .label-sticky,.archive article.page .entry-title .label-sticky,.archive article.lsx-slot .entry-title .label-sticky,.search-results article.post .entry-title .label-sticky,.search-results article.page .entry-title .label-sticky,.search-results article.lsx-slot .entry-title .label-sticky{font-family:\'Noto Sans\',sans-serif}
			#respond .comment-reply-title>small{font-family:\'Noto Sans\',sans-serif}
			#comments .media-list .media .media-heading{font-family:\'Noto Sans\',sans-serif}
			.single-testimonial .entry-content:before{font-family:\'Lora\',serif}			
		';

		if ( ! empty( $font_styles ) ) {
			wp_add_inline_style( 'lsx_main', $font_styles );
		}
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

		wp_enqueue_script( 'lsx_script', get_template_directory_uri() . '/assets/js/lsx.min.js', array( 'jquery', 'platform', 'bootstrap', 'masonry', 'imagesLoaded', 'scrolltofixed', 'slick', 'slick-lightbox', 'picturefill' ), LSX_VERSION, true );

		$param_array = array(
			'columns' => apply_filters( 'lsx_archive_column_number', 3 ),
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
