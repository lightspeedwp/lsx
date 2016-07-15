<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Layout hooks
 *
 * @package lsx
 */

function lsx_layout_selector( $class, $area = 'site' ) {

	$layout = get_theme_mod('lsx_layout','2cr');
	$layout = apply_filters( 'lsx_layout', $layout );

	$default_size = 'sm';
	$size = apply_filters( 'lsx_bootstrap_column_size', $default_size );

	switch ( $layout ) {
		case '1c':
			$main_class = 'col-' . $size . '-12';
			$sidebar_class = 'col-' . $size . '-12';
			break;
		case '2cr':
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
		case '2cl':
			$main_class = 'col-' . $size . '-8 col-' . $size . '-push-4';
			$sidebar_class = 'col-' . $size . '-4 col-' . $size . '-pull-8';
			break;
		default:
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
	}

	if ( $class == 'main' ) {
		return $main_class;
	}

	if ( $class == 'sidebar' ) {
		return $sidebar_class;
	}
}

/**
 * .main classes
 */
function lsx_main_class() {
	return lsx_layout_selector( 'main' );
}

function lsx_home_main_class() {
	return lsx_layout_selector( 'main', 'home' );
}

/**
 * Outputs the class for the main div on the index.php page only
 */
function lsx_index_main_class() {

	$show_on_front = get_option('show_on_front');
	if('page' == $show_on_front){
		return lsx_layout_selector( 'main', 'home' );
	}else{
		return lsx_layout_selector( 'main', 'site' );
	}

}

/**
 * .sidebar classes
 */
function lsx_sidebar_class() {
	return lsx_layout_selector( 'sidebar' );
}

function lsx_home_sidebar_class() {
	return lsx_layout_selector( 'sidebar', 'home' );
}

/**
 * Output the classes for the header
 *
 * @package 	lsx
 * @subpackage	layout
 * @category	classes
 */
function lsx_header_classes($additional = false) {
	
	$classes = 'banner navbar navbar-default';
	
	//Fixed header
	$fixed_header = get_theme_mod('lsx_header_fixed',false);
	if(false != $fixed_header){
		$classes .= ' navbar-static-top';
	}
	
	if(false != $additional){
		$classes .= ' '.$additional;
	}
	echo $classes;
}

/**
 * Output the classes for the top-menu
 *
 * @package 	lsx
 * @subpackage	layout
 * @category	classes
 */
function lsx_top_menu_classes($additional = false) {
	
	$classes = 'top-menu-default';
	
	//Fixed header
	$fixed_header = get_theme_mod('lsx_header_fixed',false);
	if(false != $fixed_header){
		$classes .= ' top-menu-fixed';
	}
	
	if(false != $additional){
		$classes .= ' '.$additional;
	}
	echo $classes;
}

add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) { 
	function lsx_add_footer_sidebar_area() {
		if ( is_active_sidebar( 'sidebar-footer-cta' ) ) : ?>
			<section id="footer-cta">
				<div class="container">
					<div class="lsx-full-width">
						<div class="lsx-hero-unit">
							<?php dynamic_sidebar( 'sidebar-footer-cta' ); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-footer-cta' ) ) : ?>
			<section id="footer-widgets">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
					</div>
				</div>
			</section>
		<?php endif;
	}
}

/**
 * Displays the blog page title
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_blog_page_title() {
		
		if ('page' == get_option('show_on_front') && get_option('page_for_posts') == get_the_ID()) { ?>
			<header class="page-header">
					<h1 class="page-title"><?php echo get_the_title($blog_page); ?></h1>		
			</header>
		<?php } 
		
}
add_action('lsx_content_top','lsx_blog_page_title',20);

/**
 * Add Viewport Meta Tag to head
 */
function lsx_add_viewport_meta_tag() {	
	?>
  		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
  		<!-- Noto Sans -->
  		<link href='http<?php if(is_ssl()){ echo 's'; } ?>://fonts.googleapis.com/css?family=Noto+Sans:700' rel='stylesheet' type='text/css'>
  	<?php }
add_action( 'wp_head', 'lsx_add_viewport_meta_tag' );


/**
 * Add a search form to just above the nav menu
 */
function lsx_header_search_form() {
	$search_form = get_theme_mod( 'lsx_header_search', 0 );
	if($search_form || is_customize_preview()){
		get_search_form( true );
	}
}
add_action( 'lsx_nav_before', 'lsx_header_search_form', 0 );