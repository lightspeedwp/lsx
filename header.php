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
<?php if ( lsx_get_option('static_layout') != 1 ) : ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php endif; ?>
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) { ?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if( lsx_get_option('favicon') ){ 
	$favicon = lsx_get_option('favicon'); ?>
	<link rel="shortcut icon" href="<?php echo esc_url( $favicon ); ?>"/>
<?php } ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet"> <!-- @TODO take this out -->
<?php wp_head(); ?>
<?php lsx_head_bottom(); ?>
</head>
<body <?php body_class( 'lsx' ); ?>>
<?php lsx_body_top(); ?>
<?php lsx_header_before(); ?>
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
				          <?php if ( function_exists( 'jetpack_the_site_logo' ) ) {
				          		jetpack_the_site_logo();
				          	} else {
				          		echo get_bloginfo('name');
				          	} ?>
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
<?php lsx_header_after(); ?>
    <div class="wrap container" role="document">
	<div class="content role row">
	<?php if (get_bloginfo('description')) {echo get_bloginfo('name');}?>