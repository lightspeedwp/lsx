<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Customize Swatch Control Class
 *
 * @since 1.0.0
 */
if( !class_exists( 'WP_Customize_Control' ) ){
	return;
}
class LSX_Customize_Core_Control extends WP_Customize_Control {
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'core';

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		?> 
		<label>
			<?php if ( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
			<?php }
			if ( ! empty( $this->description ) ) { ?>
				<span class="description customize-control-description"><?php echo $this->description ?></span>
			<?php } ?>
			<input <?php $this->link() ?> type="checkbox" value="<?php echo esc_attr( $this->value() ) ?>" <?php $this->input_attrs() ?>>
		</label>
	<?php
	}

}

