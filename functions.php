<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */

//require get_template_directory() . '/inc/bootstrap-variables.php';
require get_template_directory() . '/inc/config.php';


//define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
//require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
require_once dirname( __FILE__ ) . '/inc/customizer.php';


require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/utility.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/comment-walker.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';


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
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
    return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}

$width = lsx_get_option( 'thumb_width' );
// if ( ! $width ) $width = 150;

$height = lsx_get_option( 'thumb_height' );
// if ( ! $height ) $height = 150;

add_image_size( 'lsx-thumbnail', $width, $height, true );
add_image_size( 'thumbnail-wide', 350, 230, true );
add_image_size( 'thumbnail-single', 750, 400, true );


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
 * Load Bootstrap Navwalker.
 */
require_once('wp_bootstrap_navwalker.php');


/**
 * Add theme support for infinite scroll.
 *
 * @uses add_theme_support
 * @return void
 */
function lsx_infinite_scroll_init() {
    add_theme_support( 'infinite-scroll', array(
        'container' => 'main',
        'type' => 'scroll',
    ) );
}
add_action( 'after_setup_theme', 'lsx_infinite_scroll_init' );


?>