<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

define('LSX_VERSION', '1.7.3');

require get_template_directory() . '/inc/config.php';
//require get_template_directory() . '/inc/example/customizer-colour-extended.php';
require get_template_directory() . '/inc/customizer-colour-options.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/sanitize.php';
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/comment-walker.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/lazyload.php';
if(class_exists('BuddyPress')){
	require get_template_directory() . '/inc/buddypress.php';
}
if(class_exists('WooCommerce')){
	require get_template_directory() . '/inc/woocommerce.php';
}
if(class_exists('WP_Job_Manager')){
	require get_template_directory() . '/inc/wp-job-manager.php';
}
if(class_exists('Tribe__Events__Main')){
	require get_template_directory() . '/inc/the-events-calendar.php';
}
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
if(class_exists('Sensei_WC')){
	require get_template_directory() . '/inc/sensei.php';
}

/**
 * Returns an array of the core panel.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_core_controls( $lsx_controls ) {
	$lsx_controls['sections']['lsx-core'] = array(
		'title'       =>  esc_html__( 'Core Settings', 'lsx' ),
		'description' => __( 'Change the core settings.', 'lsx' ),
		'priority'    => 21
	);

	$lsx_controls['settings']['lsx_lazyload_status'] = array(
		'default'           =>  '1',
		'sanitize_callback' => 'lsx_sanitize_checkbox',
		'transport'         =>  'postMessage',
	);

	$lsx_controls['fields']['lsx_lazyload_status'] = array(
		'label'         =>  __( 'Lazy Loading Images', 'lsx' ),
		'section'       =>  'lsx-core',
		'type'          =>  'checkbox',
	);

	$lsx_controls['settings']['lsx_preloader_content_status'] = array(
		'default'           =>  '1',
		'sanitize_callback' => 'lsx_sanitize_checkbox',
		'transport'         =>  'postMessage',
	);

	$lsx_controls['fields']['lsx_preloader_content_status'] = array(
		'label'         =>  __( 'Preloader Content', 'lsx' ),
		'section'       =>  'lsx-core',
		'type'          =>  'checkbox',
	);

	return $lsx_controls;
}
add_filter( 'lsx_customizer_controls', 'lsx_customizer_core_controls' );

/**
 * Returns an array of the colour scheme picker.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_colour_scheme_controls( $lsx_controls ) {
	global $customizer_colour_names;
	global $customizer_colour_choices;
	
	$lsx_controls['settings']['color_scheme'] = array(
		'default'       =>  'default',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
	);

	$lsx_controls['fields']['color_scheme'] = array(
		'label'         =>  esc_html__( 'Base Color Scheme', 'lsx' ),
		'section'       =>  'colors',
		'type'          =>  'select',
		'priority'      =>  1,
		'control'       =>  'LSX_Customize_Colour_Control',
		'choices'       =>  $customizer_colour_choices
	);

	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$lsx_controls['settings'][$key] = array(
			'default'       =>  $customizer_colour_choices['default']['colors'][$counter],
			'type'	        =>  'theme_mod',
			'transport'     =>  'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		);

		$lsx_controls['fields'][$key] = array(
			'label'         =>  $value,
			'section'       =>  'colors',
			'control'       =>  'WP_Customize_Color_Control',
		);

		$counter++;
	}

	return $lsx_controls;
}
add_filter( 'lsx_customizer_controls', 'lsx_customizer_colour_scheme_controls' );

/**
 * Returns an array of the layout panel.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_layout_controls($lsx_controls) {
	$lsx_controls['settings']['lsx_header_layout']  = array(
			'default'       =>  'inline', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	$lsx_controls['fields']['lsx_header_layout'] = array(
			'label'         =>  __('Header','lsx'),
			'section'       =>  'lsx-layout',
			'control'   =>  'LSX_Customize_Header_Layout_Control',
			'choices'		=>	array('central','expanded','inline')
	);	
	$lsx_controls['sections']['lsx-layout'] = array(
			'title'       =>  esc_html__( 'Layout', 'lsx' ),
			'description' => __( 'Change the layout sitewide. If your homepage is set to use a page with a template, the following will not apply to it.', 'lsx' ),
			'priority' => 22
	);
	$lsx_controls['settings']['lsx_layout']  = array(
			'default'       =>  '2cr', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	$lsx_controls['settings']['lsx_header_fixed']  = array(
			'default'       =>  false, //Default setting/value to save
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	$lsx_controls['fields']['lsx_header_fixed'] = array(
			'label'         =>  __('Fixed Header','lsx'),
			'section'       =>  'lsx-layout',
			'type'       =>  'checkbox',
	);
	$lsx_controls['settings']['lsx_header_search']  = array(
			'default'       =>  false, //Default setting/value to save
			'sanitize_callback' => 'lsx_sanitize_checkbox',
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	$lsx_controls['fields']['lsx_header_search'] = array(
			'label'         =>  __('Search Box in Header','lsx'),
			'section'       =>  'lsx-layout',
			'type'       =>  'checkbox',
	);	
	$lsx_controls['fields']['lsx_layout'] = array(
			'label'         =>  __('Body','lsx'),
			'section'       =>  'lsx-layout',
			'control'   =>  'LSX_Customize_Layout_Control',
			'choices'		=>	array('1c','2cr','2cl')
	);	
	return $lsx_controls;
}
add_filter('lsx_customizer_controls','lsx_customizer_layout_controls');

/**
 * Returns an array of the font controls.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_font_controls($lsx_controls) {
	$lsx_controls['sections']['lsx-font'] = array(
			'title'       =>  __( 'Font', 'lsx' ),
			'description' => 'Change the fonts sitewide.',
			'priority' => 41
	);
	$lsx_controls['settings']['lsx_font']  = array(
			'default'       =>  'raleway_open_sans', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	/// add the control
	$lsx_controls['fields']['lsx_font'] = array(
			'label'         =>  '',
			'section'       =>  'lsx-font',
			'settings'      =>  'lsx_font',
			'control'   =>  'LSX_Customize_Font_Control',
			'choices'   =>  array(
					'raleway_open_sans' => array(
							'header'  => array(
									"title" => __( 'Raleway', 'lsx' ),
									"location" => "Raleway",
									"cssDeclaration" => "'Raleway', sans-serif",
									"cssClass" => "raleway",
							),
							'body'  => array(
									"title" => __( 'Open Sans', 'lsx' ),
									"location" => "Open+Sans",
									"cssDeclaration" => "'Open Sans', sans-serif",
									"cssClass" => "openSans"
							),
					),
					'noto_serif_noto_sans' => array(
							'header'  => array(
									"title" => __( 'Noto Serif', 'lsx' ),
									"location" => "Noto+Serif",
									"cssDeclaration" => "'Noto Serif', serif",
									"cssClass" => "notoSerif",
							),
							'body'  => array(
									"title" => __( 'Noto Sans', 'lsx' ),
									"location" => "Noto+Sans",
									"cssDeclaration" => "'Noto Sans', sans-serif",
									"cssClass" => "notoSans",
							),
					),
					'noto_sans_noto_sans' => array(
					'header'  => array(
					"title" => __( 'Noto Sans', 'lsx' ),
					"location" => "Noto+Sans",
					"cssDeclaration" => "'Noto Sans', sans-serif",
					"cssClass" => "notoSans",
					),
					'body'  => array(
					"title" => __( 'Noto Sans', 'lsx' ),
					"location" => "Noto+Sans",
					"cssDeclaration" => "'Noto Sans', sans-serif",
					"cssClass" => "notoSans",
					),
					),
					'alegreya_open_sans' => array(
					'header'  => array(
					"title" => __( 'Alegreya', 'lsx' ),
					"location" => "Alegreya",
					"cssDeclaration" => "'Alegreya', serif",
					"cssClass" => "alegreya",
					),
					'body'  => array(
					"title" => __( 'Open Sans', 'lsx' ),
					"location" => "Open+Sans",
					"cssDeclaration" => "'Open Sans', sans-serif",
					"cssClass" => "openSans"
							),
					),
			),
			'priority' => 2,
	);	
	return $lsx_controls;
}
add_filter('lsx_customizer_controls','lsx_customizer_font_controls');

/**
 * Returns an array of $controls for the customizer class to generate.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_get_customizer_controls(){
	$lsx_controls = array();
	$lsx_controls = apply_filters('lsx_customizer_controls', $lsx_controls);
	return $lsx_controls;
}
$lsx_customizer = new LSX_Theme_Customizer( lsx_get_customizer_controls() );

add_image_size( 'lsx-thumbnail-wide', 350, 230, true );
add_image_size( 'lsx-thumbnail-single', 750, 350, true );