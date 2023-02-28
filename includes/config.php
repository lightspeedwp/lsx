<?php
/**
 * LSX functions and definitions - Config.
 *
 * @package    lsx
 * @subpackage config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * WPForms submit button, match Gutenberg button block
 *
 * @param [type] $form_data
 * @return void
 */
function lsx_wpforms_match_button_block( $form_data ) {
	$form_data['settings']['submit_class'] .= ' btn';
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'lsx_wpforms_match_button_block' );
