<?php
/**
 * LSX functions and definitions - Lazyload.
 *
 * @package    lsx
 * @subpackage lazyload
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSX_Lazy_Load_Images' ) ) :

	/*
	 * LSX Lazy Load Images Class
	 *
	 * add_filters availables:
	 *   lsx_lazyload_is_enabled
	 *   lsx_lazyload_placeholder_image
	 *
	 * apply_filters availables:
	 *   lsx_lazyload_filter_images
	 *
	 * Currently filtering:
	 *   the_content
	 *   widget_text
	 *   post_thumbnail_html
	 *   get_avatar
	 *   envira_gallery_output_image
	 *
	 * @package    lsx
	 * @subpackage lazyload
	 */
	class LSX_Lazy_Load_Images {

		protected static $enabled     = true;
		protected static $noscript_id = 0;
		protected static $noscripts   = array();

		static function init() {
			if ( is_admin() ) {
				return;
			}

			if ( get_theme_mod( 'lsx_lazyload_status', '1' ) === false ) {
				self::$enabled = false;
				return;
			}

			if ( ! apply_filters( 'lsx_lazyload_is_enabled', true ) ) {
				self::$enabled = false;
				return;
			}

			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_scripts' ) );
			add_action( 'wp_head', array( __CLASS__, 'setup_filters' ), 9999 );
			add_filter( 'wp_kses_allowed_html', array( __CLASS__, 'kses_allowed_html' ), 10, 2 );
		}

		static function setup_filters() {
			// WordPress
			add_filter( 'the_content', array( __CLASS__, 'filter_images' ), 200 );
			add_filter( 'widget_text', array( __CLASS__, 'filter_images' ), 200 );
			add_filter( 'post_thumbnail_html', array( __CLASS__, 'filter_images' ), 200 );
			add_filter( 'get_avatar', array( __CLASS__, 'filter_images' ), 200 );

			// LSX
			add_filter( 'lsx_lazyload_filter_images', array( __CLASS__, 'filter_images' ), 200 );

			// Envira Gallery
			add_filter( 'envira_gallery_output_image', array( __CLASS__, 'filter_images' ), 200 );
		}

		static function add_scripts() {
			wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/assets/js/vendor/lazysizes.min.js', array( 'jquery' ), LSX_VERSION, true );
			// Plugin that enables use lazysizes in brackground images
			//wp_enqueue_script( 'lazysizes', get_template_directory_uri() . '/assets/js/vendor/ls.unveilhooks.min.js', array( 'jquery', 'lazysizes' ), LSX_VERSION, true );
		}

		static function filter_images( $content ) {
			if ( ! self::is_enabled() ) {
				return $content;
			}

			$http_user_agent = sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) );
			$http_user_agent = ! empty( $http_user_agent ) ? $http_user_agent : '';

			if ( is_feed()
				|| is_preview()
				|| 1 === intval( get_query_var( 'print' ) )
				|| 1 === intval( get_query_var( 'printpage' ) )
				|| strpos( $http_user_agent, 'Opera Mini' ) !== false
			) {
				return $content;
			}

			$skip_images_regex = '/class=".*(lazyload|disable-lazyload).*"/';
			$placeholder_image = apply_filters( 'lsx_lazyload_placeholder_image', get_template_directory_uri() . '/assets/images/empty.gif' );

			$matches = array();
			$search = array();
			$replace = array();

			$content = preg_replace_callback( '~<noscript.+?</noscript>~s', 'self::noscripts_remove', $content );
			preg_match_all( '/<img[^>]*>/', $content, $matches );

			foreach ( $matches[0] as $img_html ) {
				if ( ! ( preg_match( $skip_images_regex, $img_html ) ) ) {
					$add_class = false;

					if ( ! preg_match( '/src=[\'"]([^\'"]+)[\'"]/', $img_html ) && preg_match( '/srcset=[\'"]([^\'"]+)[\'"]/', $img_html ) ) {
						$replace_html = preg_replace( '/<img(.*?)srcset=/i', '<img$1srcset="' . $placeholder_image . '" data-srcset=', $img_html );

						if ( preg_match( '/sizes=[\'"]([^\'"]+)[\'"]/', $img_html ) ) {
							$replace_html = preg_replace( '/sizes=/i', 'data-sizes=', $replace_html );
						} else {
							$replace_html = preg_replace( '/data-srcset=/i', 'data-sizes="auto" data-srcset=', $replace_html );
						}

						$add_class = true;
					} elseif ( preg_match( '/src=[\'"]([^\'"]+)[\'"]/', $img_html ) ) {
						$replace_html = preg_replace( '/<img(.*?)src=/i', '<img$1src="' . $placeholder_image . '" data-src=', $img_html );

						if ( preg_match( '/srcset=[\'"]([^\'"]+)[\'"]/', $img_html ) ) {
							if ( preg_match( '/sizes=[\'"]([^\'"]+)[\'"]/', $img_html ) ) {
								$replace_html = preg_replace( '/srcset=/i', 'data-srcset=', $replace_html );
								$replace_html = preg_replace( '/sizes=/i', 'data-sizes=', $replace_html );
							} else {
								$replace_html = preg_replace( '/srcset=/i', 'data-sizes="auto" data-srcset=', $replace_html );
							}
						}

						$add_class = true;
					}

					if ( $add_class ) {
						$replace_html = self::add_class( $replace_html, 'lazyload' );
						$replace_html .= '<noscript>' . $img_html . '</noscript>';

						array_push( $search, $img_html );
						array_push( $replace, $replace_html );
					}
				}
			}

			$content = str_replace( $search, $replace, $content );
			$content = preg_replace_callback( '~' . chr( 20 ) . '([0-9]+)' . chr( 20 ) . '~', 'self::noscripts_restore', $content );
			return $content;
		}

		static function noscripts_remove( $match ) {
			self::$noscript_id++;
			self::$noscripts[ self::$noscript_id ] = $match[0];
			return chr( 20 ) . self::$noscript_id . chr( 20 );
		}

		static function noscripts_restore( $match ) {
			return self::$noscripts[ (int) $match[1] ];
		}

		static function add_class( $html_string = '', $new_class ) {
			$pattern = '/class=[\'"]([^\'"]*)[\'"]/';

			if ( preg_match( $pattern, $html_string, $matches ) ) {
				$defined_classes = explode( ' ', $matches[1] );

				if ( ! in_array( $new_class, $defined_classes ) ) {
					$defined_classes[] = $new_class;

					$html_string = str_replace(
						$matches[0],
						sprintf( 'class="%s"', implode( ' ', $defined_classes ) ),
						$html_string
					);
				}
			} else {
				$html_string = preg_replace( '/(\<.+\s)/', sprintf( '$1class="%s" ', $new_class ), $html_string );
			}

			return $html_string;
		}

		static function is_enabled() {
			return self::$enabled;
		}

		static function kses_allowed_html( $allowedtags, $context ) {
			$allowedtags['noscript'] = array();

			$allowedtags['img']['data-src'] = true;
			$allowedtags['img']['data-srcset'] = true;
			$allowedtags['img']['data-sizes'] = true;

			return $allowedtags;
		}
	}

endif;

add_action( 'init', array( 'LSX_Lazy_Load_Images', 'init' ) );
