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
class LSX_Customize_Layout_Control extends WP_Customize_Control {
	/**
	 * @access public
	 * @var string
	 */
	public $type = 'layout';

	/**
	 * @access public
	 * @var array
	 */
	public $statuses;

	/**
	 * @access public
	 * @var array
	 */
	public $layouts = array();

	/**
	 * Constructor.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string $id
	 * @param array $args
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if( !empty( $args['choices'] ) ){
			$this->layouts = $args['choices'];
		}
	}

	/**
	 * Enqueue scripts/styles for the color picker.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		// 
		wp_enqueue_script( 'lsx-layout-control', get_template_directory_uri() .'/js/customizer-layout.js', array('jquery'), null, true );
	}

	/**
	 * Render output
	 *
	 * @since 3.4.0
	 */
	public function render_content() {
		
		$post_id    = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
		$class = 'customize-control customize-control-' . $this->type;
		$value = $this->value();

		?>
		<label>
			<?php if ( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php }
			if ( ! empty( $this->description ) ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
			<div class="layouts-selector">
			<?php
			foreach( $this->layouts as $layout ){
				$sel = 'border: 1px solid transparent;';
				if( $value == $layout ){
					$sel = 'border: 1px solid rgb(43, 166, 203);';
				}
				echo '<img class="layout-button" style="padding:2px;'. $sel .'" src="' . get_template_directory_uri() .'/img/' . $layout . '.png" data-option="' . $layout . '">';
			}

			?>
			<input <?php $this->link(); ?> class="selected-layout <?php echo $class; ?>" id="<?php echo $post_id; ?>" type="hidden" value="<?php echo esc_attr($value); ?>" <?php $this->input_attrs(); ?>>
			</div>
		</label>
	<?php
	}

}

