<?php

add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_support' );

$color_palette = array(
	array(
		'name'  => esc_html__( 'Black', 'db-lsx-child-theme' ),
		'slug' => 'black',
		'color' => '#2a2a2a',
	),
	array(
		'name'  => esc_html__( 'Gray', 'db-lsx-child-theme' ),
		'slug' => 'gray',
		'color' => '#727477',
	),
);

/**
 * Enqueue theme CSS and JavaScript .
 */
function theme_support() {
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
	// Add support for styling blocks.
	add_theme_support( 'wp-block-styles' );
	// Add support for custom color palettes
	add_theme_support( 'editor-color-palette', $color_palette );
}
