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
// Gutenberg Compatibility

require_once( get_template_directory() . '/lib/theme-support.php' );

//add_filter( 'body_class', __NAMESPACE__ . '\add_gutenberg_compatible_body_class' );
/**
 * Add custom class for Gutenberg Compatible template
 */
function add_gutenberg_compatible_body_class( $classes ) {
	if ( is_page_template( 'single.php' ) )
		$classes[] = 'gutenberg-compatible-template';
	return $classes;
}
