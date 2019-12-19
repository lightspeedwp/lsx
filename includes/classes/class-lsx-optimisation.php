<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Holds the speed optimization functions for LSX.
 *
 * @author   LightSpeed
 * @category Widgets
 * @package  LSX
 * @return   LSX_Optimisation
 */
class LSX_Optimisation {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Constructor.
	 */
	public function __construct() {
		//add_filter( 'style_loader_tag', array( $this, 'preload_css' ), 100, 4 );
		//add_filter( 'script_loader_tag', array( $this, 'defer_parsing_of_js' ), 100, 3 );
		add_action( 'init', array( $this, 'pum_remove_admin_bar_tools' ), 100 );
	}
	/**
	 * Return an instance of this class.
	 *
	 * @since 1.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {
		// If the single instance hasn't been set, set it now.
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Defers the JS loading till Last
	 *
	 * @param  string $url The url to check and defer.
	 * @return string
	 */
	public function preload_css( $tag, $handle, $href, $media ) {
		if ( 'lsx_fonts' === $handle || 'fontawesome' === $handle ) {
			$tag = str_replace( 'href', ' preload href', $tag );
		}
		return $tag;
	}

	/**
	 * Defers the JS loading till Last
	 *
	 * @param  string $url The url to check and defer.
	 * @return string
	 */
	public function defer_parsing_of_js( $tag, $handle, $href ) {
		$skip_defer = apply_filters( 'lsx_defer_parsing_of_js', false, $tag, $handle, $href );
		if ( ! is_admin() && false !== stripos( $href, '.js' ) && false === stripos( $href, 'jquery.js' ) && false === $skip_defer ) {
			$tag = str_replace( 'src=', ' defer src=', $tag );
		}
		return $tag;
	}

	public function pum_remove_admin_bar_tools() {
		remove_action( 'admin_bar_menu', array( 'PUM_Modules_Admin_Bar', 'toolbar_links' ), 999 );
		remove_action( 'wp_footer', array( 'PUM_Modules_Admin_Bar', 'admin_bar_styles' ), 999 );
		remove_action( 'init', array( 'PUM_Modules_Admin_Bar', 'show_debug_bar' ) );
	}
}
LSX_Optimisation::get_instance();
