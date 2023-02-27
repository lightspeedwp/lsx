<?php
namespace LSX\Classes;

/**
 * All the functions loading blocks and setting up fields.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Block_Setup {

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Initiate our class.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'init', array( $this, 'register_block_types' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_block_variations' ) );
		add_action( 'init', array( $this, 'register_block_patterns' ), 9 );
		add_action( 'init', array( $this, 'register_block_fields' ), 100 );

	}

	/**
	 * Registers our block types via block.json
	 *
	 * @return void
	 */
	public function register_block_types() {
		register_block_type( get_template_directory() . '/blocks/src/post-meta' );
	}

	/**
	 * Registers our block variations.
	 *
	 * @return void
	 */
	public function register_block_variations() {
		wp_enqueue_script(
			'lsx-block-variations',
			get_template_directory_uri() . '/blocks/build/related-posts/index.js',
			array( 'wp-blocks' )
		);
	}

	/**
	 * Registers block patterns and categories.
	 *
	 * @since LSX 1.0
	 *
	 * @return void
	 */
	public function register_block_patterns() {
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
			if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
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

	/**
	 * Register the meta fields with REST so we can access them in the blocks.
	 *
	 * @return void
	 */
	public function register_block_fields() {

		$metafields = [ 'price' ];

		foreach( $metafields as $metafield ){
			// Pass an empty string to register the meta key across all existing post types.
			register_post_meta( '', $metafield, array(
				'show_in_rest' => true,
				'type' => 'string',
				'single' => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback' => function() { 
					return current_user_can( 'edit_posts' );
				}
			));
		} 
	}
}
