<?php
namespace LSX\Classes;

/**
 * All the functions for setting up the theme.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Setup {

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Initiate our class.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'yoast_faq_asset_files' ) );
		add_action( 'init', array( $this, 'remove_customizer_menu' ), 10 );
	}

	/**
	 * Load the assets files for Yoast
	 *
	 * @return void
	 */
	public function yoast_faq_asset_files() {
		/**
		 * @todo Load the Yoast files conditionally
		 */
		wp_enqueue_style( 'lsx-yoast-faq-css', get_stylesheet_directory_uri() . '/assets/css/faq/style.min.css', array() );
		wp_enqueue_script( 'lsx-yoast-faq-js', get_stylesheet_directory_uri()  . '/assets/js/LSXFAQ-JS.min.js', array( "jquery" ), "1.0", true );
	}

	/**
	 * Removed the Customzer option from the Appearance Menu 
	 *
	 * @return void
	 */
	public function remove_customizer_menu() {
		remove_submenu_page( 'themes.php', 'customize.php' );
	}
}
