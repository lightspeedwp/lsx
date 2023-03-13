<?php
namespace LSX;

use LSX\Classes\Setup;
use LSX\Classes\Block_Setup;
use LSX\Classes\Block_Functions;

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
	 * Contains the class responsible for setting up theme.
	 *
	 * @var object
	 */
	public $setup;

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
	 * Loads the actions we need.
	 *
	 * @return void
	 */
	public function init() {
		//Load our files and includes
		$this->load_classes();

		// Initiate our classes.
		$this->setup->init();
		$this->block_setup->init();
		$this->block_functions->init();
	}

	/**
	 * Loads the classes
	 */
	public function load_classes() {
		require get_template_directory() . '/includes/classes/class-setup.php';
		$this->setup = new Setup();

		require get_template_directory() . '/includes/classes/class-block-setup.php';
		$this->block_setup = new Block_Setup();
		
		require get_template_directory() . '/includes/classes/class-block-functions.php';
		$this->block_functions = new Block_Functions();
	}
}
