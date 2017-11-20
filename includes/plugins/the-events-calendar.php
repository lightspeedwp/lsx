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

/**
 * Adds theme stylesheet
 * @package 	lsx
 * @subpackage 	tribe-events
 * @category 	styles
 */
// function lsx_tribe_breadcrumbs($output) {
// 	global $wp_query;
// 	if( (isset($wp_query->tribe_is_event) && true === $wp_query->tribe_is_event) || (isset($wp_query->query_vars['post_type']) && !is_array($wp_query->query_vars['post_type']) && 'tribe_venue' === $wp_query->query_vars['post_type'])){
// 		if(function_exists('woocommerce_breadcrumb')){
// 		 	$closing_div = '</nav>';

// 		 	if( is_single()) {
// 		 		$output = str_replace('Page','<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.esc_html__('Events','lsx').'</a>',$output);
// 		 		if(isset($wp_query->query_vars['eventDisplay']) && 'all' === $wp_query->query_vars['eventDisplay']){
// 		 			$output = str_replace($closing_div,get_the_title($wp_query->query_vars['post_parent']).$closing_div,$output);
// 		 		}else{
// 		 			$single_event = get_queried_object();
// 		 			$output = str_replace($closing_div,apply_filters('the_title',$single_event->post_title).$closing_div,$output);
// 		 		}
// 		 	}elseif( is_tax()) {
// 		 		$tax_event = get_queried_object();
// 		 		$output = str_replace('Page','<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.esc_html__('Events','lsx').'</a>',$output);
// 		 		$output = str_replace($closing_div,'&nbsp;/&nbsp;'.apply_filters('the_title',$tax_event->name).$closing_div,$output);
// 		 	}else{
// 		 		$output = str_replace('Page',esc_html__('Events','lsx'),$output);
// 		 	}
// 		 }elseif(function_exists('yoast_breadcrumb')){
// 		 	$closing_div = '</div>';
// 		 	$last_breadcrumb = '<span class="breadcrumb_last">'.esc_html__('Events','lsx').'</span>';

// 		 	if( is_single()) {
// 		 		$single_event = get_queried_object();
// 		 		$output = str_replace($closing_div,'<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.esc_html__('Events','lsx').'</a>&nbsp;/&nbsp;'.apply_filters('the_title',$single_event->post_title),$output);
// 		 	}elseif( is_tax()) {
// 		 		$tax_event = get_queried_object();
// 		 		$output = str_replace($last_breadcrumb,'<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.esc_html__('Events','lsx').'</a>&nbsp;/&nbsp;'.apply_filters('the_title',$tax_event->name),$output);

// 		 	}else{
// 		 		$output = str_replace('Page',esc_html__('Events','lsx'),$output);
// 		 	}
// 		 }
// 	}
// 	return $output;
// }
// add_filter( 'lsx_breadcrumbs', 'lsx_tribe_breadcrumbs',1,10 );
