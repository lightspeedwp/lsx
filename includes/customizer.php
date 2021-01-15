<?php
/**
 * LSX functions and definitions - Customizer.
 *
 * @package    lsx
 * @subpackage customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_customizer_layout_controls' ) ) :

	/**
	 * Returns an array of the layout panel.
	 *
	 * @package    lsx
	 * @subpackage customizer
	 *
	 * @return $lsx_controls array()
	 */
	function lsx_customizer_layout_controls( $lsx_controls ) {
		$lsx_controls['sections']['lsx-layout'] = array(
			'title'       => esc_html__( 'Layout', 'lsx' ),
			'description' => esc_html__( 'Change the layout sitewide. If your homepage is set to use a page with a template, the following will not apply to it.', 'lsx' ),
			'priority'    => 22,
		);

		$lsx_controls['settings']['lsx_header_fixed'] = array(
			'default'           => false,
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_header_fixed'] = array(
			'label'   => esc_html__( 'Fixed Header', 'lsx' ),
			'section' => 'lsx-layout',
			'type'    => 'checkbox',
		);

		$lsx_controls['settings']['lsx_header_search'] = array(
			'default'           => false,
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_header_search'] = array(
			'label'   => esc_html__( 'Search Box in Header', 'lsx' ),
			'section' => 'lsx-layout',
			'type'    => 'checkbox',
		);

		$lsx_controls['selective_refresh']['lsx_header_search'] = array(
			'selector'        => '#lsx-header-search-css',
			'render_callback' => function() {
				$search_form = get_theme_mod( 'lsx_header_search' );

				if ( false !== $search_form ) {
					echo 'body #searchform { display: block; }';
				} else {
					echo 'body #searchform { display: none; }';
				}
			},
		);

		$lsx_controls['settings']['lsx_header_layout'] = array(
			'default'   => 'inline',
			'type'      => 'theme_mod',
			'transport' => 'postMessage',
		);

		$lsx_controls['fields']['lsx_header_layout'] = array(
			'label'   => esc_html__( 'Header', 'lsx' ),
			'section' => 'lsx-layout',
			'control' => 'LSX_Customize_Header_Layout_Control',
			'choices' => array(
				'central',
				'expanded',
				'inline',
			),
		);

		$lsx_controls['settings']['lsx_header_mobile_layout'] = array(
			'default'   => 'navigation-bar',
			'type'      => 'theme_mod',
			'transport' => 'postMessage',
		);

		$lsx_controls['fields']['lsx_header_mobile_layout'] = array(
			'label'   => esc_html__( 'Mobile Header', 'lsx' ),
			'section' => 'lsx-layout',
			'control' => 'LSX_Customize_Mobile_Header_Layout_Control',
			'choices' => array(
				'navigation-bar',
				'hamburger',
			),
		);

		$lsx_controls['settings']['lsx_layout'] = array(
			'default'   => '1c',
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		);

		$lsx_controls['fields']['lsx_layout'] = array(
			'label'   => esc_html__( 'Body', 'lsx' ),
			'section' => 'lsx-layout',
			'control' => 'LSX_Customize_Layout_Control',
			'choices' => array(
				'1c',
				'2cr',
				'2cl',
			),
		);

		$lsx_controls = apply_filters( 'lsx_layout_customizer_controls', $lsx_controls );

		return $lsx_controls;
	}

endif;

add_filter( 'lsx_customizer_controls', 'lsx_customizer_layout_controls' );

if ( ! function_exists( 'lsx_customizer_template_cover_controls' ) ) :

	/**
	 * Returns an array of the Cover Template panel.
	 *
	 * @package    lsx
	 * @subpackage customizer
	 *
	 * @return $lsx_controls array()
	 */
	function lsx_customizer_template_cover_controls( $lsx_controls ) {
		$lsx_controls['sections']['lsx-cover-template'] = array(
			'title'       => esc_html__( 'Cover Template Settings', 'lsx' ),
			'description' => esc_html__( 'Change the cover template settings.', 'lsx' ),
			'priority'    => 23,
		);

		$lsx_controls['settings']['lsx_cover_template_alt_logo'] = array(
			'default'           => '',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		);

		$lsx_controls['fields']['lsx_cover_template_alt_logo'] = array(
			'label'       => esc_html__( 'Upload Alternative Logo Image', 'lsx' ),
			'description' => __( 'Upload an alternative logo image (svg, png or jpg).', 'lsx' ),
			'section'     => 'lsx-cover-template',
			'control'     => 'WP_Customize_Media_Control',
			'mime_type'   => 'image',
		);

		$lsx_controls['settings']['lsx_cover_template_fixed_background'] = array(
			'default'           => '',
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_fixed_background'] = array(
			'label'   => esc_html__( 'Fixed Background Image', 'lsx' ),
			'section' => 'lsx-cover-template',
			'type'    => 'checkbox',
		);

		$lsx_controls['settings']['lsx_cover_template_cover_background_color'] = array(
			'default'           => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_cover_background_color'] = array(
			'label'       => esc_html__( 'Cover Background Colour', 'lsx' ),
			'description' => __( 'The colour used for the cover background, for post or pages without featured image. Defaults to #27639e.', 'lsx' ),
			'section'     => 'lsx-cover-template',
			'control'     => 'WP_Customize_Color_Control',
		);

		$lsx_controls['settings']['lsx_cover_template_overlay_background_color'] = array(
			'default'           => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_overlay_background_color'] = array(
			'label'       => esc_html__( 'Overlay Background Colour', 'lsx' ),
			'description' => __( 'The colour used for the overlay. Defaults to black.', 'lsx' ),
			'section'     => 'lsx-cover-template',
			'control'     => 'WP_Customize_Color_Control',
		);

		$lsx_controls['settings']['lsx_cover_template_overlay_text_color'] = array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_overlay_text_color'] = (
			array(
				'label'       => __( 'Overlay Text Colour', 'lsx' ),
				'description' => __( 'The colour used for the text in the overlay.', 'lsx' ),
				'section'     => 'lsx-cover-template',
				'control'     => 'WP_Customize_Color_Control',
			)
		);

		$lsx_controls['settings']['lsx_cover_template_overlay_opacity'] = array(
			'default'           => 80,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_overlay_opacity'] = (
			array(
				'label'       => __( 'Overlay Opacity', 'lsx' ),
				'description' => __( 'Make sure that the contrast is high enough so that the text is readable.', 'lsx' ),
				'section'     => 'lsx-cover-template',
				'type'        => 'range',
			)
		);

		$lsx_controls['settings']['lsx_cover_template_menu_text_color'] = array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_menu_text_color'] = (
			array(
				'label'       => __( 'Menu Text Colour', 'lsx' ),
				'description' => __( 'The colour used for the text in the nav menu.', 'lsx' ),
				'section'     => 'lsx-cover-template',
				'control'     => 'WP_Customize_Color_Control',
			)
		);

		$lsx_controls['settings']['lsx_cover_template_text_hover_color'] = array(
			'default'           => '#f7ae00',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'theme_mod',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_cover_template_text_hover_color'] = (
			array(
				'label'       => __( 'Hover Text Colour', 'lsx' ),
				'description' => __( 'The colour used for the text hover on links and the nav menu.', 'lsx' ),
				'section'     => 'lsx-cover-template',
				'control'     => 'WP_Customize_Color_Control',
			)
		);


		return $lsx_controls;
	}

endif;

add_filter( 'lsx_customizer_controls', 'lsx_customizer_template_cover_controls' );


if ( ! function_exists( 'lsx_get_customizer_controls' ) ) :

	/**
	 * Returns an array of $controls for the customizer class to generate.
	 *
	 * @package    lsx
	 * @subpackage customizer
	 *
	 * @return $lsx_controls array()
	 */
	function lsx_get_customizer_controls() {
		$lsx_controls = array();
		$lsx_controls = apply_filters( 'lsx_customizer_controls', $lsx_controls );
		return $lsx_controls;
	}

endif;

$lsx_customizer = new LSX_Theme_Customizer( lsx_get_customizer_controls() );
