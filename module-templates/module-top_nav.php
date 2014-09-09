 
 	<header class="banner navbar navbar-default navbar-static-top" role="banner">
      		<?php lsx_header_top(); ?>
		  	<div class="container">
		    	<div class="navbar-header">
		      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			        	<span class="sr-only">Toggle navigation</span>
			        	<span class="icon-bar"></span>
			        	<span class="icon-bar"></span>
			        	<span class="icon-bar"></span>
		      		</button>
				     <a class="navbar-brand" href="<?php echo home_url(); ?>/">
				     <?php 
				     	if (lsx_get_option('site_logo')) {
				     		?>
				     		<img src="<?php echo lsx_get_option('site_logo'); ?>" alt="<?php echo get_bloginfo('name');?>">
				     		<?php
				     	} else {
				     		echo get_bloginfo('name');
				     	}
				     ?>
				     </a>
			    </div>
			<?php lsx_nav_before(); ?>

		    <nav class="collapse navbar-collapse" role="navigation">
			    <?php
		        if (has_nav_menu('primary')) :
		          wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav navbar-nav'));
		        endif;
			    ?>
		    </nav>
		  </div>
		  	<?php lsx_header_bottom(); ?>
		</header>
