<?php
/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<div class="lsx-woocommerce-slot">
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<figure class="lsx-woocommerce-avatar">
			<?php echo wp_kses_post( $product->get_image( 'lsx-thumbnail-square' ) ); ?>
		</figure>
	</a>

	<h5 class="lsx-woocommerce-title">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo wp_kses_post( $product->get_name() ); ?></a>
	</h5>

	<?php if ( ! empty( $show_rating ) ) : ?>
		<div class="lsx-woocommerce-rating">
			<?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating() ) ); ?>
		</div>
	<?php endif; ?>

	<?php
		$price_html = $product->get_price_html();
		if ( $price_html ) : ?>
		<div class="lsx-woocommerce-price">
			<?php echo wp_kses_post( $price_html ); ?>
		</div>
	<?php endif; ?>

	<div class="lsx-woocommerce-content">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="moretag"><?php esc_attr_e( 'View more', 'lsx' ); ?></a>
	</div>
</div>
