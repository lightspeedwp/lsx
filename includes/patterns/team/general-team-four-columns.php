<?php
/**
 * Team 4 Column
 */
return array(
	'title'	  => __( 'Team 4 Column', 'lsx' ),
	'categories' => array( 'team' ),
	'content'	=> '
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0px"},"padding":{"top":"var:preset|spacing|x-large","right":"30px","bottom":"var:preset|spacing|x-large","left":"30px"}}},"layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px"><!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
<h2 class="has-text-align-center has-x-large-font-size" id="our-team">'.  esc_html__( 'Our Team', 'lsx' ).'</h2>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|medium"}}}} -->
<p class="has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--medium)">The people who are ready to serve you.</p>
<!-- /wp:paragraph -->
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":3489,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-placeholder-contrast-800x800.jpg'.'" alt="Sample Image" class="wp-image-3489"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"medium"} -->
<h3 class="has-text-align-center has-medium-font-size" id="member-name-1">'.  esc_html__( 'Member Name', 'lsx' ).'</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur et adipiscing.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><a href="#">'.  esc_html__( 'View profile', 'lsx' ).'</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":3489,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-placeholder-contrast-800x800.jpg'.'" alt="Sample Image" class="wp-image-3489"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"medium"} -->
<h3 class="has-text-align-center has-medium-font-size" id="member-name-2">'.  esc_html__( 'Member Name', 'lsx' ).'</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur et adipiscing.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><a href="#">'.  esc_html__( 'View profile', 'lsx' ).'</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":3489,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-placeholder-contrast-800x800.jpg'.'" alt="Sample Image" class="wp-image-3489"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"medium"} -->
<h3 class="has-text-align-center has-medium-font-size" id="member-name-3">'.  esc_html__( 'Member Name', 'lsx' ).'</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur et adipiscing.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><a href="#">'.  esc_html__( 'View profile', 'lsx' ).'</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><!-- wp:image {"id":3489,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="'.  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-placeholder-contrast-800x800.jpg'.'" alt="Sample Image" class="wp-image-3489"/></figure>
<!-- /wp:image -->
<!-- wp:heading {"textAlign":"center","level":3,"fontSize":"medium"} -->
<h3 class="has-text-align-center has-medium-font-size" id="member-name-4">'.  esc_html__( 'Member Name', 'lsx' ).'</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Lorem ipsum dolor sit amet, consectetur et adipiscing.</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><a href="#">'.  esc_html__( 'View profile', 'lsx' ).'</a>.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->',
);
