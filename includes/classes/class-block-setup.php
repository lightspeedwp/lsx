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
		add_action( 'init', array( $this, 'register_block_patterns' ), 9 );
		add_action( 'init', array( $this, 'register_block_fields' ), 100 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_block_variations' ) );
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
 * Registers block categories, and type.
 *
 * @since 0.9.2
 */
function lsx_register_block_pattern_categories() {

	/* Functionality specific to the Block Pattern Explorer plugin. */
	if ( function_exists( 'register_block_pattern_category_type' ) ) {
		register_block_pattern_category_type( 'lsx', array( 'label' => __( 'LSX', 'lsx' ) ) );
	}

	$block_pattern_categories = array(
		'lsx-footer'  => array(
			'label'         => __( 'Footer', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
		'lsx-general' => array(
			'label'         => __( 'General', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
		'lsx-featured' => array(
			'label'         => __( 'Featured', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
		'lsx-header'  => array(
			'label'         => __( 'Header', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
		'lsx-page'    => array(
			'label'         => __( 'Page', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
		'lsx-query'   => array(
			'label'         => __( 'Query', 'lsx' ),
			'categoryTypes' => array( 'lsx' ),
		),
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', 'lsx_register_block_pattern_categories', 9 );

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
}
