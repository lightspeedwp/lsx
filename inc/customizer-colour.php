<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Customize Colour Control Class
 *
 * @since 1.7.0
 */

if ( !class_exists( 'WP_Customize_Control' ) ) {
	return;
}

class LSX_Customize_Colour_Control extends WP_Customize_Control {
	
	/**
	 * Constructor.
	 *
	 * Supplied `$args` override class property defaults.
	 *
	 * If `$args['settings']` is not defined, use the $id as the setting ID.
	 *
	 * @param WP_Customize_Manager $manager Customizer bootstrap instance.
	 * @param string               $id      Control ID.
	 * @param array                $args    {
	 *     Optional. Arguments to override class property defaults.
	 *
	 *     @type int                  $instance_number Order in which this instance was created in relation
	 *                                                 to other instances.
	 *     @type WP_Customize_Manager $manager         Customizer bootstrap instance.
	 *     @type string               $id              Control ID.
	 *     @type array                $settings        All settings tied to the control. If undefined, `$id` will
	 *                                                 be used.
	 *     @type string               $setting         The primary setting for the control (if there is one).
	 *                                                 Default 'default'.
	 *     @type int                  $priority        Order priority to load the control. Default 10.
	 *     @type string               $section         Section the control belongs to. Default empty.
	 *     @type string               $label           Label for the control. Default empty.
	 *     @type string               $description     Description for the control. Default empty.
	 *     @type array                $choices         List of choices for 'radio' or 'select' type controls, where
	 *                                                 values are the keys, and labels are the values.
	 *                                                 Default empty array.
	 *     @type array                $input_attrs     List of custom input attributes for control output, where
	 *                                                 attribute names are the keys and values are the values. Not
	 *                                                 used for 'checkbox', 'radio', 'select', 'textarea', or
	 *                                                 'dropdown-pages' control types. Default empty array.
	 *     @type array                $json            Deprecated. Use {@see WP_Customize_Control->json()} instead.
	 *     @type string               $type            Control type. Core controls include 'text', 'checkbox',
	 *                                                 'textarea', 'radio', 'select', and 'dropdown-pages'. Additional
	 *                                                 input types such as 'email', 'url', 'number', 'hidden', and
	 *                                                 'date' are supported implicitly. Default 'text'.
	 * }
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );

		add_action( 'customize_controls_print_footer_scripts', array( $this, 'lsx_color_scheme_css_template' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'lsx_color_scheme_css' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'lsx_link_color_css' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'lsx_main_text_color_css' ), 11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'lsx_secondary_text_color_css' ), 11 );
	}

	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array( 'customize-controls', 'wp-util' ), null, true );
		wp_localize_script( 'lsx-colour-control', 'colorScheme', $this->choices );
	}

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper in $this->render().
	 *
	 * Supports basic input types `text`, `checkbox`, `textarea`, `radio`, `select` and `dropdown-pages`.
	 * Additional input types such as `email`, `url`, `number`, `hidden` and `date` are supported implicitly.
	 *
	 * Control content can alternately be rendered in JS. See {@see WP_Customize_Control::print_template()}.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

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
					foreach ( $this->choices as $value => $label ) {
						echo '<option value="'. esc_attr( $value ) .'"'. selected( $this->value(), $value, false ) .'>'. $label['label'] .'</option>';
					}
				?>
			</select>
		</label>
	<?php
	}

	// *********************************************************************
	// *********************************************************************
	// *********************************************************************
	// *********************************************************************
	// *********************************************************************

	/**
	 * Outputs an Underscore template for generating CSS for the color scheme.
	 */
	public function lsx_color_scheme_css_template() {
		$colors = array(
			'background_color'      => '{{ data.background_color }}',
			'link_color'            => '{{ data.link_color }}',
			'main_text_color'       => '{{ data.main_text_color }}',
			'secondary_text_color'  => '{{ data.secondary_text_color }}',
			'border_color'          => '{{ data.border_color }}',
		);
		?>
		<script type="text/html" id="tmpl-lsx-color-scheme">
			<?php echo $this->lsx_get_color_scheme_css( $colors ) ?>
		</script>
		<?php
	}

	/**
	 * Retrieves the current Twenty Sixteen color scheme.
	 */
	protected function lsx_get_color_scheme() {
		$color_scheme_option = $this->value();
		$color_schemes = $this->choices;

		if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
			return $color_schemes[ $color_scheme_option ]['colors'];
		}

		return $color_schemes['default']['colors'];
	}

	/**
	 * Returns CSS for the color schemes.
	 */
	protected function lsx_get_color_scheme_css( $colors ) {
		$colors = wp_parse_args( $colors, array(
			'background_color'      => '',
			'link_color'            => '',
			'main_text_color'       => '',
			'secondary_text_color'  => '',
			'border_color'          => '',
		) );

return <<<CSS
		/* Color Scheme */

		/* Background Color */

		body {
			background-color: {$colors['background_color']};
		}

		/* Link Color */

		a {
			color: {$colors['link_color']};
		}

		/* Main Text Color */

		body,
		p {
			color: {$colors['main_text_color']};
		}

		/* Border Color (extend Main Text Color) */

		input,
		textarea {
			border-color: {$colors['border_color']};
		}

		/* Secondary Text Color */

		a:hover,
		a:focus,
		a:active {
			color: {$colors['secondary_text_color']};
		}
CSS;
	}

	/**
	 * Enqueues front-end CSS for color scheme.
	 */
	public function lsx_color_scheme_css() {
		$color_scheme_option = $this->value();
		$color_scheme = $this->lsx_get_color_scheme();

		// Convert main text hex color to rgba.
		$color_textcolor_rgb = $this->lsx_hex2rgb( $color_scheme[3] );

		// If the rgba values are empty return early.
		if ( empty( $color_textcolor_rgb ) ) {
			return;
		}

		$colors = array(
			'background_color'      => $color_scheme[0],
			'link_color'            => $color_scheme[1],
			'main_text_color'       => $color_scheme[2],
			'secondary_text_color'  => $color_scheme[3],
			'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),

		);

		$color_scheme_css = $this->lsx_get_color_scheme_css( $colors );
		wp_add_inline_style( 'lsx_main', $color_scheme_css );
	}

	/**
	 * Enqueues front-end CSS for the link color.
	 */
	public function lsx_link_color_css() {
		$color_scheme = $this->lsx_get_color_scheme();
		$default_color = $color_scheme[1];
		$link_color = get_theme_mod( 'link_color', $default_color );

		$css = '
			/* Link Color */

			a {
				color: %1$s;
			}
		';

		wp_add_inline_style( 'lsx_main', sprintf( $css, $link_color ) );
	}

	/**
	 * Enqueues front-end CSS for the main text color.
	 */
	public function lsx_main_text_color_css() {
		$color_scheme = $this->lsx_get_color_scheme();
		$default_color = $color_scheme[2];
		$main_text_color = get_theme_mod( 'main_text_color', $default_color );

		// Convert main text hex color to rgba.
		$main_text_color_rgb = $this->lsx_hex2rgb( $main_text_color );

		// If the rgba values are empty return early.
		if ( empty( $main_text_color_rgb ) ) {
			return;
		}

		$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

		$css = '
			/* Main Text Color */

			body,
			p {
				color: %1$s;
			}

			/* Border Color */

			input,
			textarea {
				border-color: %2$s;
			}
		';

		wp_add_inline_style( 'lsx_main', sprintf( $css, $main_text_color, $border_color ) );
	}

	/**
	 * Enqueues front-end CSS for the secondary text color.
	 */
	public function lsx_secondary_text_color_css() {
		$color_scheme = $this->lsx_get_color_scheme();
		$default_color = $color_scheme[3];
		$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

		$css = '
			/* Secondary Text Color */

			a:hover,
			a:focus,
			a:active {
				color: %1$s;
			}
		';

		wp_add_inline_style( 'lsx_main', sprintf( $css, $secondary_text_color ) );
	}

	// *********************************************************************
	// *********************************************************************
	// *********************************************************************
	// *********************************************************************
	// *********************************************************************

	/**
	 * Converts a HEX value to RGB.
	 *
	 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
	 * @return array Array containing RGB (red, green, and blue) values for the given
	 *               HEX code, empty array otherwise.
	 */
	protected function lsx_hex2rgb( $color ) {
		$color = trim( $color, '#' );

		if ( strlen( $color ) === 3 ) {
			$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
			$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
			$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
		} else if ( strlen( $color ) === 6 ) {
			$r = hexdec( substr( $color, 0, 2 ) );
			$g = hexdec( substr( $color, 2, 2 ) );
			$b = hexdec( substr( $color, 4, 2 ) );
		} else {
			return array();
		}

		return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}

}
?>