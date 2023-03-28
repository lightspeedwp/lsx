<?php
/**
 * Header default
 */
return array(
	'title'	  => __( 'Header Contrast default', 'lsx' ),
	'categories' => array( 'header' ),
	'content'	=> '
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"20px","bottom":"10px"},"margin":{"top":"0px"}}},"backgroundColor":"contrast","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-contrast-background-color has-background" style="margin-top:0px;padding-top:20px;padding-bottom:10px"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"0","padding":{"top":"0","right":"0","bottom":"0","left":"0"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"id":379,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="' .  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-white.png'. '" alt="" class="wp-image-379"/></figure>
	<!-- /wp:image -->
	
	<!-- wp:navigation {"ref":17,"textColor":"base","layout":{"type":"flex","orientation":"horizontal"},"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"}}} /--></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->',
);
