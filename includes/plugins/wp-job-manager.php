<?php
/**
 * LSX functions and definitions - Integrations - WP Job Manager.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   wp-job-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_wp_job_manager_styles' ) ) :

	/**
	 * Adds WP Job Manager custom stylesheet.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   wp-job-manager
	 */
	function lsx_wp_job_manager_styles() {
		wp_enqueue_style( 'lsx-wp-job-manager', get_template_directory_uri() . '/assets/css/plugins/wp-job-manager.css', array( 'lsx_main' ), LSX_VERSION );
		wp_style_add_data( 'lsx-wp-job-manager', 'rtl', 'replace' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'lsx_wp_job_manager_styles' );
