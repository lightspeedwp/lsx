<?php
/**
 * LSX functions and definitions - Comment Walker.
 *
 * @package    lsx
 * @subpackage comment-walker
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_get_avatar' ) ) :

	/**
	 * Comment Form Field Filter.
	 *
	 * @package    lsx
	 * @subpackage comment-walker
	 */
	function lsx_get_avatar( $avatar ) {
		$avatar = str_replace( "class='avatar", "class='avatar pull-left media-object ", $avatar );
		$avatar = str_replace( 'class="avatar', 'class="avatar pull-left media-object ', $avatar );
		return $avatar;
	}

endif;

add_filter( 'get_avatar', 'lsx_get_avatar' );

add_action( 'admin_bar_menu', function() {
	remove_filter( 'get_avatar', 'lsx_get_avatar' );
}, 0 );

add_action( 'wp_after_admin_bar_render', function() {
	add_filter( 'get_avatar','lsx_get_avatar' );
} );

if ( ! function_exists( 'lsx_comment_form_fields_filter' ) ) :

	/**
	 * Comment Form Field Filter.
	 *
	 * @package    lsx
	 * @subpackage comment-walker
	 */
	function lsx_comment_form_fields_filter( $fields ) {
		foreach ( $fields as &$field ) {
			if ( stristr( 'class=', $field ) ) {
				$field = str_replace( 'class="', 'class="form-control ', $field );
			} else {
				$field = str_replace( '<input', '<input class="form-control" ', $field );
			}
		}

		return $fields;
	}

endif;

add_filter( 'comment_form_default_fields', 'lsx_comment_form_fields_filter' );
