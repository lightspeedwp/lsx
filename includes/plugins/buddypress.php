<?php
/**
 * LSX functions and definitions - Integrations - Buddypress.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   budypress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_buddypress_page_columns' ) ) :

	/**
	 * Forces the Buddypress Profile Pages to be 1 column (layout).
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   budypress
	 */
	function lsx_buddypress_page_columns( $layout ) {
		if ( bp_is_profile_component()
			|| bp_is_settings_component()
			|| bp_is_activity_component()
			|| bp_is_group()
			|| bp_is_messages_component()
			|| bp_is_members_directory()
			|| bp_is_groups_directory()
			|| bp_is_groups_component()
			|| bp_is_members_component() ) {
			$layout = '1c';
		}

		return $layout;
	}

endif;

add_filter( 'lsx_layout', 'lsx_buddypress_page_columns', 1, 100 );
