<?php
/**
 * Header default
 */
return array(
	'title'	  => __( 'Header default', 'lsx' ),
	'categories' => array( 'header' ),
	'content'	=> '
	<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"10px","bottom":"10px"},"margin":{"top":"0px"}}},"backgroundColor":"base","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignfull has-base-background-color has-background" style="margin-top:0px;padding-top:10px;padding-bottom:10px"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:image {"id":377,"sizeSlug":"full","linkDestination":"none"} -->
	<figure class="wp-block-image size-full"><img src="' .  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-theme.png'. '" alt="" class="wp-image-377"/></figure>
	<!-- /wp:image -->
	
	<!-- wp:navigation {"ref":17,"layout":{"type":"flex","orientation":"horizontal"},"style":{"spacing":{"blockGap":"20px"}}} /--></div>
	<!-- /wp:group --></div>
	<!-- /wp:group -->',
);
