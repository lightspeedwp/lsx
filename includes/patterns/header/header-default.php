<?php
/**
 * Header default
 */
return array(
	'title'	  => __( 'Header default', 'lsx' ),
	'categories' => array( 'header' ),
	'content'	=> '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"30px","bottom":"30px"},"margin":{"top":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:30px;padding-bottom:30px">
<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide">
<!-- wp:site-title /-->
<!-- wp:navigation {"isResponsive":true,"style":{"spacing":{"blockGap":"20px"}}} -->
<!-- wp:page-list {"isNavigationChild":true,"showSubmenuIcon":true,"openSubmenusOnClick":false} /-->
<!-- /wp:navigation -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->',
);
