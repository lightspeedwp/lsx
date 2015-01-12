<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */

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
    'capability'    =>  'edit_theme_options', //Optional. Special permissions for accessing this setting.
    'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    'sanitize_callback' =>  'absint' // santize setting callback
  );
  /// add the control
  $controls['fields']['lsx_homepage_slider'] = array(
    'label'         =>  esc_html__( 'Select Slider', 'lsx-theme' ),
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
 );
 /// add the control
 $controls['fields']['lsx_color_scheme'] = array(
   'label'         =>  esc_html__( 'Color Scheme', 'lsx-theme' ),
   'section'       =>  'colors',
   'type'          =>  'select',
   'choices'  => array(
 		'default' => 'Default',
   		'red' => 'Red',
 	  	'green' => 'Green',
      'brown' => 'Brown'
 	),
	'priority' => 1,
  );

 /*
  * Layout Controls
  */
	 
  $controls['sections']['lsx-layout'] = array(
    'title'       =>  'Layout',
  	'description' => 'Change the layout sitewide. If your homepage is set to use a page with a template, the following will not apply to it.',
  	'priority' => 112,  		
  );

  $controls['settings']['lsx_layout']  = array(
    'default'       =>  '2cr', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    'layouts'		=>	array(
    	'1c',
    	'2cr',
    	'2cl'
    )
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
    'title'       =>  'Font',
    'description' => 'Change the fonts sitewide.',
  	'priority' => 42,
  );
  $controls['settings']['lsx_font']  = array(
    'default'       =>  'noto_sans_open_sans', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
  );  
  /// add the control
  $controls['fields']['lsx_font'] = array(
    'label'         =>  '',
    'section'       =>  'lsx-font',
    'settings'      =>  'lsx_font',
    'control'   =>  'LSX_Customize_Font_Control',
    'choices'   =>  array(
      'noto_serif_noto_sans' => array(
        'header'  => array(
            "title" => "Noto Serif", 
            "location" => "Noto+Serif", 
            "cssDeclaration" => "'Noto Serif', serif", 
            "cssClass" => "notoSerif",
          ),
        'body'  => array(
            "title" => "Noto Sans", 
            "location" => "Noto+Sans", 
            "cssDeclaration" => "'Noto Sans', sans-serif", 
            "cssClass" => "notoSans",
          ),
        ),
      'noto_sans_noto_sans' => array(
        'header'  => array(
            "title" => "Noto Sans", 
            "location" => "Noto+Sans", 
            "cssDeclaration" => "'Noto Sans', sans-serif", 
            "cssClass" => "notoSans",
          ),
        'body'  => array(
            "title" => "Noto Sans", 
            "location" => "Noto+Sans", 
            "cssDeclaration" => "'Noto Sans', sans-serif", 
            "cssClass" => "notoSans",
          ),
        ),
      'noto_sans_open_sans' => array(
        'header'  => array(
            "title" => "Noto Sans", 
            "location" => "Noto+Sans", 
            "cssDeclaration" => "'Noto Sans', sans-serif", 
            "cssClass" => "notoSans",
          ),
        'body'  => array(
            "title" => "Open Sans", 
            "location" => "Open+Sans", 
            "cssDeclaration" => "'Open Sans', sans-serif", 
            "cssClass" => "openSans"
          ),
        ),
      'alegreya_serif_open_sans' => array(
        'header'  => array(
            "title" => "Alegreya", 
            "location" => "Alegreya", 
            "cssDeclaration" => "'Alegreya', serif", 
            "cssClass" => "alegreya",
          ),
        'body'  => array(
            "title" => "Open Sans", 
            "location" => "Open+Sans", 
            "cssDeclaration" => "'Open Sans', sans-serif", 
            "cssClass" => "openSans"
          ),
        ),
    ),
  'priority' => 2,
  );    

$lsx_customizer = new LSX_Theme_Customizer( $controls );
// after setup theme
add_action('after_setup_theme' , function() {
	$args = array(
    'header-text' => array(
        'site-title',
        'site-description',
    ),
    'size' => 'medium',
);
add_theme_support( 'site-logo', $args );
});



// filter the Gravity Forms button type
add_filter("gform_submit_button", "lsx_form_submit_button", 10, 2);
function lsx_form_submit_button($button, $form){
    return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}

$width = lsx_get_option( 'thumb_width' );
// if ( ! $width ) $width = 150;

$height = lsx_get_option( 'thumb_height' );
// if ( ! $height ) $height = 150;

add_image_size( 'lsx-thumbnail', $width, $height, true );
add_image_size( 'thumbnail-wide', 350, 230, true );
add_image_size( 'thumbnail-single', 750, 350, true );


add_theme_support( 'custom-background', array(
	// Background color default
	'default-color' => 'FFF',
	// Background image default
) );

/**
 * Add theme support for infinite scroll.
 *
 * @uses add_theme_support
 * @return void
 */
function lsx_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'main',
        'type' => 'click',
        'posts_per_page' => get_option('posts_per_page',10),
    ) );
}
add_action( 'after_setup_theme', 'lsx_infinite_scroll_init' );


/**
 * Add Featured Image as Banner on Single Portfolio Posts.
 */
function lsx_portfolio_banner() {
	global $post;
    if ( is_singular( 'jetpack-portfolio' ) && has_post_thumbnail() ) {
        $image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
        <div class="portfolio-banner" style="background: url(<?php echo $image_src ?>);">
        </div>
    <?php }
}
add_action( 'lsx_header_after', 'lsx_portfolio_banner' );


/**
* Register Social Navigation
*/
function lsx_register_social_menu() {
  register_nav_menu('social',__( 'Social Menu' ));
}
add_action( 'init', 'lsx_register_social_menu' );


/**
* Custom Metaboxes for Jetpack Portfolio
*/
add_action( 'load-post.php', 'lsx_portfolio_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'lsx_portfolio_post_meta_boxes_setup' );

function lsx_portfolio_post_meta_boxes_setup() {
  add_action( 'add_meta_boxes', 'lsx_add_portfolio_post_meta_boxes' );

   add_action( 'save_post', 'lsx_save_portfolio_post_meta', 100, 2 );
}

function lsx_save_portfolio_post_meta( $post_id, $post ) {


  if ( (!isset( $_POST['lsx_website_nonce'] ) || !wp_verify_nonce( $_POST['lsx_website_nonce'], basename( __FILE__ ) )) 
	|| (!isset( $_POST['lsx_client_nonce'] ) || !wp_verify_nonce( $_POST['lsx_client_nonce'], basename( __FILE__ ) )) )
    return $post_id;

  $post_type = get_post_type_object( $post->post_type );

  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  
  $meta_keys = array('lsx-website','lsx-client');
  
  foreach($meta_keys as $meta_key){
  
	  $new_meta_value = ( isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '' );
	
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
    esc_html__( 'Client', 'client' ),
    'lsx_client_meta_box',
    'jetpack-portfolio',
    'side',
    'default'
  );

  add_meta_box(
    'lsx_website_meta_box',
    esc_html__( 'Website', 'website' ),
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