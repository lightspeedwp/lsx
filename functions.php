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

// define your controls here
$controls = array(
  // array to define settings
  'settings'      =>  array(
    'my_setting'    =>  array(
      'default'     =>  '#2BA6CB', //Default setting/value to save
      'type'      =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
      'capability'  =>  'edit_theme_options', //Optional. Special permissions for accessing this setting.
      'transport'   =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
      'css' => array( // Optional: does this apply to a css selector for the live site?
        'selector'    =>  'a', // CSS Selector the setting is for
        'style_name'  =>  'color', // the css style to be applied
        'prefix'      =>  '', //optional: the value prefix for sanatized values, if needed
        'postfix'     =>  '', //optional: the value postfix for sanatized values, if needed
      )
    ),//add more settings
  ),
  // array to define panels
  'panels'      =>  array(
    'my_panel_slug'   =>  array(
      'title'     =>  'My Panel Title',
      'priority'    =>  1
    ), // add more panels
  ),
  // array to define sections
  'sections'      =>  array(
    'my_section_slug'   =>  array(
      'title'     =>  'My Section Title',
      'panel'     =>  'my_panel_slug' // Optional: if defined a panel, reference the panel slug here
    ),//add more sections
  ),
  // array to define fields
  'fields'      =>  array(
    'my_color'      =>  array(
      'label'     =>  __( 'Link Color', 'mytheme' ), //Admin-visible name of the control
      'control'   =>  'WP_Customize_Color_Control', // Optional: the control type class name ( built in WP_Customize_Image_Control, WP_Customize_Upload_Control, WP_Customize_Color_Control, WP_Customize_Text_Control ) use lowercase type : ie. textarea for generic
      //'type'    =>  'select', // only if control is not defined. this is the input type (text, textarea, select etc..)
      //'choices'   =>  '', //array() | callback of choices for selects or choice based controls / types
      'section'     =>  'my_section_slug', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
      'settings'    =>  'my_setting', //Which setting to load and manipulate (serialized is okay)
      'priority'    =>  11, //Determines the order this control appears in for the specified section
    ),//add more fields
  )
);


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

  /// add the setting
  $controls['settings']['lsx_color_scheme']  = array(
    'default'       =>  'default', //Default setting/value to save
    'type'        =>  'theme_mod', //Is this an 'option' or a 'theme_mod'?
    'transport'     =>  'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
    'sanitize_callback' =>  'twentyfifteen_sanitize_color_scheme' // santize setting callback
  );
  /// add the control
  $controls['fields']['lsx_color_scheme'] = array(
    'label'         =>  esc_html__( 'Color Scheme', 'lsx-theme' ),
    'section'       =>  'colors',
    'type'          =>  'select',
    'choices'  => twentyfifteen_get_color_scheme_choices(),
	'priority' => 1,
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


function lsx_title_tag_setup() {
   add_theme_support( 'title-tag' ); 
   add_theme_support( 'jetpack-testimonial' );
}
add_action( 'after_setup_theme', 'lsx_title_tag_setup' );


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


// Wordpress specific Variables
if ( ! isset( $content_width ) ) {
	$content_width = lsx_get_option( 'content_width' , 750 );
}


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

   add_action( 'save_post', 'lsx_save_portfolio_post_meta', 10, 2 );
}

function lsx_save_portfolio_post_meta( $post_id, $post ) {

  if ( !isset( $_POST['lsx_website_nonce'] ) || !wp_verify_nonce( $_POST['lsx_website_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  $post_type = get_post_type_object( $post->post_type );

  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  $new_meta_value = ( isset( $_POST['lsx-portfolio'] ) ? sanitize_html_class( $_POST['lsx-portfolio'] ) : '' );

  $meta_key = 'lsx_portfolio_meta';

  $meta_value = get_post_meta( $post_id, $meta_key, true );

  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );

  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );

  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
}

function lsx_add_portfolio_post_meta_boxes() {

  add_meta_box(
    '',
    esc_html__( 'Client', 'client' ),
    'lsx_client_meta_box',
    'jetpack-portfolio',
    'side',
    'default'
  );

  add_meta_box(
    '',
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