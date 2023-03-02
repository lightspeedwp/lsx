<?php
/**
 * Footer 3 Column
 */
return array(
	'title'	  => __( 'Footer 3 Column', 'lsx' ),
	'categories' => array( 'footer' ),
	'content'	=> '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"},"margin":{"top":"0px"}}},"layout":{"type":"constrained"},"fontSize":"small"} -->
<div class="wp-block-group alignfull has-small-font-size" style="margin-top:0px;padding-top:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small)">
<!-- wp:group {"align":"wide","layout":{"type":"flex","allowOrientation":false,"justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide">
<!-- wp:paragraph -->
<p>© ' .   esc_html( gmdate( 'Y' ) ). ' Your Company LLC</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="#">' .   esc_html__( 'Privacy Policy', 'lsx' ). '</a> · <a href="#">' .   esc_html__( 'Terms of Service', 'lsx' ). '</a> · <a href="#">' .   esc_html__( 'Contact Us', 'lsx' ). '</a></p>
<!-- /wp:paragraph -->
<!-- wp:social-links {"iconColor":"base","iconColorValue":"#fff","iconBackgroundColor":"contrast","iconBackgroundColorValue":"#000","className":"is-style-default","style":{"spacing":{"blockGap":"10px"}}} -->
<ul class="wp-block-social-links has-icon-color has-icon-background-color is-style-default">
<!-- wp:social-link {"url":"#","service":"facebook"} /-->
<!-- wp:social-link {"url":"#","service":"instagram"} /-->
<!-- wp:social-link {"url":"#","service":"twitter"} /-->
</ul>
<!-- /wp:social-links -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->',
);
