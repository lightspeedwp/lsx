<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Sensei Messages Class
 *
 * All functionality pertaining to the Messages post type in Sensei.
 *
 */
class LSX_Sensei_Messages {

	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	} // End __construct()

	/**
	 * Fetches an instance of the class.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Run our changes.
	 */
	public function init() {

	}

} // End Class

new LSX_Sensei_Messages();
