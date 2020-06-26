<?php
/**
 * LSX Yoast Class
 *
 * @package    lsx
 * @subpackage yoast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSX_Yoast' ) ) :

	/**
	 * The LSX Yoast integration class
	 */
	class LSX_Yoast {

		/**
		 * Holds class instance
		 *
		 * @since 1.0.0
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			add_action( 'wp_enqueue_scripts', array( $this, 'lsx_yoast_scripts_add_styles' ) );
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
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Yoast enqueue styles.
		 *
		 * @package    lsx
		 * @subpackage yoast
		 */
		public function lsx_yoast_scripts_add_styles() {
			wp_enqueue_script( 'lsx_yoast_js', get_template_directory_uri() . '/assets/js/yoast/yoast.js', array( 'jquery' ), LSX_VERSION, true );
			wp_enqueue_style( 'lsx_yoast_css', get_template_directory_uri() . '/assets/css/yoast/yoast.css', array( 'lsx_main' ), LSX_VERSION );
		}
	}

endif;

LSX_Yoast::get_instance();
