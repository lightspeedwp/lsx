<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Holds functions for rest api specific actions.
 *
 * @author   LightSpeed
 * @category Widgets
 * @package  LSX
 * @return   LSX_Rest_Helper
 */
class LSX_Rest_Helper {

	/**
	 * Holds class instance
	 *
	 * @since 1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Holds the conditional.
	 *
	 * @var boolean
	 */
	protected $is_rest_request = false;

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'tribe_events_views_v2_rest_params', array( $this, 'check_event_request' ), 10, 2 );
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
	 * This will set the 'is_rest_request' variable as true if it runs. Tribe has already done the checkes for us.
	 *
	 * @param array $params
	 * @param array $request
	 * @return void
	 */
	public function check_event_request( $params, $request ) {
		$this->is_rest_request = true;
		return $params;
	}

	/**
	 * Determines if the request is an REST API request.
	 *
	 * @return bool True if it's a REST API request, false otherwise.
	 */
	public function is_rest_api_request() {
		if ( true === $this->is_rest_request ) {
			return $this->is_rest_request;
		}

		if ( empty( $_SERVER['REQUEST_URI'] ) ) {
			return false;
		}
		$rest_prefix         = trailingslashit( rest_get_url_prefix() );
		$this->is_rest_request = ( false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix ) );
		return $this->is_rest_request;
	}
}
$rest_helper = LSX_Rest_Helper::get_instance();
