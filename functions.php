<?php
use function Aws\serialize;

/**
 * LSX functions and definitions.
 *
 * @package lsx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSX_VERSION', '2.9.5' );

require get_template_directory() . '/includes/config.php';
require get_template_directory() . '/includes/deprecated.php';
require get_template_directory() . '/includes/classes/class-lsx-theme-customizer.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/includes/sanitize.php';
require get_template_directory() . '/includes/layout.php';
require get_template_directory() . '/includes/hooks.php';
require get_template_directory() . '/includes/widgets.php';
require get_template_directory() . '/includes/scripts.php';
require get_template_directory() . '/includes/classes/class-lsx-nav-walker.php';
require get_template_directory() . '/includes/nav-navwalker.php';
require get_template_directory() . '/includes/classes/class-lsx-bootstrap-navwalker.php';
require get_template_directory() . '/includes/nav-bootstrap-navwalker.php';
require get_template_directory() . '/includes/classes/class-lsx-walker-comment.php';
require get_template_directory() . '/includes/walker-comment.php';
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/extras.php';
require get_template_directory() . '/includes/welcome.php';
require get_template_directory() . '/includes/404-widget.php';
require get_template_directory() . '/includes/gutenberg.php';
require get_template_directory() . '/includes/classes/class-lsx-schema-utils.php';
require get_template_directory() . '/includes/classes/class-lsx-schema-graph-piece.php';
require get_template_directory() . '/includes/classes/class-lsx-optimisation.php';
require get_template_directory() . '/includes/classes/class-lsx-rest-helper.php';

// Add block patterns
/**require get_template_directory() . '/includes/block-patterns.php'; */