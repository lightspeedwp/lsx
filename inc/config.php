<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Theme Configuration File
 * See: http://jetpack.me/
 *
 * @package lsx
 */

if ( ! function_exists( 'lsx_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lsx_setup() {
	global $content_width;
	
	load_theme_textdomain( 'lsx', get_template_directory() . '/languages' );
	
	$args = array(
			'header-text' => array(
					'site-title',
					'site-description',
			),
			'size' => 'medium',
	);
	add_theme_support( 'site-logo', $args );
	add_theme_support( 'custom-background', array(
	'default-color' => 'FFF',
	) );	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array('image', 'video', 'gallery', 'audio', 'link', 'quote', 'aside') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'lsx' ),
		'top-menu'=> __( 'Top Menu' , 'lsx' ),
		'social'=> __( 'Social Menu' , 'lsx' ),
		'footer'=> __( 'Footer Menu' , 'lsx' )
	) );	

	//Set the content width
	$content_width = 750;
	
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );	
	add_theme_support( 'html5', array( 'caption' ) );

	add_theme_support( 'woocommerce' );	
	add_theme_support( 'sensei' );
}
endif; // lsx_setup
add_action( 'after_setup_theme', 'lsx_setup' );


add_action( 'tgmpa_register', 'lsx_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 */
function lsx_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Advanced Mobile Pages',
			'slug'      => 'amp',
			'required'  => false,
		),		
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => false,
		),
		array(
			'name'      => 'Jetpack',
			'slug'      => 'jetpack',
			'required'  => false,
		),	
		array(
			'name'      => 'Sensei',
			'slug'      => 'sensei',
			'required'  => false,
		),		
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => false,
		),
		array(
			'name'      => 'WP Pagenavi',
			'slug'      => 'wp-pagenavi',
			'required'  => false,
		),
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),					
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'lsx',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}


/**
 * Overwrite the $content_width var, based on the layout of the page.
 * 
 * @package	lsx
 * @subpackage config
 * @category content_width
 */
function lsx_process_content_width() {
	global $content_width;

	if(
		is_page_template('page-templates/template-portfolio.php') ||
		is_page_template('page-templates/template-front-page.php') ||
		is_page_template('page-templates/template-full-width.php') ||
		is_post_type_archive('jetpack-portfolio') ||
		is_tax(array('jetpack-portfolio-type','jetpack-portfolio-tag')) ||
		is_singular('jetpack-portfolio')
	){
		$content_width = 1140;
	}
}
add_action('wp_head','lsx_process_content_width');


/**
 * Disable the comments form by default for the page post type.
 * @package	lsx
 * @subpackage config
 */
function lsx_page_comments_off( $data ) {

	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' && $data['post_title'] == __('Auto Draft','lsx') ) {
		$data['comment_status'] = 0;
		$data['ping_status'] = 0;
	}

	return $data;
}
add_filter( 'wp_insert_post_data', 'lsx_page_comments_off' );

/**
 * Disable the comments form by default for the page post type.
 * @package	lsx
 * @subpackage config
 */
function lsx_is_legacy($data) {

	if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' && $data['post_title'] == __('Auto Draft','lsx') ) {
		$data['comment_status'] = 0;
		$data['ping_status'] = 0;
	}

	return $data;
}
add_filter( 'wp_insert_post_data', 'lsx_page_comments_off' );

/**
 * Run the init command
 * @package	lsx
 * @subpackage config
 */
function lsx_init() {
	if(class_exists('WooCommerce')){
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
	}
}
add_action( 'init', 'lsx_init',100 );

/**
 * Run on the wp_head 
 * @package	lsx
 * @subpackage config
 */
function lsx_wp_head() {

	$layout = get_theme_mod('lsx_layout','2cr');
	$layout = apply_filters( 'lsx_layout', $layout );

	if('1c' === $layout && (is_author() || is_search() || (is_post_type_archive(array('post','page','jetpack-portfolio')) && !is_post_type_archive('tribe_events')) || is_tag() || is_category()) ){
		remove_action('lsx_content_top', 'lsx_breadcrumbs', 100 );
	}

	return $data;
}
add_action( 'wp_head', 'lsx_wp_head',100 );