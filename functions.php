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
   'choices'  => array(
 		'default' => esc_html__( 'Default', 'lsx' ),
   		'red' => esc_html__( 'Red', 'lsx' ),
 	  	'green' => esc_html__( 'Green', 'lsx' ),
      'brown' => esc_html__( 'Brown', 'lsx' )
 	),
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

$lsx_customizer = new LSX_Theme_Customizer( $controls );

// filter the Gravity Forms button type
add_filter("gform_submit_button", "lsx_form_submit_button", 10, 2);
function lsx_form_submit_button($button, $form){
    return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}


add_image_size( 'thumbnail-wide', 350, 230, true );
add_image_size( 'thumbnail-single', 750, 350, true );


/**
 * Add Featured Image as Banner on Single Portfolio Posts.
 */
function lsx_portfolio_banner() {
	global $post;
    if ( is_singular( 'jetpack-portfolio' ) && has_post_thumbnail() ) {
        $image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="portfolio-banner" style="background-position: center !important; background: url(<?php echo $image_src ?>);">
        </div>
    <?php }
}
add_action( 'lsx_header_after', 'lsx_portfolio_banner' );


/**
* Register Social Navigation
*/
function lsx_register_social_menu() {
  register_nav_menu('social', __( 'Social Menu' , 'lsx' ));
}
add_action( 'init', 'lsx_register_social_menu' );


/**
* Custom Metaboxes for Jetpack Portfolio
*/

  add_action( 'add_meta_boxes', 'lsx_add_portfolio_post_meta_boxes' );
   add_action( 'save_post', 'lsx_save_portfolio_post_meta', 100, 2 );

function lsx_save_portfolio_post_meta( $post_id, $post ) {


  if ( (!isset( $_POST['lsx_website_nonce'] ) || !wp_verify_nonce( $_POST['lsx_website_nonce'], basename( __FILE__ ) )) 
	|| (!isset( $_POST['lsx_client_nonce'] ) || !wp_verify_nonce( $_POST['lsx_client_nonce'], basename( __FILE__ ) )) )
    return $post_id;

  $post_type = get_post_type_object( $post->post_type );

  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  
  $meta_keys = array('lsx-website','lsx-client');
  
  foreach($meta_keys as $meta_key){
  
	  $new_meta_value = ( isset( $_POST[$meta_key] ) ? sanitize_text_field($_POST[$meta_key]) : '' );
	
	  $meta_value = get_post_meta( $post_id, $meta_key, true );
	
	  if ( $new_meta_value && '' == $meta_value )
	    add_post_meta( $post_id, $meta_key, $new_meta_value, true );
	
	  elseif ( $new_meta_value && $new_meta_value != $meta_value )
	    update_post_meta( $post_id, $meta_key, $new_meta_value );
	
	  elseif ( '' == $new_meta_value && $meta_value )
	    delete_post_meta( $post_id, $meta_key, $meta_value );
  
  }
}

function lsx_add_portfolio_post_meta_boxes() {

  add_meta_box(
    'lsx_client_meta_box',
    esc_html__( 'Client', 'lsx' ),
    'lsx_client_meta_box',
    'jetpack-portfolio',
    'side',
    'default'
  );

  add_meta_box(
    'lsx_website_meta_box',
    esc_html__( 'Website', 'lsx' ),
    'lsx_website_meta_box',
    'jetpack-portfolio',
    'side',
    'default'
  );
}

function lsx_client_meta_box( $object, $box ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'lsx_client_nonce' ); ?>

  <p>
    <input class="widefat" type="text" name="lsx-client" id="lsx-client" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lsx-client', true ) ); ?>" size="30" />
    <br /><br />
    <label for="lsx-client"><?php _e( "Enter the name of the project client", 'client' ); ?></label>
  </p>
<?php }

function lsx_website_meta_box( $object, $box ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'lsx_website_nonce' ); ?>

  <p>
    <input class="widefat" type="text" name="lsx-website" id="lsx-website" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lsx-website', true ) ); ?>" size="30" />
    <br /><br />
    <label for="lsx-website"><?php _e( "Enter the URL of the project website", 'website' ); ?></label>
  </p>
<?php }


?>