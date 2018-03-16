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

if ( ! function_exists( 'lsx_tec_disable_lsx_banner' ) ) :

	/**
	 * Disable LSX Banners in some pages.
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_tec_disable_lsx_banner( $disabled ) {
		global $current_screen;

		$post_types = apply_filters( 'tribe_is_post_type_screen_post_types', Tribe__Main::get_post_types() );

		if ( is_archive() && tribe_is_event() ) {
			$disabled = true;
		}

		if ( is_single() && tribe_is_event() ) {
			$disabled = true;
		}

		return $disabled;
	}

	// LSX Banners - Banner
	add_filter( 'lsx_banner_disable', 'lsx_tec_disable_lsx_banner' );

endif;
