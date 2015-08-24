<?php
/**
 * Buddypress Functionality
 *
 * @package lsx
 * @subpackage jetpack
 */

/*
 * Layout
 */

/**
 * Forces the BP Profile Pages to be 1 Column
 * 
 * @package lsx
 * @subpackage jetpack
 * @category infinite scroll
 */
 function lsx_buddypress_page_columns($layout) {
 	
	if(bp_is_profile_component()|| bp_is_settings_component() || bp_is_activity_component() || bp_is_group() || bp_is_messages_component()
		|| bp_is_members_directory() || bp_is_groups_directory() || bp_is_groups_component() || bp_is_members_component()){
		$layout = '1c';
	}
	return $layout;
 }
 add_filter( 'lsx_layout', 'lsx_buddypress_page_columns' , 1 , 100 );