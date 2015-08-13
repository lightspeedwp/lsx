<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Customizer Header Fixed Class
 *
 * @since 1.0.0
 */
if( !class_exists( 'WP_Customize_Control' ) ){
	return;
}
class LSX_Customize_Header_Fixed_Control extends WP_Customize_Control {
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
	 * Enqueue scripts/styles
	 *
	 * @since 3.4.0
	 */
	public function enqueue() {
		// 
		wp_enqueue_script( 'lsx-header-fixed-control', get_template_directory_uri() .'/js/customizer-header-fixed.js', array('jquery'), null, true );
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
			<div class="header-fixed">
				<label>
					<input <?php $this->link(); ?> type="checkbox" id="<?php echo $post_id; ?>" class="header-fixed <?php echo $class; ?>" value="<?php echo esc_attr($value); ?>" <?php $this->input_attrs(); ?>> Uncheck for standard header
				</label>
			</div>
		</label>
	<?php
	}

}