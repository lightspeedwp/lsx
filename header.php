<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lsx
 */
global $lsx_options;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php lsx_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php lsx_head_bottom(); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'lsx' ); ?>>
<?php lsx_body_top(); ?>

<?php if ( !is_singular('landing-page') && !is_page_template('page-templates/template-metaplate.php') && !is_page_template('page-templates/template-metaplate-alt.php') ) { ?>

	<?php lsx_header_before(); ?>
		 	<header class="<?php lsx_header_classes(); ?>" role="banner">
		  		<?php lsx_header_top(); ?>
			  	<div class="container">

					<?php lsx_nav_before(); ?>
					
					<?php lsx_nav_menu(); ?>
			  		
			  		<?php lsx_nav_after(); ?>
			  		
			  	<?php lsx_header_bottom(); ?>

			  	</div>
			</header>
				
			<?php lsx_header_after(); ?>
			
			<div class="wrap container" role="document">
				<div class="content role row">

	<?php } elseif ( is_page_template('page-templates/template-metaplate-alt.php') ) { ?>

		<?php lsx_header_before(); ?>

	 	<header class="banner navbar navbar-default navbar-static-top" role="banner">
	  		<?php lsx_header_top(); ?>

		  	<div class="container">
		    	<div class="navbar-header">
					<?php lsx_site_identity(); ?>
			    </div>
		  	</div>

		  	<?php lsx_header_bottom(); ?>
		</header>
			
		<?php lsx_header_after(); ?>

	<?php } else { ?>

		<?php lsx_header_before(); ?>

	 	<header class="banner navbar navbar-default navbar-static-top" role="banner">
	  		<?php lsx_header_top(); ?>

		  	<div class="container">
		    	<div class="navbar-header">
					<?php lsx_site_identity(); ?>
			    </div>

			    <div class="header-links">
			    	<strong><?php _e( 'Get your Tourism Establishment Online', 'lsx' ); ?></strong>
			    	
			    	<?php 
			    	if(is_singular('landing-page')){ 
			    			$email_address = get_post_meta(get_the_ID(),'email_address',true);
			    			if(false === $email_address){
								$email_address = 'email@address.com';
							}
			    	}else{
							$email_address = get_theme_mod('lsx_header_email_address','email@address.com');
					} ?>
			    	
			    	<span class="email-address"><?php _e( 'Questions? Email Us: ', 'lsx' ); ?><a href="mailto:<?php echo $email_address; ?>"><?php echo $email_address; ?></a></span>
			    </div>
		  	</div>

		  	<?php lsx_header_bottom(); ?>
		</header>
			
		<?php lsx_header_after(); ?>

	<?php }