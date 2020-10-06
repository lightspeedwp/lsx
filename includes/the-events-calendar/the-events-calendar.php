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

		// Get plugin version.
		$plugin  = 'the-events-calendar/the-events-calendar.php';
		$data    = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
		$version = $data['Version'];

		if ( substr( $version, 0, 1 ) >= '5' ) {
			// New Version 5.0 and up.
			wp_enqueue_style( 'the-events-calendar-lsx', get_template_directory_uri() . '/assets/css/the-events-calendar/the-events-calendar-5.css', array( 'lsx_main' ), LSX_VERSION );
		} else {
			// Old Version.
			wp_enqueue_style( 'the-events-calendar-lsx', get_template_directory_uri() . '/assets/css/the-events-calendar/the-events-calendar.css', array( 'lsx_main' ), LSX_VERSION );
		}

		wp_enqueue_style( 'the-events-calendar-lsx', get_template_directory_uri() . '/assets/css/the-events-calendar/the-events-calendar.css', array( 'lsx_main' ), LSX_VERSION );
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
		if ( function_exists( 'lsx_is_rest_api_request' ) && lsx_is_rest_api_request() ) {
			return;
		}
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
		if ( function_exists( 'lsx_is_rest_api_request' ) && lsx_is_rest_api_request() ) {
			return;
		}
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

		if ( tribe_is_community_edit_event_page() ) {

			$is_route = get_query_var( 'WP_Route' );
			switch ( $is_route ) {
				case 'ce-edit-route':
					$title = apply_filters( 'tribe_ce_edit_event_page_title', __( 'Edit an Event', 'lsx' ) );
					break;

				case 'ce-edit-organizer-route':
					$title = __( 'Edit an Organizer', 'lsx' );
					break;

				case 'ce-edit-venue-route':
					$title = __( 'Edit a Venue', 'lsx' );
					break;

				default:
					$title = apply_filters( 'tribe_ce_submit_event_page_title', __( 'Submit an Event', 'lsx' ) );
					break;
			}
		} elseif ( tribe_is_community_my_events_page() ) {
			$title = apply_filters( 'tribe_ce_submit_event_page_title', __( 'My Events', 'lsx' ) );
		} elseif ( tribe_is_event() && ( ! is_tag() ) ) {
			$title = tribe_get_events_title();
		}

		// Only disable the title after we have retrieved it.
		add_filter( 'tribe_get_events_title', 'lsx_text_disable_body_title', 200, 1 );

		if ( is_singular( 'tribe_events' ) ) {
			add_filter( 'the_title', 'lsx_text_disable_body_title', 200, 1 );
		}

		if ( class_exists( 'LSX_Banners' ) ) {
			if ( is_archive() && is_post_type_archive( 'tribe_events' ) ) {
				$options = get_option( '_lsx_settings', false );
				if ( is_array( $options ) && isset( $options['tribe_events'] ) && isset( $options['tribe_events']['title'] ) && '' !== $options['tribe_events']['title'] ) {
					$title = $options['tribe_events']['title'];
				}
			}
			$title = '<h1 class="page-title">' . $title . '</h1>';
		}
		return $title;
	}
	add_filter( 'lsx_banner_title', 'lsx_tec_global_header_title', 200, 1 );
	add_filter( 'lsx_global_header_title', 'lsx_tec_global_header_title', 200, 1 );

endif;

if ( ! function_exists( 'lsx_text_disable_body_title' ) ) :
	/**
	 * Disable the events title for the post archive if the dynamic setting is active.
	 *
	 * @param $title
	 * @return string
	 */
	function lsx_text_disable_body_title( $title ) {
		$title = '';
		remove_filter( 'the_title', 'lsx_text_disable_body_title', 200, 1 );
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

		if ( tribe_is_venue() || tribe_is_organizer() || tribe_is_community_edit_event_page() || tribe_is_community_my_events_page() ) {
			$new_crumbs    = array();
			$new_crumbs[0] = $crumbs[0];

			if ( function_exists( 'woocommerce_breadcrumb' ) ) {
				$new_crumbs[1] = array(
					0 => __( 'Events', 'lsx' ),
					1 => get_post_type_archive_link( 'tribe_events' ),
				);
			} else {
				$new_crumbs[1] = array(
					'text' => __( 'Events', 'lsx' ),
					'url'  => get_post_type_archive_link( 'tribe_events' ),
				);
			}

			if ( tribe_is_community_my_events_page() ) {
				$new_crumbs[2] = $crumbs[2];
			} elseif ( tribe_is_community_edit_event_page() ) {

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {
					$new_crumbs[2] = array(
						0 => apply_filters( 'tribe_ce_submit_event_page_title', __( 'My Events', 'lsx' ) ),
						1 => tribe_community_events_list_events_link(),
					);
				} else {
					$new_crumbs[2] = array(
						'text' => apply_filters( 'tribe_ce_submit_event_page_title', __( 'My Events', 'lsx' ) ),
						'url'  => tribe_community_events_list_events_link(),
					);
				}

				$new_crumbs[3] = $crumbs[2];
			} else {
				$new_crumbs[2] = $crumbs[1];
			}
			$crumbs = $new_crumbs;
		}
		return $crumbs;
	}
	add_filter( 'wpseo_breadcrumb_links', 'lsx_tec_breadcrumb_filter', 30, 1 );
	add_filter( 'woocommerce_get_breadcrumb', 'lsx_tec_breadcrumb_filter', 30, 1 );

endif;
