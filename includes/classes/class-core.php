<?php
namespace LSX;

/**
 * The main file loading the rest of the files
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Core {

	/**
	 * Contructor
	 */
	public function __construct() {
		$this->load_classes();
	}

	/**
	 * Loads the classes
	 */
	private function load_classes() {

		require get_template_directory() . '/includes/classes/class-block-setup.php';

	}
}
