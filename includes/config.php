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

		remove_theme_support( 'widgets-block-editor' );

		load_theme_textdomain( 'lsx', get_template_directory() . '/languages' );

		add_image_size( 'lsx-thumbnail-carousel', 350, 230, true );
		add_image_size( 'lsx-thumbnail-wide', 360, 168, true );
		add_image_size( 'lsx-thumbnail-square', 350, 350, true );
		add_image_size( 'lsx-thumbnail-single', 750, 350, true );
		add_image_size( 'lsx-banner', 1920, 600, true );

		register_nav_menus(
			array(
				'primary'       => esc_html__( 'Primary Menu', 'lsx' ),
				'top-menu'      => esc_html__( 'Top Menu (right)', 'lsx' ),
				'top-menu-left' => esc_html__( 'Top Menu (left)', 'lsx' ),
				'social'        => esc_html__( 'Social Menu', 'lsx' ),
				'footer'        => esc_html__( 'Footer Menu', 'lsx' ),
			)
		);

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 50,
				'width'       => 160,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support( 'html5', array( 'caption' ) );

		add_theme_support(
			'post-formats',
			array(
				'image',
				'video',
				'gallery',
				'audio',
				'quote',
			)
		);

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'sensei' );

		add_theme_support(
			'site-logo',
			array(
				'header-text' => array(
					'site-title',
					'site-description',
				),
				'size'        => 'medium',
			)
		);

		add_theme_support( 'title-tag' );

		/*
		 * @TODO - Necessary to test it
		 */

		// add_theme_support( 'woocommerce' );.
		add_theme_support( 'starter-content', array(
			'widgets'     => array(
				'sidebar-home'       => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="row"><div class="col-sm-12 text-center"><h3>Build your perfect website <small>with the LSX theme</small></h3></div></div><div class="row"><div class="col-sm-4 text-center"><h4>Fast</h4><p>"Quick" isn\'t a word most people use when describing their website building experience.</p></div><div class="col-sm-4 text-center"><h4>Easy</h4><p>We\'ve built websites for countless clients, and we know what kind of back-end makes sense easily.</p></div><div class="col-sm-4 text-center"><h4>Comprehensive</h4><p>The LSX extensions come with features out the box that are essential.</p></div></div>' ),
						),
					),

					'custom_widget_2' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="lsx-full-width-alt"><div class="row"><div class="col-xs-12"><h3>A big CTA title</h3><p class="text-center"><a class="btn cta-btn" href="http://www.lsdeb.biz/" target="_blank" rel="noreferrer noopener">Hire Us</a><p></div></div></div>' ),
						),
					),

					'custom_widget_3' => array(
						'text',

						array(
							'title' => '',
							'text'  => wp_kses_post( '<div class="row"><div class="col-xs-12"><h3>Homepage Widget</h3><p>Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.</p></div></div>' ),
						),
					),
				),

				'sidebar-footer'     => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => esc_html__( 'Space for Footer Widgets', 'lsx' ),
							'text'  => esc_html__( 'This is here to showcase some footer widgets. You can decide what to add and what to hide. Nam nostrum evertitur ad, ut pri nibh veniam, urbanitas definitionem eum ex.', 'lsx' ),
						),
					),

					'custom_widget_2' => array(
						'text',

						array(
							'title' => esc_html__( 'Space for Footer Widgets', 'lsx' ),
							'text'  => esc_html__( 'This is here to showcase some footer widgets. You can decide what to add and what to hide. Nam nostrum evertitur ad, ut pri nibh veniam, urbanitas definitionem eum ex.', 'lsx' ),
						),
					),

					'custom_widget_3' => array(
						'text',

						array(
							'title' => esc_html__( 'Contact us:', 'lsx' ),
							'text'  => wp_kses_post( '<a href="mailto:info@lsdev.biz><i class="fa fa-envelope fa-fw"></i> info@lsdev.biz</a><br><a href="tel:+27214489843"><i class="fa fa-phone fa-fw"></i> +27 21 448 9843</a><br><i class="fa fa-skype fa-fw"></i> /lightspeeddevelopment' ),
						),
					),
				),

				'sidebar-footer-cta' => array(
					'custom_widget_1' => array(
						'text',

						array(
							'title' => esc_html__( 'A Footer Call to Action', 'lsx' ),
							'text'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'lsx' ),
						),
					),
				),
			),

			'posts'       => array(
				'home'    => array(
					'template'     => 'page-templates/template-front-page.php',
					'thumbnail'    => '{{image-banner-example-01}}',
					'post_title'   => esc_html__( 'LSX is a free WordPress theme', 'lsx' ),
					'post_content' => '',
				),

				'about'   => array(
					'thumbnail' => '{{image-banner-example-02}}',
				),

				'blog',

				'contact' => array(
					'thumbnail' => '{{image-banner-example-03}}',
				),
			),

			'attachments' => array(
				'image-banner-example-01' => array(
					'post_title' => esc_html_x( 'Banner Example 01', 'Theme starter content', 'lsx' ),
					'file'       => 'assets/images/admin/banner-example-01.jpg',
				),

				'image-banner-example-02' => array(
					'post_title' => esc_html_x( 'Banner Example 02', 'Theme starter content', 'lsx' ),
					'file'       => 'assets/images/admin/banner-example-02.jpg',
				),

				'image-banner-example-03' => array(
					'post_title' => esc_html_x( 'Banner Example 03', 'Theme starter content', 'lsx' ),
					'file'       => 'assets/images/admin/banner-example-03.jpg',
				),
			),

			'options'     => array(
				'show_on_front'   => 'page',
				'page_on_front'   => '{{home}}',
				'page_for_posts'  => '{{blog}}',
				'blogdescription' => esc_html__( 'LSX starter content example', 'lsx' ),
			),

			'nav_menus'   => array(
				'primary'  => array(
					'name'  => esc_html__( 'Primary Menu', 'lsx' ),

					'items' => array(
						'page_home',
						'page_about',
						'page_blog',
						'page_contact',
					),
				),

				'top-menu' => array(
					'name'  => esc_html__( 'Top Menu', 'lsx' ),

					'items' => array(
						'custom_link_1' => array(
							'title'   => 'View Map',
							'url'     => 'https://www.google.com/maps/place/LightSpeed+WordPress+Development/@-33.92945,18.45345,17z/data=!3m1!4b1!4m2!3m1!1s0x1dcc5da1b2446d25:0xc8ecdb1cc8afd170',
							'classes' => 'map',
						),

						'custom_link_2' => array(
							'title'   => '+27 21 448 9843',
							'url'     => 'tel:+27214489843',
							'classes' => 'tel',
						),

						'custom_link_3' => array(
							'title'   => 'info@lsdev.biz',
							'url'     => 'mailto:info@lsdev.biz',
							'classes' => 'email',
						),

						'page_contact'  => array(
							'classes' => 'cta',
						),
					),
				),

				'social'   => array(
					'name'  => esc_html__( 'Social Menu', 'lsx' ),

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

				'footer'   => array(
					'name'  => esc_html__( 'Footer Menu', 'lsx' ),

					'items' => array(
						'page_about',
						'page_contact',
					),
				),
			),

			'theme_mods'  => array(
				'lsx_header_fixed'  => true,
				'lsx_header_search' => false,
				'lsx_layout'        => '1c',
			),
		) );
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
		add_post_type_support( 'page', 'excerpt' );

		if ( class_exists( 'WooCommerce' ) ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}

		remove_action( 'comment_form', 'wp_comment_form_unfiltered_html_nonce', 10 );
	}

endif;

add_action( 'init', 'lsx_init', 100 );

if ( ! function_exists( 'lsx_process_content_width' ) ) :

	/**
	 * Overwrite the $content_width var, based on the layout of the page.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_process_content_width() {
		global $content_width;

		if ( is_page_template( 'page-templates/template-front-page.php' ) ) {
			$content_width = 1140;
		}
	}

endif;

add_action( 'wp_head', 'lsx_process_content_width' );

if ( ! function_exists( 'lsx_file_get_contents' ) ) :

	/**
	 * Get file contents.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_file_get_contents( $file ) {
		if ( file_exists( $file ) ) {
			global $wp_filesystem;

			if ( empty( $wp_filesystem ) ) {
				require_once ABSPATH . 'wp-admin/includes/file.php';
				WP_Filesystem();
			}

			if ( $wp_filesystem ) {
				$contents = $wp_filesystem->get_contents( $file );

				if ( ! empty( $contents ) ) {
					return $contents;
				}
			}
		}

		return '';
	}

endif;

/**
 * Enqueues the editor styles.
 *
 * @return void
 */
function editor_styles() {

	// Enqueue  shared editor styles.
	add_editor_style(
		'/assets/css/admin/gutenberg-admin.css'
	);
	add_editor_style(
		'/assets/css/yoast/yoast.css'
	);

}
add_action( 'admin_init', 'editor_styles' );

/**
 * Add theme support functions.
 *
 * @package lsx
 */

if ( ! function_exists( 'theme_support' ) ) :
	/**
	 * Add theme support functions.
	 *
	 * @return void
	 */
	function theme_support() {
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
		// Add support for styling blocks.
		add_theme_support( 'wp-block-styles' );
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		// Add support for Custom Line Heights.
		add_theme_support( 'custom-line-height' );
		// Add support for Custom Units.
		add_theme_support( 'custom-units' );
		// Add support for experimental link colors.
		add_theme_support( 'experimental-link-color' );
		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html_x( 'Small', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'S', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html_x( 'Normal', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'N', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 15,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html_x( 'Medium', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'M', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 22,
					'slug'      => 'medium',
				),
				array(
					'name'      => esc_html_x( 'Large', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'L', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 30,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html_x( 'Huge', 'font size option label', 'lsx' ),
					'shortName' => esc_html_x( 'XL', 'abbreviation of the font size option label', 'lsx' ),
					'size'      => 40,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Strong Blue', 'lsx' ),
				'slug'  => 'strong-blue',
				'color' => '#27639e',
			),
			array(
				'name'  => __( 'Lighter Blue', 'lsx' ),
				'slug'  => 'lighter-blue',
				'color' => '#428bca',
			),
			array(
				'name'  => __( 'Yellow', 'lsx' ),
				'slug'  => 'light-yellow',
				'color' => '#f7ae00',
			),
			array(
				'name'  => __( 'Dark Yellow', 'lsx' ),
				'slug'  => 'dark-yellow',
				'color' => '#ab7800',
			),
			array(
				'name'  => __( 'Green', 'lsx' ),
				'slug'  => 'light-green',
				'color' => '#6BA913',
			),
			array(
				'name'  => __( 'Dark Green', 'lsx' ),
				'slug'  => 'dark-green',
				'color' => '#3F640B',
			),
			array(
				'name'  => __( 'White', 'lsx' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Black', 'lsx' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
		) );

		$primary_color    = 'rgba(39,99,158,1)';
		$secondary_color  = 'rgba(247,174,0,1)';
		$tertiary_color   = 'rgba(107,169,19,1)';
		$background_color = 'rgba(249,249,249,1)';

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => __( 'Primary to Secondary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $secondary_color ) . ' 100%)',
					'slug'     => 'primary-to-secondary',
				),
				array(
					'name'     => __( 'Primary to Tertiary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $tertiary_color ) . ' 100%)',
					'slug'     => 'primary-to-tertiary',
				),
				array(
					'name'     => __( 'Primary to Background', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $primary_color ) . ' 0%, ' . esc_attr( $background_color ) . ' 100%)',
					'slug'     => 'primary-to-background',
				),
				array(
					'name'     => __( 'Secondary to Tertiary', 'lsx' ),
					'gradient' => 'linear-gradient(135deg, ' . esc_attr( $secondary_color ) . ' 0%, ' . esc_attr( $tertiary_color ) . ' 100%)',
					'slug'     => 'secondary-to-tertiary',
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'theme_support' );

/**
 * WPForms submit button, match Gutenberg button block
 *
 * @param [type] $form_data
 * @return void
 */
function lsx_wpforms_match_button_block( $form_data ) {
	$form_data['settings']['submit_class'] .= ' btn';
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'lsx_wpforms_match_button_block' );
