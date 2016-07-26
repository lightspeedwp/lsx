<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 */
function lsx_customizer_colour__color_scheme_css_template() {
	global $customizer_colour_names;
	
	$colors = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = '{{ data.'.$key.' }}';
	}
	?>
	<script type="text/html" id="tmpl-lsx-color-scheme">
		<?php echo lsx_customizer_colour__top_menu_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__header_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__main_menu_get_css( $colors ) ?>

		<?php echo lsx_customizer_colour__banner_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__body_get_css( $colors ) ?>

		<?php echo lsx_customizer_colour__footer_cta_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__footer_widgets_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__footer_get_css( $colors ) ?>

		<?php echo lsx_customizer_colour__button_get_css( $colors ) ?>
		<?php echo lsx_customizer_colour__button_cta_get_css( $colors ) ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'lsx_customizer_colour__color_scheme_css_template' );

/**
 * Retrieves the current color scheme.
 */
function lsx_customizer_colour__get_color_scheme() {
	global $customizer_colour_choices;

	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes = $customizer_colour_choices;

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}

/**
 * Converts a HEX value to RGB.
 */
function lsx_customizer_colour__hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/* ################################################################################# */


/**
 * Enqueues front-end CSS for the button.
 */
function lsx_customizer_colour__button_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'button_background_color' => get_theme_mod( 'button_background_color', $colors['button_background_color'] ),
		'button_background_hover_color' => get_theme_mod( 'button_background_hover_color', $colors['button_background_hover_color'] ),
		'button_text_color' => get_theme_mod( 'button_text_color', $colors['button_text_color'] ),
		'button_text_color_hover' => get_theme_mod( 'button_text_color_hover', $colors['button_text_color_hover'] )
	);

	$color_scheme_css = lsx_customizer_colour__button_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__button_css' );

/**
 * Returns CSS for the button.
 */
function lsx_customizer_colour__button_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Button */

	.btn,
	.btn:visited,
	.button,
	.button:visited,
	input[type="submit"],
	input[type="submit"]:visited,
	#searchform .input-group span.input-group-btn button.search-submit,
	#searchform .input-group span.input-group-btn button.search-submit:visited,
	.caldera-clarity-grid .btn,
	.caldera-clarity-grid .btn:visited,
	.caldera-clarity-grid .button-primary,
	.caldera-clarity-grid .button-primary:visited,
	.caldera-grid .btn,
	.caldera-grid .btn:visited,
	.caldera-grid .button-primary,
	.caldera-grid .button-primary:visited,
	#footer-widgets .widget form .btn,
	#footer-widgets .widget form .btn:visited,
	#footer-widgets .widget form .button-primary,
	#footer-widgets .widget form .button-primary:visited {
		background-color: {$colors['button_background_color']};
		color: {$colors['button_text_color']};
	}

	.btn:hover,
	.btn:active,
	.btn:focus,
	.button:hover,
	.button:active,
	.button:focus,
	button:hover,
	button:active,
	button:focus,
	input[type="submit"]:hover,
	input[type="submit"]:active,
	input[type="submit"]:focus,
	#searchform .input-group span.input-group-btn button.search-submit:hover,
	#searchform .input-group span.input-group-btn button.search-submit:active,
	#searchform .input-group span.input-group-btn button.search-submit:focus,
	.caldera-clarity-grid .btn:hover,
	.caldera-clarity-grid .btn:active,
	.caldera-clarity-grid .btn:focus,
	.caldera-clarity-grid .button-primary:hover,
	.caldera-clarity-grid .button-primary:active,
	.caldera-clarity-grid .button-primary:focus,
	.caldera-grid .btn:hover,
	.caldera-grid .btn:active,
	.caldera-grid .btn:focus,
	.caldera-grid .button-primary:hover,
	.caldera-grid .button-primary:active,
	.caldera-grid .button-primary:focus,
	#footer-widgets .widget form .btn:hover,
	#footer-widgets .widget form .btn:active,
	#footer-widgets .widget form .btn:focus,
	#footer-widgets .widget form .button-primary:hover,
	#footer-widgets .widget form .button-primary:active,
	#footer-widgets .widget form .button-primary:focus {
		background-color: {$colors['button_background_hover_color']};
		color: {$colors['button_text_color_hover']};
	}

	article header.entry-header h1.entry-title a.format-link,
	article header.entry-header h1.entry-title a.format-link:visited {
		background-color: {$colors['button_background_color']};
		color: {$colors['button_text_color']} !important;
	}

	.border-btn.button-primary,
	.border-btn.button-primary:visited,
	.btn.border-btn,
	.btn.border-btn:visited,
	button.border-btn,
	button.border-btn:visited,
	.wp-pagenavi a,
	.wp-pagenavi a:visited,
	.lsx-postnav > a,
	.lsx-postnav > a:visited {
		border-color: {$colors['button_background_color']} !important;
		color: {$colors['button_background_color']} !important;
	}

	.border-btn.button-primary:hover,
	.border-btn.button-primary:active,
	.border-btn.button-primary:focus,
	.btn.border-btn:hover,
	.btn.border-btn:active,
	.btn.border-btn:focus,
	button.border-btn:hover,
	button.border-btn:active,
	button.border-btn:focus,
	.wp-pagenavi a:hover,
	.wp-pagenavi a:active,
	.wp-pagenavi a:focus,
	.lsx-postnav > a:hover,
	.lsx-postnav > a:active,
	.lsx-postnav > a:focus {
		background-color: {$colors['button_background_hover_color']} !important;
		border-color: {$colors['button_background_hover_color']} !important;
		color: {$colors['button_text_color_hover']} !important;
	}

	.wp-pagenavi span.current,
	.lsx-postnav > span {
		background-color: {$colors['button_background_color']} !important;
		color: {$colors['button_text_color']} !important;
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_button', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the button cta.
 */
function lsx_customizer_colour__button_cta_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'button_cta_background_color' => get_theme_mod( 'button_cta_background_color', $colors['button_cta_background_color'] ),
		'button_cta_background_hover_color' => get_theme_mod( 'button_cta_background_hover_color', $colors['button_cta_background_hover_color'] ),
		'button_cta_text_color' => get_theme_mod( 'button_cta_text_color', $colors['button_cta_text_color'] ),
		'button_cta_text_color_hover' => get_theme_mod( 'button_cta_text_color_hover', $colors['button_cta_text_color_hover'] )
	);

	$color_scheme_css = lsx_customizer_colour__button_cta_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__button_cta_css' );

/**
 * Returns CSS for the button cta.
 */
function lsx_customizer_colour__button_cta_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Button CTA */

	.btn.cta-btn,
	.btn.cta-btn:visited,
	#top-menu nav.top-menu ul li.cta a,
	#top-menu nav.top-menu ul li.cta a:visited {
		background-color: {$colors['button_cta_background_color']} !important;
		color: {$colors['button_cta_text_color']} !important;
	}

	.btn.cta-border-btn,
	.btn.cta-border-btn:visited {
		border-color: {$colors['button_cta_background_color']} !important;
		color: {$colors['button_cta_background_color']} !important;
	}

	.btn.cta-btn:hover,
	.btn.cta-btn:active,
	.btn.cta-btn:focus,
	#top-menu nav.top-menu ul li.cta a:hover,
	#top-menu nav.top-menu ul li.cta a:active,
	#top-menu nav.top-menu ul li.cta a:focus,
	.btn.cta-border-btn:hover,
	.btn.cta-border-btn:active,
	.btn.cta-border-btn:focus {
		background-color: {$colors['button_cta_background_hover_color']} !important;
		color: {$colors['button_cta_text_color_hover']} !important;
	}

	.btn.cta-border-btn:hover,
	.btn.cta-border-btn:active,
	.btn.cta-border-btn:focus {
		border-color: {$colors['button_cta_background_hover_color']} !important;
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_button_cta', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the top menu.
 */
function lsx_customizer_colour__top_menu_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'top_menu_background_color' => get_theme_mod( 'top_menu_background_color', $colors['top_menu_background_color'] ),
		'top_menu_text_color' => get_theme_mod( 'top_menu_text_color', $colors['top_menu_text_color'] ),
		'top_menu_text_hover_color' => get_theme_mod( 'top_menu_text_hover_color', $colors['top_menu_text_hover_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__top_menu_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__top_menu_css' );

/**
 * Returns CSS for the top menu.
 */
function lsx_customizer_colour__top_menu_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Top Menu */

	#top-menu {
		background-color: {$colors['top_menu_background_color']};
	}

	#top-menu nav.top-menu ul li a,
	#top-menu nav.top-menu ul li a:visited {
		color: {$colors['top_menu_text_color']};
	}

	#top-menu nav.top-menu ul li a:hover,
	#top-menu nav.top-menu ul li a:active,
	#top-menu nav.top-menu ul li a:focus,
	#top-menu nav.top-menu ul li a:before,
	#top-menu nav.top-menu ul li a:visited:before,
	#top-menu nav.top-menu ul li a:hover:before,
	#top-menu nav.top-menu ul li a:active:before,
	#top-menu nav.top-menu ul li a:focus:before {
		color: {$colors['top_menu_text_hover_color']};
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_top_menu', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the header.
 */
function lsx_customizer_colour__header_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'header_background_color' => get_theme_mod( 'header_background_color', $colors['header_background_color'] ),
		'header_title_color' => get_theme_mod( 'header_title_color', $colors['header_title_color'] ),
		'header_title_hover_color' => get_theme_mod( 'header_title_hover_color', $colors['header_title_hover_color'] ),
		'header_description_color' => get_theme_mod( 'header_description_color', $colors['header_description_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__header_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__header_css' );

/**
 * Returns CSS for the header.
 */
function lsx_customizer_colour__header_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Header */

	header.banner {
		background-color: {$colors['header_background_color']};
	}

	header.banner .site-branding .site-title,
	header.banner .site-branding .site-title a,
	header.banner .site-branding .site-title a:visited {
		color: {$colors['header_title_color']};
	}

	header.banner .site-branding .site-title a:hover,
	header.banner .site-branding .site-title a:active,
	header.banner .site-branding .site-title a:focus {
		color: {$colors['header_title_hover_color']};
	}

	header.banner .site-branding .site-description {
		color: {$colors['header_description_color']};
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_header', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the main menu.
 */
function lsx_customizer_colour__main_menu_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'main_menu_background_hover1_color' => get_theme_mod( 'main_menu_background_hover1_color', $colors['main_menu_background_hover1_color'] ),
		'main_menu_background_hover2_color' => get_theme_mod( 'main_menu_background_hover2_color', $colors['main_menu_background_hover2_color'] ),
		'main_menu_text_color' => get_theme_mod( 'main_menu_text_color', $colors['main_menu_text_color'] ),
		'main_menu_text_hover1_color' => get_theme_mod( 'main_menu_text_hover1_color', $colors['main_menu_text_hover1_color'] ),
		'main_menu_text_hover2_color' => get_theme_mod( 'main_menu_text_hover2_color', $colors['main_menu_text_hover2_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__main_menu_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__main_menu_css' );

/**
 * Returns CSS for the main menu.
 */
function lsx_customizer_colour__main_menu_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Main Menu */

	nav.primary-navbar .nav.navbar-nav li a {
		color: {$colors['main_menu_text_color']};
	}

	nav.primary-navbar .nav.navbar-nav li ul.dropdown-menu li a,
	nav.primary-navbar .nav.navbar-nav li.active a,
	nav.primary-navbar .nav.navbar-nav li.active:hover > a {
		color: {$colors['main_menu_text_hover1_color']};
	}

	nav.primary-navbar .nav.navbar-nav li.active > a .caret,
	nav.primary-navbar .nav.navbar-nav li.open > a .caret,
	nav.primary-navbar .nav.navbar-nav li:hover > a .caret {
		border-top-color: {$colors['main_menu_text_hover1_color']};
		border-bottom-color: {$colors['main_menu_text_hover1_color']};
	}

	nav.primary-navbar .nav.navbar-nav li.active > a,
	nav.primary-navbar .nav.navbar-nav li.open > a,
	nav.primary-navbar .nav.navbar-nav li:hover > a,
	nav.primary-navbar .nav.navbar-nav li ul.dropdown-menu {
		background-color: {$colors['main_menu_background_hover1_color']};
		color: {$colors['main_menu_text_hover1_color']};
	}

	nav.primary-navbar .nav.navbar-nav li ul.dropdown-menu li a:hover,
	nav.primary-navbar .nav.navbar-nav li.active li.active a {
		background-color: {$colors['main_menu_background_hover2_color']};
		color: {$colors['main_menu_text_hover2_color']};
	}

	.navbar-default .navbar-toggle,
	.navbar-default .navbar-toggle:visited,
	.navbar-default .navbar-toggle:focus,
	.navbar-default .navbar-toggle:hover,
	.navbar-default .navbar-toggle:active {
		border-color: {$colors['main_menu_background_hover1_color']};
		background-color: {$colors['main_menu_background_hover1_color']};
	}

	.navbar-default .navbar-toggle .icon-bar {
		background-color: {$colors['main_menu_text_hover1_color']};
	}

	header.banner .search-submit,
	header.banner .search-submit:visited {
		color: {$colors['main_menu_text_color']} !important;
	}

	header.banner .search-submit:hover,
	header.banner .search-submit:active,
	header.banner .search-submit:focus {
		color: #333 !important;
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_main_menu', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the banner.
 */
function lsx_customizer_colour__banner_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'banner_background_color' => get_theme_mod( 'banner_background_color', $colors['banner_background_color'] ),
		'banner_text_color' => get_theme_mod( 'banner_text_color', $colors['banner_text_color'] ),
		'banner_text_image_color' => get_theme_mod( 'banner_text_image_color', $colors['banner_text_image_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__banner_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__banner_css' );

/**
 * Returns CSS for the banner.
 */
function lsx_customizer_colour__banner_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Banner */

	#primary.col-md-12 .archive-header,
	#primary.col-sm-12 .archive-header {
		background-color: {$colors['banner_background_color']} !important;
	}

	#primary.col-md-12 .archive-header .archive-title,
	#primary.col-md-12 .archive-header h1,
	#primary.col-sm-12 .archive-header .archive-title,
	#primary.col-sm-12 .archive-header h1 {
		color: {$colors['banner_text_color']} !important;
	}

	body.page-has-banner .page-banner h1.page-title {
		color: {$colors['banner_text_image_color']} !important;
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_banner', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the body.
 */
function lsx_customizer_colour__body_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'body_background_color' => get_theme_mod( 'body_background_color', $colors['body_background_color'] ),
		'body_line_color' => get_theme_mod( 'body_line_color', $colors['body_line_color'] ),
		'body_text_heading_color' => get_theme_mod( 'body_text_heading_color', $colors['body_text_heading_color'] ),
		'body_text_color' => get_theme_mod( 'body_text_color', $colors['body_text_color'] ),
		'body_link_color' => get_theme_mod( 'body_link_color', $colors['body_link_color'] ),
		'body_link_hover_color' => get_theme_mod( 'body_link_hover_color', $colors['body_link_hover_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__body_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__body_css' );

/**
 * Returns CSS for the body.
 */
function lsx_customizer_colour__body_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Body */

	body,
	.wrap {
		background-color: {$colors['body_background_color']};
	}

	h1, h2, h3, h4, h5, h6,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited,
	body.single-post .wrap #primary .post-navigation .pager a div h3,
	body.single-post .wrap #primary .post-navigation .pager a:visited div h3 {
		color: {$colors['body_text_heading_color']};
	}

	article header.entry-header h1.entry-title a,
	article header.entry-header h1.entry-title a:visited {
		color: {$colors['body_text_heading_color']} !important;
	}

	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
	h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active,
	h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus, h6 a:focus,
	body.single-post .wrap #primary .post-navigation .pager a:hover div h3,
	body.single-post .wrap #primary .post-navigation .pager a:active div h3 ,
	body.single-post .wrap #primary .post-navigation .pager a:focus div h3 {
		color: {$colors['body_link_hover_color']};
	}

	article header.entry-header h1.entry-title a:hover,
	article header.entry-header h1.entry-title a:active,
	article header.entry-header h1.entry-title a:focus {
		color: {$colors['body_link_hover_color']} !important;
	}

	body {
		color: {$colors['body_text_color']};
	}

	article .entry-content,
	article .entry-summary,
	.sharedaddy .sd-sharing .sd-title,
	.sharedaddy .sd-sharing .sd-title:before,
	.entry-meta .post-meta,
	.nav-links-description,
	.post-meta-author:before,
	.post-meta-categories:before,
	.post-meta-time:before,
	.post-comments:before,
	.post-tags:before,
	#reply-title:before,
	.post-meta-link:before,
	.nav-links-description:after,
	.nav-links-description:before {
		color: {$colors['body_text_color']} !important;
	}

	a,
	a:visited,
	.entry-content a,
	.entry-content a:visited,
	.entry-summary a,
	.entry-summary a:visited {
		color: {$colors['body_link_color']};
	}

	a:hover,
	a:active,
	a:focus,
	.entry-content a:hover,
	.entry-content a:active,
	.entry-content a:focus,
	.entry-summary a:hover,
	.entry-summary a:active,
	.entry-summary a:focus {
		color: {$colors['body_link_hover_color']};
	}

	.post-meta-author a,
	.post-meta-author a:visited,
	.post-meta-categories a,
	.post-meta-categories a:visited,
	.post-meta-time a,
	.post-meta-time a:visited,
	.post-tags-wrapper .post-comments a,
	.post-tags-wrapper .post-comments a:visited {
		color: {$colors['body_link_color']} !important;
	}

	.post-meta-author a:hover,
	.post-meta-author a:active,
	.post-meta-author a:focus,
	.post-meta-categories a:hover,
	.post-meta-categories a:active,
	.post-meta-categories a:focus,
	.post-meta-time a:hover,
	.post-meta-time a:active,
	.post-meta-time a:focus,
	.post-tags-wrapper .post-comments a:hover,
	.post-tags-wrapper .post-comments a:active,
	.post-tags-wrapper .post-comments a:focus {
		color: {$colors['body_link_hover_color']} !important;
	}

	body.archive.author .wrap #primary #main > article,
	body.archive.category .wrap #primary #main > article,
	body.archive.date .wrap #primary #main > article,
	body.archive.tag .wrap #primary #main > article,
	body.archive.tax-post_format .wrap #primary #main > article,
	body.blog .wrap #primary #main > article,
	body.search .wrap #primary #main > article {
		box-shadow: 1px 1px 3px 0 {$colors['body_line_color']};
		border-color: {$colors['body_line_color']};
	}

	body.single-post .wrap #primary #main > article .post-tags-wrapper {
		border-top-color: {$colors['body_line_color']};
		border-bottom-color: {$colors['body_line_color']};
	}

	figure.wp-caption {
		border-color: {$colors['body_line_color']};
	}

	figure.wp-caption figcaption.wp-caption-text,
	.sharedaddy .sd-sharing {
		border-top-color: {$colors['body_line_color']};
	}

	.page-header {
		border-bottom-color: {$colors['body_line_color']};
	}

	input[type="text"]:focus,
	input[type="search"]:focus,
	input[type="email"]:focus,
	textarea:focus,
	select:focus {
		border-color: {$colors['body_link_hover_color']} !important;
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_body', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the footer cta.
 */
function lsx_customizer_colour__footer_cta_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'footer_cta_background_color' => get_theme_mod( 'footer_cta_background_color', $colors['footer_cta_background_color'] ),
		'footer_cta_text_color' => get_theme_mod( 'footer_cta_text_color', $colors['footer_cta_text_color'] ),
		'footer_cta_link_color' => get_theme_mod( 'footer_cta_link_color', $colors['footer_cta_link_color'] ),
		'footer_cta_link_hover_color' => get_theme_mod( 'footer_cta_link_hover_color', $colors['footer_cta_link_hover_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__footer_cta_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__footer_cta_css' );

/**
 * Returns CSS for the footer cta.
 */
function lsx_customizer_colour__footer_cta_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Footer CTA */

	#footer-cta,
	.lsx-full-width {
		background-color: {$colors['footer_cta_background_color']};
	}

	#footer-cta h1,
	#footer-cta h2,
	#footer-cta h3,
	#footer-cta h4,
	#footer-cta h5,
	#footer-cta h6,
	#footer-cta .textwidget {
		color: {$colors['footer_cta_text_color']};
	}

	#footer-cta a,
	#footer-cta a:visited,
	#footer-cta h1 a,
	#footer-cta h1 a:visited,
	#footer-cta h2 a,
	#footer-cta h2 a:visited,
	#footer-cta h3 a,
	#footer-cta h3 a:visited,
	#footer-cta h4 a,
	#footer-cta h4 a:visited,
	#footer-cta h5 a,
	#footer-cta h5 a:visited,
	#footer-cta h6 a,
	#footer-cta h6 a:visited,
	#footer-cta .textwidget a,
	#footer-cta .textwidget a:visited {
		color: {$colors['footer_cta_link_color']};
	}

	#footer-cta a:hover,
	#footer-cta a:active,
	#footer-cta a:focus,
	#footer-cta h1 a:hover,
	#footer-cta h1 a:active,
	#footer-cta h1 a:focus,
	#footer-cta h2 a:hover,
	#footer-cta h2 a:active,
	#footer-cta h2 a:focus,
	#footer-cta h3 a:hover,
	#footer-cta h3 a:active,
	#footer-cta h3 a:focus,
	#footer-cta h4 a:hover,
	#footer-cta h4 a:active,
	#footer-cta h4 a:focus,
	#footer-cta h5 a:hover,
	#footer-cta h5 a:active,
	#footer-cta h5 a:focus,
	#footer-cta h6 a:hover,
	#footer-cta h6 a:active,
	#footer-cta h6 a:focus,
	#footer-cta .textwidget a:hover,
	#footer-cta .textwidget a:active,
	#footer-cta .textwidget a:focus {
		color: {$colors['footer_cta_link_hover_color']};
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_footer_cta', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the footer widgets.
 */
function lsx_customizer_colour__footer_widgets_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'footer_widgets_background_color' => get_theme_mod( 'footer_widgets_background_color', $colors['footer_widgets_background_color'] ),
		'footer_widgets_text_color' => get_theme_mod( 'footer_widgets_text_color', $colors['footer_widgets_text_color'] ),
		'footer_widgets_link_color' => get_theme_mod( 'footer_widgets_link_color', $colors['footer_widgets_link_color'] ),
		'footer_widgets_link_hover_color' => get_theme_mod( 'footer_widgets_link_hover_color', $colors['footer_widgets_link_hover_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__footer_widgets_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__footer_widgets_css' );

/**
 * Returns CSS for the footer widgets.
 */
function lsx_customizer_colour__footer_widgets_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Footer Widgets */

	#footer-widgets {
		background-color: {$colors['footer_widgets_background_color']};
	}

	#footer-widgets,
	#footer-widgets .widget,
	#footer-widgets .widget h3.widget-title {
		color: {$colors['footer_widgets_text_color']};
	}

	#footer-widgets a,
	#footer-widgets a:visited,
	#footer-widgets .widget a,
	#footer-widgets .widget a:visited,
	#footer-widgets .widget h3.widget-title a,
	#footer-widgets .widget h3.widget-title a:visited {
		color: {$colors['footer_widgets_link_color']};
	}

	#footer-widgets a:hover,
	#footer-widgets a:active,
	#footer-widgets a:focus,
	#footer-widgets .widget a:hover,
	#footer-widgets .widget a:active,
	#footer-widgets .widget a:focus,
	#footer-widgets .widget h3.widget-title :hover,
	#footer-widgets .widget h3.widget-title a:active,
	#footer-widgets .widget h3.widget-title a:focus {
		color: {$colors['footer_widgets_link_hover_color']};
	}

	#footer-widgets .widget h3.widget-title {
		border-bottom-color: {$colors['footer_widgets_text_color']};
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_footer_widgets', $css, $colors );
}


/* ################################################################################# */


/**
 * Enqueues front-end CSS for the footer.
 */
function lsx_customizer_colour__footer_css() {
	global $customizer_colour_names;

	$color_scheme = lsx_customizer_colour__get_color_scheme();
	$colors = array();
	$counter = 0;

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors[$key] = $color_scheme[$counter];
		$counter++;
	}

	$inline_colors = array(
		'footer_background_color' => get_theme_mod( 'footer_background_color', $colors['footer_background_color'] ),
		'footer_text_color' => get_theme_mod( 'footer_text_color', $colors['footer_text_color'] ),
		'footer_link_color' => get_theme_mod( 'footer_link_color', $colors['footer_link_color'] ),
		'footer_link_hover_color' => get_theme_mod( 'footer_link_hover_color', $colors['footer_link_hover_color'] )
	);

	$color_scheme_css = lsx_customizer_colour__footer_get_css( $inline_colors );
	wp_add_inline_style( 'lsx_main', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'lsx_customizer_colour__footer_css' );

/**
 * Returns CSS for the footer.
 */
function lsx_customizer_colour__footer_get_css( $colors ) {
	global $customizer_colour_names;
	
	$colors_template = array();

	foreach ( $customizer_colour_names as $key => $value ) {
		$colors_template[$key] = '';
	}

	$colors = wp_parse_args( $colors, $colors_template );

	$css = <<<CSS
	
	/* Footer */

	footer.content-info {
		background-color: {$colors['footer_background_color']};
	}

	footer.content-info,
	footer.content-info .credit {
		color: {$colors['footer_text_color']};
	}

	footer.content-info a,
	footer.content-info a:visited {
		color: {$colors['footer_link_color']};
	}

	footer.content-info a:hover,
	footer.content-info a:active,
	footer.content-info a:focus {
		color: {$colors['footer_link_hover_color']};
	}

	nav#footer-navigation ul li {
		border-right: {$colors['footer_link_color']};
	}
CSS;

	return apply_filters( 'lsx_customizer_colour_selectors_footer', $css, $colors );
}


/* ################################################################################# */


/**
 * Customize Colour Control Class
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

class LSX_Customize_Colour_Control extends WP_Customize_Control {
	
	/**
	 * Enqueue control related scripts/styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'lsx-colour-control', get_template_directory_uri() .'/js/customizer-colour.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), null, true );
		wp_localize_script( 'lsx-colour-control', 'colorScheme', $this->choices );

		global $customizer_colour_names;
		$colors = array();
		foreach ( $customizer_colour_names as $key => $value ) {
			$colors[] = $key;
		}
		wp_localize_script( 'lsx-colour-control', 'colorSchemeKeys', $colors );
	}

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return;
		}

		?> 
		<label>
			<?php if ( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ) ?></span>
			<?php }
			if ( ! empty( $this->description ) ) { ?>
				<span class="description customize-control-description"><?php echo $this->description ?></span>
			<?php } ?>
			<select <?php $this->link() ?>>
				<?php
					foreach ( $this->choices as $value => $label ) {
						echo '<option value="'. esc_attr( $value ) .'"'. selected( $this->value(), $value, false ) .'>'. $label['label'] .'</option>';
					}
				?>
			</select>
		</label>
	<?php
	}

}

?>