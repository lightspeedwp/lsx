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
 * This is the 1st action in the theme that fires after <head>.
 */
function lsx_head_top() {
	do_action( 'lsx_head_top' );
}

/**
 * This is the 2nd action that fires before wp_head() and </head>.
 *
 * @return void
 */
function lsx_head_bottom() {
	do_action( 'lsx_head_bottom' );
}

/**
 * The 3rd action thta fires after <body>
 */
function lsx_body_top() {
	do_action( 'lsx_body_top' );
}

/**
 * The 4th action that fires after <div class="header-wrap">.
 *
 * $lsx_supports[] = 'header';
 */
function lsx_header_before() {
	do_action( 'lsx_header_before' );
}

/**
 * The 5th action that fires after <header>
 *
 * @return void
 */
function lsx_header_top() {
	do_action( 'lsx_header_top' );
}

/**
 * The 6th action fires before lsx_nav_menu().
 *
 * @return void
 */
function lsx_nav_before() {
	do_action( 'lsx_nav_before' );
}

/**
 * The 7th action fires after  lsx_nav_menu().
 *
 * @return void
 */
function lsx_nav_after() {
	do_action( 'lsx_nav_after' );
}

/**
 * The 8th action that fires directly after lsx_nav_after().
 *
 * @return void
 */
function lsx_header_bottom() {
	do_action( 'lsx_header_bottom' );
}

/**
 * The 9th action that fires directly after </header>.
 *
 * @return void
 */
function lsx_header_after() {
	do_action( 'lsx_header_after' );
}

/**
 * The 10th action which fires before the <div class="wrap container" role="document" tabindex="-1">.
 *
 * @return void
 */
function lsx_header_wrap_after() {
	do_action( 'lsx_header_wrap_after' );
}

/**
 * The 10th action which fires before the <div class="wrap container" role="document" tabindex="-1">.
 *
 * @return void
 */
function lsx_header_wrap_container_top() {
	do_action( 'lsx_header_wrap_container_top' );
}

/**
 * Body Bottom
 *
 * @return void
 */
function lsx_body_bottom() {
	do_action( 'lsx_body_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $lsx_supports[] = 'banner';
 */
function lsx_banner_content() {
	do_action( 'lsx_banner_content' );
}

/**
 * Banner Inner top
 *
 * @return void
 */
function lsx_banner_inner_top() {
	do_action( 'lsx_banner_inner_top' );
}

/**
 * Banner Inner bottom
 *
 * @return void
 */
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

/**
 * Content Wrap After
 *
 * @return void
 */
function lsx_content_wrap_after() {
	do_action( 'lsx_content_wrap_after' );
}

/**
 * Content before
 *
 * @return void
 */
function lsx_content_before() {
	do_action( 'lsx_content_before' );
}

/**
 * Content After
 *
 * @return void
 */
function lsx_content_after() {
	do_action( 'lsx_content_after' );
}

/**
 * Content Top
 *
 * @return void
 */
function lsx_content_top() {
	do_action( 'lsx_content_top' );
}

/**
 * Content Bottom
 *
 * @return void
 */
function lsx_content_bottom() {
	do_action( 'lsx_content_bottom' );
}

/**
 * Content Post tags
 *
 * @return void
 */
function lsx_content_post_tags() {
	do_action( 'lsx_content_post_tags' );
}

/**
 * Content Sharing
 *
 * @return void
 */
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

/**
 * Entry After
 *
 * @return void
 */
function lsx_entry_after() {
	do_action( 'lsx_entry_after' );
}

/**
 * Entry Top
 *
 * @return void
 */
function lsx_entry_top() {
	do_action( 'lsx_entry_top' );
}

/**
 * Entry Inside Top
 *
 * @return void
 */
function lsx_entry_inside_top() {
	do_action( 'lsx_entry_inside_top' );
}

/**
 * Entry Bottom
 *
 * @return void
 */
function lsx_entry_bottom() {
	do_action( 'lsx_entry_bottom' );
}

/**
 * Semantic <entry> hooks
 */
function lsx_post_meta_top() {
	do_action( 'lsx_post_meta_top' );
}

/**
 * Widget Semantic <entry> hooks
 *
 * $lsx_supports[] = 'entry';
 */
function lsx_widget_entry_before() {
	do_action( 'lsx_widget_entry_before' );
}

/**
 * Widget Entry after
 *
 * @return void
 */
function lsx_widget_entry_after() {
	do_action( 'lsx_widget_entry_after' );
}

/**
 * Widget Entry Top
 *
 * @return void
 */
function lsx_widget_entry_top() {
	do_action( 'lsx_widget_entry_top' );
}

/**
 * Widget Entry Bottom
 *
 * @return void
 */
function lsx_widget_entry_bottom() {
	do_action( 'lsx_widget_entry_bottom' );
}

/**
 * Widget entry content
 *
 * @return void
 */
function lsx_widget_entry_content_top() {
	do_action( 'lsx_widget_entry_content_top' );
}

/**
 * Widget Entry content bottom
 *
 * @return void
 */
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

/**
 * Comment After
 *
 * @return void
 */
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

/**
 * Sidebar After
 *
 * @return void
 */
function lsx_sidebars_after() {
	do_action( 'lsx_sidebars_after' );
}

/**
 * Sidebar Top
 *
 * @return void
 */
function lsx_sidebar_top() {
	do_action( 'lsx_sidebar_top' );
}

/**
 * Sidebar Bottom
 *
 * @return void
 */
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

/**
 * Footer After
 *
 * @return void
 */
function lsx_footer_after() {
	do_action( 'lsx_footer_after' );
}

/**
 * Footer Top
 *
 * @return void
 */
function lsx_footer_top() {
	do_action( 'lsx_footer_top' );
}

/**
 * Footer Bottom
 *
 * @return void
 */
function lsx_footer_bottom() {
	do_action( 'lsx_footer_bottom' );
}
