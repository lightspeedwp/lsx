<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package lsx
 */

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
		<?php wp_body_open(); ?>
		<?php lsx_body_top(); ?>

		<div class="header-wrap">
			<?php lsx_header_before(); ?>
			<header id="masthead" class="<?php lsx_header_classes(); ?>" role="banner">
				<?php lsx_header_top(); ?>
				<div class="container">
					<?php lsx_nav_before(); ?>
					<?php lsx_nav_menu(); ?>
					<?php lsx_nav_after(); ?>
					<?php lsx_header_bottom(); ?>
				</div>
			</header>
			<?php lsx_header_after(); ?>
		</div>

		<?php lsx_header_wrap_after(); ?>

		<div class="wrap container" role="document" tabindex="-1">
			<div class="content role row">

			<?php lsx_header_wrap_container_top(); ?>
