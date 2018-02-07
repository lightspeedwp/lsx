<?php
/**
 * WooCommerce thank you Template.
 *
 * Template Name: WC Thank You
 *
 * @package    lsx
 * @subpackage template
 */

get_header(); ?>

<?php lsx_content_wrap_before(); ?>

<div id="primary" class="content-area col-sm-12">

	<?php lsx_content_before(); ?>

	<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					WC()->payment_gateways()->payment_gateways;
					$order_key = isset( $_GET['key'] ) ? wc_clean( $_GET['key'] ) : '';
					$order_id  = absint( $wp->query_vars['order-received'] );
					$order = wc_get_order( $order_id );
				?>

				<?php if ( $order && $order->get_id() === $order_id && $order->get_order_key() === $order_key ) : ?>

					<?php // @codingStandardsIgnoreStart ?>

					<div class="alert alert-success"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'lsx' ), $order ); ?></div>

					<div class="row">
						<div class="col-xs-12 col-sm-6">
							<h2><?php esc_html_e( 'Order Details', 'lsx' ); ?></h2>

							<table class="table">
								<tbody>
									<tr>
										<th><?php esc_html_e( 'Order:', 'lsx' ); ?></th>
										<td><?php echo $order->get_order_number(); ?></td>
									</tr>

									<tr>
										<th><?php esc_html_e( 'Date:', 'lsx' ); ?></th>
										<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
									</tr>

									<tr>
										<th><?php esc_html_e( 'Total:', 'lsx' ); ?></th>
										<td><?php echo $order->get_formatted_order_total(); ?></td>
									</tr>

									<?php if ( $order->payment_method_title ) : ?>
										<tr>
											<th><?php esc_html_e( 'Payment method:', 'lsx' ); ?></th>
											<td><?php echo $order->payment_method_title; ?></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>

							<?php // do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

							<h2><?php esc_html_e( 'Customer details', 'lsx' ); ?></h2>

							<dl class="customer_details">
								<?php
									if ( $order->billing_email ) echo '<dt>' . esc_html__( 'Email:', 'lsx' ) . '</dt><dd>' . $order->billing_email . '</dd>';
									if ( $order->billing_phone ) echo '<dt>' . esc_html__( 'Telephone:', 'lsx' ) . '</dt><dd>' . $order->billing_phone . '</dd>';

									// Additional customer details hook
									do_action( 'woocommerce_order_details_after_customer_details', $order );
								?>
							</dl>

							<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

								<div class="row">
									<div class="col-xs-12 col-sm-6">

							<?php endif; ?>

										<h3><?php esc_html_e( 'Billing Address', 'lsx' ); ?></h3>

										<address>
											<?php
												if ( ! $order->get_formatted_billing_address() ) {
													esc_html_e( 'N/A', 'lsx' );
												} else {
													echo $order->get_formatted_billing_address();
												}
											?>
										</address>

							<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

									</div>

									<div class="col-xs-12 col-sm-6">
										<h3><?php esc_html_e( 'Shipping Address', 'lsx' ); ?></h3>

										<address>
											<?php
												if ( ! $order->get_formatted_shipping_address() ) {
													esc_html_e( 'N/A', 'lsx' );
												} else {
													echo $order->get_formatted_shipping_address();
												}
											?>
										</address>
									</div>
								</div>

							<?php endif; ?>
						</div>

						<div class="col-xs-12 col-sm-6">
							<h2><?php esc_html_e( 'Products details', 'lsx' ); ?></h2>

							<table class="table">
								<thead>
									<tr>
										<th><?php esc_html_e( 'Product', 'lsx' ); ?></th>
										<th><?php esc_html_e( 'Total', 'lsx' ); ?></th>
									</tr>
								</thead>

								<tbody>
									<?php
										if ( sizeof( $order->get_items() ) > 0 ) :
											foreach( $order->get_items() as $item ) :
												$_product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
												$item_meta = new WC_Order_Item_Meta( $item['item_meta'], $_product );
											?>

											<tr>
												<td>
													<?php
														if ( $_product && ! $_product->is_visible() ) {
															echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
														} else {
															echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
														}

														echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );

														ob_start();
														$item_meta->display();
														$_item_meta = ob_get_clean();

														if ( ! empty( $_item_meta ) ) {
															echo $_item_meta;
														} else {
															echo '<br>';
														}

														if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {
															$download_files = $order->get_item_downloads( $item );
															$i = 0;
															$links = array();

															if ( empty( $download_files ) ) {
																$download_files = $_product->get_files();
															}

															foreach ( $download_files as $download_id => $file ) {
																$i++;

																if ( $i > 1 ) {
																	echo '<br>';
																}

																if ( ! empty( $_item_meta ) ) {
																	echo '<span style="margin-top: -2.4rem; display: block;">';
																} else {
																	echo '<span>';
																}

																echo '<a href="' . esc_url( $file['download_url'] ? $file['download_url'] : $file['file'] ) . '">' . sprintf( esc_html__( 'Download file%s', 'lsx' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a>';
																echo '</span>';
															}
														}
													?>
												</td>

												<td>
													<?php echo $order->get_formatted_line_subtotal( $item ); ?>
												</td>
											</tr>

											<?php
												if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
													?>
													<tr class="product-purchase-note">
														<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
													</tr>
													<?php
												}
											endforeach;
										endif;

										// do_action( 'woocommerce_order_items_table', $order );
									?>
								</tbody>

								<tfoot>
									<?php
										if ( $totals = $order->get_order_item_totals() ) :
											foreach ( $totals as $total ) :
												?>
												<tr>
													<th scope="row"><?php echo $total['label']; ?></th>
													<td><?php echo $total['value']; ?></td>
												</tr>
												<?php
											endforeach;
										endif;
									?>
								</tfoot>
							</table>

							<?php if ( 'bacs' === $order->get_payment_method() ) { ?>
								<h2><?php esc_html_e( 'Bank Details', 'lsx' ); ?></h2>
								<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
							<?php } ?>
						</div>
					</div>

					<?php // @codingStandardsIgnoreEnd ?>

				<?php else : ?>

					<div class="alert alert-danger"><?php esc_html_e( 'Invalid order.', 'lsx' ); ?></div>

				<?php endif; ?>

			<?php endwhile; ?>

		<?php endif; ?>

		<?php lsx_content_bottom(); ?>

	</main><!-- #main -->

	<?php lsx_content_after(); ?>

</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_footer();
