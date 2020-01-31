<?php
/**
 * Enqueue theme CSS and JavaScript .
 *
 * @package lsx
 */

if ( ! function_exists( 'theme_support' ) ) :
	/**
	 * Enqueue theme CSS and JavaScript .
	 *
	 * @return void
	 */
	function theme_support() {
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
		// Add support for styling blocks.
		add_theme_support( 'wp-block-styles' );
		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'lsx' ),
				'slug'  => 'strong-blue',
				'color' => '#27639e',
			),
			array(
				'name'  => __( 'Lighter Blue', 'lsx' ),
				'slug'  => 'lighter-blue',
				'color' => '#428bca',
			),
			array(
				'name'  => __( 'Yellow', 'lsx' ),
				'slug'  => 'light-yellow',
				'color' => '#f7ae00',
			),
			array(
				'name'  => __( 'Dark Yellow', 'lsx' ),
				'slug'  => 'dark-yellow',
				'color' => '#ab7800',
			),
			array(
				'name'  => __( 'Green', 'lsx' ),
				'slug'  => 'light-green',
				'color' => '#6BA913',
			),
			array(
				'name'  => __( 'Dark Green', 'lsx' ),
				'slug'  => 'dark-green',
				'color' => '#3F640B',
			),
			array(
				'name'  => __( 'White', 'lsx' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'lsx' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'theme_support' );

