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
	global $customizer_colour_choices;

	$customizer_colour_choices = array(
		'default' => array(
			'label'  => __( 'Default', 'lsx' ),
			'colors' => array(
				// Button
				'#428bca', '#2a6496', '#ffffff', '#ffffff',
				// Button CTA
				'#f7941d', '#f7741d', '#ffffff', '#ffffff',
				// Top Menu
				'#333333', '#ffffff', '#428bca',
				// Header
				'#ffffff', '#337ab7', '#23527c', '#777777',
				// Main Menu
				'', '', '', '',
				// Banner
				'', '', '', '',
				// Body
				'', '',
				// Footer CTA
				'', '', '', '',
				// Footer Widgets
				'', '', '', '',
				// Footer
				'', '', '', ''
			)
		),
		'red' => array(
			'label'  => __( 'Red', 'lsx' ),
			'colors' => array(
				// Button
				'#b64d3f', '#87291c', '#ffffff', '#ffffff',
				// Button CTA
				'#f7941d', '#f7741d', '#ffffff', '#ffffff',
				// Top Menu
				'#333333', '#ffffff', '#eaa520',
				// Header
				'#ffffff', '#b64d3f', '#87291c', '#777777',
				// Main Menu
				'', '', '', '',
				// Banner
				'', '', '', '',
				// Body
				'', '',
				// Footer CTA
				'', '', '', '',
				// Footer Widgets
				'', '', '', '',
				// Footer
				'', '', '', ''
			)
		),
		'orange' => array(
			'label'  => __( 'Orange', 'lsx' ),
			'colors' => array(
				// Button
				'#fbaf3f', '#e49435', '#260e03', '#260e03',
				// Button CTA
				'#f7941d', '#f7741d', '#ffffff', '#ffffff',
				// Top Menu
				'#333333', '#ffffff', '#cc4800',
				// Header
				'#ffffff', '#e4701e', '#cc4800', '#777777',
				// Main Menu
				'', '', '', '',
				// Banner
				'', '', '', '',
				// Body
				'', '',
				// Footer CTA
				'', '', '', '',
				// Footer Widgets
				'', '', '', '',
				// Footer
				'', '', '', ''
			)
		),
		'green' => array(
			'label'  => __( 'Green', 'lsx' ),
			'colors' => array(
				// Button
				'#596b46', '#3d4a30', '#ffffff', '#ffffff',
				// Button CTA
				'#f7941d', '#f7741d', '#ffffff', '#ffffff',
				// Top Menu
				'#333333', '#ffffff', '#a5a370',
				// Header
				'#ffffff', '#596b46', '#3d4a30', '#777777',
				// Main Menu
				'', '', '', '',
				// Banner
				'', '', '', '',
				// Body
				'', '',
				// Footer CTA
				'', '', '', '',
				// Footer Widgets
				'', '', '', '',
				// Footer
				'', '', '', ''
			)
		),
		'brown' => array(
			'label'  => __( 'Brown', 'lsx' ),
			'colors' => array(
				// Button
				'#8c6a45', '#5b452e', '#ffffff', '#ffffff',
				// Button CTA
				'#f7941d', '#f7741d', '#ffffff', '#ffffff',
				// Top Menu
				'#333333', '#ffffff', '#dfad55',
				// Header
				'#ffffff', '#8c6a45', '#5b452e', '#777777',
				// Main Menu
				'', '', '', '',
				// Banner
				'', '', '', '',
				// Body
				'', '',
				// Footer CTA
				'', '', '', '',
				// Footer Widgets
				'', '', '', '',
				// Footer
				'', '', '', ''
			)
		)
	);

	// Base
	
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

	// Button

	$lsx_controls['settings']['button_background_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][0],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_background_color'] = array(
		'label'         =>  esc_html__( 'Button: Background', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_background_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][1],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_background_hover_color'] = array(
		'label'         =>  esc_html__( 'Button: Background (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_text_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][2],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_text_color'] = array(
		'label'         =>  esc_html__( 'Button: Text', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_text_color_hover'] = array(
		'default'       =>  $customizer_colour_choices['default'][3],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_text_color_hover'] = array(
		'label'         =>  esc_html__( 'Button: Text (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	// Button CTA

	$lsx_controls['settings']['button_cta_background_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][4],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_cta_background_color'] = array(
		'label'         =>  esc_html__( 'Button CTA: Background', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_cta_background_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][5],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_cta_background_hover_color'] = array(
		'label'         =>  esc_html__( 'Button CTA: Background (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_cta_text_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][6],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_cta_text_color'] = array(
		'label'         =>  esc_html__( 'Button CTA: Text', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['button_cta_text_color_hover'] = array(
		'default'       =>  $customizer_colour_choices['default'][7],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['button_cta_text_color_hover'] = array(
		'label'         =>  esc_html__( 'Button CTA: Text (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	// Top Menu

	$lsx_controls['settings']['top_menu_background_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][8],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['top_menu_background_color'] = array(
		'label'         =>  esc_html__( 'Top Menu: Background', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['top_menu_text_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][9],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['top_menu_text_color'] = array(
		'label'         =>  esc_html__( 'Top Menu: Text', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['top_menu_text_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][10],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['top_menu_text_hover_color'] = array(
		'label'         =>  esc_html__( 'Top Menu: Text (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	// Header

	$lsx_controls['settings']['header_background_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][11],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['header_background_color'] = array(
		'label'         =>  esc_html__( 'Header: Background', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['header_title_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][12],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['header_title_color'] = array(
		'label'         =>  esc_html__( 'Header: Title', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['header_title_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][13],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['header_title_hover_color'] = array(
		'label'         =>  esc_html__( 'Header: Title (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['header_description_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][14],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['header_description_color'] = array(
		'label'         =>  esc_html__( 'Header: Description', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	// Main Menu

	/*
	$lsx_controls['settings']['main_menu_background_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][15],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['main_menu_background_color'] = array(
		'label'         =>  esc_html__( 'Menu: Background', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['main_menu_background_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][16],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['main_menu_background_hover_color'] = array(
		'label'         =>  esc_html__( 'Menu: Background (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['main_menu_text_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][17],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['main_menu_text_color'] = array(
		'label'         =>  esc_html__( 'Menu: Text', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);

	$lsx_controls['settings']['main_menu_text_hover_color'] = array(
		'default'       =>  $customizer_colour_choices['default'][18],
		'type'	        =>  'theme_mod',
		'transport'     =>  'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	);
	$lsx_controls['fields']['main_menu_text_hover_color'] = array(
		'label'         =>  esc_html__( 'Menu: Text (hover)', 'lsx' ),
		'section'       =>  'colors',
		'control'       =>  'WP_Customize_Color_Control',
	);
	*/

	// Banner

	// Body

	// Footer CTA

	// Footer Widgets

	// Footer

	// Return

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