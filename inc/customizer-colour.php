<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Customize Colour Swatch Control Class
 *
 * @since 1.0.0
 */

if ( !class_exists( 'WP_Customize_Control' ) ) {
	return;
}

class LSX_Customize_Colour_Control extends WP_Customize_Control {
	
	/**
	 * @access public
	 * @var array
	 */
	public $colours = array();

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

		if ( ! empty( $args['choices'] ) ) {
			$this->colours = $args['choices'];
		}
	}

	/**
	 * Enqueue scripts/styles for the color picker.
	 *
	 * @since 3.4.0
	 */
	public function enqueue() { 
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array('jquery'), null, true );
	}

	/**
	 * Render output
	 *
	 * @since 3.4.0
	 */
	public function render_content() {
		$set_value = $this->value();

		?> 
		<label>
			<?php if ( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
			<?php }
			if ( ! empty( $this->description ) ) { ?>
				<span class="description customize-control-description"><?php echo $this->description ?></span>
			<?php } ?>
			<select <?php $this->link() ?>>
				<?php
				foreach ( $this->colours as $key => $value ) {
					$sel = '';
					if ( $set_value == $key ) {
						$sel = ' selected="selected"';
					}
					echo '<option value="'. $key .'"'. $sel .'>'. $value['label'] .'</option>';
				}
				?>
			</select>
			</div>
		</label>
	<?php
	}
	
	/*
	public function get_color_scheme_choices() {
		$color_schemes                = $this->colours;
		$color_scheme_control_options = array();

		foreach ( $color_schemes as $color_scheme => $value ) {
			$color_scheme_control_options[ $color_scheme ] = $value['label'];
		}

		return $color_scheme_control_options;
	}

	public function get_color_scheme() {
		$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
		$color_schemes       = $this->colours;

		if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
			return $color_schemes[ $color_scheme_option ]['colors'];
		}

		return $color_schemes['default']['colors'];
	}

	public function sanitize_color_scheme( $value ) {
		$color_schemes = LSX_Customize_Colour_Control::get_color_scheme_choices();

		if ( ! array_key_exists( $value, $color_schemes ) ) {
			return 'default';
		}

		return $value;
	}
	*/
}
?>