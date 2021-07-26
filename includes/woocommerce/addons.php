<?php 
/**
 * WooCommerce Addons filters and functions
 *
 * @package    lsx
 * @subpackage woocommerce
 */

/**
 * WooCommerce Order Delivery Date
 */
if ( function_exists( 'wc_od_get_delivery_date_field_args' ) ) {
	/**
	 * Change the arguments for the checkout delivery date field.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 * @param      $args array
	 * @return     array
	 */
	function lsx_wc_delivery_date_args( $args = array(), $context ) {
		if ( 'checkout' === $context ) {
			$args['label'] = _x( 'Date', 'Delivery date checkout field label', 'lsx' );
		}
		return $args;
	}
	add_action( 'wc_od_delivery_date_field_args', 'lsx_wc_delivery_date_args', 10, 2 );
}

if ( function_exists( 'wc_od_order_delivery_details_args' ) ) {
	/**
	 * Change the title of the shipping and delivery title.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 * @param      $args array
	 * @return     array
	 */
	function lsx_wc_delivery_details_args( $args = array() ) {
		$args['title'] = _x( 'Collection or Delivery Time-slot', 'Delivery date title on checkout', 'lsx' );
		return $args;
	}
	add_action( 'wc_od_order_delivery_details_args', 'lsx_wc_delivery_details_args', 10, 1 );
}
