<?php
/**
 * LSX functions and definitions - Customizer - Font.
 *
 * @package    lsx
 * @subpackage customizer
 * @category   font
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

if ( ! class_exists( 'LSX_Customize_Font_Control' ) ) :

	/**
	 * LSX_Customize_Font_Control Class
	 *
	 * @package    lsx
	 * @subpackage customizer
	 * @category   font
	 */
	class LSX_Customize_Font_Control extends WP_Customize_Control {

		public $fonts;

		/**
		 * Constructor.
		 */
		public function __construct( $manager, $id, $args ) {
			parent::__construct( $manager, $id, $args );

			add_action( 'after_switch_theme',   array( $this, 'set_theme_mod' ) );
			add_action( 'customize_save_after', array( $this, 'set_theme_mod' ) );
		}

		/**
		 * Enqueue the styles and scripts.
		 */
		public function enqueue() {
			wp_enqueue_style( 'lsx-font-picker-custom-control', get_template_directory_uri() . '/assets/css/admin/customizer-font.css', array(), LSX_VERSION );
			wp_style_add_data( 'lsx-font-picker-custom-control', 'rtl', 'replace' );

			wp_enqueue_script( 'lsx-font-picker-custom-control', get_template_directory_uri() . '/assets/js/admin/customizer-font.js', array(), LSX_VERSION );
		}

		/**
		 * Render the content on the theme customizer page.
		 */
		public function render_content() {
			if ( empty( $this->choices ) ) {
				return;
			}

			$fonts = array();

			foreach ( $this->choices as $slug => $font ) {
				$fonts[] = $font['header'];
				$fonts[] = $font['body'];
				$this->choices[ $slug ] = $font;
			}

			$saved_value = $this->value();
			?>
			<div class="fontPickerCustomControl">
				<select <?php $this->link(); ?>>
					<?php
						foreach ( $this->choices as $value => $conf ) {
							echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $value ) . '</option>';
						}
					?>
				</select>
				<div class="fancyDisplay">
					<ul>
						<?php
						foreach ( $this->choices as $key => $font ) {
							$class = null;

							if ( $key === $saved_value ) {
								$class = ' selected';
							}

							?>
							<li class="font-choice <?php echo esc_attr( $class ); ?>">
								<div class="<?php echo esc_attr( $font['header']['cssClass'] ); ?>"><?php echo esc_html( $font['header']['title'] ); ?></div>
								<small class="<?php echo esc_attr( $font['body']['cssClass'] ); ?>"><?php echo esc_html( $font['body']['title'] ); ?></small>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
			<script>
				jQuery(document).ready(function($) {
					$('.fontPickerCustomControl').fontPickerCustomControl();
				});
			</script>
			<?php
		}

		/**
		 * Assign CSS to theme mod.
		 */
		public function set_theme_mod() {
			$saved_value = $this->value();

			foreach ( $this->choices as $key => $font ) {
				if ( $key === $saved_value ) {
					$font_styles = $this->get_css( $font['header']['cssDeclaration'], $font['body']['cssDeclaration'] );

					if ( ! empty( $font_styles ) ) {
						set_transient( 'lsx_font_styles', $font_styles, ( 24 * 60 * 60 ) );
					}
				}
			}
		}

		/**
		 * Returns CSS.
		 */
		public function get_css( $font_header, $font_body ) {
			$css_fonts_file = get_template_directory() . '/assets/css/lsx-fonts.css';
			$css_fonts = lsx_file_get_contents( $css_fonts_file );
			$css_fonts = apply_filters( 'lsx_fonts_css', $css_fonts );

			if ( ! empty( $css_fonts ) ) {
				$css_fonts = str_replace( '[font-family-headings]', $font_header, $css_fonts );
				$css_fonts = str_replace( '[font-family-body]', $font_body, $css_fonts );
				$css_fonts = preg_replace( '/(\/\*# ).+( \*\/)/', '', $css_fonts );
				return $css_fonts;
			}

			return '';
		}

	}

endif;
