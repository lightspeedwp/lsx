<?php
/**
 * LSX functions and definitions - Customizer - Core.
 *
 * @package    lsx
 * @subpackage customizer
 * @category   core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

if ( ! class_exists( 'LSX_Customize_Core_Control' ) ) :

	/**
	 * LSX_Customize_Core_Control Class
	 *
	 * @package    lsx
	 * @subpackage customizer
	 * @category   core
	 */
	class LSX_Customize_Core_Control extends WP_Customize_Control {

		public $type = 'core';

		/**
		 * Render output.
		 */
		public function render_content() {
			?>
			<label>
				<?php
				if ( ! empty( $this->label ) ) {
					?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<?php
				}
				if ( ! empty( $this->description ) ) {
					?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input <?php $this->link(); ?> type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->input_attrs(); ?>>
			</label>
			<?php
		}

	}

endif;
