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
 * @return   LSX_Optimization
 */
class LSX_Optimization {

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
		add_filter( 'clean_url', array( $this, 'defer_parsing_of_js' ), 11, 1 );
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
	public function defer_parsing_of_js( $url ) {
		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}
		return "$url' defer ";
	}
}
LSX_Optimization::get_instance();
