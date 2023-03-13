<?php
/**
 * LSX functions and definitions.
 *
 * @package lsx
 */

use LSX\Core;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSX_VERSION', '2.9.5' );

require get_template_directory() . '/includes/config.php';
require_once get_template_directory() . '/includes/classes/class-core.php';
require_once get_template_directory() . '/includes/classes/block-styles.php';

function lsx_styles() {
	wp_enqueue_style( 'lsx-styles', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'lsx_styles' );



/**
 * Contains the LSX theme object
 *
 * @return void
 */
function lsx() {
	global $lsx;
	if ( null === $lsx ) {
		$lsx = new Core();
		$lsx->init();
	}
	return $lsx;
}
lsx();
