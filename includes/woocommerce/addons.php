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
	add_filter( 'wc_od_delivery_date_field_args', 'lsx_wc_delivery_date_args', 10, 2 );

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
	add_filter( 'wc_od_order_delivery_details_args', 'lsx_wc_delivery_details_args', 10, 1 );
	add_filter( 'wc_od_checkout_delivery_details_args', 'lsx_wc_delivery_details_args', 10, 1 );
}

/**
 * WooCommerce Points and Rewards
 */

if ( class_exists( 'WC_Points_Rewards' ) ) {
	/**
	 * Adds a div around the Points and rewards message.
	 *
	 * @param string $message
	 * @param string $option
	 * @return string
	 */
	function lsx_wc_points_message_div( $message = '', $option = '' ) {
		if ( '' !== $message ) {
			$message = '<div class="lsx-woocommerce-message-text">' . $message . '</div>';
		}
		return $message;
	}
	add_filter( 'option_wc_points_rewards_redeem_points_message', 'lsx_wc_points_message_div', 10, 2 );

	/**
	 * Adds in the lsx wrapper class.
	 *
	 * @param string $message
	 * @param boolean $discount_available
	 * @return string
	 */
	function lsx_wc_points_message_div_wrapper_class( $message = '', $discount_available ) {
		if ( '' !== $message ) {
			$message = str_replace( 'wc_points_redeem_earn_points', 'wc_points_redeem_earn_points woocommerce-message lsx-woocommerce-message-wrap', $message );
		}
		return $message;
	}
	add_filter( 'wc_points_rewards_redeem_points_message', 'lsx_wc_points_message_div_wrapper_class', 10, 2 );
}
