<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage LSX
 * @since 0.1
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since 0.1
	 *
	 * @return void
	 */
	function lsx_register_block_styles() {

			$block_styles = array(
				'core/button'           => array(
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
		
	add_action( 'init', 'lsx_register_block_styles' );
}
