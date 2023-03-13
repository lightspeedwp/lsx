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
		add_action( 'init', array( $this, 'remove_customizer_menu' ), 10 );
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
