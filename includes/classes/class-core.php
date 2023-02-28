<?php
namespace LSX;

use LSX\Classes\Block_Functions;
use LSX\Classes\Block_Setup;

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
	 * Contains the class responsible for setting up our blocks.
	 *
	 * @var object
	 */
	public $block_setup;

	/**
	 * Contains the class responsible altering / displaying the blocks.
	 *
	 * @var object
	 */
	public $block_functions;

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Loads the classes
	 */
	public function load_classes() {
		require get_template_directory() . '/includes/classes/class-block-setup.php';
		$this->block_setup = new Block_Setup();
		$this->block_setup->init();

		require get_template_directory() . '/includes/classes/class-block-functions.php';
		$this->block_functions = new Block_Functions();
		$this->block_functions->init();

		/*require get_template_directory() . '/includes/classes/class-lsx-schema-utils.php';
		require get_template_directory() . '/includes/classes/class-lsx-schema-graph-piece.php';
		require get_template_directory() . '/includes/classes/class-lsx-optimisation.php';
		require get_template_directory() . '/includes/classes/class-lsx-rest-helper.php';*/
	}
}
