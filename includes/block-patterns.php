<?php
/**
 * LSX: Block Patterns
 *
 * @since LSX 1.0
 */

/**
 * Registers block patterns and categories.
 *
 * @since LSX 1.0
 *
 * @return void
 */
function lsx_register_block_patterns() {
	$block_pattern_categories = array(
		'featured' => array( 'label' => __( 'Featured', 'lsx' ) ),
		'footer'   => array( 'label' => __( 'Footers', 'lsx' ) ),
		'header'   => array( 'label' => __( 'Headers', 'lsx' ) ),
		'query'    => array( 'label' => __( 'Query', 'lsx' ) ),
		'pages'    => array( 'label' => __( 'Pages', 'lsx' ) ),
	);

	/**
	 * Filters the theme block pattern categories.
	 *
	 * @since LSX 1.0
	 *
	 * @param array[] $block_pattern_categories {
	 *     An associative array of block pattern categories, keyed by category name.
	 *
	 *     @type array[] $properties {
	 *         An array of block category properties.
	 *
	 *         @type string $label A human-readable label for the pattern category.
	 *     }
	 * }
	 */
	$block_pattern_categories = apply_filters( 'lsx_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'general-pricing-table',
	);

	/**
	 * Filters the theme block patterns.
	 *
	 * @since LSX 1.0
	 *
	 * @param array $block_patterns List of block patterns by name.
	 */
	$block_patterns = apply_filters( 'lsx_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = get_theme_file_path( '/includes/patterns/' . $block_pattern . '.php' );

		register_block_pattern(
			'lsx/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', 'lsx_register_block_patterns', 9 );


function lsx_post_meta_basic_block_init() {
	register_block_type( get_template_directory() . '/blocks/build/post-meta' );
}
add_action( 'init', 'lsx_post_meta_basic_block_init' );
