<?php
/**
 * LSX functions and definitions - Navigation Walker.
 *
 * @package    lsx
 * @subpackage navigation
 * @category   bootstrap-walker
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter( 'nav_menu_item_id', '__return_null' );

if ( ! function_exists( 'lsx_nav_menu_css_class' ) ) :

	/**
	 * Remove the id="" on nav menu items.
	 * Return 'menu-slug' for nav menu classes.
	 *
	 * @package    lsx
	 * @subpackage navigation
	 * @category   bootstrap-walker
	 */
	function lsx_nav_menu_css_class( $classes, $item ) {
		$slug    = sanitize_title( $item->title );
		$classes = preg_replace( '/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes );
		$classes = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );

		$classes[] = 'menu-' . $slug;
		$classes   = array_unique( $classes );

		return array_filter( $classes, 'lsx_is_element_empty' );
	}

endif;

add_filter( 'nav_menu_css_class', 'lsx_nav_menu_css_class', 10, 2 );

if ( ! function_exists( 'lsx_nav_menu_args' ) ) :

	/**
	 * Clean up wp_nav_menu_args.
	 *
	 * Remove the container.
	 * Use LSX_Nav_Walker() by default.
	 *
	 * @package    lsx
	 * @subpackage navigation
	 * @category   bootstrap-walker
	 */
	function lsx_nav_menu_args( $args = '' ) {
		$roots_nav_menu_args['container'] = false;

		if ( ! $args['items_wrap'] ) {
			$roots_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
		}

		if ( current_theme_supports( 'bootstrap-top-navbar' ) && ! $args['depth'] ) {
			$roots_nav_menu_args['depth'] = 2;
		}

		if ( ! $args['walker'] ) {
			$roots_nav_menu_args['walker'] = new LSX_Nav_Walker();
		}

		return array_merge( $args, $roots_nav_menu_args );
	}

endif;

add_filter( 'wp_nav_menu_args', 'lsx_nav_menu_args' );
