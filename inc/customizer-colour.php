<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 */
function lsx_customizer_colour__color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-lsx-color-scheme">
		<?php echo lsx_customizer_colour__get_color_scheme_css( $colors ) ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'lsx_customizer_colour__color_scheme_css_template' );

/**
 * Returns CSS for the color schemes.
 */
function lsx_customizer_colour__get_color_scheme_css( $colors ) {
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
 * Retrieves the current color scheme.
 */
function lsx_customizer_colour__get_color_scheme() {
	global $customizer_colour_choices;

	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes = $customizer_colour_choices;

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}

/**
 * Enqueues front-end CSS for color scheme.
 */
function lsx_customizer_colour__color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = lsx_customizer_colour__hex2rgb( $color_scheme[3] );

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

	$color_scheme_css = lsx_customizer_colour__get_color_scheme_css( $colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__color_scheme_css' );

/**
 * Converts a HEX value to RGB.
 */
function lsx_customizer_colour__hex2rgb( $color ) {
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
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array( 'customize-controls', 'wp-util' ), null, true );
		wp_localize_script( 'lsx-colour-control', 'colorScheme', $this->choices );
	}

	/**
	 * Render the control's content.
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

}

?>