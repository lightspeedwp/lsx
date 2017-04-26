<?php
/**
 * LSX functions and definitions - Config.
 *
 * @package    lsx
 * @subpackage config
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_setup' ) ) :

	/**
	 * Theme after_setup_theme action.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_setup() {
		global $content_width;
		$content_width = 1140;

		load_theme_textdomain( 'lsx', get_template_directory() . '/languages' );

		add_theme_support( 'site-logo', array(
			'header-text' => array(
				'site-title',
				'site-description',
			),
			'size' => 'medium',
		) );

		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 150,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		add_theme_support( 'custom-background' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
			'link',
			'quote',
			'aside',
		) );

		register_nav_menus( array(
			'primary'       => esc_html__( 'Primary Menu', 'lsx' ),
			'top-menu'      => esc_html__( 'Top Menu (right)' , 'lsx' ),
			'top-menu-left' => esc_html__( 'Top Menu (left)' , 'lsx' ),
			'social'        => esc_html__( 'Social Menu' , 'lsx' ),
			'footer'        => esc_html__( 'Footer Menu' , 'lsx' ),
		) );

		/* @TODO - Check if is still necessary */
		//add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

		add_theme_support( 'html5', array( 'caption' ) );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'sensei' );

		add_theme_support( 'starter-content', array(
			'widgets' => array(
				'sidebar-home' => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="lsx-full-width"><div class="row"><div class="col-sm-6"><h3>Full Width Widget</h3><p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Donec odio. Quisque volutpat mattis eros.</p><p><a href="#" class="btn cta-btn">Lorem ipsum</a></p></div><div class="col-sm-6"><h3>Full Width Widget</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p></div></div></div>' ),
						),
					),

					'custom_widget_2' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="row"><div class="col-sm-6"><h3 style="margin-top:0">Text Widget</h3><p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Donec odio. Quisque volutpat mattis eros.</p></div><div class="col-sm-6"><h3 style="margin-top:0">Text Widget</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque <a href="#">volutpat mattis eros</a>.</p></div></div>' ),
						),
					),

					'custom_widget_3' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="lsx-full-width-alt"><div class="row"><div class="col-sm-6"><h3>Full Width CTA Widget</h3><p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Donec odio. Quisque volutpat mattis eros.</p><p><a href="#" class="btn cta-btn">Lorem ipsum</a></p></div><div class="col-sm-6"><h3>Full Width CTA Widget</h3><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.</p><p><a href="#" class="btn">Lorem ipsum</a></p></div></div></div>' ),
						),
					),

					'custom_widget_4' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="row"><div class="col-sm-12"><h3 style="margin-top:0">Text Widget</h3><p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p></div></div>' ),
						),
					),
				),

				'sidebar-footer' => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => esc_html__( 'Footer Widget', 'lsx' ),
							'text'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae ipsum nec sapien consectetur convallis eu sit amet diam. Praesent dignissim vel arcu et gravida.', 'lsx' ),
						),
					),

					'custom_widget_2' => array(
						'text',

						array(
							'title' => esc_html__( 'Footer Widget', 'lsx' ),
							'text'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae ipsum nec sapien consectetur convallis eu sit amet diam. Praesent dignissim vel arcu et gravida.', 'lsx' ),
						),
					),

					'custom_widget_3' => array(
						'text',

						array(
							'title' => esc_html__( 'Footer Widget', 'lsx' ),
							'text'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae ipsum nec sapien consectetur convallis eu sit amet diam. Praesent dignissim vel arcu et gravida.', 'lsx' ),
						),
					),
				),

				'sidebar-footer-cta' => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => esc_html__( 'Footer Call to Action Widget', 'lsx' ),
							'text'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'lsx' ),
						),
					),
				),

				'sidebar-1' => array(
					'search',
				),
			),

			'posts' => array(
				'home' => array(
					'template' => 'page-templates/template-front-page.php',
					'thumbnail' => '{{image-banner-placeholder-01}}',
				),

				'about' => array(
					'thumbnail' => '{{image-banner-placeholder-02}}',
				),

				'blog',

				'contact' => array(
					'thumbnail' => '{{image-banner-placeholder-03}}',
				),
			),

			'attachments' => array(
				'image-banner-placeholder-01' => array(
					'post_title' => esc_html_x( 'Banner Placeholder 01', 'Theme starter content', 'lsx' ),
					'file' => 'img/banner-placeholder-01.jpg',
				),

				'image-banner-placeholder-02' => array(
					'post_title' => esc_html_x( 'Banner Placeholder 02', 'Theme starter content', 'lsx' ),
					'file' => 'img/banner-placeholder-02.jpg',
				),

				'image-banner-placeholder-03' => array(
					'post_title' => esc_html_x( 'Banner Placeholder 03', 'Theme starter content', 'lsx' ),
					'file' => 'img/banner-placeholder-03.jpg',
				),
			),

			'options' => array(
				'show_on_front' => 'page',
				'page_on_front' => '{{home}}',
				'page_for_posts' => '{{blog}}',
			),

			'nav_menus' => array(
				'primary' => array(
					'name' => esc_html__( 'Primary Menu', 'lsx' ),

					'items' => array(
						'page_home',
						'page_about',
						'page_blog',
						'page_contact',
					),
				),

				'top-menu' => array(
					'name' => esc_html__( 'Top Menu', 'lsx' ),

					'items' => array(
						'custom_link_1' => array(
							'title' => 'View Map',
							'url' => 'https://www.google.com/maps/place/LightSpeed+WordPress+Development/@-33.92945,18.45345,17z/data=!3m1!4b1!4m2!3m1!1s0x1dcc5da1b2446d25:0xc8ecdb1cc8afd170',
							'classes' => 'map',
						),

						'custom_link_2' => array(
							'title' => '+27 21 448 9843',
							'url' => 'tel:+27214489843',
							'classes' => 'tel',
						),

						'custom_link_3' => array(
							'title' => 'info@lsdev.biz',
							'url' => 'mailto:info@lsdev.biz',
							'classes' => 'email',
						),

						'page_contact' => array(
							'classes' => 'cta',
						),
					),
				),

				'social' => array(
					'name' => esc_html__( 'Social Menu', 'lsx' ),

					'items' => array(
						'link_facebook',
						'link_foursquare',
						'link_github',
						'link_instagram',
						'link_linkedin',
						'link_pinterest',
						'link_twitter',
						'link_youtube',
					),
				),

				'footer' => array(
					'name' => esc_html__( 'Footer Menu', 'lsx' ),

					'items' => array(
						'page_about',
						'page_contact',
					),
				),
			),

			'theme_mods' => array(
				'lsx_header_fixed' => '1',
				'lsx_header_search' => '1',
				'lsx_layout' => '1c',
			),
		) );

		add_image_size( 'lsx-thumbnail-wide',   350, 230, true );
		add_image_size( 'lsx-thumbnail-single', 750, 350, true );
	}

endif;

add_action( 'after_setup_theme', 'lsx_setup' );

if ( ! function_exists( 'lsx_init' ) ) :

	/**
	 * Theme init action.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_init() {
		if ( class_exists( 'WooCommerce' ) ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		}
	}

endif;

add_action( 'init', 'lsx_init', 100 );

if ( ! function_exists( 'lsx_wp_head' ) ) :

	/**
	 * Theme wp_head action.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_wp_head() {
		$layout = get_theme_mod( 'lsx_layout', '2cr' );
		$layout = apply_filters( 'lsx_layout', $layout );

		if ( '1c' === $layout && ( is_author() || is_search() || ( is_post_type_archive( array( 'post', 'page', 'jetpack-portfolio' ) ) && ! is_post_type_archive( 'tribe_events' ) ) || is_tag() || is_category() || is_date() || is_tax( 'post_format' ) ) ) {
			remove_action( 'lsx_content_top', 'lsx_breadcrumbs', 100 );
		}
	}

endif;

add_action( 'wp_head', 'lsx_wp_head', 100 );

if ( ! function_exists( 'lsx_process_content_width' ) ) :

	/**
	 * Overwrite the $content_width var, based on the layout of the page.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_process_content_width() {
		global $content_width;

		if (
			is_page_template( 'page-templates/template-portfolio.php' ) ||
			is_page_template( 'page-templates/template-front-page.php' ) ||
			is_page_template( 'page-templates/template-full-width.php' ) ||
			is_post_type_archive( 'jetpack-portfolio' ) ||
			is_tax( array( 'jetpack-portfolio-type', 'jetpack-portfolio-tag' ) ) ||
			is_singular( 'jetpack-portfolio' )
		) {
			$content_width = 1140;
		}
	}

endif;

add_action( 'wp_head', 'lsx_process_content_width' );
