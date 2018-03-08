<?php
/**
 * Welcome screen contribute template
 *
 * @package lxs
 */

?>

<div class="row">
	<div class="col-md-6">
		<div class="box mailchimp">
			<h2><?php esc_html_e( 'Newsletter', 'lsx' ); ?></h2>
			<p><?php esc_html_e( 'Subscribe to our mailing list.', 'lsx' ); ?></p>

			<!-- Begin MailChimp Signup Form -->
			<form action="//lsdev.us2.list-manage.com/subscribe/post?u=e50b2c5c82f4b42ea978af479&amp;id=92c36218e5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				<div id="mc_embed_signup">
					<div id="mc_embed_signup_scroll">
						<div class="mc-field-group">
							<label for="mce-EMAIL"><?php esc_html_e( 'Email Address', 'lsx' ); ?> <span class="asterisk">*</span></label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div class="mc-field-group">
							<label for="mce-FNAME"><?php esc_html_e( 'First Name', 'lsx' ); ?> </label>
							<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
						</div>
						<div class="mc-field-group">
							<label for="mce-LNAME"><?php esc_html_e( 'Last Name', 'lsx' ); ?> </label>
							<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
						</div>
					</div>
					<div style="position:absolute;left:-5000px;" aria-hidden="true"><input type="text" name="b_e50b2c5c82f4b42ea978af479_92c36218e5" tabindex="-1" value=""></div>
				</div>
				<div class="more-button">
					<input type="submit" value="<?php esc_html_e( 'Subscribe', 'lsx' ); ?>" name="subscribe" class="button button-primary">
				</div>
			</form>
			<!--End mc_embed_signup-->
		</div>
	</div>

	<div class="col-md-6">
		<div class="box suggest">
			<h2><?php esc_html_e( 'Enjoying LSX?', 'lsx' ); ?></h2>

			<p>
				<?php
					printf(
						/* Translators: 1: HTML open tag link, 2: HTML close tag link */
						esc_html__( 'Why not %1$sleave a review%2$s on WordPress.org? We\'re looking foward to all our users\' feedback!', 'lsx' ),
						'<a href="https://wordpress.org/themes/lsx" target="_blank rel="noopener noreferrer">',
						'</a>'
					);
				?>
			</p>

			<div class="more-button">
				<span class="logo"></span>
			</div>
		</div>
	</div>
</div>
