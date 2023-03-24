<?php
namespace LSX\Classes;

/**
 * All the functions that run on the frontend and the rendering of the blocks.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Block_Styles {

	/**
	 * Holds the array of block stylesheets
	 */
	var $block_assets = array();

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
		add_action( 'init', array( $this, 'register_block_styles' ), 10 );
		add_action( 'enqueue_block_editor_assets', array( $this, 'block_editor_styles' ) );
		add_action( 'after_setup_theme', array( $this, 'enqueue_block_styles' ), 10 );
	}

	/**
	 * Register our block styles.
	 *
	 * @return void
	 */
	public function register_block_styles() {

		$block_styles = array(
			'core/separator'           => array(
				'wide'       => __( 'Wide', 'lsx' ),
			),
			'core/button'           => array(
				'cta'       => __( 'CTA', 'lsx' ),
				'pill'       => __( 'Pill', 'lsx' ),
				'rounded'       => __( 'Rounded', 'lsx' ),
				'shadow'       => __( 'Shadow', 'lsx' ),
			),
			'core/quote'           => array(
				'contrast-background' => __( 'Contrast', 'lsx' ),
				'primary-background' => __( 'Primary', 'lsx' ),
				'secondary-background' => __( 'Secondary', 'lsx' ),
			),
			'core/image'           => array(
				'inner-border'   => __( 'Inner Border', 'lsx' ),
				'shadow'       => __( 'Shadow', 'lsx' ),
			),
		);
	
		foreach ( $block_styles as $block => $styles ) {
			foreach ( $styles as $style_name => $style_label ) {
				register_block_style(
					$block,
					array(
						'name'  => $style_name,
						'label' => $style_label,
					)
				);
			}
		}
	}

	/**
	 * Registers the editor styles
	 *
	 * @return void
	 */
	public function block_editor_styles() {
		wp_enqueue_style( 'editor-styles', get_template_directory_uri() . '/assets/css/editor-style.css', false, LSX_VERSION, 'all' );
	}

	/**
	 * Returns an array of the block assets.
	 *
	 * @return array
	 */
	private function get_block_assets() {
		$this->block_assets = array(
			'core/separator' => array(
				'handle' => 'lsx-separator-block-styles',
				'src'    => get_template_directory_uri() . '/assets/css/blocks/separator.css',
				'path'   => get_template_directory() . '/assets/css/blocks/separator.css',
			),
			'core/button' => array(
				'handle' => 'lsx-button-block-styles',
				'src'    => get_template_directory_uri() . '/assets/css/blocks/button.css',
				'path'   => get_template_directory() . '/assets/css/blocks/button.css',
			),
			'core/image' => array(
				'handle' => 'lsx-image-block-styles',
				'src'    => get_template_directory_uri() . '/assets/css/blocks/image.css',
				'path'   => get_template_directory() . '/assets/css/blocks/image.css',
			),
		);
		return $this->block_assets;
	}

	/**
	 * Registers our block specific styles.
	 *
	 * @return void
	 */
	public function enqueue_block_styles() {
		foreach ( $this->get_block_assets() as $block_name => $block_asset ) {
			wp_enqueue_block_style(
				$block_name,
				array(
					'handle' => $block_asset['handle'],
					'src'    => $block_asset['src'],
					'path'   => $block_asset['path'],
				),
			);
		}
	}
}