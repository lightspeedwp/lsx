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


function lsx_search_args( $query ) {
	if ( is_search() ) {
		$query->set( 'post_type', 'post' );
	}
	return $query;
}
add_action( 'pre_get_posts', 'lsx_search_args', 10, 1 );
