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
require get_template_directory() . '/includes/classes/customizer.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/includes/sanitize.php';
require get_template_directory() . '/includes/layout.php';
require get_template_directory() . '/includes/hooks.php';
require get_template_directory() . '/includes/widgets.php';
require get_template_directory() . '/includes/scripts.php';
require get_template_directory() . '/includes/nav.php';
require get_template_directory() . '/includes/comment-walker.php';
require get_template_directory() . '/includes/jetpack.php';
require get_template_directory() . '/includes/lazyload.php';

if ( class_exists( 'BuddyPress' ) ) {
	require get_template_directory() . '/includes/buddypress.php';
}

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/woocommerce.php';
}

if ( class_exists( 'WP_Job_Manager' ) ) {
	require get_template_directory() . '/includes/wp-job-manager.php';
}

if ( class_exists( 'Tribe__Events__Main' ) ) {
	require get_template_directory() . '/includes/the-events-calendar.php';
}

require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/extras.php';
require get_template_directory() . '/includes/wp-bootstrap-navwalker.php';

if ( class_exists( 'Sensei_WC' ) ) {
	require get_template_directory() . '/includes/sensei.php';
}

require get_template_directory() . '/includes/welcome.php';
