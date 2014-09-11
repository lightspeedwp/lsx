<?php
/* Template Name: Contact */
global $lsx_options;
get_header(); ?>

	<div id="primary" class="content-area col-sm-12">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

				<header class="page-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header><!-- .page-header -->
				
				<div class="row">
					<div class="col-md-4">
						<div class="contact-block" itemscope itemtype="http://schema.org/LocalBusiness">
							<?php if(false != lsx_get_option( 'contact_name' )) {?>
								<p itemprop="name"><strong><?php echo lsx_get_option( 'contact_name' ); ?></strong></p>
								<hr>
							<?php } ?>
							
							<?php if(false != lsx_get_option( 'contact_address' )) {?>
								<p><strong><i class="fa fa-building-o lsx-contact-building"></i><?php echo __( 'Physical Address', 'lsx');?></strong>
								<div itemprop="address">	
									<?php echo wpautop( lsx_get_option( 'contact_address' ) ); ?>								
								</div></p>
							<?php } ?>
							
							<?php if(false != lsx_get_option( 'contact_phone' )) {?>
								<p><strong><i class="fa fa-phone lsx-contact-phone"></i><?php echo __( 'Phone: ', 'lsx' ); ?></strong>
								<a href="tel:<?php echo lsx_get_option( 'contact_phone' ); ?>"><span itemprop="telephone"><?php echo lsx_get_option( 'contact_phone' ); ?></span></a></p>
							<?php } ?>
							
							<?php if(false != lsx_get_option( 'contact_fax' )) {?>
								<p><strong><i class="fa fa-print lsx-contact-fax"></i><?php echo __( 'Fax: ', 'lsx' ); ?></strong>
								<a href="tel:<?php echo lsx_get_option( 'contact_fax' ); ?>"><span itemprop="faxNumber"><?php echo lsx_get_option( 'contact_fax' ); ?></span></a></p>
							<?php } ?>
							
							<?php if(false != lsx_get_option( 'contact_email' )) {?>
								<p><strong><i class="fa fa-envelope lsx-contact-email"></i><?php echo __( 'Email: ', 'lsx' ); ?></strong>
								<a href="mailto:<?php echo lsx_get_option( 'contact_email' ); ?>"><span itemprop="email"><?php echo lsx_get_option( 'contact_email' ); ?></span></a></p>
							<?php } ?>
							
						</div>
					</div>

					<div class="col-md-8">
						<?php echo lsx_get_option( 'contact_map' ); ?>
					</div>
					
					<div class="col-md-12">
						<?php if ( function_exists( 'gravity_form' ) ) { ?>
							<?php gravity_form( lsx_get_option( 'contact_form' ), false, false, false, '', false); ?>
						<?php } ?>
					</div>
				</div>

				<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

<?php get_footer(); ?>