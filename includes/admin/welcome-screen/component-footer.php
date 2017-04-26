<?php
/**
 * Welcome screen contribute template
 *
 * @package lxs
 */

?>

<div class="row">
	<div class="col-md-4">
		<div class="box customise">
			<h2><?php esc_html_e( 'Theme Customizer', 'lsx' ); ?> - <span class="price">$59.00</span></h2>
			<p><?php esc_html_e( 'You\'ve installed LSX, so now why not make it all yours? Whether it\'s a small CSS tweak or changing the entire layout of pages, posts or archives, please make use of the Theme Customizer plugin. Click below to install and get custom!', 'lsx' ); ?></p>

			<div class="more-button">
				<a href="https://www.lsdev.biz/product/lsx-theme-customizer/" target="_blank" class="button button-primary">
					<?php esc_html_e( 'Theme Customizer', 'lsx' ); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="box support">
			<h2><?php esc_html_e( 'Get support', 'lsx' ); ?></h2>

			<p>
				<?php
					printf(
						/* Translators: 1: HTML open tag link, 2: HTML close tag link, 3: HTML open tag link, 4: HTML close tag link */
						esc_html__( 'You\'ll find information on how to use and customize the LSX theme in our %1$sdocumentation%2$s section. However, please do %3$scontact us%4$s for support should you still find yourself unable to achieve your needs.', 'lsx' ),
						'<a href="https://www.lsdev.biz/documentation/lsx/" target="_blank">',
						'</a>',
						'<a href="https://www.lsdev.biz/contact-us/" target="_blank">',
						'</a>'
					);
				?>
			</p>

			<div class="more-button">
				<a href="https://www.lsdev.biz/contact-us/" target="_blank" class="button button-primary">
					<?php esc_html_e( 'Get in touch', 'lsx' ); ?>
				</a>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="box suggest">
			<h2><?php esc_html_e( 'Suggest a feature', 'lsx' ); ?></h2>

			<p>
				<?php
					printf(
						/* Translators: 1: HTML open tag link, 2: HTML close tag link */
						esc_html__( 'If you\'d like to suggest a feature for inclusion in upcoming releases of the LSX theme, please don\'t hesitate to %1$scontact us%2$s directly. We\'re always on the lookout for fresh ideas to help make LSX even better.', 'lsx' ),
						'<a href="https://www.lsdev.biz/contact-us/" target="_blank">',
						'</a>'
					);
				?>
			</p>

			<div class="more-button">
				<a href="https://www.lsdev.biz/contact-us/" target="_blank" class="button button-primary">
					<?php esc_html_e( 'Submit a request', 'lsx' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
