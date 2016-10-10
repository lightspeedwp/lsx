<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Transform SCSS to CSS
 */
function lsx_customizer_colour__scss_to_css( $scss ) {
	$css = '';
	$scssphp_file = get_template_directory() .'/vendor/leafo/scssphp/scss.inc.php';

	if ( ! empty( $scss ) && file_exists( $scssphp_file ) ) {
		require_once $scssphp_file;

		$compiler = new \Leafo\ScssPhp\Compiler();
		$compiler->setFormatter( 'Leafo\ScssPhp\Formatter\Compact' );

		try {
			$css = $compiler->compile( $scss );
		} catch ( Exception $e ) {
			$error = $e->getMessage();
			return "/*\n\n\$error:\n\n{$error}\n\n\$scss:\n\n{$scss} */";
		}
	}

	return $css;
}

/**
 * 
 */
function lsx_customizer_colour__add_footer_styles() {
	wp_enqueue_style( 'lsx_customizer_colour', get_stylesheet_uri() );
}
add_action( 'wp_footer', 'lsx_customizer_colour__add_footer_styles', 11 );

/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 */
function lsx_customizer_colour__color_scheme_css_template() {
	global $customizer_colour_names;
	
	$colors = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = 'unquote("{{ data.'.$key.' }}")';
	}
	?>
	<script type="text/html" id="tmpl-lsx-color-scheme">
		<?php echo esc_html( lsx_customizer_colour__top_menu_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__header_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__main_menu_get_css( $colors ) ) ?>

		<?php echo esc_html( lsx_customizer_colour__banner_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__body_get_css( $colors ) ) ?>

		<?php echo esc_html( lsx_customizer_colour__footer_cta_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__footer_widgets_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__footer_get_css( $colors ) ) ?>

		<?php echo esc_html( lsx_customizer_colour__button_get_css( $colors ) ) ?>
		<?php echo esc_html( lsx_customizer_colour__button_cta_get_css( $colors ) ) ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'lsx_customizer_colour__color_scheme_css_template' );

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

/* ################################################################################# */


/**
 * Assign CSS to button theme mod.
 */
function lsx_customizer_colour__button_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__button_get_theme_mods();
	$styles     = lsx_customizer_colour__button_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__button_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__button_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__button_set_theme_mod' );

/**
 * Enqueues front-end CSS for the button.
 */
function lsx_customizer_colour__button_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__button_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__button_get_theme_mods();
		$styles     = lsx_customizer_colour__button_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__button_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__button_css', 12 );

/**
 * Get button CSS theme mods.
 */
function lsx_customizer_colour__button_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'button_background_color' =>       get_theme_mod( 'button_background_color',       $colors['button_background_color'] ),
		'button_background_hover_color' => get_theme_mod( 'button_background_hover_color', $colors['button_background_hover_color'] ),
		'button_text_color' =>             get_theme_mod( 'button_text_color',             $colors['button_text_color'] ),
		'button_text_color_hover' =>       get_theme_mod( 'button_text_color_hover',       $colors['button_text_color_hover'] )
	);
}

/**
 * Returns CSS for the button.
 */
function lsx_customizer_colour__button_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Button
		 *
		 */

		.btn,
		.button,
		input[type="submit"],
		#searchform .input-group span.input-group-btn button.search-submit,
		#respond #submit {
			&,
			&:visited {
				background-color: {$colors['button_background_color']};
				color: {$colors['button_text_color']};
			}

			&:hover,
			&:active,
			&:focus {
				background-color: {$colors['button_background_hover_color']};
				color: {$colors['button_text_color_hover']};
			}
		}

		#infinite-handle span {
			&,
			&:visited {
				background-color: {$colors['button_background_color']} !important;
				color: {$colors['button_text_color']} !important;
			}

			&:hover,
			&:active,
			&:focus {
				background-color: {$colors['button_background_hover_color']} !important;
				color: {$colors['button_text_color_hover']} !important;
			}
		}

		.caldera-grid,
		.caldera-clarity-grid,
		#footer-widgets .widget form {
			.btn,
			.button-primary {
				&,
				&:visited {
					background-color: {$colors['button_background_color']};
					color: {$colors['button_text_color']};
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_background_hover_color']};
					color: {$colors['button_text_color_hover']};
				}
			}
		}

		.field-wrap {
			input[type="submit"],
			input[type="button"],
			button {
				&,
				&:visited {
					background-color: {$colors['button_background_color']} !important;
					color: {$colors['button_text_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_background_hover_color']} !important;
					color: {$colors['button_text_color_hover']} !important;
				}
			}
		}

		article {
			header.entry-header {
				h1.entry-title {
					a.format-link {
						&,
						&:visited {
							background-color: {$colors['button_background_color']};
							color: {$colors['button_text_color']} !important;
						}
					}
				}
			}
		}

		.button-primary.border-btn,
		.btn.border-btn,
		button.border-btn,
		.wp-pagenavi a,
		.lsx-postnav > a {
			&,
			&:visited {
				border-color: {$colors['button_background_color']} !important;
				color: {$colors['button_background_color']} !important;
			}

			&:hover,
			&:active,
			&:focus {
				background-color: {$colors['button_background_hover_color']} !important;
				border-color: {$colors['button_background_hover_color']} !important;
				color: {$colors['button_text_color_hover']} !important;
			}
		}

		.wp-pagenavi span.current,
		.lsx-postnav > span {
			background-color: {$colors['button_background_color']} !important;
			border-color: {$colors['button_background_color']} !important;
			color: {$colors['button_text_color']} !important;
		}

		input[type="text"],
		input[type="search"],
		input[type="email"],
		input[type="number"],
		input[type="password"],
		textarea,
		select {
			&:focus {
				border-color: {$colors['button_background_color']} !important;
			}
		}

		/*
		 *
		 * Button WooCommerce
		 *
		 */

		.woocommerce {
			a.button,
			button.button,
			input.button,
			input[type="submit"],
			#respond input#submit {
				&,
				&:visited {
					background-color: {$colors['button_background_color']} !important;
					color: {$colors['button_text_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_background_hover_color']} !important;
					color: {$colors['button_text_color_hover']} !important;
				}
			}

			table.cart {
				td.actions {
					.coupon {
						.input-text {
							&:focus {
								border-color: {$colors['button_background_color']} !important;
							}
						}
					}
				}
			}

			nav.woocommerce-pagination a {
				&,
				&:visited {
					border-color: {$colors['button_background_color']} !important;
					color: {$colors['button_background_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_background_hover_color']} !important;
					border-color: {$colors['button_background_hover_color']} !important;
					color: {$colors['button_text_color_hover']} !important;
				}
			}

			nav.woocommerce-pagination span.current {
				background-color: {$colors['button_background_color']} !important;
				border-color: {$colors['button_background_color']} !important;
				color: {$colors['button_text_color']} !important;
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_button', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to button cta theme mod.
 */
function lsx_customizer_colour__button_cta_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__button_cta_get_theme_mods();
	$styles     = lsx_customizer_colour__button_cta_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__button_cta_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__button_cta_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__button_cta_set_theme_mod' );

/**
 * Enqueues front-end CSS for the button cta.
 */
function lsx_customizer_colour__button_cta_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__button_cta_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__button_cta_get_theme_mods();
		$styles     = lsx_customizer_colour__button_cta_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__button_cta_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__button_cta_css', 12 );

/**
 * Get button cta CSS theme mods.
 */
function lsx_customizer_colour__button_cta_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'button_cta_background_color' =>       get_theme_mod( 'button_cta_background_color',       $colors['button_cta_background_color'] ),
		'button_cta_background_hover_color' => get_theme_mod( 'button_cta_background_hover_color', $colors['button_cta_background_hover_color'] ),
		'button_cta_text_color' =>             get_theme_mod( 'button_cta_text_color',             $colors['button_cta_text_color'] ),
		'button_cta_text_color_hover' =>       get_theme_mod( 'button_cta_text_color_hover',       $colors['button_cta_text_color_hover'] )
	);
}

/**
 * Returns CSS for the button cta.
 */
function lsx_customizer_colour__button_cta_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Button CTA
		 *
		 */

		.btn {
			&.cta-btn {
				&,
				&:visited {
					background-color: {$colors['button_cta_background_color']} !important;
					color: {$colors['button_cta_text_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_cta_background_hover_color']} !important;
					color: {$colors['button_cta_text_color_hover']} !important;
				}
			}

			&.cta-border-btn {
				&,
				&:visited {
					border-color: {$colors['button_cta_background_color']} !important;
					color: {$colors['button_cta_background_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					background-color: {$colors['button_cta_background_hover_color']} !important;
					border-color: {$colors['button_cta_background_hover_color']} !important;
					color: {$colors['button_cta_text_color_hover']} !important;
				}
			}
		}

		#top-menu {
			nav.top-menu {
				ul {
					li.cta {
						a {
							&,
							&:visited {
								background-color: {$colors['button_cta_background_color']} !important;
								color: {$colors['button_cta_text_color']} !important;
							}

							&:hover,
							&:active,
							&:focus {
								background-color: {$colors['button_cta_background_hover_color']} !important;
								color: {$colors['button_cta_text_color_hover']} !important;
							}
						}
					}
				}
			}
		}

		/*
		 *
		 * Button CTA WooCommerce
		 *
		 */

		.woocommerce {
			a.button,
			button.button,
			input.button,
			input[type="submit"],
			#respond input#submit {
				&.alt {
					&,
					&:visited {
						background-color: {$colors['button_cta_background_color']} !important;
						color: {$colors['button_cta_text_color']} !important;
					}

					&:hover,
					&:active,
					&:focus {
						background-color: {$colors['button_cta_background_hover_color']} !important;
						color: {$colors['button_cta_text_color_hover']} !important;
					}
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_button_cta', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to top menu theme mod.
 */
function lsx_customizer_colour__top_menu_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__top_menu_get_theme_mods();
	$styles     = lsx_customizer_colour__top_menu_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__top_menu_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__top_menu_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__top_menu_set_theme_mod' );

/**
 * Enqueues front-end CSS for the top menu.
 */
function lsx_customizer_colour__top_menu_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__top_menu_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__top_menu_get_theme_mods();
		$styles     = lsx_customizer_colour__top_menu_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__top_menu_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__top_menu_css', 12 );

/**
 * Get top menu CSS theme mods.
 */
function lsx_customizer_colour__top_menu_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'top_menu_background_color' => get_theme_mod( 'top_menu_background_color', $colors['top_menu_background_color'] ),
		'top_menu_text_color' =>       get_theme_mod( 'top_menu_text_color',       $colors['top_menu_text_color'] ),
		'top_menu_text_hover_color' => get_theme_mod( 'top_menu_text_hover_color', $colors['top_menu_text_hover_color'] )
	);
}

/**
 * Returns CSS for the top menu.
 */
function lsx_customizer_colour__top_menu_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Top Menu
		 *
		 */

		#top-menu {
			background-color: {$colors['top_menu_background_color']};

			nav.top-menu {
				ul {
					li {
						a {
							&,
							&:visited {
								color: {$colors['top_menu_text_color']};
							}

							&:before {
								color: {$colors['top_menu_text_hover_color']};
							}

							&:hover,
							&:active,
							&:focus {
								&,
								&:before {
									color: {$colors['top_menu_text_hover_color']};
								}
							}
						}
					}
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_top_menu', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to header theme mod.
 */
function lsx_customizer_colour__header_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__header_get_theme_mods();
	$styles     = lsx_customizer_colour__header_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__header_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__header_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__header_set_theme_mod' );

/**
 * Enqueues front-end CSS for the header.
 */
function lsx_customizer_colour__header_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__header_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__header_get_theme_mods();
		$styles     = lsx_customizer_colour__header_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__header_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__header_css', 12 );

/**
 * Get header CSS theme mods.
 */
function lsx_customizer_colour__header_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'header_background_color'  => get_theme_mod( 'header_background_color',  $colors['header_background_color'] ),
		'header_title_color'       => get_theme_mod( 'header_title_color',       $colors['header_title_color'] ),
		'header_title_hover_color' => get_theme_mod( 'header_title_hover_color', $colors['header_title_hover_color'] ),
		'header_description_color' => get_theme_mod( 'header_description_color', $colors['header_description_color'] )
	);
}

/**
 * Returns CSS for the header.
 */
function lsx_customizer_colour__header_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Header
		 *
		 */

		header.banner {
			background-color: {$colors['header_background_color']};

			.site-branding {
				.site-title {
					color: {$colors['header_title_color']};

					a {
						&,
						&:visited {
							color: {$colors['header_title_color']};
						}

						&:hover,
						&:active,
						&:focus {
							color: {$colors['header_title_hover_color']};
						}
					}
				}

				.site-description {
					color: {$colors['header_description_color']};
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_header', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to main menu theme mod.
 */
function lsx_customizer_colour__main_menu_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__main_menu_get_theme_mods();
	$styles     = lsx_customizer_colour__main_menu_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__main_menu_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__main_menu_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__main_menu_set_theme_mod' );

/**
 * Enqueues front-end CSS for the main menu.
 */
function lsx_customizer_colour__main_menu_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__main_menu_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__main_menu_get_theme_mods();
		$styles     = lsx_customizer_colour__main_menu_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__main_menu_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__main_menu_css', 12 );

/**
 * Get main menu CSS theme mods.
 */
function lsx_customizer_colour__main_menu_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'main_menu_background_hover1_color' => get_theme_mod( 'main_menu_background_hover1_color', $colors['main_menu_background_hover1_color'] ),
		'main_menu_background_hover2_color' => get_theme_mod( 'main_menu_background_hover2_color', $colors['main_menu_background_hover2_color'] ),
		'main_menu_text_color' =>              get_theme_mod( 'main_menu_text_color',              $colors['main_menu_text_color'] ),
		'main_menu_text_hover1_color' =>       get_theme_mod( 'main_menu_text_hover1_color',       $colors['main_menu_text_hover1_color'] ),
		'main_menu_text_hover2_color' =>       get_theme_mod( 'main_menu_text_hover2_color',       $colors['main_menu_text_hover2_color'] )
	);
}

/**
 * Returns CSS for the main menu.
 */
function lsx_customizer_colour__main_menu_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Main Menu
		 *
		 */

		nav.primary-navbar {
			.nav.navbar-nav {
				& > li,
				ul.dropdown-menu > li {
					& > a,
					ul.dropdown-menu > li > a {
						color: {$colors['main_menu_text_color']};
					}
					
					&:hover,
					&.open,
					&.active {
						& > a {
							background-color: {$colors['main_menu_background_hover1_color']};
							color: {$colors['main_menu_text_hover1_color']};

							.caret {
								border-top-color: {$colors['main_menu_text_hover1_color']};
								border-bottom-color: {$colors['main_menu_text_hover1_color']};
							}
						}
					}

					ul.dropdown-menu {
						background-color: {$colors['main_menu_background_hover1_color']};

						& > li {
							& > a {
								color: {$colors['main_menu_text_hover1_color']};

								&:hover {
									color: {$colors['main_menu_text_hover1_color']};
								}
							}
						}
					}

					&.active {
						a {
							color: {$colors['main_menu_text_hover1_color']};
						}

						&:hover {
							& > a {
								color: {$colors['main_menu_text_hover1_color']};
							}
						}
						
						& li.active a {
							background-color: {$colors['main_menu_background_hover2_color']} !important;
							color: {$colors['main_menu_text_hover2_color']};
						}
					}
				}
			}
		}

		.navbar-default {
			.navbar-toggle {
				&,
				&:visited,
				&:focus,
				&:hover,
				&:active {
					border-color: {$colors['main_menu_background_hover1_color']};
					background-color: {$colors['main_menu_background_hover1_color']};
				}

				.icon-bar {
					background-color: {$colors['main_menu_text_hover1_color']};
				}
			}
		}

		header.banner {
			.search-submit {
				&,
				&:visited {
					color: {$colors['main_menu_text_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					color: #333 !important; /* @TODO */
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_main_menu', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to banner theme mod.
 */
function lsx_customizer_colour__banner_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__banner_get_theme_mods();
	$styles     = lsx_customizer_colour__banner_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__banner_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__banner_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__banner_set_theme_mod' );

/**
 * Enqueues front-end CSS for the banner.
 */
function lsx_customizer_colour__banner_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__banner_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__banner_get_theme_mods();
		$styles     = lsx_customizer_colour__banner_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__banner_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__banner_css', 12 );

/**
 * Get banner CSS theme mods.
 */
function lsx_customizer_colour__banner_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'banner_background_color' => get_theme_mod( 'banner_background_color', $colors['banner_background_color'] ),
		'banner_text_color' =>       get_theme_mod( 'banner_text_color',       $colors['banner_text_color'] ),
		'banner_text_image_color' => get_theme_mod( 'banner_text_image_color', $colors['banner_text_image_color'] )
	);
}

/**
 * Returns CSS for the banner.
 */
function lsx_customizer_colour__banner_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Banner
		 *
		 */

		.wrap {
			.archive-header {
				background-color: {$colors['banner_background_color']} !important;

				.archive-title,
				h1 {
					color: {$colors['banner_text_color']} !important;
				}
			}
		}

		body.page-has-banner {
			.page-banner {
				h1.page-title {
					color: {$colors['banner_text_image_color']} !important;
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_banner', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to body theme mod.
 */
function lsx_customizer_colour__body_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__body_get_theme_mods();
	$styles     = lsx_customizer_colour__body_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__body_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__body_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__body_set_theme_mod' );

/**
 * Enqueues front-end CSS for the body.
 */
function lsx_customizer_colour__body_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__body_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__body_get_theme_mods();
		$styles     = lsx_customizer_colour__body_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__body_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__body_css', 12 );

/**
 * Get body CSS theme mods.
 */
function lsx_customizer_colour__body_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'body_background_color' =>   get_theme_mod( 'body_background_color',   $colors['body_background_color'] ),
		'body_line_color' =>         get_theme_mod( 'body_line_color',         $colors['body_line_color'] ),
		'body_text_heading_color' => get_theme_mod( 'body_text_heading_color', $colors['body_text_heading_color'] ),
		'body_text_color' =>         get_theme_mod( 'body_text_color',         $colors['body_text_color'] ),
		'body_link_color' =>         get_theme_mod( 'body_link_color',         $colors['body_link_color'] ),
		'body_link_hover_color' =>   get_theme_mod( 'body_link_hover_color',   $colors['body_link_hover_color'] )
	);
}

/**
 * Returns CSS for the body.
 */
function lsx_customizer_colour__body_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$rgb = lsx_customizer_colour__hex2rgb( $colors['body_line_color'] );
	$colors['body_line_color_rgba'] = "rgba({$rgb['red']}, {$rgb['green']}, {$rgb['blue']}, 0.5)";

	$css = <<<CSS
		/*
		 *
		 * Body
		 *
		 */

		body {
			background-color: {$colors['body_background_color']};
			color: {$colors['body_text_color']};
			
			&.archive.author,
			&.archive.category,
			&.archive.date,
			&.archive.tag,
			&.archive.tax-post_format,
			&.blog,
			&.search {
				.wrap {
					#primary {
						#main {
							& > article {
								-webkit-box-shadow: 1px 1px 3px 0 {$colors['body_line_color_rgba']};
								box-shadow: 1px 1px 3px 0 {$colors['body_line_color_rgba']};
								border-color: {$colors['body_line_color']};
							}
						}
					}
				}
			}

			&.single-post {
				.wrap {
					#primary {
						#main {
							& > article {
								.post-tags-wrapper {
									border-top-color: {$colors['body_line_color']};
									border-bottom-color: {$colors['body_line_color']};
								}
							}
						}

						.post-navigation {
							.pager {
								a {
									&,
									&:visited {
										div {
											h3 {
												color: {$colors['body_text_heading_color']};
											}
										}
									}

									&:hover,
									&:active,
									&:focus {
										div {
											h3 {
												color: {$colors['body_link_hover_color']};
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}

		.wrap {
			background-color: {$colors['body_background_color']};
		}

		h1, h2, h3, h4, h5, h6 {
			color: {$colors['body_text_heading_color']};

			a {
				&,
				&:visited {
					color: {$colors['body_text_heading_color']};
				}

				&:hover,
				&:active,
				&:focus {
					color: {$colors['body_link_hover_color']};
				}
			}
		}

		article {
			header.entry-header {
				h1.entry-title {
					a {
						&,
						&:visited {
							color: {$colors['body_text_heading_color']} !important;
						}

						&:hover,
						&:active,
						&:focus {
							color: {$colors['body_link_hover_color']} !important;
						}
					}
				}
			}

			.entry-content,
			.entry-summary {
				color: {$colors['body_text_color']} !important;
			}
		}

		.sharedaddy {
			.sd-sharing {
				border-top-color: {$colors['body_line_color']};

				.sd-title {
					&,
					&:before {
						color: {$colors['body_text_color']} !important;
					}
				}
			}
		}

		.entry-meta {
			.post-meta {
				color: {$colors['body_text_color']} !important;
			}
		}

		.nav-links-description {
			color: {$colors['body_text_color']} !important;
			
			&:after,
			&:before {
				color: {$colors['body_text_color']} !important;
			}
		}

		.post-meta-author,
		.post-meta-categories,
		.post-meta-time,
		.post-comments {
			&:before {
				color: {$colors['body_text_color']} !important;
			}

			a {
				&,
				&:visited {
					color: {$colors['body_link_color']} !important;
				}

				&:hover,
				&:active,
				&:focus {
					color: {$colors['body_link_hover_color']} !important;
				}
			}
		}

		.post-meta-link {
			&:before {
				color: {$colors['body_text_color']} !important;
			}

			&,
			&:visited {
				color: {$colors['body_link_color']} !important;
			}

			&:hover,
			&:active,
			&:focus {
				color: {$colors['body_link_hover_color']} !important;
			}
		}
		
		.post-tags,
		#reply-title {
			&:before {
				color: {$colors['body_text_color']} !important;
			}
		}

		a {
			&,
			.entry-content &:not(.btn),
			.entry-summary &:not(.btn) {
				&,
				&:visited {
					color: {$colors['body_link_color']};
				}

				&:hover,
				&:active,
				&:focus {
					color: {$colors['body_link_hover_color']};
				}
			}
		}

		.facetwp-alpha {
			&.available,
			&.selected {
				color: {$colors['body_link_color']} !important;

				&:hover {
					color: {$colors['body_link_hover_color']} !important;
				}
			}
		}

		figure.wp-caption {
			border-color: {$colors['body_line_color']};

			figcaption.wp-caption-text {
				border-top-color: {$colors['body_line_color']};
			}
		}

		.page-header {
			border-bottom-color: {$colors['body_line_color']};
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_body', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Assign CSS to footer cta theme mod.
 */
function lsx_customizer_colour__footer_cta_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__footer_cta_get_theme_mods();
	$styles     = lsx_customizer_colour__footer_cta_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__footer_cta_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__footer_cta_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__footer_cta_set_theme_mod' );

/**
 * Enqueues front-end CSS for the footer cta.
 */
function lsx_customizer_colour__footer_cta_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__footer_cta_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__footer_cta_get_theme_mods();
		$styles     = lsx_customizer_colour__footer_cta_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__footer_cta_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__footer_cta_css', 12 );

/**
 * Get footer cta CSS theme mods.
 */
function lsx_customizer_colour__footer_cta_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'footer_cta_background_color' => get_theme_mod( 'footer_cta_background_color', $colors['footer_cta_background_color'] ),
		'footer_cta_text_color'       => get_theme_mod( 'footer_cta_text_color',       $colors['footer_cta_text_color'] ),
		'footer_cta_link_color'       => get_theme_mod( 'footer_cta_link_color',       $colors['footer_cta_link_color'] ),
		'footer_cta_link_hover_color' => get_theme_mod( 'footer_cta_link_hover_color', $colors['footer_cta_link_hover_color'] )
	);
}

/**
 * Returns CSS for the footer cta.
 */
function lsx_customizer_colour__footer_cta_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Footer CTA
		 *
		 */

		#footer-cta {
			&,
			.lsx-full-width {
				background-color: {$colors['footer_cta_background_color']};
			}

			h1, h2, h3, h4, h5, h6,
			.textwidget {
				color: {$colors['footer_cta_text_color']};

				a {
					&,
					&:visited {
						color: {$colors['footer_cta_link_color']};
					}

					&:hover,
					&:active,
					&:focus {
						color: {$colors['footer_cta_link_hover_color']};
					}
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_footer_cta', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */

/**
 * Assign CSS to footer widgets theme mod.
 */
function lsx_customizer_colour__footer_widgets_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__footer_widgets_get_theme_mods();
	$styles     = lsx_customizer_colour__footer_widgets_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__footer_widgets_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__footer_widgets_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__footer_widgets_set_theme_mod' );

/**
 * Enqueues front-end CSS for the footer widgets.
 */
function lsx_customizer_colour__footer_widgets_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__footer_widgets_theme_mod' );
	
	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__footer_widgets_get_theme_mods();
		$styles     = lsx_customizer_colour__footer_widgets_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__footer_widgets_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__footer_widgets_css', 12 );

/**
 * Get footer widgets CSS theme mods.
 */
function lsx_customizer_colour__footer_widgets_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'footer_widgets_background_color' => get_theme_mod( 'footer_widgets_background_color', $colors['footer_widgets_background_color'] ),
		'footer_widgets_text_color'       => get_theme_mod( 'footer_widgets_text_color',       $colors['footer_widgets_text_color'] ),
		'footer_widgets_link_color'       => get_theme_mod( 'footer_widgets_link_color',       $colors['footer_widgets_link_color'] ),
		'footer_widgets_link_hover_color' => get_theme_mod( 'footer_widgets_link_hover_color', $colors['footer_widgets_link_hover_color'] )
	);
}

/**
 * Returns CSS for the footer widgets.
 */
function lsx_customizer_colour__footer_widgets_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Footer Widgets
		 *
		 */

		#footer-widgets {
			background-color: {$colors['footer_widgets_background_color']};

			&,
			.widget,
			.widget h3.widget-title {
				color: {$colors['footer_widgets_text_color']};

				a {
					&,
					&:visited {
						color: {$colors['footer_widgets_link_color']};
					}

					&:hover,
					&:active,
					&:focus {
						color: {$colors['footer_widgets_link_hover_color']};
					}
				}
			}

			.widget {
				h3.widget-title {
					border-bottom-color: {$colors['footer_widgets_text_color']};
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_footer_widgets', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */

/**
 * Assign CSS to footer theme mod.
 */
function lsx_customizer_colour__footer_set_theme_mod() {
	$theme_mods = lsx_customizer_colour__footer_get_theme_mods();
	$styles     = lsx_customizer_colour__footer_get_css( $theme_mods );
	
	set_theme_mod( 'lsx_customizer_colour__footer_theme_mod', $styles );
}
add_action( 'after_switch_theme',   'lsx_customizer_colour__footer_set_theme_mod' );
add_action( 'customize_save_after', 'lsx_customizer_colour__footer_set_theme_mod' );

/**
 * Enqueues front-end CSS for the footer.
 */
function lsx_customizer_colour__footer_css() {
	$styles_from_theme_mod = get_theme_mod( 'lsx_customizer_colour__footer_theme_mod' );

	if ( is_customize_preview() || false === $styles_from_theme_mod ) {
		$theme_mods = lsx_customizer_colour__footer_get_theme_mods();
		$styles     = lsx_customizer_colour__footer_get_css( $theme_mods );
		
		if ( false === $styles_from_theme_mod ) {
			set_theme_mod( 'lsx_customizer_colour__footer_theme_mod', $styles );
		}
	} else {
		$styles = $styles_from_theme_mod;
	}

	wp_add_inline_style( 'lsx_customizer_colour', $styles );
}
add_action( 'wp_footer', 'lsx_customizer_colour__footer_css', 12 );

/**
 * Get footer CSS theme mods.
 */
function lsx_customizer_colour__footer_get_theme_mods() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors       = array();
	$counter      = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	return array(
		'footer_background_color' => get_theme_mod( 'footer_background_color', $colors['footer_background_color'] ),
		'footer_text_color'       => get_theme_mod( 'footer_text_color',       $colors['footer_text_color'] ),
		'footer_link_color'       => get_theme_mod( 'footer_link_color',       $colors['footer_link_color'] ),
		'footer_link_hover_color' => get_theme_mod( 'footer_link_hover_color', $colors['footer_link_hover_color'] )
	);
}

/**
 * Returns CSS for the footer.
 */
function lsx_customizer_colour__footer_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
		/*
		 *
		 * Footer
		 *
		 */

		footer.content-info {
			background-color: {$colors['footer_background_color']};

			&,
			& .credit {
				color: {$colors['footer_text_color']};
			}

			a {
				&,
				&:visited {
					color: {$colors['footer_link_color']};
				}

				&:hover,
				&:active,
				&:focus {
					color: {$colors['footer_link_hover_color']};
				}
			}
		}

		nav#footer-navigation {
			ul {
				li {
					border-right-color: {$colors['footer_link_color']};
				}
			}
		}
CSS;

	$css = apply_filters( 'lsx_customizer_colour_selectors_footer', $css, $colors );
	$css = lsx_customizer_colour__scss_to_css( $css );
	return $css;
}


/* ################################################################################# */


/**
 * Customize Colour Control Class
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

class LSX_Customize_Colour_Control extends WP_Customize_Control {
	
	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
		wp_localize_script( 'lsx-colour-control', 'colorScheme', $this->choices );

		global $customizer_colour_names;
		$colors = array();
		foreach ( $customizer_colour_names as $key => $value ) {
			$colors[] = $key;
		}
		wp_localize_script( 'lsx-colour-control', 'colorSchemeKeys', $colors );
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
				<span class="description customize-control-description"><?php echo esc_html( $this->description ) ?></span>
			<?php } ?>
			<select <?php $this->link() ?>>
				<?php
					foreach ( $this->choices as $value => $label ) {
						echo '<option value="'. esc_attr( $value ) .'"'. selected( $this->value(), $value, false ) .'>'. esc_html( $label['label'] ) .'</option>';
					}
				?>
			</select>
		</label>
	<?php
	}

}

?>