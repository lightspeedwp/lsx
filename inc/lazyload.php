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
 *   envira_gallery_output_image
 */
class LSX_LazyLoadImages {
	protected static $enabled = true;

	static function init() {
		if ( is_admin() )
			return;

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
		wp_enqueue_script( 'lazysizes', get_template_directory_uri() .'/js/vendor/lazysizes.min.js', array( 'jquery' ), null, true );
		// Plugin that enables use lazysizes in brackground images
		//wp_enqueue_script( 'lazysizes', get_template_directory_uri() .'/js/vendor/ls.unveilhooks.min.js', array( 'jquery', 'lazysizes' ), null, true );
	}

	static function filter_images( $content ) {
		if ( ! self::is_enabled() ) {
			return $content;
		}

		if ( is_feed()
			|| is_preview()
			|| intval( get_query_var( 'print' ) ) == 1
			|| intval( get_query_var( 'printpage' ) ) == 1
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
		) {
			return $content;
		}

		$libxml_previous_state = libxml_use_internal_errors( true );
		$post = new DOMDocument( '1.0', 'UTF-8' );
		$loaded = $post->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
		libxml_clear_errors();
		libxml_use_internal_errors( $libxml_previous_state );
		
		if ( ! $loaded ) {
			return $content;
		}

		$placeholder_image = apply_filters( 'lsx_lazyload_placeholder_image', 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' );
		$imgs = $post->getElementsByTagName( 'img' );

		foreach( $imgs as $img ) {
			$class = '';

			if ( $img->hasAttribute( 'class' ) ) {
				$class = $img->getAttribute( 'class' );

				if ( strstr( $class, 'lazyload' ) ) {
					continue;
				}
			}

			if ( $img->parentNode->tagName == 'noscript' ) {
				continue;
			}

			$src_test = $img->hasAttribute( 'src' ) && ! empty( $img->getAttribute( 'src' ) );
			$srcset_test = $img->hasAttribute( 'srcset' ) && ! empty( $img->getAttribute( 'srcset' ) );
			
			if ( $src_test || $srcset_test ) {
				$clone = $img->cloneNode();
				$sizes_test = $img->hasAttribute( 'sizes' ) && ! empty( $img->getAttribute( 'sizes' ) );

				if ( $src_test ) {
					$src = $img->getAttribute( 'src' );
					$img->setAttribute( 'src', $placeholder_image );
					$img->setAttribute( 'data-src', $src );
				}

				if ( $srcset_test ) {
					$srcset = $img->getAttribute( 'srcset' );
					$img->setAttribute( 'srcset', $placeholder_image );
					$img->setAttribute( 'data-srcset', $srcset );
				}
				
				if ( $sizes_test ) {
					$sizes = $img->getAttribute( 'sizes' );
					$img->removeAttribute( 'sizes' );   
					$img->setAttribute( 'data-sizes', $sizes );
				} else {
					$img->setAttribute( 'data-sizes', 'auto' );
				}

				$classes = array( $class, 'lazyload' );
				$img->setAttribute( 'class', implode( ' ', $classes ) );

				$no_script = $post->createElement( 'noscript' );
				$no_script->appendChild( $clone );
				$img->parentNode->insertBefore( $no_script, $img );
			}
		};

		return $post->saveHTML();
	}

	static function is_enabled() {
		return self::$enabled;
	}
}

add_action( 'init', array( 'LSX_LazyLoadImages', 'init' ) );
