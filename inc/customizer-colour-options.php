<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

global $customizer_colour_names;
global $customizer_colour_choices;

$customizer_colour_names = apply_filters( 'lsx_customizer_colour_names', array(
	'button_background_color'                => esc_html__( 'BUTTON: Background', 'lsx' ),
	'button_background_hover_color'          => esc_html__( 'BUTTON: Background (hover)', 'lsx' ),
	'button_text_color'                      => esc_html__( 'BUTTON: Text', 'lsx' ),
	'button_text_color_hover'                => esc_html__( 'BUTTON: Text (hover)', 'lsx' ),

	'button_cta_background_color'            => esc_html__( 'BUTTON CTA: Background', 'lsx' ),
	'button_cta_background_hover_color'      => esc_html__( 'BUTTON CTA: Background (hover)', 'lsx' ),
	'button_cta_text_color'                  => esc_html__( 'BUTTON CTA: Text', 'lsx' ),
	'button_cta_text_color_hover'            => esc_html__( 'BUTTON CTA: Text (hover)', 'lsx' ),

	'top_menu_background_color'              => esc_html__( 'TOP MENU: Background', 'lsx' ),
	'top_menu_text_color'                    => esc_html__( 'TOP MENU: Text', 'lsx' ),
	'top_menu_text_hover_color'              => esc_html__( 'TOP MENU: Text (hover)', 'lsx' ),

	'header_background_color'                => esc_html__( 'HEADER: Background', 'lsx' ),
	'header_title_color'                     => esc_html__( 'HEADER: Title', 'lsx' ),
	'header_title_hover_color'               => esc_html__( 'HEADER: Title (hover)', 'lsx' ),
	'header_description_color'               => esc_html__( 'HEADER: Description', 'lsx' ),

	'main_menu_background_hover1_color'      => esc_html__( 'MENU: Background (L1 hover)', 'lsx' ),
	'main_menu_background_hover2_color'      => esc_html__( 'MENU: Background (L2 hover)', 'lsx' ),
	'main_menu_text_color'                   => esc_html__( 'MENU: Text (L1)', 'lsx' ),
	'main_menu_text_hover1_color'            => esc_html__( 'MENU: Text (L1 hover)', 'lsx' ),
	'main_menu_text_hover2_color'            => esc_html__( 'MENU: Text (L2 hover)', 'lsx' ),

	'banner_background_color'                => esc_html__( 'BANNER: Background', 'lsx' ),
	'banner_text_color'                      => esc_html__( 'BANNER: Text', 'lsx' ),
	'banner_text_image_color'                => esc_html__( 'BANNER: Text (over image)', 'lsx' ),

	'background_color'                       => esc_html__( 'BODY: Background', 'lsx' ),
	'body_line_color'                        => esc_html__( 'BODY: Line', 'lsx' ),
	'body_text_heading_color'                => esc_html__( 'BODY: Text (heading)', 'lsx' ),
	'body_text_color'                        => esc_html__( 'BODY: Text', 'lsx' ),
	'body_link_color'                        => esc_html__( 'BODY: Link', 'lsx' ),
	'body_link_hover_color'                  => esc_html__( 'BODY: Link (hover)', 'lsx' ),
	'body_section_full_background_color'     => esc_html__( 'BODY: Section full (background)', 'lsx' ),
	'body_section_full_text_color'           => esc_html__( 'BODY: Section full (text)', 'lsx' ),
	'body_section_full_cta_background_color' => esc_html__( 'BODY: Section full CTA (background)', 'lsx' ),
	'body_section_full_cta_text_color'       => esc_html__( 'BODY: Section full CTA (text)', 'lsx' ),

	'footer_cta_background_color'            => esc_html__( 'FOOTER CTA: Background', 'lsx' ),
	'footer_cta_text_color'                  => esc_html__( 'FOOTER CTA: Text', 'lsx' ),
	'footer_cta_link_color'                  => esc_html__( 'FOOTER CTA: Link', 'lsx' ),
	'footer_cta_link_hover_color'            => esc_html__( 'FOOTER CTA: Link (hover)', 'lsx' ),

	'footer_widgets_background_color'        => esc_html__( 'FOOTER WIDGETS: Background', 'lsx' ),
	'footer_widgets_text_color'              => esc_html__( 'FOOTER WIDGETS: Text', 'lsx' ),
	'footer_widgets_link_color'              => esc_html__( 'FOOTER WIDGETS: Link', 'lsx' ),
	'footer_widgets_link_hover_color'        => esc_html__( 'FOOTER WIDGETS: Link (hover)', 'lsx' ),

	'footer_background_color'                => esc_html__( 'FOOTER: Background', 'lsx' ),
	'footer_text_color'                      => esc_html__( 'FOOTER: Text', 'lsx' ),
	'footer_link_color'                      => esc_html__( 'FOOTER: Link', 'lsx' ),
	'footer_link_hover_color'                => esc_html__( 'FOOTER: Link (hover)', 'lsx' ),
) );

$customizer_colour_choices = apply_filters( 'lsx_customizer_colour_choices', array(
	'default' => array(
		'label'  => __( 'Default', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_default', array(
			'button_background_color'                => '#428bca',
			'button_background_hover_color'          => '#2a6496',
			'button_text_color'                      => '#ffffff',
			'button_text_color_hover'                => '#ffffff',

			'button_cta_background_color'            => '#f7941d',
			'button_cta_background_hover_color'      => '#f7741d',
			'button_cta_text_color'                  => '#ffffff',
			'button_cta_text_color_hover'            => '#ffffff',

			'top_menu_background_color'              => '#333333',
			'top_menu_text_color'                    => '#ffffff',
			'top_menu_text_hover_color'              => '#428bca',

			'header_background_color'                => '#ffffff',
			'header_title_color'                     => '#337ab7',
			'header_title_hover_color'               => '#23527c',
			'header_description_color'               => '#777777',

			'main_menu_background_hover1_color'      => '#428bca',
			'main_menu_background_hover2_color'      => '#333333',
			'main_menu_text_color'                   => '#555555',
			'main_menu_text_hover1_color'            => '#ffffff',
			'main_menu_text_hover2_color'            => '#ffffff',

			'banner_background_color'                => '#2a6496',
			'banner_text_color'                      => '#ffffff',
			'banner_text_image_color'                => '#ffffff',

			'background_color'                       => '#ffffff',
			'body_line_color'                        => '#dddddd',
			'body_text_heading_color'                => '#333333',
			'body_text_color'                        => '#333333',
			'body_link_color'                        => '#337ab7',
			'body_link_hover_color'                  => '#23527c',
			'body_section_full_background_color'     => '#428bca',
			'body_section_full_text_color'           => '#ffffff',
			'body_section_full_cta_background_color' => '#333333',
			'body_section_full_cta_text_color'       => '#ffffff',

			'footer_cta_background_color'            => '#428bca',
			'footer_cta_text_color'                  => '#ffffff',
			'footer_cta_link_color'                  => '#eeeeee',
			'footer_cta_link_hover_color'            => '#dddddd',

			'footer_widgets_background_color'        => '#333333',
			'footer_widgets_text_color'              => '#eeeeee',
			'footer_widgets_link_color'              => '#dddddd',
			'footer_widgets_link_hover_color'        => '#cccccc',

			'footer_background_color'                => '#232222',
			'footer_text_color'                      => '#ffffff',
			'footer_link_color'                      => '#337ab7',
			'footer_link_hover_color'                => '#969696',
		) )
	),
	'red' => array(
		'label'  => __( 'Red', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_red', array(
			'button_background_color'                => '#b64d3f',
			'button_background_hover_color'          => '#87291c',
			'button_text_color'                      => '#ffffff',
			'button_text_color_hover'                => '#ffffff',

			'button_cta_background_color'            => '#f7941d',
			'button_cta_background_hover_color'      => '#f7741d',
			'button_cta_text_color'                  => '#ffffff',
			'button_cta_text_color_hover'            => '#ffffff',

			'top_menu_background_color'              => '#333333',
			'top_menu_text_color'                    => '#ffffff',
			'top_menu_text_hover_color'              => '#eaa520',

			'header_background_color'                => '#ffffff',
			'header_title_color'                     => '#b64d3f',
			'header_title_hover_color'               => '#87291c',
			'header_description_color'               => '#777777',

			'main_menu_background_hover1_color'      => '#b64d3f',
			'main_menu_background_hover2_color'      => '#333333',
			'main_menu_text_color'                   => '#555555',
			'main_menu_text_hover1_color'            => '#ffffff',
			'main_menu_text_hover2_color'            => '#ffffff',

			'banner_background_color'                => '#87291c',
			'banner_text_color'                      => '#ffffff',
			'banner_text_image_color'                => '#ffffff',

			'background_color'                       => '#ffffff',
			'body_line_color'                        => '#dddddd',
			'body_text_heading_color'                => '#333333',
			'body_text_color'                        => '#333333',
			'body_link_color'                        => '#b64d3f',
			'body_link_hover_color'                  => '#87291c',
			'body_section_full_background_color'     => '#b64d3f',
			'body_section_full_text_color'           => '#ffffff',
			'body_section_full_cta_background_color' => '#333333',
			'body_section_full_cta_text_color'       => '#ffffff',

			'footer_cta_background_color'            => '#b64d3f',
			'footer_cta_text_color'                  => '#ffffff',
			'footer_cta_link_color'                  => '#ffffff',
			'footer_cta_link_hover_color'            => '#eeeeee',

			'footer_widgets_background_color'        => '#333333',
			'footer_widgets_text_color'              => '#eeeeee',
			'footer_widgets_link_color'              => '#dddddd',
			'footer_widgets_link_hover_color'        => '#cccccc',

			'footer_background_color'                => '#232222',
			'footer_text_color'                      => '#ffffff',
			'footer_link_color'                      => '#b64d3f',
			'footer_link_hover_color'                => '#969696',
		) )
	),
	'orange' => array(
		'label'  => __( 'Orange', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_orange', array(
			'button_background_color'                => '#fbaf3f',
			'button_background_hover_color'          => '#e49435',
			'button_text_color'                      => '#260e03',
			'button_text_color_hover'                => '#260e03',

			'button_cta_background_color'            => '#f7941d',
			'button_cta_background_hover_color'      => '#f7741d',
			'button_cta_text_color'                  => '#ffffff',
			'button_cta_text_color_hover'            => '#ffffff',

			'top_menu_background_color'              => '#333333',
			'top_menu_text_color'                    => '#ffffff',
			'top_menu_text_hover_color'              => '#cc4800',

			'header_background_color'                => '#ffffff',
			'header_title_color'                     => '#e4701e',
			'header_title_hover_color'               => '#cc4800',
			'header_description_color'               => '#777777',

			'main_menu_background_hover1_color'      => '#fbaf3f',
			'main_menu_background_hover2_color'      => '#333333',
			'main_menu_text_color'                   => '#555555',
			'main_menu_text_hover1_color'            => '#ffffff',
			'main_menu_text_hover2_color'            => '#ffffff',

			'banner_background_color'                => '#e49435',
			'banner_text_color'                      => '#ffffff',
			'banner_text_image_color'                => '#ffffff',

			'background_color'                       => '#ffffff',
			'body_line_color'                        => '#dddddd',
			'body_text_heading_color'                => '#333333',
			'body_text_color'                        => '#333333',
			'body_link_color'                        => '#e4701e',
			'body_link_hover_color'                  => '#cc4800',
			'body_section_full_background_color'     => '#fbaf3f',
			'body_section_full_text_color'           => '#ffffff',
			'body_section_full_cta_background_color' => '#333333',
			'body_section_full_cta_text_color'       => '#ffffff',

			'footer_cta_background_color'            => '#fbaf3f',
			'footer_cta_text_color'                  => '#555555',
			'footer_cta_link_color'                  => '#555555',
			'footer_cta_link_hover_color'            => '#333333',

			'footer_widgets_background_color'        => '#333333',
			'footer_widgets_text_color'              => '#eeeeee',
			'footer_widgets_link_color'              => '#dddddd',
			'footer_widgets_link_hover_color'        => '#cccccc',

			'footer_background_color'                => '#232222',
			'footer_text_color'                      => '#ffffff',
			'footer_link_color'                      => '#e4701e',
			'footer_link_hover_color'                => '#969696',
		) )
	),
	'green' => array(
		'label'  => __( 'Green', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_green', array(
			'button_background_color'                => '#596b46',
			'button_background_hover_color'          => '#3d4a30',
			'button_text_color'                      => '#ffffff',
			'button_text_color_hover'                => '#ffffff',

			'button_cta_background_color'            => '#f7941d',
			'button_cta_background_hover_color'      => '#f7741d',
			'button_cta_text_color'                  => '#ffffff',
			'button_cta_text_color_hover'            => '#ffffff',

			'top_menu_background_color'              => '#333333',
			'top_menu_text_color'                    => '#ffffff',
			'top_menu_text_hover_color'              => '#a5a370',

			'header_background_color'                => '#ffffff',
			'header_title_color'                     => '#596b46',
			'header_title_hover_color'               => '#3d4a30',
			'header_description_color'               => '#777777',

			'main_menu_background_hover1_color'      => '#596b46',
			'main_menu_background_hover2_color'      => '#333333',
			'main_menu_text_color'                   => '#555555',
			'main_menu_text_hover1_color'            => '#ffffff',
			'main_menu_text_hover2_color'            => '#ffffff',

			'banner_background_color'                => '#3d4a30',
			'banner_text_color'                      => '#ffffff',
			'banner_text_image_color'                => '#ffffff',

			'background_color'                       => '#ffffff',
			'body_line_color'                        => '#dddddd',
			'body_text_heading_color'                => '#333333',
			'body_text_color'                        => '#333333',
			'body_link_color'                        => '#596b46',
			'body_link_hover_color'                  => '#3d4a30',
			'body_section_full_background_color'     => '#596b46',
			'body_section_full_text_color'           => '#ffffff',
			'body_section_full_cta_background_color' => '#333333',
			'body_section_full_cta_text_color'       => '#ffffff',

			'footer_cta_background_color'            => '#596b46',
			'footer_cta_text_color'                  => '#ffffff',
			'footer_cta_link_color'                  => '#ffffff',
			'footer_cta_link_hover_color'            => '#eeeeee',

			'footer_widgets_background_color'        => '#333333',
			'footer_widgets_text_color'              => '#eeeeee',
			'footer_widgets_link_color'              => '#dddddd',
			'footer_widgets_link_hover_color'        => '#cccccc',

			'footer_background_color'                => '#232222',
			'footer_text_color'                      => '#ffffff',
			'footer_link_color'                      => '#596b46',
			'footer_link_hover_color'                => '#969696',
		) )
	),
	'brown' => array(
		'label'  => __( 'Brown', 'lsx' ),
		'colors' => apply_filters( 'lsx_customizer_colour_choices_brown', array(
			'button_background_color'                => '#8c6a45',
			'button_background_hover_color'          => '#5b452e',
			'button_text_color'                      => '#ffffff',
			'button_text_color_hover'                => '#ffffff',

			'button_cta_background_color'            => '#f7941d',
			'button_cta_background_hover_color'      => '#f7741d',
			'button_cta_text_color'                  => '#ffffff',
			'button_cta_text_color_hover'            => '#ffffff',

			'top_menu_background_color'              => '#333333',
			'top_menu_text_color'                    => '#ffffff',
			'top_menu_text_hover_color'              => '#dfad55',

			'header_background_color'                => '#ffffff',
			'header_title_color'                     => '#8c6a45',
			'header_title_hover_color'               => '#5b452e',
			'header_description_color'               => '#777777',

			'main_menu_background_hover1_color'      => '#8c6a45',
			'main_menu_background_hover2_color'      => '#333333',
			'main_menu_text_color'                   => '#555555',
			'main_menu_text_hover1_color'            => '#ffffff',
			'main_menu_text_hover2_color'            => '#ffffff',

			'banner_background_color'                => '#5b452e',
			'banner_text_color'                      => '#ffffff',
			'banner_text_image_color'                => '#ffffff',

			'background_color'                       => '#ffffff',
			'body_line_color'                        => '#dddddd',
			'body_text_heading_color'                => '#333333',
			'body_text_color'                        => '#333333',
			'body_link_color'                        => '#8c6a45',
			'body_link_hover_color'                  => '#5b452e',
			'body_section_full_background_color'     => '#8c6a45',
			'body_section_full_text_color'           => '#ffffff',
			'body_section_full_cta_background_color' => '#333333',
			'body_section_full_cta_text_color'       => '#ffffff',

			'footer_cta_background_color'            => '#8c6a45',
			'footer_cta_text_color'                  => '#ffffff',
			'footer_cta_link_color'                  => '#ffffff',
			'footer_cta_link_hover_color'            => '#eeeeee',

			'footer_widgets_background_color'        => '#333333',
			'footer_widgets_text_color'              => '#eeeeee',
			'footer_widgets_link_color'              => '#dddddd',
			'footer_widgets_link_hover_color'        => '#cccccc',

			'footer_background_color'                => '#232222',
			'footer_text_color'                      => '#ffffff',
			'footer_link_color'                      => '#8c6a45',
			'footer_link_hover_color'                => '#969696',
		) )
	)
) );
