<?php
namespace LSX\Classes;

/**
 * All the image functions for the theme.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Images {

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
		add_action( 'after_setup_theme', array( $this, 'register_image_sizes' ), 10 );
		add_filter( 'image_size_names_choose', array( $this, 'register_media_editor_sizes' ), 10, 1 );
		add_filter( 'render_block_data', array( $this, 'render_post_image_data' ), 10, 3 );
	}

	/**
	 * Register our image size
	 *
	 * @return void
	 */
	public function register_image_sizes() {
		add_image_size( 'lsx-blog-thumbnail', 640, 480, array( 'center', 'center' ) );
	}

	/**
	 * Add ing the image sizes to the media editor.
	 *
	 * @param array $sizes
	 * @return void
	 */
	public function register_media_editor_sizes( $sizes = array() ) {
		return array_merge( $sizes, array(
			'lsx-blog-thumbnail' => __( 'LSX Blog Thumbnail', 'lsx' ),
		) );
	}

	/**
	 * Sets the post image fields
	 *
	 * @param array         $parsed_block The block being rendered.
	 * @param array         $source_block An un-modified copy of $parsed_block, as it appeared in the source content.
	 * @param WP_Block|null $parent_block If this is a nested block, a reference to the parent block.
	 * @return array
	 */
	public function render_post_image_data( $parsed_block, $source_block, $parent_block ) {
		if ( ! is_front_page() && is_archive() && 'core/post-featured-image' === $parsed_block['blockName'] ) {
			$parsed_block['attrs']['sizeSlug'] = 'lsx-blog-thumbnail';
		}
		return $parsed_block;
	}
}
