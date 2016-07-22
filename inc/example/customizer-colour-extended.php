<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Filter: lsx_customizer_colour_names
 *
 * Add two new colors (test) in main array of colors
 */
function test_lsx_customizer_colour_names( $array ) {
	$array['test_text_color'] = esc_html__( 'TEST: Text', 'lsx' );
	$array['test_text_color_hover'] = esc_html__( 'TEST: Text (hover)', 'lsx' );
	return $array;
}
add_filter( 'lsx_customizer_colour_names', 'test_lsx_customizer_colour_names' );

/**
 * Filter: lsx_customizer_colour_choices_default
 *
 * Add the new colors (test) in default scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices_default( $array ) {
	$array[] = '#ddddd1';
	$array[] = '#eeeee1';
	return $array;
}
add_filter( 'lsx_customizer_colour_choices_default', 'test_lsx_customizer_colour_choices_default' );

/**
 * Filter: lsx_customizer_colour_choices_red
 *
 * Add the new colors (test) in red scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices_red( $array ) {
	$array[] = '#ddddd2';
	$array[] = '#eeeee2';
	return $array;
}
add_filter( 'lsx_customizer_colour_choices_red', 'test_lsx_customizer_colour_choices_red' );

/**
 * Filter: lsx_customizer_colour_choices_orange
 *
 * Add the new colors (test) in orange scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices_orange( $array ) {
	$array[] = '#ddddd3';
	$array[] = '#eeeee3';
	return $array;
}
add_filter( 'lsx_customizer_colour_choices_orange', 'test_lsx_customizer_colour_choices_orange' );

/**
 * Filter: lsx_customizer_colour_choices_green
 *
 * Add the new colors (test) in green scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices_green( $array ) {
	$array[] = '#ddddd4';
	$array[] = '#eeeee4';
	return $array;
}
add_filter( 'lsx_customizer_colour_choices_green', 'test_lsx_customizer_colour_choices_green' );

/**
 * Filter: lsx_customizer_colour_choices_brown
 *
 * Add the new colors (test) in brown scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices_brown( $array ) {
	$array[] = '#ddddd5';
	$array[] = '#eeeee5';
	return $array;
}
add_filter( 'lsx_customizer_colour_choices_brown', 'test_lsx_customizer_colour_choices_brown' );

/**
 * Filter: lsx_customizer_colour_choices
 *
 * Add a new scheme (example: new site)
 * Also add the new colors (test) in new scheme (example: new plugin with new elements)
 */
function test_lsx_customizer_colour_choices( $array ) {
	$array['test'] = array(
		'label'  => __( 'Test', 'lsx' ),
		'colors' => array(
			// Button
			'#428bca', '#2a6496', '#ffffff', '#ffffff',
			// Button CTA
			'#f7941d', '#f7741d', '#ffffff', '#ffffff',
			// Top Menu
			'#333333', '#ffffff', '#428bca',
			// Header
			'#ffffff', '#337ab7', '#23527c', '#777777',
			// Main Menu
			'#428bca', '#333333', '#555555', '#ffffff', '#ffffff',
			// Banner
			'#2a6496', '#ffffff', '#ffffff',
			// Body
			'#ffffff', '#dddddd', '#333333', '#333333', '#337ab7', '#23527c',
			// Footer CTA
			'#428bca', '#ffffff', '#eeeeee', '#dddddd',
			// Footer Widgets
			'#333333', '#eeeeee', '#dddddd', '#cccccc',
			// Footer
			'#232222', '#ffffff', '#337ab7', '#969696'
			// Test
			'#ddddd6', '#eeeee6'
		)
	);

	return $array;
}
add_filter( 'lsx_customizer_colour_choices', 'test_lsx_customizer_colour_choices' );

?>