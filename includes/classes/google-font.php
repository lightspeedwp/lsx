<?php
/**
 * LSX functions and definitions - Customizer - Google Font
 *
 * @package    lsx
 * @subpackage customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSX_Google_Font' ) ) :

	/**
	 * Google Font
	 *
	 * @package    lsx
	 * @subpackage customizer
	 */
	class LSX_Google_Font {

		private $title;
		private $location;
		private $css_declaration;
		private $css_class;

		/**
		 * Constructor
		 */
		public function __construct( $title, $location, $css_declaration, $css_class ) {
			$this->title           = $title;
			$this->location        = $location;
			$this->css_declaration = $css_declaration;
			$this->css_class       = $css_class;
		}

		/**
		 * Getter
		 */
		public function __get( $property ) {
			if ( property_exists( $this, $property ) ) {
				return $this->$property;
			}
		}

	}

endif;
