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

define( 'LSX_VERSION', '4.0.0' );

require_once get_template_directory() . '/includes/classes/class-core.php';

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
