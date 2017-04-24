<?php
/**
 * LSX functions and definitions - Customizer
 *
 * @package    lsx
 * @subpackage customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_customizer_core_controls' ) ) :

	/**
	 * Returns an array of the core panel.
	 *
	 * @package 	lsx
	 * @subpackage	customizer
	 *
	 * @return		$lsx_controls array()
	 */
	function lsx_customizer_core_controls( $lsx_controls ) {
		$lsx_controls['sections']['lsx-core'] = array(
			'title'       => esc_html__( 'Core Settings', 'lsx' ),
			'description' => esc_html__( 'Change the core settings.', 'lsx' ),
			'priority'    => 21
		);

		$lsx_controls['settings']['lsx_lazyload_status'] = array(
			'default'           => '1',
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_lazyload_status'] = array(
			'label'   => esc_html__( 'Lazy Loading Images', 'lsx' ),
			'section' => 'lsx-core',
			'type'    => 'checkbox',
		);

		$lsx_controls['settings']['lsx_preloader_content_status'] = array(
			'default'           => '1',
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'         => 'postMessage',
		);

		$lsx_controls['fields']['lsx_preloader_content_status'] = array(
			'label'   => esc_html__( 'Preloader Content', 'lsx' ),
			'section' => 'lsx-core',
			'type'    => 'checkbox',
		);

		return $lsx_controls;
	}

endif;
add_filter( 'lsx_customizer_controls', 'lsx_customizer_core_controls' );

if ( ! function_exists( 'lsx_customizer_layout_controls' ) ) :

	/**
	 * Returns an array of the layout panel.
	 *
	 * @package 	lsx
	 * @subpackage	customizer
	 *
	 * @return		$lsx_controls array()
	 */
	function lsx_customizer_layout_controls( $lsx_controls ) {
		$lsx_controls['settings']['lsx_header_layout']  = array(
			'default'   => 'inline',
			'type'      => 'theme_mod',
			'transport' => 'postMessage',
		);

		$lsx_controls['fields']['lsx_header_layout'] = array(
			'label'   => esc_html__('Header','lsx'),
			'section' => 'lsx-layout',
			'control' => 'LSX_Customize_Header_Layout_Control',
			'choices' => array(
				'central',
				'expanded',
				'inline',
			),
		);

		$lsx_controls['sections']['lsx-layout'] = array(
			'title'       => esc_html__( 'Layout', 'lsx' ),
			'description' => esc_html__( 'Change the layout sitewide. If your homepage is set to use a page with a template, the following will not apply to it.', 'lsx' ),
			'priority'    => 22,
		);

		$lsx_controls['settings']['lsx_layout'] = array(
			'default'   => '2cr',
			'type'      => 'theme_mod',
			'transport' => 'refresh',
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

		return $lsx_controls;
	}

endif;
add_filter( 'lsx_customizer_controls', 'lsx_customizer_layout_controls' );

if ( ! function_exists( 'lsx_customizer_font_controls' ) ) :

	/**
	 * Returns an array of the font controls.
	 *
	 * @package 	lsx
	 * @subpackage	customizer
	 *
	 * @return		$lsx_controls array()
	 */
	function lsx_customizer_font_controls( $lsx_controls ) {
		$lsx_controls['sections']['lsx-font'] = array(
			'title'       => esc_html__( 'Font', 'lsx' ),
			'description' => esc_html__( 'Change the fonts sitewide.', 'lsx' ),
			'priority'    => 41
		);

		$lsx_controls['settings']['lsx_font']  = array(
			'default'   => 'raleway_open_sans',
			'type'      => 'theme_mod',
			'transport' => 'refresh',
		);

		$lsx_controls['fields']['lsx_font'] = array(
			'label'    => '',
			'section'  => 'lsx-font',
			'settings' => 'lsx_font',
			'control'  => 'LSX_Customize_Font_Control',
			'choices'  => array(
				'raleway_open_sans' => array(
					'header' => array(
						'title'          => esc_html__( 'Raleway', 'lsx' ),
						'location'       => 'Raleway',
						'cssDeclaration' => "'Raleway', sans-serif",
						'cssClass'       => 'raleway',
					),
					'body' => array(
						'title'          => esc_html__( 'Open Sans', 'lsx' ),
						'location'       => 'Open+Sans',
						'cssDeclaration' => "'Open Sans', sans-serif",
						'cssClass'       => 'openSans'
					),
				),
				'noto_serif_noto_sans' => array(
					'header' => array(
						'title'          => esc_html__( 'Noto Serif', 'lsx' ),
						'location'       => 'Noto+Serif',
						'cssDeclaration' => "'Noto Serif', serif",
						'cssClass'       => 'notoSerif',
					),
					'body' => array(
						'title'          => esc_html__( 'Noto Sans', 'lsx' ),
						'location'       => 'Noto+Sans',
						'cssDeclaration' => "'Noto Sans', sans-serif",
						'cssClass'       => 'notoSans',
					),
				),
				'noto_sans_noto_sans' => array(
					'header' => array(
						'title'          => esc_html__( 'Noto Sans', 'lsx' ),
						'location'       => 'Noto+Sans',
						'cssDeclaration' => "'Noto Sans', sans-serif",
						'cssClass'       => 'notoSans',
					),
					'body' => array(
						'title' => esc_html__( 'Noto Sans', 'lsx' ),
						'location'       => 'Noto+Sans',
						'cssDeclaration' => "'Noto Sans', sans-serif",
						'cssClass'       => 'notoSans',
					),
				),
				'alegreya_open_sans' => array(
					'header' => array(
						'title'          => esc_html__( 'Alegreya', 'lsx' ),
						'location'       => 'Alegreya',
						'cssDeclaration' => "'Alegreya', serif",
						'cssClass'       => 'alegreya',
					),
					'body' => array(
						'title'          => esc_html__( 'Open Sans', 'lsx' ),
						'location'       => 'Open+Sans',
						'cssDeclaration' => "'Open Sans', sans-serif",
						'cssClass'       => 'openSans'
					),
				),
			),
			'priority' => 2,
		);

		return $lsx_controls;
	}

endif;
add_filter( 'lsx_customizer_controls', 'lsx_customizer_font_controls' );

if ( ! function_exists( 'lsx_get_customizer_controls' ) ) :

	/**
	 * Returns an array of $controls for the customizer class to generate.
	 *
	 * @package 	lsx
	 * @subpackage	customizer
	 *
	 * @return		$lsx_controls array()
	 */
	function lsx_get_customizer_controls() {
		$lsx_controls = array();
		$lsx_controls = apply_filters( 'lsx_customizer_controls', $lsx_controls );
		return $lsx_controls;
	}

endif;

$lsx_customizer = new LSX_Theme_Customizer( lsx_get_customizer_controls() );
