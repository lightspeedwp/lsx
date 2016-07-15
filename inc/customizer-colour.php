<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 */
function lsx_customizer_colour__color_scheme_css_template() {
	$colors = array(
		'button_background_color'           => '{{ data.button_background_color }}',
		'button_background_hover_color'     => '{{ data.button_background_hover_color }}',
		'button_text_color'                 => '{{ data.button_text_color }}',
		'button_text_color_hover'           => '{{ data.button_text_color_hover }}',

		'button_cta_background_color'       => '{{ data.button_cta_background_color }}',
		'button_cta_background_hover_color' => '{{ data.button_cta_background_hover_color }}',
		'button_cta_text_color'             => '{{ data.button_cta_text_color }}',
		'button_cta_text_color_hover'       => '{{ data.button_cta_text_color_hover }}',

		'top_menu_background_color'         => '{{ data.top_menu_background_color }}',
		'top_menu_text_color'               => '{{ data.top_menu_text_color }}',
		'top_menu_text_hover_color'         => '{{ data.top_menu_text_hover_color }}',

		'header_background_color'           => '{{ data.header_background_color }}',
		'header_title_color'                => '{{ data.header_title_color }}',
		'header_title_hover_color'          => '{{ data.header_title_hover_color }}',
		'header_description_color'          => '{{ data.header_description_color }}',

		'main_menu_background_color'        => '{{ data.main_menu_background_color }}',
		'main_menu_background_hover_color'  => '{{ data.main_menu_background_hover_color }}',
		'main_menu_text_color'              => '{{ data.main_menu_text_color }}',
		'main_menu_text_hover_color'        => '{{ data.main_menu_text_hover_color }}',

		'banner_background_color'           => '{{ data.banner_background_color }}',
		'banner_text_color'                 => '{{ data.banner_text_color }}',

		'body_background_color'             => '{{ data.body_background_color }}',
		'body_text_color'                   => '{{ data.body_text_color }}',
		'body_link_color'                   => '{{ data.body_link_color }}',
		'body_link_hover_color'             => '{{ data.body_link_hover_color }}',

		'footer_cta_background_color'       => '{{ data.footer_cta_background_color }}',
		'footer_cta_text_color'             => '{{ data.footer_cta_text_color }}',
		'footer_cta_link_color'             => '{{ data.footer_cta_link_color }}',
		'footer_cta_link_hover_color'       => '{{ data.footer_cta_link_hover_color }}',

		'footer_widgets_background_color'   => '{{ data.footer_widgets_background_color }}',
		'footer_widgets_text_color'         => '{{ data.footer_widgets_text_color }}',
		'footer_widgets_link_color'         => '{{ data.footer_widgets_link_color }}',
		'footer_widgets_link_hover_color'   => '{{ data.footer_widgets_link_hover_color }}',

		'footer_background_color'           => '{{ data.footer_background_color }}',
		'footer_text_color'                 => '{{ data.footer_text_color }}',
		'footer_link_color'                 => '{{ data.footer_link_color }}',
		'footer_link_hover_color'           => '{{ data.footer_link_hover_color }}',
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
		'button_background_color'           => '',
		'button_background_hover_color'     => '',
		'button_text_color'                 => '',
		'button_text_color_hover'           => '',

		'button_cta_background_color'       => '',
		'button_cta_background_hover_color' => '',
		'button_cta_text_color'             => '',
		'button_cta_text_color_hover'       => '',

		'top_menu_background_color'         => '',
		'top_menu_text_color'               => '',
		'top_menu_text_hover_color'         => '',

		'header_background_color'           => '',
		'header_title_color'                => '',
		'header_title_hover_color'          => '',
		'header_description_color'          => '',

		'main_menu_background_color'        => '',
		'main_menu_background_hover_color'  => '',
		'main_menu_text_color'              => '',
		'main_menu_text_hover_color'        => '',

		'banner_background_color'           => '',
		'banner_text_color'                 => '',

		'body_background_color'             => '',
		'body_text_color'                   => '',
		'body_link_color'                   => '',
		'body_link_hover_color'             => '',

		'footer_cta_background_color'       => '',
		'footer_cta_text_color'             => '',
		'footer_cta_link_color'             => '',
		'footer_cta_link_hover_color'       => '',

		'footer_widgets_background_color'   => '',
		'footer_widgets_text_color'         => '',
		'footer_widgets_link_color'         => '',
		'footer_widgets_link_hover_color'   => '',

		'footer_background_color'           => '',
		'footer_text_color'                 => '',
		'footer_link_color'                 => '',
		'footer_link_hover_color'           => '',
	) );

	return <<<CSS
	/* Button */

	.btn,
	.btn:visited,
	.button,
	.button:visited,
	input[type="submit"],
	input[type="submit"]:visited {
		background-color: {$colors['button_background_color']} !important;
		color: {$colors['button_text_color']} !important;
	}

	.btn:hover,
	.btn:active,
	.button:hover,
	.button:active,
	button:hover,
	button:active,
	input[type="submit"]:hover,
	input[type="submit"]:active {
		background-color: {$colors['button_background_hover_color']} !important;
		color: {$colors['button_text_color_hover']} !important;
	}

	/* Button CTA */

	.btn.cta-btn,
	.btn.cta-btn:visited,
	#top-menu nav.top-menu ul li.cta a,
	#top-menu nav.top-menu ul li.cta a:visited {
		background-color: {$colors['button_cta_background_color']} !important;
		color: {$colors['button_cta_text_color']} !important;
	}

	.btn.cta-border-btn,
	.btn.cta-border-btn:visited {
		border-color: {$colors['button_cta_background_color']} !important;
		color: {$colors['button_cta_background_color']} !important;
	}

	.btn.cta-btn:hover,
	.btn.cta-btn:active,
	#top-menu nav.top-menu ul li.cta a:hover,
	#top-menu nav.top-menu ul li.cta a:active,
	.btn.cta-border-btn:hover,
	.btn.cta-border-btn:active {
		background-color: {$colors['button_cta_background_hover_color']} !important;
		color: {$colors['button_cta_text_color_hover']} !important;
	}

	.btn.cta-border-btn:hover,
	.btn.cta-border-btn:active {
		border-color: {$colors['button_cta_background_hover_color']} !important;
	}

	/* Top Menu */

	#top-menu {
		background-color: {$colors['top_menu_background_color']} !important;
	}

	#top-menu nav.top-menu ul li a,
	#top-menu nav.top-menu ul li a:visited {
		color: {$colors['top_menu_text_color']} !important;
	}

	#top-menu nav.top-menu ul li a:hover,
	#top-menu nav.top-menu ul li a:active,

	#top-menu nav.top-menu ul li a:before,
	#top-menu nav.top-menu ul li a:visited:before,
	#top-menu nav.top-menu ul li a:hover:before,
	#top-menu nav.top-menu ul li a:active:before {
		color: {$colors['top_menu_text_hover_color']} !important;
	}

	/* Header */

	header.banner {
		background-color: {$colors['header_background_color']} !important;
	}

	header.banner .site-branding .site-title,
	header.banner .site-branding .site-title a,
	header.banner .site-branding .site-title a:visited {
		color: {$colors['header_title_color']} !important;
	}

	header.banner .site-branding .site-title a:hover,
	header.banner .site-branding .site-title a:active {
		color: {$colors['header_title_hover_color']} !important;
	}

	header.banner .site-branding .site-description {
		color: {$colors['header_description_color']} !important;
	}

	/* Main Menu */

	/* Banner */

	/* Body */

	/* Footer CTA */

	/* Footer Widgets */

	/* Footer */
CSS;
}

/**
 * Enqueues front-end CSS for the button.
 */
function lsx_customizer_colour__button_css() {
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	$base_button_background_color = $color_scheme[0];
	$base_button_background_hover_color = $color_scheme[1];
	$base_button_text_color = $color_scheme[2];
	$base_button_text_color_hover = $color_scheme[3];

	$button_background_color = get_theme_mod( 'button_background_color', $base_button_background_color );
	$button_background_hover_color = get_theme_mod( 'button_background_hover_color', $base_button_background_hover_color );
	$button_text_color = get_theme_mod( 'button_text_color', $base_button_text_color );
	$button_text_color_hover = get_theme_mod( 'button_text_color_hover', $base_button_text_color_hover );

	if ( $base_button_background_color === $button_background_color
		 && $base_button_background_hover_color === $button_background_hover_color
		 && $base_button_text_color === $button_text_color
		 && $base_button_text_color_hover === $button_text_color_hover ) {
		return;
	}

	$css = '
		/* Button */

		.btn,
		.btn:visited,
		.button,
		.button:visited,
		input[type="submit"],
		input[type="submit"]:visited {
			background-color: %1$s !important;
			color: %3$s !important;
		}

		.btn:hover,
		.btn:active,
		.button:hover,
		.button:active,
		button:hover,
		button:active,
		input[type="submit"]:hover,
		input[type="submit"]:active {
			background-color: %2$s !important;
			color: %4$s !important;
		}
	';

	wp_add_inline_style(
		'lsx_main',

		sprintf(
			$css,
			$button_background_color,
			$button_background_hover_color,
			$button_text_color,
			$button_text_color_hover
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__button_css', 11 );

/**
 * Enqueues front-end CSS for the button cta.
 */
function lsx_customizer_colour__button_cta_css() {
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	$base_button_cta_background_color = $color_scheme[4];
	$base_button_cta_background_hover_color = $color_scheme[5];
	$base_button_cta_text_color = $color_scheme[6];
	$base_button_cta_text_color_hover = $color_scheme[7];

	$button_cta_background_color = get_theme_mod( 'button_cta_background_color', $base_button_cta_background_color );
	$button_cta_background_hover_color = get_theme_mod( 'button_cta_background_hover_color', $base_button_cta_background_hover_color );
	$button_cta_text_color = get_theme_mod( 'button_cta_text_color', $base_button_cta_text_color );
	$button_cta_text_color_hover = get_theme_mod( 'button_cta_text_color_hover', $base_button_cta_text_color_hover );

	if ( $base_button_cta_background_color === $button_cta_background_color
		 && $base_button_cta_background_hover_color === $button_cta_background_hover_color
		 && $base_button_cta_text_color === $button_cta_text_color
		 && $base_button_cta_text_color_hover === $button_cta_text_color_hover ) {
		return;
	}

	$css = '
		/* Button CTA */

		.btn.cta-btn,
		.btn.cta-btn:visited,
		#top-menu nav.top-menu ul li.cta a,
		#top-menu nav.top-menu ul li.cta a:visited {
			background-color: %1$s !important;
			color: %3$s !important;
		}

		.btn.cta-border-btn,
		.btn.cta-border-btn:visited {
			border-color: %1$s !important;
			color: %1$s !important;
		}

		.btn.cta-btn:hover,
		.btn.cta-btn:active,
		#top-menu nav.top-menu ul li.cta a:hover,
		#top-menu nav.top-menu ul li.cta a:active,
		.btn.cta-border-btn:hover,
		.btn.cta-border-btn:active {
			background-color: %2$s !important;
			color: %4$s !important;
		}

		.btn.cta-border-btn:hover,
		.btn.cta-border-btn:active {
			border-color: %2$s !important;
		}
	';

	wp_add_inline_style(
		'lsx_main',

		sprintf(
			$css,
			$button_cta_background_color,
			$button_cta_background_hover_color,
			$button_cta_text_color,
			$button_cta_text_color_hover
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__button_cta_css', 11 );

/**
 * Enqueues front-end CSS for the top menu.
 */
function lsx_customizer_colour__top_menu_css() {
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	$base_top_menu_background_color = $color_scheme[8];
	$base_top_menu_text_color = $color_scheme[9];
	$base_top_menu_text_hover_color = $color_scheme[10];

	$top_menu_background_color = get_theme_mod( 'top_menu_background_color', $base_top_menu_background_color );
	$top_menu_text_color = get_theme_mod( 'top_menu_text_color', $base_top_menu_text_color );
	$top_menu_text_hover_color = get_theme_mod( 'top_menu_text_hover_color', $base_top_menu_text_hover_color );
	
	if ( $base_top_menu_background_color === $top_menu_background_color
		 && $base_top_menu_text_color === $top_menu_text_color
		 && $base_top_menu_text_hover_color === $top_menu_text_hover_color ) {
		return;
	}

	$css = '
		/* Top Menu */

		#top-menu {
			background-color: %1$s !important;
		}

		#top-menu nav.top-menu ul li a,
		#top-menu nav.top-menu ul li a:visited {
			color: %2$s !important;
		}

		#top-menu nav.top-menu ul li a:hover,
		#top-menu nav.top-menu ul li a:active,

		#top-menu nav.top-menu ul li a:before,
		#top-menu nav.top-menu ul li a:visited:before,
		#top-menu nav.top-menu ul li a:hover:before,
		#top-menu nav.top-menu ul li a:active:before {
			color: %3$s !important;
		}
	';

	wp_add_inline_style(
		'lsx_main',

		sprintf(
			$css,
			$top_menu_background_color,
			$top_menu_text_color,
			$top_menu_text_hover_color
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__top_menu_css', 11 );

/**
 * Enqueues front-end CSS for the header.
 */
function lsx_customizer_colour__header_css() {
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	$base_header_background_color = $color_scheme[11];
	$base_header_title_color = $color_scheme[12];
	$base_header_title_hover_color = $color_scheme[13];
	$base_header_description_color = $color_scheme[14];

	$header_background_color = get_theme_mod( 'header_background_color', $base_header_background_color );
	$header_title_color = get_theme_mod( 'header_title_color', $base_header_title_color );
	$header_title_hover_color = get_theme_mod( 'header_title_hover_color', $base_header_title_hover_color );
	$header_description_color = get_theme_mod( 'header_description_color', $base_header_description_color );

	if ( $base_header_background_color === $header_background_color
		 && $base_header_title_color === $header_title_color
		 && $base_header_title_hover_color === $header_title_hover_color
		 && $base_header_description_color === $header_description_color ) {
		return;
	}

	$css = '
		/* Header */

		header.banner {
			background-color: %1$s !important;
		}

		header.banner .site-branding .site-title,
		header.banner .site-branding .site-title a,
		header.banner .site-branding .site-title a:visited {
			color: %2$s !important;
		}

		header.banner .site-branding .site-title a:hover,
		header.banner .site-branding .site-title a:active {
			color: %3$s !important;
		}

		header.banner .site-branding .site-description {
			color: %4$s !important;
		}
	';

	wp_add_inline_style(
		'lsx_main',

		sprintf(
			$css,
			$header_background_color,
			$header_title_color,
			$header_title_hover_color,
			$header_description_color
		)
	);
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__header_css', 11 );

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
	$color_scheme = lsx_customizer_colour__get_color_scheme();

	$colors = array(
		'button_background_color'           => $color_scheme[0],
		'button_background_hover_color'     => $color_scheme[1],
		'button_text_color'                 => $color_scheme[2],
		'button_text_color_hover'           => $color_scheme[3],

		'button_cta_background_color'       => $color_scheme[4],
		'button_cta_background_hover_color' => $color_scheme[5],
		'button_cta_text_color'             => $color_scheme[6],
		'button_cta_text_color_hover'       => $color_scheme[7],

		'top_menu_background_color'         => $color_scheme[8],
		'top_menu_text_color'               => $color_scheme[9],
		'top_menu_text_hover_color'         => $color_scheme[10],

		'header_background_color'           => $color_scheme[11],
		'header_title_color'                => $color_scheme[12],
		'header_title_hover_color'          => $color_scheme[13],
		'header_description_color'          => $color_scheme[14],

		'main_menu_background_color'        => $color_scheme[15],
		'main_menu_background_hover_color'  => $color_scheme[16],
		'main_menu_text_color'              => $color_scheme[17],
		'main_menu_text_hover_color'        => $color_scheme[18],

		'banner_background_color'           => $color_scheme[19],
		'banner_text_color'                 => $color_scheme[20],

		'body_background_color'             => $color_scheme[21],
		'body_text_color'                   => $color_scheme[22],
		'body_link_color'                   => $color_scheme[23],
		'body_link_hover_color'             => $color_scheme[24],

		'footer_cta_background_color'       => $color_scheme[25],
		'footer_cta_text_color'             => $color_scheme[26],
		'footer_cta_link_color'             => $color_scheme[27],
		'footer_cta_link_hover_color'       => $color_scheme[28],

		'footer_widgets_background_color'   => $color_scheme[29],
		'footer_widgets_text_color'         => $color_scheme[30],
		'footer_widgets_link_color'         => $color_scheme[31],
		'footer_widgets_link_hover_color'   => $color_scheme[32],

		'footer_background_color'           => $color_scheme[33],
		'footer_text_color'                 => $color_scheme[34],
		'footer_link_color'                 => $color_scheme[35],
		'footer_link_hover_color'           => $color_scheme[36],

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
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
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