<?php
/**
 * WP Job Manager Layout and  Functionality
 *
 * @package lsx
 * @subpackage wp-job-manager
 */

/**
 * Add plugin-specific stylesheet
 * @package lsx
 * @subpackage woocommerce
 * @category 	wp-job-manager
 */

function lsx_wp_job_manager_styles() {
    wp_enqueue_style( 'wp_job_manager', get_template_directory_uri() . '/css/wp-job-manager.css', array(), LSX_VERSION );
}
add_action( 'wp_enqueue_scripts', 'lsx_wp_job_manager_styles' );