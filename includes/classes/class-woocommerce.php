<?php
namespace LSX\Classes;

/**
 * All our WooCommerce enhancements
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class WooCommerce {

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
		add_action( 'wp_head', array( $this, 'maybe_load_class' ), 10 );
	}

	/**
	 * Loads our class if the plugin is active
	 *
	 * @return void
	 */
	public function maybe_load_class() {
		if ( class_exists( 'WooCommerce' ) ) {
			add_action( 'woocommerce_product_meta_end', array( $this, 'show_attribute_links' ) );
		}
	}

	/**
	 * Adds the archive links to the product attributes
	 *
	 * @var $product WC_Product() 
	 * @return void
	 */
	public function show_attribute_links() {
		global $product;

		$product = wc_get_product();

		$atttributes = $product->get_attributes();

		print_r('<pre>');
		print_r($atttributes);
		print_r('</pre>');
		return;

		$attribute_names = array( '<ATTRIBUTE_NAME>', '<ANOTHER_ATTRIBUTE_NAME>' ); // Add attribute names here and remember to add the pa_ prefix to the attribute name
			
		foreach ( $attribute_names as $attribute_name ) {
			$taxonomy = get_taxonomy( $attribute_name );
			
			if ( $taxonomy && ! is_wp_error( $taxonomy ) ) {
				$terms = wp_get_post_terms( $post->ID, $attribute_name );
				$terms_array = array();
			
				if ( ! empty( $terms ) ) {
					foreach ( $terms as $term ) {
					   $archive_link = get_term_link( $term->slug, $attribute_name );
					   $full_line = '<a href="' . $archive_link . '">'. $term->name . '</a>';
					   array_push( $terms_array, $full_line );
					}
					echo $taxonomy->labels->name . ': ' . implode( ', ' . $terms_array );
				}
			}
		}
	}
}
