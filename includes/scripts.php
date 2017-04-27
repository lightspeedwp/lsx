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
	 * Enqueue scripts and styles.
	 *
	 * @package    lsx
	 * @subpackage scripts
	 */
	function lsx_scripts() {
		if ( defined( 'WP_DEBUG' ) && true === WP_DEBUG ) {
			$min = '';
		} else {
			$min = '.min';
		}

		// Styles

		wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/css/vendor/font-awesome.css', array(), LSX_VERSION );
		wp_style_add_data( 'fontawesome', 'rtl', 'replace' );

		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/vendor/bootstrap.css', array(), LSX_VERSION );
		wp_style_add_data( 'bootstrap', 'rtl', 'replace' );

		wp_enqueue_style( 'lsx_main_style', get_template_directory_uri() . '/style.css', array(), LSX_VERSION );
		wp_enqueue_style( 'lsx_main', get_template_directory_uri() . '/assets/css/lsx.css', array( 'lsx_main_style', 'fontawesome', 'bootstrap' ), LSX_VERSION );
		wp_style_add_data( 'lsx_main', 'rtl', 'replace' );

		if ( is_child_theme() && file_exists( get_stylesheet_directory() . '/assets/css/custom.css' ) ) {
			wp_enqueue_style( 'child-css', get_stylesheet_directory_uri() . '/assets/css/custom.css', array( 'lsx_main' ), LSX_VERSION );
			wp_style_add_data( 'child-css', 'rtl', 'replace' );
		}

		// Google Fonts

		$font = get_theme_mod( 'lsx_font', 'lora_noto_sans' );

		switch ( $font ) {
			case 'lora_noto_sans':
				$header_font_location    = 'Lora';
				$body_font_location      = 'Noto+Sans';
				$header_font_declaration = "'Lora', serif";
				$body_font_declaration   = "'Noto Sans', sans-serif";
				break;

			case 'raleway_open_sans':
				$header_font_location    = 'Raleway';
				$body_font_location      = 'Open+Sans';
				$header_font_declaration = "'Raleway', sans-serif";
				$body_font_declaration   = "'Open Sans', sans-serif";
				break;

			case 'noto_serif_noto_sans':
				$header_font_location    = 'Noto+Serif';
				$body_font_location      = 'Noto+Sans';
				$header_font_declaration = "'Noto Serif', serif";
				$body_font_declaration   = "'Noto Sans', sans-serif";
				break;

			case 'noto_sans_noto_sans':
				$header_font_location    = 'Noto+Sans';
				$body_font_location      = 'Noto+Sans';
				$header_font_declaration = "'Noto Sans', sans-serif";
				$body_font_declaration   = "'Noto Sans', sans-serif";
				break;

			case 'alegreya_open_sans':
				$header_font_location    = 'Alegreya';
				$body_font_location      = 'Open+Sans';
				$header_font_declaration = "'Alegreya', serif";
				$body_font_declaration   = "'Open Sans', sans-serif";
				break;

			default:
				$header_font_location    = 'Lora';
				$body_font_location      = 'Noto+Sans';
				$header_font_declaration = "'Lora', serif";
				$body_font_declaration   = "'Noto Sans', sans-serif";
				break;
		}

		$http_var = 'http';

		if ( is_ssl() ) {
			$http_var .= 's';
		}

		wp_enqueue_style( 'lsx-header-font', esc_url( $http_var . '://fonts.googleapis.com/css?family=' . $header_font_location ) );
		wp_enqueue_style( 'lsx-body-font', esc_url( $http_var . '://fonts.googleapis.com/css?family=' . $body_font_location ) );

		$font_styles = get_theme_mod( 'lsx_font_styles' );

		if ( is_customize_preview() || false === $font_styles ) {
			global $wp_filesystem;

			$css_fonts_file = get_template_directory() . '/assets/css/lsx-fonts.css';

			if ( ! empty( $header_font_declaration ) && ! empty( $body_font_declaration ) && file_exists( $css_fonts_file ) ) {
				if ( empty( $wp_filesystem ) ) {
					require_once( ABSPATH . '/wp-admin/includes/file.php' );
					WP_Filesystem();
				}

				if ( $wp_filesystem ) {
					$css_fonts = $wp_filesystem->get_contents( $css_fonts_file );

					if ( ! empty( $css_fonts ) ) {
						$css_fonts = str_replace( '[font-family-headings]', $header_font_declaration, $css_fonts );
						$css_fonts = str_replace( '[font-family-body]', $body_font_declaration, $css_fonts );
						$css_fonts = preg_replace( '/(\/\*# ).+( \*\/)/', '', $css_fonts );
						$font_styles = $css_fonts;
					}
				}
			}

			set_theme_mod( 'lsx_font_styles', $font_styles );
		}

		wp_add_inline_style( 'lsx_main', $font_styles );

		// Scripts

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		/* @TODO - Check if is still necessary */
		//wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/vendor/jquery.mousewheel.min.js', array( 'jquery' ), LSX_VERSION, true );
		//wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/vendor/jquery.simplr.smoothscroll.min.js', array( 'jquery' ), LSX_VERSION, true );

		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), LSX_VERSION, true );
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-3.5.0.min.js', array(), LSX_VERSION, false );

		wp_enqueue_script( 'imagesLoaded', get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js', array( 'masonry' ), LSX_VERSION, true );
		wp_enqueue_script( 'scrolltofixed', get_template_directory_uri() . '/assets/js/vendor/jquery-scrolltofixed-min.js', array( 'jquery' ), LSX_VERSION, true );
		wp_enqueue_script( 'picturefill', get_template_directory_uri() . '/assets/js/vendor/picturefill.min.js', array(), LSX_VERSION, true );

		wp_enqueue_script( 'lsx_script', get_template_directory_uri() . '/assets/js/lsx' . $min . '.js', array( 'jquery', 'bootstrap', 'modernizr', 'masonry', 'imagesLoaded', 'scrolltofixed', 'picturefill' ), LSX_VERSION, true );

		// Script parameters

		$is_portfolio = false;

		if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) || is_page_template( 'page-templates/template-portfolio.php' ) ) {
			$is_portfolio = true;
		}

		$param_array = array(
			'is_portfolio' => $is_portfolio,
			'columns'      => apply_filters( 'lsx_archive_column_number', 3 ),
		);

		wp_localize_script( 'lsx_script', 'lsx_params', $param_array );

	}

endif;

add_action( 'wp_enqueue_scripts', 'lsx_scripts' );
