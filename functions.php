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

/**
 * Contains the LSX theme object
 *
 * @return void
 */
function lsx() {
	global $lsx;
	if ( null === $lsx ) {
		$lsx = new Core();
		$lsx->load_classes();
	}
	return $lsx;
}
lsx();
