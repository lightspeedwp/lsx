<?php
/**
 * LSX functions and definitions for general plugins.
 *
 * @package    lsx
 * @subpackage plugins
 */

/**
 * Moves the loading of the optinmonster plugin JS to the footer.
 * @param $located
 * @param $template_name
 *
 * @return array
 */
function lsx_optinmonster_move_js( ) {
	if ( class_exists( 'OMAPI_Output' ) ) {
		//remove_action( 'wp_enqueue_scripts', array( $this, 'api_script' ) );
	}
	return $located;
}
add_filter( 'init', 'lsx_optinmonster_move_js' );
