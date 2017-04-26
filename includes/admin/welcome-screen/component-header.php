<?php
/**
 * Welcome screen intro template
 *
 * @package lxs
 */

?>

<div class="row">
	<div class="col-md-6">
		<h1><?php echo esc_html__( 'LSX', 'lsx' ) . ' <sup class="version">' . esc_attr( LSX_VERSION ) . '</sup>'; ?></h1>
	</div>

	<div class="col-md-6">
		<p class="review">
			<?php
				printf(
					/* Translators: 1: HTML open tag strong, 2: HTML close tag strong, 3: HTML open tag link, 4: HTML close tag link */
					esc_html__( '%1$sEnjoying LSX?%2$s Why not %3$sleave a review%4$s on WordPress.org? We\'re looking foward to all our users\' feedback!', 'lsx' ),
					'<strong>',
					'</strong>',
					'<a href="https://wordpress.org/themes/lsx" target="_blank">',
					'</a>'
				);
			?>
		</p>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="box enrich">
			<h2><?php esc_html_e( 'Built to enrich your WordPress experience', 'lsx' ); ?></h2>
			<p><?php esc_html_e( 'Whether you\'re using LSX for your personal blog, as the platform for a powerful WooCommerce store or as the foundation for your own child-theme, you\'ll find it\'s the perfect fit for WordPress.', 'lsx' ); ?></p>
		</div>
	</div>

	<div class="col-md-6">
		<div class="box news">
			<h2><?php esc_html_e( 'LSX News &amp; Documentation', 'lsx' ); ?></h2>

			<div class="row">
				<div class="col-md-6 news">
					<h3><?php esc_html_e( 'Recent News', 'lsx' ); ?></h3>

					<ul>
						<?php
							$rss = fetch_feed( 'https://www.lsdev.biz/lsx/feed/' );
							$rss_items = array();

							if ( ! is_wp_error( $rss ) ) {
								$maxitems  = $rss->get_item_quantity( 3 );
								$rss_items = $rss->get_items( 0, $maxitems );
							}

							foreach ( $rss_items as $item ) : ?>
								<li>
									<a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank">
										<?php echo esc_html( $item->get_title() ); ?>
									</a>
								</li>
								<span class="date"><?php echo esc_attr( $item->get_date( 'j F Y' ) ); ?></span>
							<?php
							endforeach;
						?>
					</ul>
				</div>

				<div class="col-md-6 docs">
					<h3><?php esc_html_e( 'Documentation', 'lsx' ); ?></h3>

					<ul>
						<li>
							<a href="https://www.lsdev.biz/documentation/lsx/" target="_blank"><?php esc_html_e( 'Installation &amp; configuration', 'lsx' ); ?></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
