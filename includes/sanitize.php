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
		$allowed_choices = array_keys( $choices );

		if ( ! in_array( $value, $allowed_choices ) ) {
			$value = lsx_customizer_sanitize_get_default( $setting );
		}

		return $value;
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
		$field = $lsx_customizer->get_control( $id );

		if ( isset( $field['choices'] ) ) {
			return $field['choices'];
		}
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
		$setting = $lsx_customizer->get_setting($id);

		if ( isset( $setting['default'] ) ) {
			return $setting['default'];
		}
	}

endif;

if ( ! function_exists( 'lsx_sanitize_email' ) ) :

	/**
	 * Sanitizes an email input.
	 *
	 * @package    lsx
	 * @subpackage sanitize
	 *
	 * @param string $email
	 * @param obj $setting
	 * @return string $default
	 */
	function lsx_sanitize_email( $email, $setting ) {
		$email = sanitize_email( $email );
		return ( ! is_null( $email ) ? $email : $setting->default );
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
		if ( $input ) {
			$output = '1';
		} else {
			$output = false;
		}

		return $output;
	}

endif;
