<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * LSX Sensei Messages Class
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

		$sensei_messages = new Sensei_Messages();
		remove_action( 'sensei_single_course_content_inside_before', array( $sensei_messages, 'send_message_link' ), 35 );
		add_action( 'sensei_single_course_content_inside_before', array( $sensei_messages, 'send_message_link' ), 1 );
	}

} // End Class

new LSX_Sensei_Messages();
