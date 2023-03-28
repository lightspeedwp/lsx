<?php
/**
 * Header CTA
 */
return array(
	'title'	  => __( 'Header CTA', 'lsx' ),
	'categories' => array( 'header' ),
	'content'	=> '
    <!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0","bottom":"0"},"blockGap":"0"}},"layout":{"inherit":true,"type":"constrained","justifyContent":"center"},"extUtilities":[]} -->
<div class="wp-block-group alignfull" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"bottom":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dlarge, 1rem)","top":"var(\u002d\u002dwp\u002d\u002dcustom\u002d\u002dspacing\u002d\u002dsmall, 1.00rem)"}}},"layout":{"type":"flex","justifyContent":"space-between","flexWrap":"nowrap"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--custom--spacing--small, 1.00rem);padding-bottom:var(--wp--custom--spacing--large, 1rem)"><!-- wp:group {"layout":{"type":"flex"}} -->
<div class="wp-block-group"><!-- wp:site-logo {"width":169} /--></div>
<!-- /wp:group -->

<!-- wp:navigation {"ref":17,"textColor":"contrast","icon":"menu","overlayBackgroundColor":"contrast","overlayTextColor":"base","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"},"style":{"spacing":{"blockGap":"var:preset|spacing|x-small"},"typography":{"fontSize":"18px"}}} /-->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"cta","textColor":"base","className":"is-style-cta"} -->
<div class="wp-block-button is-style-cta"><a class="wp-block-button__link has-base-color has-cta-background-color has-text-color has-background wp-element-button" href="">Download</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->',
);
