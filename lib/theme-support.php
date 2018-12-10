<?php

/**
 * Enqueue theme CSS and JavaScript .
 */
if ( ! function_exists( 'theme_support' ) ) :
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
		) );
	}
endif;
add_action( 'after_setup_theme', 'theme_support' );

