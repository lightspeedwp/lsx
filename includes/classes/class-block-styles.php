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
				'shadow'       => __( 'Shadow', 'lsx' ),
			),
			'core/image'           => array(
				'shadow'       => __( 'Shadow', 'lsx' ),
			),
			'core/quote'           => array(
				'shadow'       => __( 'Shadow', 'lsx' ),
			),
			'core/quote'           => array(
				'contrast-background' => __( 'Contrast', 'lsx' ),
				'primary-background' => __( 'Primary', 'lsx' ),
				'secondary-background' => __( 'Secondary', 'lsx' ),
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
}