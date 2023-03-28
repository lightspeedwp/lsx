<?php
/**
 * Header Center
 */
return array(
	'title'	  => __( 'Header Center', 'lsx' ),
	'categories' => array( 'header' ),
	'content'	=> '
    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"30px","bottom":"30px"},"margin":{"top":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:30px;padding-bottom:30px"><!-- wp:image {"align":"center","id":377,"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image aligncenter size-full"><img src="' .  esc_url( get_theme_file_uri() ) . '/assets/images/lsx-theme.png'. '" alt="" class="wp-image-377"/></figure>
<!-- /wp:image -->

<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group"><!-- wp:navigation {"ref":17,"layout":{"type":"flex","orientation":"horizontal"},"style":{"spacing":{"blockGap":"20px"}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
);
