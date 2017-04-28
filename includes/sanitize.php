<?php
/**
 * LSX sanitize callbacks for the customizer options.
 *
 * @package    lsx
 * @subpackage sanitize
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_sanitize_choices' ) ) :

	/**
	 * Sanitize a value from a list of allowed values.
	 *
	 * @package    lsx
	 * @subpackage sanitize
	 *
	 * @param  mixed    $value      The value to sanitize.
	 * @param  mixed    $setting    The setting for which the sanitizing is occurring.
	 * @return mixed                The sanitized value.
	*/
	function lsx_sanitize_choices( $value, $setting ) {
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}

		$choices = lsx_customizer_sanitize_get_choices( $setting );

		if ( ! is_wp_error( $choices ) && ! empty( $choices ) ) {
			$allowed_choices = array_keys( $choices );

			if ( ! in_array( $value, $allowed_choices ) ) {
				$value = lsx_customizer_sanitize_get_default( $setting );
			}

			return $value;
		} else {
			return $choices;
		}
	}

endif;

if ( ! function_exists( 'lsx_customizer_sanitize_get_choices' ) ) :

	/**
	 * Helper function to return the choices for a field.
	 *
	 * @package    lsx
	 * @subpackage sanitize
	 *
	 * @param string
	 * @return mixed $field
	 */
	function lsx_customizer_sanitize_get_choices( $id ) {
		global $lsx_customizer;

		$can_validate = method_exists( 'WP_Customize_Setting', 'validate' );
		$field        = $lsx_customizer->get_control( $id );

		if ( ! isset( $field['choices'] ) ) {
			return $can_validate ? new WP_Error( 'notexists', esc_html__( 'Choice doesn\'t exist', 'lsx' ) ) : false;
		}

		return $field['choices'];
	}

endif;

if ( ! function_exists( 'lsx_customizer_sanitize_get_default' ) ) :

	/**
	 * Helper function to return defaults.
	 *
	 * @package    lsx
	 * @subpackage sanitize
	 *
	 * @param string
	 * @return mixed $default
	 */
	function lsx_customizer_sanitize_get_default( $id ) {
		global $lsx_customizer;
		$setting = $lsx_customizer->get_setting( $id );

		if ( isset( $setting['default'] ) ) {
			return $setting['default'];
		}

		return false;
	}

endif;

if ( ! function_exists( 'lsx_sanitize_checkbox' ) ) :

	/**
	 * Sanitizes an single or multiple checkbox input.
	 *
	 * @package    lsx
	 * @subpackage sanitize
	 *
	 * @param array $input
	 * @return array $output
	 */
	function lsx_sanitize_checkbox( $input ) {
		$can_validate = method_exists( 'WP_Customize_Setting', 'validate' );

		if ( ! is_bool( $input ) ) {
			return $can_validate ? new WP_Error( 'notboolean', esc_html__( 'Not a boolean', 'lsx' ) ) : false;
		}

		return $input;
	}

endif;
