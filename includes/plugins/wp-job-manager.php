<?php
/**
 * LSX functions and definitions - Integrations - WP Job Manager
 *
 * @package    lsx
 * @subpackage plugins
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_wp_job_manager_styles' ) ) :

	/**
	 * Adds WP Job Manager custom stylesheet
	 *
	 * @package    lsx
	 * @subpackage plugins
	 */
	function lsx_wp_job_manager_styles() {
		wp_enqueue_style( 'lsx_wp_job_manager', get_template_directory_uri() . '/assets/css/plugins/wp-job-manager.css', array( 'lsx_main' ), LSX_VERSION );
	}

endif;
add_action( 'wp_enqueue_scripts', 'lsx_wp_job_manager_styles' );
