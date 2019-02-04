<?php
/**
 * LSX functions to make theme Gutenberg compatible
 *
 * @package    lsx
 * @subpackage Gutenberg
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Enqueue Admin styles on admin area
function load_gutenberg_admin_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/css/admin/gutenberg-admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'load_gutenberg_admin_style' );

// Gutenberg Compatibility
require_once( get_template_directory() . '/lib/theme-support.php' );

/**
 * Add custom class for Gutenberg Compatible template
 */

function add_gutenberg_compatible_body_class( $classes ) {
	//if ( ! is_home() && ! is_front_page() )
		if ( is_page() || is_page_template() || is_single() )
			$classes[] = 'gutenberg-compatible-template';
		return $classes;

}

add_filter( 'body_class', __NAMESPACE__ . '\add_gutenberg_compatible_body_class' );

// Add custom class for templates that are using the Gutenberg editor
add_action('body_class', function( $classes ) {
	if ( function_exists( 'has_blocks' ) && has_blocks( get_the_ID() ) )
		$classes[] = 'using-gutenberg';
	return $classes;
});
