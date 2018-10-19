<?php
/**
 * LSX functions and definitions - Integrations - Extras
 *
 * @package    lsx
 * @subpackage extras
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Gutenberg Compatibility

require_once( __DIR__ . '/lib/theme-support.php' );

add_filter( 'body_class', __NAMESPACE__ . '\add_gutenberg_compatible_body_class' );
/**
 * Add custom class for Gutenberg Compatible template
 */
function add_gutenberg_compatible_body_class( $classes ) {
	if ( is_page_template( 'single.php' ) )
		$classes[] = 'gutenberg-compatible-template';
	return $classes;
}
