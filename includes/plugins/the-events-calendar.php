<?php
/**
 * LSX functions and definitions - Integrations - The Events Calendar.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   the-events-calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_the_events_calendar_styles' ) ) :

	/**
	 * Adds The Events Calendar custom stylesheet.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   the-events-calendar
	 */
	function lsx_the_events_calendar_styles() {
		wp_enqueue_style( 'lsx_the_events_calendar', get_template_directory_uri() . '/assets/css/plugins/the-events-calendar.css', array( 'lsx_main' ), LSX_VERSION );
	}

endif;

add_action( 'wp_enqueue_scripts', 'lsx_the_events_calendar_styles' );

if ( ! function_exists( 'lsx_the_events_calendar_breadcrumbs' ) ) :
	/**
	 * Change breadcrumb for The Events Calendar.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   the-events-calendar
	 */
	function lsx_the_events_calendar_breadcrumbs( $output ) {
		global $wp_query;

		if ( ( isset( $wp_query->tribe_is_event ) && true === $wp_query->tribe_is_event ) || ( isset( $wp_query->query_vars['post_type'] ) && ! is_array( $wp_query->query_vars['post_type'] ) && 'tribe_venue' === $wp_query->query_vars['post_type'] ) ) {
			if ( function_exists( 'woocommerce_breadcrumb' ) ) {
				$closing_div = '</nav>';

				if ( is_single() ) {
					$output = str_replace( 'Page', '<a href="' . get_post_type_archive_link( 'tribe_events' ) . '">' . esc_html__( 'Events', 'lsx' ) . '</a>', $output );

					if ( isset( $wp_query->query_vars['eventDisplay'] ) && 'all' === $wp_query->query_vars['eventDisplay'] ) {
						$output = str_replace( $closing_div, get_the_title( $wp_query->query_vars['post_parent'] ) . $closing_div, $output );
					} else {
						$single_event = get_queried_object();
						$output       = str_replace( $closing_div, apply_filters( 'the_title', $single_event->post_title ) . $closing_div, $output );
					}
				} elseif ( is_tax() ) {
					$tax_event = get_queried_object();
					$output    = str_replace( 'Page', '<a href="' . get_post_type_archive_link( 'tribe_events' ) . '">' . esc_html__( 'Events', 'lsx' ) . '</a>', $output );
					$output    = str_replace( $closing_div, '&nbsp;/&nbsp;' . apply_filters( 'the_title', $tax_event->name ) . $closing_div, $output );
				} else {
					$output = str_replace( 'Page', esc_html__( 'Events', 'lsx' ), $output );
				}
			 } elseif ( function_exists( 'yoast_breadcrumb' ) ) {
				$closing_div     = '</div>';
				$last_breadcrumb = '<span class="breadcrumb_last">' . esc_html__( 'Events', 'lsx' ) . '</span>';

				if ( is_single() ) {
					$single_event = get_queried_object();
					$output       = str_replace( $closing_div, '<a href="' . get_post_type_archive_link( 'tribe_events' ) . '">' . esc_html__( 'Events', 'lsx' ) . '</a>&nbsp;/&nbsp;' . apply_filters( 'the_title', $single_event->post_title ), $output );
				} elseif ( is_tax() ) {
					$tax_event = get_queried_object();
					$output    = str_replace( $last_breadcrumb, '<a href="' . get_post_type_archive_link( 'tribe_events' ) . '">' . esc_html__( 'Events', 'lsx' ) . '</a>&nbsp;/&nbsp;' . apply_filters( 'the_title', $tax_event->name ), $output );
				} else {
					$output = str_replace( 'Page', esc_html__( 'Events', 'lsx' ), $output );
				}
			 }
		}

		return $output;
	}

endif;

add_filter( 'lsx_breadcrumbs', 'lsx_the_events_calendar_breadcrumbs', 1, 10 );
