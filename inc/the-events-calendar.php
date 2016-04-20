<?php
/**
 * The Events Calendar Layout and Functionality
 *
 * @package lsx
 * @subpackage woocommerce
 */

/*
 * Styles
 */

/**
 * Adds theme stylesheet
 * @package 	lsx
 * @subpackage 	tribe-events
 * @category 	styles
 */

function lsx_events_styles() {
    wp_enqueue_style( 'events', get_template_directory_uri() . '/css/the-events-calendar.css' );
}
add_action( 'wp_enqueue_scripts', 'lsx_events_styles' );


/**
 * Adds theme stylesheet
 * @package 	lsx
 * @subpackage 	tribe-events
 * @category 	styles
 */

function lsx_tribe_breadcrumbs($output) {
	global $wp_query;
	if(isset($wp_query->tribe_is_event) && true === $wp_query->tribe_is_event){
		if(function_exists('woocommerce_breadcrumb')){
		 	$closing_div = '</nav>';
		 }elseif(function_exists('yoast_breadcrumb')){
		 	$closing_div = '</div>';
		 }		
		
		if( is_single()) {
			$single_event = get_queried_object();
			$output = str_replace('Page','<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.__('Events','lsx').'</a>',$output);
			$output = str_replace($closing_div,apply_filters('the_title',$single_event->post_title).$closing_div,$output);
		}if( is_tax()) {
			$tax_event = get_queried_object();
			$output = str_replace('Page','<a href="'.get_post_type_archive_link( 'tribe_events' ).'">'.__('Events','lsx').'</a>',$output);
			$output = str_replace($closing_div,'&nbsp;/&nbsp;'.apply_filters('the_title',$tax_event->name).$closing_div,$output);
		}else{
			$output = str_replace('Page',__('Events','lsx'),$output);
		}
	}
	return $output;
}
add_filter( 'lsx_breadcrumbs', 'lsx_tribe_breadcrumbs',1,10 );