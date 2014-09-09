<?php
/**
 * lsx functions and definitions
 *
 * @package lsx
 */

//require get_template_directory() . '/inc/bootstrap-variables.php';
require get_template_directory() . '/inc/config.php';


define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
require_once dirname( __FILE__ ) . '/inc/options.php';

require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/layout.php';
require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/utility.php';
require get_template_directory() . '/inc/scripts.php';
require get_template_directory() . '/inc/nav.php';
require get_template_directory() . '/inc/comment-walker.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/widgets/widget-blog.php';

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
?>