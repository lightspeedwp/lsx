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

add_action( 'wp_enqueue_scripts', 'lsx_scripts' );

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
		// Font data (full JSON)

		$data_fonts = get_transient( 'lsx_font_data' );

		if ( is_customize_preview() || false === $data_fonts ) {
			$data_fonts_file = get_template_directory() . '/assets/jsons/lsx-fonts.json';
			$data_fonts = lsx_file_get_contents( $data_fonts_file );
			$data_fonts = apply_filters( 'lsx_fonts_json', $data_fonts );
		}

		if ( ! empty( $data_fonts ) ) {
			set_transient( 'lsx_font_data', $data_fonts, ( 5 * 60 ) );
		}

		$data_fonts = '{' . $data_fonts . '}';
		$data_fonts = json_decode( $data_fonts, true );

		// Font data (saved)

		$font_saved = get_theme_mod( 'lsx_font', 'lora_noto_sans' );

		if ( isset( $data_fonts[ $font_saved ] ) ) {
			$font = $data_fonts[ $font_saved ];
		} else {
			$font = $data_fonts['lora_noto_sans'];
		}

		// Font declarations

		$font_declarations = get_transient( 'lsx_font_declarations' );

		if ( is_customize_preview() || false === $font_declarations ) {
			$font_declarations = array(
				'header' => '',
				'body' => '',
			);

			$fonts_to_load = array(
				'header' => $font['header'],
				'body' => $font['body'],
			);

			$font_declaration_placeholder_file = get_template_directory() . '/assets/css/lsx-fonts-placeholder.css';
			$font_declaration_placeholder = lsx_file_get_contents( $font_declaration_placeholder_file );

			foreach ( $fonts_to_load as $font_to_load_key => $font_to_load ) {
				$font_title = $font_to_load['title'];
				$font_title_sanitize = sanitize_title( $font_title );

				$font_data = explode( ':', $font_to_load['location'] );
				$font_weights = explode( ',', $font_data[1] );

				foreach ( $font_weights as $font_weight_key => $font_weight ) {
					$font_style = 'normal';

					if ( preg_match( '/^[0-9]+i$/', $font_weight ) ) {
						$font_style = 'italic';
						$font_weight = preg_replace( '/^([0-9]+)(i)$/', '$1', $font_weight );
					}

					$font_src = get_template_directory() . '/assets/fonts/' . $font_title_sanitize . '-' . $font_weight . '-' . $font_style;
					$font_src = apply_filters( 'lsx_fonts_src', $font_src, $font_title_sanitize, $font_weight, $font_style );

					$font_src_uri = get_template_directory_uri() . '/assets/fonts/' . $font_title_sanitize . '-' . $font_weight . '-' . $font_style;
					$font_src_uri = apply_filters( 'lsx_fonts_src_uri', $font_src_uri, $font_title_sanitize, $font_weight, $font_style );

					if ( file_exists( $font_src . '.ttf' ) && file_exists( $font_src . '.woff' ) ) {
						$font_declaration = $font_declaration_placeholder;
						$font_declaration = str_replace( '[font-family]', '\'' . $font_title . '\'', $font_declaration );
						$font_declaration = str_replace( '[font-style]', $font_style, $font_declaration );
						$font_declaration = str_replace( '[font-weight]', $font_weight, $font_declaration );
						$font_declaration = str_replace( '[font-src]', $font_src_uri, $font_declaration );
						$font_declaration = preg_replace( '/(\/\*# ).+( \*\/)/', '', $font_declaration );

						$font_declarations[ $font_to_load_key ] .= $font_declaration;
					}
				}
			}

			set_transient( 'lsx_font_declarations', $font_declarations, ( 24 * 60 * 60 ) );
		}

		$http_var = 'http';

		if ( is_ssl() ) {
			$http_var .= 's';
		}

		if ( ! empty( $font_declarations ) && is_array( $font_declarations ) ) {
			foreach ( $font_declarations as $font_declaration_key => $font_declaration ) {
				if ( ! empty( $font_declaration ) ) {
					wp_add_inline_style( 'lsx_main', $font_declaration );
				} else {
					wp_enqueue_style( 'lsx-' . $font_declaration_key . '-font', esc_url( $http_var . '://fonts.googleapis.com/css?family=' . $font[ $font_declaration_key ]['location'] ) );
				}
			}
		} else {
			wp_enqueue_style( 'lsx-header-font', esc_url( $http_var . '://fonts.googleapis.com/css?family=' . $font['header']['location'] ) );
			wp_enqueue_style( 'lsx-body-font', esc_url( $http_var . '://fonts.googleapis.com/css?family=' . $font['body']['location'] ) );
		}

		// Font styles

		$font_styles = get_transient( 'lsx_font_styles' );

		if ( is_customize_preview() || false === $font_styles ) {
			$font_styles = '';

			$css_fonts_file = get_template_directory() . '/assets/css/lsx-fonts.css';
			$css_fonts = lsx_file_get_contents( $css_fonts_file );
			$css_fonts = apply_filters( 'lsx_fonts_css', $css_fonts );

			if ( ! empty( $css_fonts ) ) {
				$font_styles = $css_fonts;
				$font_styles = str_replace( '[font-family-headings]', $font['header']['cssDeclaration'], $font_styles );
				$font_styles = str_replace( '[font-family-body]', $font['body']['cssDeclaration'], $font_styles );
				$font_styles = preg_replace( '/(\/\*# ).+( \*\/)/', '', $font_styles );
			}

			set_transient( 'lsx_font_styles', $font_styles, ( 24 * 60 * 60 ) );
		}

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

		wp_enqueue_script( 'platform', get_template_directory_uri() . '/assets/js/vendor/platform.min.js', array(), LSX_VERSION, false );
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
