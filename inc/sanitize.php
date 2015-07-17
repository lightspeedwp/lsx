<?php
/**
 * The Sanitize callbacks for the customizer options
 * 
 * @package lsx-theme
 * @subpackage sanitize
 * 
 */

/**
 * Sanitize a value from a list of allowed values.
 *
 * @package lsx-theme
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

/**
 * Helper function to return the choices for a field
 *
 * @package lsx-theme
 * @subpackage sanitize
 *
 * @param string
 * @return mixed $field
 */

function lsx_customizer_sanitize_get_choices( $id ) {
	global $lsx_customizer;
	//LSX_Theme_Customizer
	
	$field = $lsx_customizer->get_control($id);
	
	if ( isset( $field['choices'] ) ) {
		return $field['choices'];
	}

}

/**
 * Helper function to return defaults
 *
 * @package lsx-theme
 * @subpackage sanitize
 *
 * @param string
 * @return mixed $default
 */

function lsx_customizer_sanitize_get_default( $id ) {
	global $lsx_customizer;
	//LSX_Theme_Customizer

	$setting = $lsx_customizer->get_setting($id);

	if ( isset( $setting['default'] ) ) {
		return $setting['default'];
	}
}

/**
 * Sanitizes an email input
 *
 * @package lsx-theme
 * @subpackage sanitize
 *
 * @param string $email
 * @param obj $setting
 * @return string $default
 */
function lsx_sanitize_email( $email, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$email = sanitize_email( $email );

	// If $email is a valid email, return it; otherwise, return the default.
	return ( ! is_null( $email ) ? $email : $setting->default );
}

/**
 * Sanitizes an single or multiple checkbox input
 *
 * @package lsx-theme
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