<?php
/**
 * LSX functions and definitions - Bootstrap Navigation Walker.
 *
 * @package    lsx
 * @subpackage navigation
 * @category   bootstrap-navigation-walker
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_wpml_nav_language_switcher_fix' ) ) :

	/**
	 * Add in our custom classes to the menus.
	 *
	 * @package    lsx
	 * @subpackage navigation
	 * @category   bootstrap-navigation-walker
	 */
	function lsx_wpml_nav_language_switcher_fix( $items, $args ) {
		$items = str_replace( 'menu-item-language-current','menu-item-language-current dropdown', $items );
		$items = str_replace( 'submenu-languages','submenu-languages dropdown-menu', $items );
		return $items;
	}

endif;

add_filter( 'wp_nav_menu_items', 'lsx_wpml_nav_language_switcher_fix', 10, 2 );
