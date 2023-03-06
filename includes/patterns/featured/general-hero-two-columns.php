<?php
/**
 * Hero 2 Col with Image
 */
return array(
	'title'	  => __( 'Hero 2 Col with Image', 'lsx' ),
	'categories' => array( 'featured' ),
	'content'	=> '<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"var:preset|spacing|x-large","right":"30px","bottom":"var:preset|spacing|x-large","left":"30px"}}},"layout":{"inherit":true,"type":"constrained"}} -->
	<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px"><!-- wp:media-text {"mediaPosition":"right","mediaId":3485,"mediaLink":"","mediaType":"image","mediaWidth":40} -->
	<div class="wp-block-media-text alignwide has-media-on-the-right is-stacked-on-mobile" style="grid-template-columns:auto 40%"><div class="wp-block-media-text__content"><!-- wp:heading {"fontSize":"x-large"} -->
	<h2 class="has-x-large-font-size" id="text-on-left-image-on-right">' . esc_html__( 'Text on left, media on right.', 'lsx' ); . '</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph -->
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing vestibulum. Fringilla nec accumsan eget, facilisis mi justo, luctus pellentesque gravida vitae non diam accumsan posuere, venenatis mi turpis.</p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons -->
	<div class="wp-block-buttons"><!-- wp:button {"style":{"border":{"radius":0}},"className":"is-style-fill"} -->
	<div class="wp-block-button is-style-fill"><a class="wp-block-button__link no-border-radius wp-element-button">' . esc_html__( 'Get Started', 'lsx' ); . '</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"style":{"border":{"radius":0}},"className":"is-style-outline"} -->
	<div class="wp-block-button is-style-outline"><a class="wp-block-button__link no-border-radius wp-element-button">' . esc_html__( 'Learn More', 'lsx' ); . '</a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons --></div><figure class="wp-block-media-text__media"><img src="'. echo esc_url( get_theme_file_uri() ) . '/assets/images/lsx-placeholder-contrast-1200x1200.jpg'; .'" alt="Sample Image" class="wp-image-3485 size-full"/></figure></div>
	<!-- /wp:media-text --></div>
	<!-- /wp:group -->',
);
