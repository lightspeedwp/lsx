<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


require get_template_directory() . '/inc/config.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/comment-walker.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';


$controls = array();

// add the slider if function exists
if(function_exists('soliloquy')){
  // add homepage slider section
  $controls['sections']['lsx-homepage'] = array(
    'title'       =>  'Homepage'
  );

  /// add the setting
  $controls['settings']['lsx_homepage_slider']  = array(
    'default'       =>  '0', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    'sanitize_callback' =>  'absint' // santize setting callback
  );
  /// add the control
  $controls['fields']['lsx_homepage_slider'] = array(
    'label'         =>  esc_html__( 'Select Slider', 'lsx' ),
    'section'       =>  'lsx-homepage',
    'type'          =>  'select',
    'choices'       =>  LSX_Theme_Customizer::get_slider_post_type_choices()
  );
  
}

/*
 * Colour Settings
 */
 /// add the setting
 $controls['settings']['lsx_color_scheme']  = array(
   'default'       =>  'default', //Default setting/value to save
   'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
   'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
 	'sanitize_callback' =>  'esc_attr' // santize setting callback
 );
 /// add the control
 $controls['fields']['lsx_color_scheme'] = array(
   'label'         =>  esc_html__( 'Color Scheme', 'lsx' ),
   'section'       =>  'colors',
   'type'          =>  'select',
   'colours'  => array(
 		'default' => esc_html__( 'Default', 'lsx' ),
   		'red' => esc_html__( 'Red', 'lsx' ),
 	  	'green' => esc_html__( 'Green', 'lsx' ),
      'brown' => esc_html__( 'Brown', 'lsx' )
 	),
 	'control'   =>  'LSX_Customize_Colour_Control',
	'priority' => 1,
  );

 /*
  * Layout Controls
  */
	 
  $controls['sections']['lsx-layout'] = array(
    'title'       =>  esc_html__( 'Layout', 'lsx' ),
  	'description' => __( 'Change the layout sitewide. If your homepage is set to use a page with a template, the following will not apply to it.', 'lsx' ),
  	'priority' => 112
  );

  $controls['settings']['lsx_layout']  = array(
    'default'       =>  '2cr', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    'layouts'		=>	array(
    	'1c',
    	'2cr',
    	'2cl'
    ),
  	'sanitize_callback' =>  'esc_attr' // santize setting callback
  ); 
  /// add the control
  $controls['fields']['lsx_layout'] = array(
    'label'         =>  '',
    'section'       =>  'lsx-layout',
    'control'   =>  'LSX_Customize_Layout_Control',
    'layouts'		=>	array(
    	'1c',
    	'2cr',
    	'2cl'
    )
  );  

  /*
   * Font Controls
   */
  
  $controls['sections']['lsx-font'] = array(
    'title'       =>  __( 'Font', 'lsx' ),
    'description' => 'Change the fonts sitewide.',
  	'priority' => 42
  );
  $controls['settings']['lsx_font']  = array(
    'default'       =>  'raleway_open_sans', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
  	'sanitize_callback' =>  'esc_attr' // santize setting callback
  );  
  /// add the control
  $controls['fields']['lsx_font'] = array(
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
  
  /*
   * Site Icon
  */
  /*
  $controls['sections']['site-logo'] = array(
  		'title'       =>  esc_html__( 'Site Logo', 'lsx' ),
  		'description' => __( 'Upload an image to', 'lsx' ),
  		'priority' => 112
  );
  
  $controls['settings']['lsx_layout']  = array(
  		'default'       =>  '2cr', //Default setting/value to save
  		'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
  		'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
  		'layouts'		=>	array(
  				'1c',
  				'2cr',
  				'2cl'
  		),
  		'sanitize_callback' =>  'esc_attr' // santize setting callback
  );
  /// add the control
  $controls['fields']['lsx_layout'] = array(
  		'label'         =>  '',
  		'section'       =>  'lsx-layout',
  		'control'   =>  'WP_Customize_Image_Control',
  		'layouts'		=>	array(
  				'1c',
  				'2cr',
  				'2cl'
  		)
  );  
  */
  
$controls = apply_filters('lsx_customizer_controls', $controls);    

$lsx_customizer = new LSX_Theme_Customizer( $controls );

// filter the Gravity Forms button type
add_filter("gform_submit_button", "lsx_form_submit_button", 10, 2);
function lsx_form_submit_button($button, $form){
    return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}

add_image_size( 'thumbnail-wide', 350, 230, true );
add_image_size( 'thumbnail-single', 750, 350, true );


/**
* Register Social Navigation
*/
function lsx_register_social_menu() {
  register_nav_menu('social', __( 'Social Menu' , 'lsx' ));
}
add_action( 'init', 'lsx_register_social_menu' );
?>