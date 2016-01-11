<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

define('LSX_VERSION', '1.4');

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
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Returns an array of the hompage slider.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_slider_controls($lsx_controls) {
	if(function_exists('soliloquy')){
		// add homepage slider section
		$lsx_controls['sections']['lsx-homepage'] = array(
				'title'       =>  'Homepage'
		);
		/// add the setting
		$lsx_controls['settings']['lsx_homepage_slider']  = array(
				'default'       =>  '0', //Default setting/value to save
				'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
		);
		/// add the control
		$lsx_controls['fields']['lsx_homepage_slider'] = array(
				'label'         =>  esc_html__( 'Select Slider', 'lsx' ),
				'section'       =>  'lsx-homepage',
				'type'          =>  'select',
				'choices'       =>  LSX_Theme_Customizer::get_slider_post_type_choices()
		);		 
	}	
	return $lsx_controls;
}
add_filter('lsx_customizer_controls','lsx_customizer_slider_controls');

/**
 * Returns an array of for Colour Scheme Picker.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_colour_scheme_controls($lsx_controls) {
	$lsx_controls['settings']['lsx_color_scheme']  = array(
			'default'       =>  'default', //Default setting/value to save
			'type'	        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);
	$lsx_controls['fields']['lsx_color_scheme'] = array(
			'label'         =>  esc_html__( 'Color Scheme', 'lsx' ),
			'section'       =>  'colors',
			'type'          =>  'select',
			'choices'  => array(
		 		'default' => esc_html__( 'Default', 'lsx' ),
					'red' => esc_html__( 'Red', 'lsx' ),
					'green' => esc_html__( 'Green', 'lsx' ),
					'brown' => esc_html__( 'Brown', 'lsx' ),
					'orange' => esc_html__( 'Orange', 'lsx' )
			),
			'control'   =>  'LSX_Customize_Colour_Control',
			'priority' => 1,
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
 * Returns an array of the hompage slider.
 *
 * @package 	lsx
 * @subpackage	functions
 * @category	customizer
 * @return		$lsx_controls array()
 */
function lsx_customizer_metaplate_controls($lsx_controls) {
	$lsx_controls['sections']['lsx-metaplate'] = array(
			'title'       =>  'Metaplate'
	);
	$lsx_controls['settings']['lsx_header_email_address']  = array(
			'default'       =>  'email@address.com', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			'sanitize_callback' => 'lsx_sanitize_email',
	);
	$lsx_controls['fields']['lsx_header_email_address'] = array(
			'label'         =>  esc_html__( 'Email Address', 'lsx' ),
			'section'       =>  'lsx-metaplate',
			'type'          =>  'email',
	);	
	return $lsx_controls;
}
add_filter('lsx_customizer_controls','lsx_customizer_metaplate_controls');

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