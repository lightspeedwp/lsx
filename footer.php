<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package lsx
 */
?>
<?php if ( !is_singular('landing-page') && !is_page_template('page-templates/template-metaplate.php') && !is_page_template('page-templates/template-metaplate-alt.php') ) { ?>

			</div><!-- .content -->
		</div><!-- wrap -->

		<?php lsx_footer_before(); ?>

		<footer class="content-info" role="contentinfo">
			<div class="container">
				<div class="row">
				    	<div class="col-sm-12">
		  					    <div class="footer-menu">
									<?php 
									
										if(!is_user_logged_in()){
											if(has_nav_menu('footer-menu')){
												wp_nav_menu(array('theme_location' => 'footer-menu'));
											}
										}else{
											if(has_nav_menu('footer_logged_in')){
												wp_nav_menu(array('theme_location' => 'footer_logged_in'));
											}
										}				
									?>
									<div class="clearfix"></div>
								</div>		    	
				    	</div>
				 </div>

			  	<div class="row">
			    	<div class="col-sm-12">

			    		<?php lsx_footer_top(); ?>

			      		<p class="credit <?php if ( has_nav_menu( 'social' ) ) { ?>credit-float<?php } ?>"><?php printf( __( '&#169; %1$s %2$s All Rights Reserved.', 'lsx' ), date_i18n( 'Y' ), get_bloginfo( 'name' ) ); ?></p>
						<?php if ( has_nav_menu( 'social' ) ) { ?>
							<nav id="social-navigation" class="social-navigation" role="navigation">
								<?php
									// Social links navigation menu.
									wp_nav_menu( array(
										'theme_location' => 'social',
										'depth'          => 1,
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php } ?>

			      		<?php lsx_footer_bottom(); ?>

			    	</div>
			  	</div>
			</div>
		</footer>

		<?php lsx_footer_after(); ?>

		<?php wp_footer(); ?> 

	<?php } else if ( is_page_template('page-templates/template-metaplate-alt.php') ) { ?>

		<?php wp_footer(); ?>

	<?php } else { ?>
	
		<?php lsx_footer_before(); ?>

		<footer class="content-info" role="contentinfo">
			<div class="container">
			  	<div class="row">
			    	<div class="col-sm-12">

			    		<?php lsx_footer_top(); ?>

			      		<p class="credit <?php if ( has_nav_menu( 'social' ) ) { ?>credit-float<?php } ?>"><?php printf( __( '&#169; %1$s %2$s All Rights Reserved.', 'lsx' ), date_i18n( 'Y' ), get_bloginfo( 'name' ) ); ?></p>
						<?php if ( has_nav_menu( 'social' ) ) { ?>
							<nav id="social-navigation" class="social-navigation" role="navigation">
								<?php
									// Social links navigation menu.
									wp_nav_menu( array(
										'theme_location' => 'social',
										'depth'          => 1,
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php } ?>

			      		<?php lsx_footer_bottom(); ?>

			    	</div>
			  	</div>
			</div>
		</footer>

		<?php lsx_footer_after(); ?>

		<?php wp_footer(); ?>

	<?php } ?>

<?php lsx_body_bottom(); ?>
</body>
</html>