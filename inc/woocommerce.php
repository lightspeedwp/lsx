<?php
/**
 * WooCommerce Layout and  Functionality
 *
 * @package lsx
 * @subpackage woocommerce
 */

/*
 * Hooks
 */
/**
 * Adding WooCommerce Hooks and Theme Support
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'lsx_content_before', 10);
add_action('woocommerce_after_main_content', 'lsx_content_after', 10);