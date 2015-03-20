<?php
/**
* Theme Hook Alliance hook stub list.
*
* @package 		lsx
* @version		1.0
* @since		1.0
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
*
* This program is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation; either version 2 of the License, or
* (at your option) any later version.
* 
* This program is distributed in the hope thatt it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*/


/**
 * HTML <body> hooks
 * $lsx_supports[] = 'body';
 */
 function lsx_body_top() {
	 do_action( 'lsx_body_top' );
 }

 function lsx_body_bottom() {
	 do_action( 'lsx_body_bottom' );
 }
 
/**
* HTML <head> hooks
* 
* $lsx_supports[] = 'head';
*/
function lsx_head_top() {
	do_action( 'lsx_head_top' );
}

function lsx_head_bottom() {
	do_action( 'lsx_head_bottom' );
}

/**
* Semantic <header> hooks
* 
* $lsx_supports[] = 'header';
*/
function lsx_header_before() {
	do_action( 'lsx_header_before' );
}

function lsx_header_after() {
	do_action( 'lsx_header_after' );
}

function lsx_header_top() {
	do_action( 'lsx_header_top' );
}

function lsx_header_bottom() {
	do_action( 'lsx_header_bottom' );
}

function lsx_nav_before() {
	do_action( 'lsx_nav_before' );
}

function lsx_nav_after() {
	do_action( 'lsx_nav_after' );
}

/**
 * Semantic <content> hooks
 *
 * $lsx_supports[] = 'lsx_banner_content';
 */

function lsx_banner_content() {
	do_action( 'lsx_banner_content' );
}

/**
* Semantic <content> hooks
* 
* $lsx_supports[] = 'content';
*/
function lsx_content_before() {
	do_action( 'lsx_content_before' );
}

function lsx_content_after() {
	do_action( 'lsx_content_after' );
}

function lsx_content_top() {
	do_action( 'lsx_content_top' );
}

function lsx_content_bottom() {
	do_action( 'lsx_content_bottom' );
}

/**
* Semantic <entry> hooks
* 
* $lsx_supports[] = 'entry';
*/
function lsx_entry_before() {
	do_action( 'lsx_entry_before' );
}

function lsx_entry_after() {
	do_action( 'lsx_entry_after' );
}

function lsx_entry_top() {
	do_action( 'lsx_entry_top' );
}

function lsx_entry_bottom() {
	do_action( 'lsx_entry_bottom' );
}

/**
* Comments block hooks
* 
* $lsx_supports[] = 'comments';
*/
function lsx_comments_before() {
	do_action( 'lsx_comments_before' );
}

function lsx_comments_after() {
	do_action( 'lsx_comments_after' );
}

/**
* Semantic <sidebar> hooks
* 
* $lsx_supports[] = 'sidebar';
*/
function lsx_sidebars_before() {
	do_action( 'lsx_sidebars_before' );
}

function lsx_sidebars_after() {
	do_action( 'lsx_sidebars_after' );
}

function lsx_sidebar_top() {
	do_action( 'lsx_sidebar_top' );
}

function lsx_sidebar_bottom() {
	do_action( 'lsx_sidebar_bottom' );
}

/**
* Semantic <footer> hooks
* 
* $lsx_supports[] = 'footer';
*/
function lsx_footer_before() {
	do_action( 'lsx_footer_before' );
}

function lsx_footer_after() {
	do_action( 'lsx_footer_after' );
}

function lsx_footer_top() {
	do_action( 'lsx_footer_top' );
}

function lsx_footer_bottom() {
	do_action( 'lsx_footer_bottom' );
}