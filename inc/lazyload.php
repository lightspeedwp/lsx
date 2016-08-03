<?php
if ( ! defined( 'ABSPATH' ) ) return;

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
 */
class LSX_LazyLoadImages {
	protected static $enabled = true;

	static function init() {
		if ( is_admin() )
			return;

		if ( ! apply_filters( 'lsx_lazyload_is_enabled', true ) ) {
			self::$enabled = false;
			return;
		}

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'add_scripts' ) );
		add_action( 'wp_head', array( __CLASS__, 'setup_filters' ), 9999 );
	}

	static function setup_filters() {
		// WordPress
		add_filter( 'the_content', array( __CLASS__, 'filter_images' ), 200 );
		add_filter( 'widget_text', array( __CLASS__, 'filter_images' ), 200 );
		add_filter( 'post_thumbnail_html', array( __CLASS__, 'filter_images' ), 200 );
		add_filter( 'get_avatar', array( __CLASS__, 'filter_images' ), 200 );
		
		// LSX
		add_filter( 'lsx_lazyload_filter_images', array( __CLASS__, 'filter_images' ), 200 );
	}

	static function add_scripts() {
		wp_enqueue_script( 'lazysizes', get_template_directory_uri() .'/js/vendor/lazysizes.min.js', array( 'jquery' ), null, true );
		// Plugin that enables use lazysizes in brackground images
		//wp_enqueue_script( 'lazysizes', get_template_directory_uri() .'/js/vendor/ls.unveilhooks.min.js', array( 'jquery', 'lazysizes' ), null, true );
	}

	static function filter_images( $content ) {
		if ( ! self::is_enabled() )
			return $content;

		if ( is_feed()
			|| is_preview()
			|| intval( get_query_var( 'print' ) ) == 1
			|| intval( get_query_var( 'printpage' ) ) == 1
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
		) {
			return $content;
		}

		$skip_images_regex = '/class=".*(lazyload|disable-lazyload).*"/';
		$placeholder_image = apply_filters( 'lsx_lazyload_placeholder_image', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );

		$matches = array();
		$search = array();
		$replace = array();
		
		preg_match_all( '/<img\s+.*?>/', $content, $matches );

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
		return $content;
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
}

add_action( 'init', array( 'LSX_LazyLoadImages', 'init' ) );
