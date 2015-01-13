<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Layout hooks
 *
 * @package lsx
 */

add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) { 
	function lsx_add_footer_sidebar_area() {
		?>
		<section id="footer-widgets">
			<h2 style="display: none;"><?php _e('Footer Widgets','lsx'); ?></h2>
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
 * Displays the hompage slider is Soliliquy Lite is active and the Customizer settings are set.
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
				<section class="soliloquy-slider">
					<?php soliloquy_slider( $slider ); ?>
				</section>
			<?php
		}
	}
};

add_action( 'lsx_entry_after', 'lsx_author_box' );
function lsx_author_box() {

	if ( ! is_single() ) { return false; }

	global $post;
	$author_id=$post->post_author;
	if ( get_post_type() == 'post' ) {
		$author_meta = get_the_author_meta( $field, $user_id );
		?>
			<div class="author-box well col-xs-12">
				<div class="image col-sm-2">
					<img class="pull-left img-circle" src="<?php echo lsx_get_avatar_url( $author_id, '80' ); ?>" alt="Author Image"/>
				</div>
				<div class="content col-sm-10">
					<h4><?php _e('Published by','lsx'); ?> <?php echo get_the_author_meta( 'display_name', $author_id ); ?></h4>
					<p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
				</div>							
				<div class="col-sm-12">
					<hr>
					<div class="profile-link pull-left">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>">
							<?php _e('View all posts by','lsx'); ?> <?php echo get_the_author_meta( 'display_name', $author_id ); ?>  <i class="fa fa-arrow-right"></i>
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php
	};
}


/**
 * Displays the blog page title
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_blog_page_title() {

		$blog_page = get_queried_object();
		if ('page' == get_option('show_on_front') && get_option('page_for_posts') == $blog_page->ID) { ?>
			<header class="page-header">
					<h1 class="page-title"><?php echo get_the_title($blog_page); ?></h1>		
			</header>
		<?php } 
		
}
add_action('lsx_content_top','lsx_blog_page_title',20);