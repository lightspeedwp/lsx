<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Layout hooks
 *
 * @package lsx
 */

function lsx_layout_selector( $class, $area = 'site' ) {

	$layout = get_theme_mod('lsx_layout','2cr');

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

add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) { 
	function lsx_add_footer_sidebar_area() {
		if ( is_active_sidebar( 'sidebar-footer-cta' ) ) : ?>
			<section id="footer-cta">
				<div class="container">
					<div class="lsx-full-width-alt">
						<div class="lsx-hero-unit">
							<?php dynamic_sidebar( 'sidebar-footer-cta' ); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section id="footer-widgets">
			<h2 class="footer-widgets-title"><?php _e('Footer Widgets','lsx'); ?></h2>
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}

/**
 * Displays the hompage slider if Soliliquy Lite is active and the Customizer settings are set.
 *
 * @package lsx-theme
 * @subpackage layout
 * @category slider
 */
if ( ! function_exists( 'lsx_homepage_slider' ) && function_exists('soliloquy')  ) { 
	add_action( 'lsx_header_after', 'lsx_homepage_slider' );
	function lsx_homepage_slider() {
		$slider = get_theme_mod( 'lsx_homepage_slider', 0 );
		$show_on_front = get_option('show_on_front');
		if('0' != $slider && (('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()))) {
			 ?>
				<section class="soliloquy-slider lsx-homepage-slider slider-<?php echo $slider;?>">
					<?php soliloquy_slider( $slider ); ?>

					<?php classybeds_enquire_bar(); ?>
				</section>
			<?php
		}
	}
};

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