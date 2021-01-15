<?php

/**
 * Enqueues the editor styles.
 *
 * @return void
 */
function editor_styles() {

	// Enqueue  shared editor styles.
	add_editor_style(
		'/assets/css/admin/gutenberg-admin.css'
	);
	add_editor_style(
		'/assets/css/yoast/yoast.css'
	);

}
add_action( 'admin_init', 'editor_styles' );

/**
 * Add theme support functions.
 *
 * @package lsx
 */

if ( ! function_exists( 'theme_support' ) ) :
	/**
	 * Add theme support functions.
	 *
	 * @return void
	 */
	function theme_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
		// Add support for styling blocks.
		add_theme_support( 'wp-block-styles' );
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		// Add support for Custom Line Heights.
		add_theme_support( 'custom-line-height' );
		// Add support for Custom Units.
		add_theme_support( 'custom-units' );
		// Add support for experimental link colors.
		add_theme_support( 'experimental-link-color' );
		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html_x( 'Small', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'S', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html_x( 'Normal', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'N', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 15,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html_x( 'Medium', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'M', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 22,
					'slug'      => 'medium',
				),
				array(
					'name'      => esc_html_x( 'Large', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'L', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 30,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html_x( 'Huge', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'XL', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 40,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'lsx' ),
				'slug'  => 'strong-blue',
				'color' => '#27639e',
			),
			array(
				'name'  => __( 'Lighter Blue', 'lsx' ),
				'slug'  => 'lighter-blue',
				'color' => '#428bca',
			),
			array(
				'name'  => __( 'Yellow', 'lsx' ),
				'slug'  => 'light-yellow',
				'color' => '#f7ae00',
			),
			array(
				'name'  => __( 'Dark Yellow', 'lsx' ),
				'slug'  => 'dark-yellow',
				'color' => '#ab7800',
			),
			array(
				'name'  => __( 'Green', 'lsx' ),
				'slug'  => 'light-green',
				'color' => '#6BA913',
			),
			array(
				'name'  => __( 'Dark Green', 'lsx' ),
				'slug'  => 'dark-green',
				'color' => '#3F640B',
			),
			array(
				'name'  => __( 'White', 'lsx' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'lsx' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		) );

		$primary_color    = 'rgba(39,99,158,1)';
		$secondary_color  = 'rgba(247,174,0,1)';
		$tertiary_color   = 'rgba(107,169,19,1)';
		$background_color = 'rgba(249,249,249,1)';

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => __( 'Primary to Secondary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $secondary_color ) . ' 100%)',
					'slug'     => 'primary-to-secondary',
				),
				array(
					'name'     => __( 'Primary to Tertiary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $tertiary_color ) . ' 100%)',
					'slug'     => 'primary-to-tertiary',
				),
				array(
					'name'     => __( 'Primary to Background', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $background_color ) . ' 100%)',
					'slug'     => 'primary-to-background',
				),
				array(
					'name'     => __( 'Secondary to Tertiary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $secondary_color ) . ' 0%, ' . esc_attr( $tertiary_color ) . ' 100%)',
					'slug'     => 'secondary-to-tertiary',
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'theme_support' );

/**
 * WPForms submit button, match Gutenberg button block
 *
 * @param [type] $form_data
 * @return void
 */
function lsx_wpforms_match_button_block( $form_data ) {
	$form_data['settings']['submit_class'] .= ' btn';
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'lsx_wpforms_match_button_block' );
