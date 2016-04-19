<?php
/**
 * The Events Calendar Layout and Functionality
 *
 * @package lsx
 * @subpackage woocommerce
 */

/*
 * Styles
 */

/**
 * Adds theme stylesheet
 * @package lsx
 * @subpackage woocommerce
 * @category 	styles
 */

function lsx_events_styles() {
    wp_enqueue_style( 'events', get_template_directory_uri() . '/css/the-events-calendar.css' );
}
add_action( 'wp_enqueue_scripts', 'lsx_events_styles' );