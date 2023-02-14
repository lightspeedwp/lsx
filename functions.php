<?php
/**
 * LSX functions and definitions.
 *
 * @package lsx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSX_VERSION', '2.9.5' );

// Setup.
require get_template_directory() . '/includes/config.php';
require get_template_directory() . '/includes/welcome.php';

require get_template_directory() . '/includes/classes/class-lsx-schema-utils.php';
require get_template_directory() . '/includes/classes/class-lsx-schema-graph-piece.php';
require get_template_directory() . '/includes/classes/class-lsx-optimisation.php';
require get_template_directory() . '/includes/classes/class-lsx-rest-helper.php';

// Add block patterns
require get_template_directory() . '/includes/block-patterns.php';
