<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

define('LSX_VERSION', '1.5');

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/sanitize.php';
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/comment-walker.php';
require get_template_directory() . '/inc/jetpack.php';
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
if(true === apply_filters( 'amp_is_enabled', true ) ){
	require get_template_directory() . '/inc/amp.php';
}
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
if(class_exists('Sensei_WC')){
	require get_template_directory() . '/inc/sensei.php';
}

/**
 * Returns an array of for Colour Scheme Picker.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_colour_scheme_controls($lsx_controls) {
	$lsx_controls['settings']['lsx_color_scheme'] = array(
		'default'       =>  'default',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
	);
	$lsx_controls['fields']['lsx_color_scheme'] = array(
		'label'         =>  esc_html__( 'Color Scheme', 'lsx' ),
		'section'       =>  'colors',
		'type'          =>  'select',
		'priority'      =>  1,
		'control'       =>  'LSX_Customize_Colour_Control',
		'choices'       =>  apply_filters( 'lsx_color_schemes',
								array(
									'default' => array(
										'label'  => __( 'Default', 'lsx' ),
										'colors' => array(
											'#1a1a1a',
											'#ffffff',
											'#007acc',
											'#1a1a1a',
											'#686868',
										),
									),
									'dark' => array(
										'label'  => __( 'Dark', 'lsx' ),
										'colors' => array(
											'#262626',
											'#1a1a1a',
											'#9adffd',
											'#e5e5e5',
											'#c1c1c1',
										),
									),
									'gray' => array(
										'label'  => __( 'Gray', 'lsx' ),
										'colors' => array(
											'#616a73',
											'#4d545c',
											'#c7c7c7',
											'#f2f2f2',
											'#f2f2f2',
										),
									),
									'red' => array(
										'label'  => __( 'Red', 'lsx' ),
										'colors' => array(
											'#ffffff',
											'#ff675f',
											'#640c1f',
											'#402b30',
											'#402b30',
										),
									),
									'yellow' => array(
										'label'  => __( 'Yellow', 'lsx' ),
										'colors' => array(
											'#3b3721',
											'#ffef8e',
											'#774e24',
											'#3b3721',
											'#5b4d3e',
										),
									),
								)
							)
	);

	$lsx_controls['settings']['page_background_color'] = array(
		'default'       =>  '#ffffff',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['page_background_color'] = array(
		'label'         =>  esc_html__( 'Page Background Color', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['link_color'] = array(
		'default'       =>  '#007acc',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['link_color'] = array(
		'label'         =>  esc_html__( 'Link Color', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['main_text_color'] = array(
		'default'       =>  '#1a1a1a',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['main_text_color'] = array(
		'label'         =>  esc_html__( 'Main Text Color', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['secondary_text_color'] = array(
		'default'       =>  '#686868',
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['secondary_text_color'] = array(
		'label'         =>  esc_html__( 'Secondary Text Color', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	return $lsx_controls;
}
add_filter('lsx_customizer_controls','lsx_customizer_colour_scheme_controls');

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
			'priority' => 112
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
			'priority' => 42
	);
	$lsx_controls['settings']['lsx_font']  = array(
			'default'       =>  'raleway_open_sans', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	/// add the control
	$lsx_controls['fields']['lsx_font'] = array(
			'label'         =>  __( '', 'lsx' ),
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