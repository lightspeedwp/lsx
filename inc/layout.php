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
			<div id="footer-cta">
				<div class="container">
					<div class="lsx-full-width">
						<div class="lsx-hero-unit">
							<?php dynamic_sidebar( 'sidebar-footer-cta' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
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
 * Displays the global header
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_global_header() {
	/*if ('page' == get_option('show_on_front') && get_option('page_for_posts') == get_the_ID()) :
		?>
		<header class="archive-header">
			<h1 class="archive-title"><?php echo get_the_title($blog_page); ?></h1>		
		</header>
		<?php
	else*/if (is_singular('post')) :
		$format = get_post_format();
		if ( false === $format ) {
			$format = 'standard';
		}
		$format_link = get_post_format_link($format);
		$format = lsx_translate_format_to_fontawesome($format);
		?>
		<header class="archive-header">
			<h1 class="archive-title">
				<i class="format-link fa fa-<?php echo $format ?>"></i>
				<span><?php the_title(); ?></span>
			</h1>
		</header>
		<?php
	elseif (is_page() || is_single()) :
		?>
		<header class="archive-header">
			<h1 class="archive-title"><?php the_title() ?></h1>		
		</header>
		<?php
	elseif (is_search()) :
		?>
		<header class="archive-header">
			<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'lsx' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>
		<?php
	elseif (is_author()) :
		?>
		<header class="archive-header">
			<h1 class="archive-title">
				<?php printf( __( 'Author: %s', 'lsx' ), get_the_author() ); ?>
			</h1>

			<?php if (get_the_author_meta('description')) { ?>
			    <p class="author-desc"><?php echo get_the_author_meta('description') ?></p>
			<?php } ?>
		</header>
		<?php
	elseif (is_archive()) :
		?>
		<header class="archive-header">
			<h1 class="archive-title">
				<?php if ( has_post_format() && !is_category() && !is_tag() && !is_date() && !is_tax('post_format') ) { ?>
					Type: <?php the_archive_title(); ?>
				<?php } else { ?>
					<?php the_archive_title(); ?>
				<?php } ?>
			</h1>

			<?php echo term_description(); ?>
		</header>
		<?php
	endif;
}
add_action('lsx_content_wrap_before', 'lsx_global_header');

/**
 * Displays the global header in default Blog landing
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_blog_header() {
	$classes = get_body_class();

	if (in_array('blog', $classes)) { ?>
		<header class="archive-header">
			<h1 class="archive-title"><?php _e('Blog', 'lsx'); ?></h1>
		</header>
	<?php }
}
add_action('lsx_content_wrap_before', 'lsx_blog_header');

/**
 * Add Viewport Meta Tag to head
 */
function lsx_add_viewport_meta_tag() {	
	?>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
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