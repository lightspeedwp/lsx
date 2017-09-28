<?php
/**
 * LSX functions and definitions.
 *
 * @package lsx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSX_VERSION', '2.0.0' );

require get_template_directory() . '/includes/config.php';
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
require get_template_directory() . '/includes/classes/class-lsx-lazy-load-images.php';
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/extras.php';
require get_template_directory() . '/includes/welcome.php';

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
}
