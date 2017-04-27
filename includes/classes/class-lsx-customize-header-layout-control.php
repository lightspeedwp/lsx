<?php
/**
 * LSX functions and definitions - Customizer - Header Layout.
 *
 * @package    lsx
 * @subpackage customizer
 * @category   header-layout
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

if ( ! class_exists( 'LSX_Customize_Header_Layout_Control' ) ) :

	/**
	 * LSX_Customize_Header_Layout_Control Class
	 *
	 * @package    lsx
	 * @subpackage customizer
	 * @category   header-layout
	 */
	class LSX_Customize_Header_Layout_Control extends WP_Customize_Control {

		public $type     = 'layout';
		public $statuses;
		public $layouts  = array();

		public function __construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );

			if ( ! empty( $args['choices'] ) ) {
				$this->layouts = $args['choices'];
			}
		}

		/**
		 * Enqueue scripts/styles for the color picker.
		 */
		public function enqueue() {
			wp_enqueue_script( 'lsx-header-layout-control', get_template_directory_uri() . '/assets/js/admin/customizer-header-layout.js', array( 'jquery' ), LSX_VERSION, true );
		}

		/**
		 * Render output.
		 */
		public function render_content() {
			$post_id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
			$class   = 'customize-control customize-control-' . $this->type;
			$value   = $this->value();
			?>
			<label>
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php }
				if ( ! empty( $this->description ) ) { ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<div class="header-layouts-selector">
					<?php
						foreach ( $this->layouts as $layout ) {
							$sel = 'border: 1px solid transparent;';
							if ( $value === $layout ) {
								$sel = 'border: 1px solid rgb(43, 166, 203);';
							}
							echo '<img class="header-layout-button" style="padding:2px;' . esc_attr( $sel ) . '" src="' . esc_attr( get_template_directory_uri() ) . '/assets/images/admin/header-' . esc_attr( $layout ) . '.png" data-option="' . esc_attr( $layout ) . '">';
						}
					?>
					<input <?php $this->link(); ?> class="selected-header-layout <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $post_id ); ?>" type="hidden" value="<?php echo esc_attr( $value ); ?>" <?php $this->input_attrs(); ?>>
				</div>
			</label>
			<?php
		}

	}

endif;
