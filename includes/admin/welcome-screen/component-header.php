<?php
/**
 * Welcome screen intro template
 *
 * @package lxs
 */

?>

<div class="row">
	<div class="col-md-12">
		<h1><span class="logo"><?php echo esc_html__( 'LSX', 'lsx' ); ?></span> <sup class="version"><?php echo esc_html( LSX_VERSION ); ?></sup></h1>
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
		<div class="box support">
			<h2><?php esc_html_e( 'Get support', 'lsx' ); ?></h2>

			<p>
				<?php
					printf(
						/* Translators: 1: HTML open tag link, 2: HTML close tag link, 3: HTML open tag link, 4: HTML close tag link */
						esc_html__( 'You\'ll find information on how to use and customize the LSX theme in our %1$sdocumentation%2$s section. However, please do %3$scontact us%4$s for support should you still find yourself unable to achieve your needs.', 'lsx' ),
						'<a href="https://www.lsdev.biz/lsx/documentation/" target="_blank" rel="noreferrer noopener">',
						'</a>',
						'<a href="https://www.lsdev.biz/contact/" target="_blank" rel="noreferrer noopener">',
						'</a>'
					);
					?>
			</p>

			<div class="more-button">
				<a href="https://www.lsdev.biz/contact/" target="_blank" rel="noreferrer" class="button button-primary" >
					<?php esc_html_e( 'Get in touch', 'lsx' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
