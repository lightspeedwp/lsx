<?php
/**
 * LSX functions and definitions - bbPress.
 *
 * @package    lsx
 * @subpackage bbpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $bbpress;

if ( ! function_exists( 'lsx_bbpress_scripts_add_styles' ) ) :

	/**
	 * bbPress enqueue styles.
	 *
	 * @package    lsx
	 * @subpackage bbpress
	 */
	function lsx_bbpress_scripts_add_styles() {
		wp_enqueue_style( 'bbpress-lsx', get_template_directory_uri() . '/assets/css/bb-press/bb-press.css', array( 'lsx_main' ), LSX_VERSION );
		wp_style_add_data( 'bbpress-lsx', 'rtl', 'replace' );
	}

	add_action( 'wp_enqueue_scripts', 'lsx_bbpress_scripts_add_styles' );

endif;

/**** Remove "Archives:"  from the forums archive title. ******/

add_filter( 'get_the_archive_title', 'modify_archive_title', 10, 1 );

function modify_archive_title( $title ) {
	if ( ! is_post_type_archive( 'forum' ) ) {
		return $title;
	}
	$title = __( 'Forums', 'lsx' );
	return $title;
}
