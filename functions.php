<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


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
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

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
	
	/*
	 * If the WP Translate plugin is active then display some controls for that.	
	 * https://wordpress.org/plugins/wp-translate/	
	 */
	/// add the setting
	/*$lsx_controls['settings']['lsx_wp_translate_location']  = array(
			'default'       =>  '0', //Default setting/value to save
			'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
			'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	);	
	
	/// add the control
	$lsx_controls['fields']['lsx_wp_translate_location'] = array(
			'label'         =>  __('Layout','lsx'),
			'section'       =>  'title_tagline',
			'type'   =>  'checkbox'
	);*/
	
	
	// add the slider if function exists
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
	
	/*
	 * Colour Settings
	 */
	 /// add the setting
	 $lsx_controls['settings']['lsx_color_scheme']  = array(
	   	'default'       =>  'default', //Default setting/value to save
	   	'type'	        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
	  	'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 );
	 /// add the control
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
	
	 /*
	  * Layout Controls
	  */
	 
	 /*
	  * Header Layout Options
	 */
	 /// add the setting
	 $lsx_controls['settings']['lsx_header_layout']  = array(
	 		'default'       =>  'inline', //Default setting/value to save
	 		'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
	 		'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	 );
	 
	 /// add the control
	 $lsx_controls['fields']['lsx_header_layout'] = array(
	 		'label'         =>  __('Header','lsx'),
	 		'section'       =>  'lsx-layout',
	 		'control'   =>  'LSX_Customize_Header_Layout_Control',
	 		//'type'       =>  'select',
	 		'choices'		=>	array(
	 				'central',
	 				'expanded',
	 				'inline'
	 		)
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
	  
	  /// add the setting
	  $lsx_controls['settings']['lsx_header_fixed']  = array(
	  		'default'       =>  true, //Default setting/value to save
	  		'sanitize_callback' => 'lsx_sanitize_checkbox',
	  		'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	  );
	  
	  /// add the control
	  $lsx_controls['fields']['lsx_header_fixed'] = array(
	  		'label'         =>  __('Fixed Header','lsx'),
	  		'section'       =>  'lsx-layout',
	  		'type'       =>  'checkbox',
	  );	  
	  
	  /// add the control
	  $lsx_controls['fields']['lsx_layout'] = array(
	    'label'         =>  __('Body','lsx'),
	    'section'       =>  'lsx-layout',
	    'control'   =>  'LSX_Customize_Layout_Control',
	    'choices'		=>	array(
	    	'1c',
	    	'2cr',
	    	'2cl'
	    )
	  );  
	
	  /*
	   * Font Controls
	   */
	  
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
	  
	  
	  $lsx_controls['sections']['lsx-metaplate'] = array(
	  		'title'       =>  'Metaplate'
	  );	  
	  /// add the setting
	  $lsx_controls['settings']['lsx_header_email_address']  = array(
	  		'default'       =>  'email@address.com', //Default setting/value to save
	  		'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
	  		'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
	  		'sanitize_callback' => 'lsx_sanitize_email',
	  );
	  /// add the control
	  $lsx_controls['fields']['lsx_header_email_address'] = array(
	  		'label'         =>  esc_html__( 'Email Address', 'lsx' ),
	  		'section'       =>  'lsx-metaplate',
	  		'type'          =>  'email',
	  );	 
	  
	  
	$lsx_controls = apply_filters('lsx_customizer_controls', $lsx_controls); 

	return $lsx_controls;
}  

$lsx_customizer = new LSX_Theme_Customizer( lsx_get_customizer_controls() );


/**
* Add Viewport Meta Tag to head
*/
function lsx_add_viewport_meta_tag() {
	?>
  		<meta name="viewport" content="width=device-width">
  		<!-- Noto Sans -->
  		<link href='http://fonts.googleapis.com/css?family=Noto+Sans:700' rel='stylesheet' type='text/css'>
  	<?php }
add_action( 'wp_head', 'lsx_add_viewport_meta_tag' );


// filter the Gravity Forms button type
add_filter("gform_submit_button", "lsx_form_submit_button", 10, 2);
function lsx_form_submit_button($button, $form){
    return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}

add_image_size( 'thumbnail-wide', 350, 230, true );
add_image_size( 'thumbnail-single', 750, 350, true );


/**
* Register Top Navigation
*/
function lsx_register_top_menu() {
  register_nav_menu('top-menu', __( 'Top Menu' , 'lsx' ));
}
add_action( 'init', 'lsx_register_top_menu' );


/**
* Register Social Navigation
*/
function lsx_register_social_menu() {
  register_nav_menu('social', __( 'Social Menu' , 'lsx' ));
}
add_action( 'init', 'lsx_register_social_menu' );


// Replaces the excerpt "more" text by a link
function lsx_excerpt_more($more) {
       global $post;
	return ' ... <a class="moretag" href="'. get_permalink($post->ID) . '">Continue reading</a>';
}
add_filter('excerpt_more', 'lsx_excerpt_more');

?>