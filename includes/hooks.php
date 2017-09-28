<?php
/**
 * LSX functions and definitions - Hooks.
 *
 * @package    lsx
 * @subpackage hooks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * HTML <body> hooks
 *
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
 * $lsx_supports[] = 'banner';
 */

function lsx_banner_content() {
	do_action( 'lsx_banner_content' );
}

function lsx_banner_inner_bottom() {
	do_action( 'lsx_banner_inner_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $lsx_supports[] = 'global_header';
 */

function lsx_global_header_inner_bottom() {
	do_action( 'lsx_global_header_inner_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $lsx_supports[] = 'content';
 */

function lsx_content_wrap_before() {
	do_action( 'lsx_content_wrap_before' );
}

function lsx_content_wrap_after() {
	do_action( 'lsx_content_wrap_after' );
}

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

function lsx_content_post_tags() {
	do_action( 'lsx_content_post_tags' );
}

function lsx_content_sharing() {
	do_action( 'lsx_content_sharing' );
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
 * Widget Semantic <entry> hooks
 *
 * $lsx_supports[] = 'entry';
 */

function lsx_widget_entry_before() {
	do_action( 'lsx_widget_entry_before' );
}

function lsx_widget_entry_after() {
	do_action( 'lsx_widget_entry_after' );
}

function lsx_widget_entry_top() {
	do_action( 'lsx_widget_entry_top' );
}

function lsx_widget_entry_bottom() {
	do_action( 'lsx_widget_entry_bottom' );
}

function lsx_widget_entry_content_top() {
	do_action( 'lsx_widget_entry_content_top' );
}

function lsx_widget_entry_content_bottom() {
	do_action( 'lsx_widget_entry_content_bottom' );
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
