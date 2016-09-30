<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

global $customizer_colour_names;
global $customizer_colour_choices;

$customizer_colour_names = apply_filters( 'lsx_customizer_colour_names', array(
	'button_background_color'           => esc_html__( 'BUTTON: Background', 'lsx' ),
	'button_background_hover_color'     => esc_html__( 'BUTTON: Background (hover)', 'lsx' ),
	'button_text_color'                 => esc_html__( 'BUTTON: Text', 'lsx' ),
	'button_text_color_hover'           => esc_html__( 'BUTTON: Text (hover)', 'lsx' ),

	'button_cta_background_color'       => esc_html__( 'BUTTON CTA: Background', 'lsx' ),
	'button_cta_background_hover_color' => esc_html__( 'BUTTON CTA: Background (hover)', 'lsx' ),
	'button_cta_text_color'             => esc_html__( 'BUTTON CTA: Text', 'lsx' ),
	'button_cta_text_color_hover'       => esc_html__( 'BUTTON CTA: Text (hover)', 'lsx' ),

	'top_menu_background_color'         => esc_html__( 'TOP MENU: Background', 'lsx' ),
	'top_menu_text_color'               => esc_html__( 'TOP MENU: Text', 'lsx' ),
	'top_menu_text_hover_color'         => esc_html__( 'TOP MENU: Text (hover)', 'lsx' ),

	'header_background_color'           => esc_html__( 'HEADER: Background', 'lsx' ),
	'header_title_color'                => esc_html__( 'HEADER: Title', 'lsx' ),
	'header_title_hover_color'          => esc_html__( 'HEADER: Title (hover)', 'lsx' ),
	'header_description_color'          => esc_html__( 'HEADER: Description', 'lsx' ),

	'main_menu_background_hover1_color' => esc_html__( 'MENU: Background (L1 hover)', 'lsx' ),
	'main_menu_background_hover2_color' => esc_html__( 'MENU: Background (L2 hover)', 'lsx' ),
	'main_menu_text_color'              => esc_html__( 'MENU: Text (L1)', 'lsx' ),
	'main_menu_text_hover1_color'       => esc_html__( 'MENU: Text (L1 hover)', 'lsx' ),
	'main_menu_text_hover2_color'       => esc_html__( 'MENU: Text (L2 hover)', 'lsx' ),

	'banner_background_color'           => esc_html__( 'BANNER: Background', 'lsx' ),
	'banner_text_color'                 => esc_html__( 'BANNER: Text', 'lsx' ),
	'banner_text_image_color'           => esc_html__( 'BANNER: Text (over image)', 'lsx' ),

	'body_background_color'             => esc_html__( 'BODY: Background', 'lsx' ),
	'body_line_color'                   => esc_html__( 'BODY: Line', 'lsx' ),
	'body_text_heading_color'           => esc_html__( 'BODY: Text (heading)', 'lsx' ),
	'body_text_color'                   => esc_html__( 'BODY: Text', 'lsx' ),
	'body_link_color'                   => esc_html__( 'BODY: Link', 'lsx' ),
	'body_link_hover_color'             => esc_html__( 'BODY: Link (hover)', 'lsx' ),

	'footer_cta_background_color'       => esc_html__( 'FOOTER CTA: Background', 'lsx' ),
	'footer_cta_text_color'             => esc_html__( 'FOOTER CTA: Text', 'lsx' ),
	'footer_cta_link_color'             => esc_html__( 'FOOTER CTA: Link', 'lsx' ),
	'footer_cta_link_hover_color'       => esc_html__( 'FOOTER CTA: Link (hover)', 'lsx' ),

	'footer_widgets_background_color'   => esc_html__( 'FOOTER WIDGETS: Background', 'lsx' ),
	'footer_widgets_text_color'         => esc_html__( 'FOOTER WIDGETS: Text', 'lsx' ),
	'footer_widgets_link_color'         => esc_html__( 'FOOTER WIDGETS: Link', 'lsx' ),
	'footer_widgets_link_hover_color'   => esc_html__( 'FOOTER WIDGETS: Link (hover)', 'lsx' ),

	'footer_background_color'           => esc_html__( 'FOOTER: Background', 'lsx' ),
	'footer_text_color'                 => esc_html__( 'FOOTER: Text', 'lsx' ),
	'footer_link_color'                 => esc_html__( 'FOOTER: Link', 'lsx' ),
	'footer_link_hover_color'           => esc_html__( 'FOOTER: Link (hover)', 'lsx' )
) );

$customizer_colour_choices = apply_filters( 'lsx_customizer_colour_choices', array(
	'default' => array(
		'label'  => __( 'Default', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_default', array(
			// Button
			'#428bca', '#2a6496', '#ffffff', '#ffffff',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#428bca',
			// Header
			'#ffffff', '#337ab7', '#23527c', '#777777',
			// Main Menu
			'#428bca', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#2a6496', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#337ab7', '#23527c',
			// Footer CTA
			'#428bca', '#ffffff', '#eeeeee', '#dddddd',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#337ab7', '#969696'
		) )
	),
	'red' => array(
		'label'  => __( 'Red', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_red', array(
			// Button
			'#b64d3f', '#87291c', '#ffffff', '#ffffff',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#eaa520',
			// Header
			'#ffffff', '#b64d3f', '#87291c', '#777777',
			// Main Menu
			'#b64d3f', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#87291c', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#b64d3f', '#87291c',
			// Footer CTA
			'#b64d3f', '#ffffff', '#ffffff', '#eeeeee',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#b64d3f', '#969696'
		) )
	),
	'orange' => array(
		'label'  => __( 'Orange', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_orange', array(
			// Button
			'#fbaf3f', '#e49435', '#260e03', '#260e03',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#cc4800',
			// Header
			'#ffffff', '#e4701e', '#cc4800', '#777777',
			// Main Menu
			'#fbaf3f', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#e49435', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#e4701e', '#cc4800',
			// Footer CTA
			'#fbaf3f', '#555555', '#555555', '#333333',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#e4701e', '#969696'
		) )
	),
	'green' => array(
		'label'  => __( 'Green', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_green', array(
			// Button
			'#596b46', '#3d4a30', '#ffffff', '#ffffff',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#a5a370',
			// Header
			'#ffffff', '#596b46', '#3d4a30', '#777777',
			// Main Menu
			'#596b46', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#3d4a30', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#596b46', '#3d4a30',
			// Footer CTA
			'#596b46', '#ffffff', '#ffffff', '#eeeeee',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#596b46', '#969696'
		) )
	),
	'brown' => array(
		'label'  => __( 'Brown', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_brown', array(
			// Button
			'#8c6a45', '#5b452e', '#ffffff', '#ffffff',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#dfad55',
			// Header
			'#ffffff', '#8c6a45', '#5b452e', '#777777',
			// Main Menu
			'#8c6a45', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#5b452e', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#8c6a45', '#5b452e',
			// Footer CTA
			'#8c6a45', '#ffffff', '#ffffff', '#eeeeee',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#8c6a45', '#969696'
		) )
	)
) );
