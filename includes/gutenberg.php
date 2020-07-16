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

/**
 * Enqueue Admin styles on admin area
 */
function load_gutenberg_admin_style() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/assets/css/admin/gutenberg-admin.css', false, '1.0.0' );
}
add_action( 'admin_enqueue_scripts', 'load_gutenberg_admin_style' );

// Gutenberg Compatibility.
require get_template_directory() . '/lib/theme-support.php';

/**
 * Add custom class for Gutenberg Compatible template
 */
function add_gutenberg_compatible_body_class( $classes ) {
	// if ( ! is_home() && ! is_front_page() ).
	if ( is_page() || is_page_template() || is_single() )
		$classes[] = 'gutenberg-compatible-template';

	// Add a class if the page is using the Content and Media block.
	$post = get_post();
	if ( function_exists( 'has_blocks' ) && isset( $post->post_content ) && has_blocks( $post->post_content ) && ( ! is_search() ) && ( ! is_archive() ) ) {
		$blocks = parse_blocks( $post->post_content );

		if ( 'core/media-text' === $blocks[0]['blockName'] ) {
			$classes[] = 'has-block-media-text';
		}
		if ( 'core/cover' === $blocks[0]['blockName'] ) {
			$classes[] = 'has-block-cover';
		}
	}
	return $classes;
}

add_filter( 'body_class', __NAMESPACE__ . '\add_gutenberg_compatible_body_class' );

// Add custom class for templates that are using the Gutenberg editor.
add_action('body_class', function( $classes ) {
	if ( function_exists( 'has_blocks' ) && has_blocks( get_the_ID() ) && ( ( is_singular( 'post' ) || is_page() ) ) )
		$classes[] = 'using-gutenberg';
	return $classes;
});

/**
 * Removes the default LSX banner if there is a page that is using blocks. (Only works if LSX banners is not turned on)
 *
 * @return void
 */
function remove_lsx_page_banner_when_using_blocks() {
	if ( function_exists( 'has_blocks' ) && ( ! class_exists( 'LSX_Banners' ) ) ) {
		add_filter( 'lsx_page_banner_disable', '__return_true' );
	}
}
add_filter( 'init', 'remove_lsx_page_banner_when_using_blocks' );
