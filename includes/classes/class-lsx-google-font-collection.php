<?php
/**
 * LSX functions and definitions - Customizer - Google Fonts Collection.
 *
 * @package    lsx
 * @subpackage customizer
 * @category   google-fonts
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSX_Google_Font_Collection' ) ) :

	/**
	 * Google Font Collection.
	 *
	 * Controls all of the data for the custom fonts used in the theme customizer.
	 *
	 * @package    lsx
	 * @subpackage customizer
	 * @category   google-fonts
	 */
	class LSX_Google_Font_Collection {

		private $fonts;

		public function __construct( $fonts ) {
			if ( empty( $fonts ) ) {
				return false;
			}

			foreach ( $fonts as $key => $value ) {
				if ( empty( $value['system'] ) ) {
					$this->fonts[ $value['title'] ] = new LSX_Google_Font( $value['title'], $value['location'], $value['cssDeclaration'], $value['cssClass'] );
				}
			}
		}

		/**
		 * Returns an array containing all of the font family names.
		 */
		public function get_font_family_name_array() {
			$result;

			foreach ( $this->fonts as $key => $value ) {
				$result[] = $value->__get( 'title' );
			}

			return $result;
		}

		/**
		 * Returns the font title.
		 */
		public function get_title( $key ) {
			return $this->fonts[ $key ]->__get( 'title' );
		}

		/**
		 * Returns the font location.
		 */
		public function get_location( $key ) {
			return $this->fonts[ $key ]->__get( 'location' );
		}

		/**
		 * Returns the font css declaration.
		 */
		public function get_css_declaration( $key ) {
			return $this->fonts[ $key ]->__get( 'cssDeclaration' );
		}

		/**
		 * Returns an array of css classes.
		 * Is used when displaying the fancy list of fonts in the theme customizer.
		 * Is used to send a JS file an array for the postMessage transport option in the theme customizer.
		 */
		public function get_css_class_array() {
			$result;

			foreach ( $this->fonts as $key => $value ) {
				$result[ $value->__get( 'title' ) ] = $value->__get( 'cssClass' );
			}

			return $result;
		}

		/**
		 * Returns the total number of fonts.
		 */
		public function get_total_number_of_fonts() {
			return count( $this->fonts );
		}

		/**
		 * Prints the links to the css files for the theme customizer.
		 */
		public function print_theme_customizer_css_locations() {
			foreach ( $this->fonts as $key => $value ) {
				$protocol = 'http';

				if ( is_ssl() ) {
					$protocol .= 's';
				}
				?>
				<link href="<?php echo esc_attr( $protocol ); ?>://fonts.googleapis.com/css?family=<?php echo esc_attr( $value->__get( 'location' ) ); ?>" rel='stylesheet'>
				<?php
			}
		}

		/**
		 * Prints the theme customizer css classes necessary to display all of the fonts.
		 */
		public function print_theme_customizer_css_classes() {
			?>
			<style type="text/css">
				<?php
					foreach ( $this->fonts as $key => $value ) {
						?>
						.<?php echo esc_attr( $value->__get( 'cssClass' ) ); ?>{
							font-family: <?php echo esc_attr( $value->__get( 'cssDeclaration' ) ); ?>;
						}
						<?php
					}
				?>
			</style>
			<?php
		}

	}

endif;
