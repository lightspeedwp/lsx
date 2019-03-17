<?php
/**
 * LSX functions and definitions - The Events Calendar.
 *
 * @package    lsx
 * @subpackage the-events-calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_tec_scripts_add_styles' ) ) :

	/**
	 * The Events Calendar enqueue styles.
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_scripts_add_styles() {
		wp_enqueue_style( 'the-events-calendar-lsx', get_template_directory_uri() . '/assets/css/the-events-calendar.css', array( 'lsx_main' ), LSX_VERSION );
		wp_style_add_data( 'the-events-calendar-lsx', 'rtl', 'replace' );
	}

	add_action( 'wp_enqueue_scripts', 'lsx_tec_scripts_add_styles' );

endif;

if ( ! function_exists( 'lsx_tec_theme_wrapper_start' ) ) :

	/**
	 * The Events Calendar wrapper start.
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_theme_wrapper_start() {
		lsx_content_wrap_before();
		echo '<div id="primary" class="content-area ' . esc_attr( lsx_main_class() ) . '">';
		lsx_content_before();
		echo '<main id="main" class="site-main" role="main">';
		lsx_content_top();
	}

	add_action( 'tribe_events_before_html', 'lsx_tec_theme_wrapper_start', 9 );

endif;

if ( ! function_exists( 'lsx_tec_theme_wrapper_end' ) ) :

	/**
	 * The Events Calendar wrapper end.
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_theme_wrapper_end() {
		lsx_content_bottom();
		echo '</main>';
		lsx_content_after();
		echo '</div>';
		lsx_content_wrap_after();
	}

	add_action( 'tribe_events_after_html', 'lsx_tec_theme_wrapper_end', 11 );

endif;

if ( ! function_exists( 'lsx_tec_global_header_title' ) ) :

	/**
	 * Move the events title into the global header
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_global_header_title( $title ) {
		$title = tribe_get_events_title();
		//Only disable the title after we have retrieved it
		add_filter( 'tribe_get_events_title', 'lsx_text_disable_body_title', 200, 1 );
		return $title;
	}
	add_filter( 'lsx_global_header_title', 'lsx_tec_global_header_title', 200, 1 );

endif;

if ( ! function_exists( 'lsx_text_disable_body_title' ) ) :
	/**
	 * Disable the events title for the post archive if the dynamic setting is active.
	 * @param $title
	 *
	 * @return string
	 */
	function lsx_text_disable_body_title ( $title ) {
		if ( ! class_exists( 'LSX_Banners' ) ) {
			$title = '';
		}
		return $title;
	}

endif;

if ( ! function_exists( 'lsx_tec_breadcrumb_filter' ) ) :
	/**
	 * Fixes the community events breadcrumb
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_breadcrumb_filter( $crumbs ) {
		if ( tribe_is_community_edit_event_page() || tribe_is_community_my_events_page() ) {

			foreach ( $crumbs as $crumb_index => $crumb ){
				if ( isset( $crumb['ptarchive'] ) ) {
					$crumbs[ $crumb_index ]['ptarchive'] = 'tribe_events';
				}
			}
		}
		return $crumbs;
	}
	add_filter( 'wpseo_breadcrumb_links', 'lsx_tec_breadcrumb_filter', 10, 1 );
endif;
