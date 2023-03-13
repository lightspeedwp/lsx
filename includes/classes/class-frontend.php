<?php
namespace LSX\Classes;

/**
 * All the functions for setting up the theme.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Frontend {

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Initiate our class.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_filter( 'wpforms_frontend_form_data', array( $this, 'wpforms_match_button_block' ) );
		add_action( 'pre_get_posts', array( $this, 'search_args' ), 10, 1 );
	}

	/**
	 * Enqueues the frontend styles
	 *
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'lsx-styles', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}
	
	/**
	 * WPForms submit button, match Gutenberg button block
	 *
	 * @param [type] $form_data
	 * @return void
	 */
	function wpforms_match_button_block( $form_data ) {
		$form_data['settings']['submit_class'] .= ' btn';
		return $form_data;
	}

	/**
	 * Make sure our search only searches posts.
	 *
	 * @param object $query
	 * @return object
	 */
	public function search_args( $query ) {
		if ( is_search() ) {
			$query->set( 'post_type', 'post' );
		}
		return $query;
	}
}
