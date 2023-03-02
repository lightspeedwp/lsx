<?php
/**
 * Footer with text, links.
 */
return array(
	'title'	  => __( 'Footer Default ', 'lsx' ),
	'categories' => array( 'footer' ),
	'content'	=> '
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"},"margin":{"top":"0px"}}},"layout":{"type":"constrained"},"fontSize":"small"} -->
<div class="wp-block-group alignfull has-small-font-size" style="margin-top:0px;padding-top:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small)">
<!-- wp:group {"align":"wide","layout":{"type":"flex","allowOrientation":false,"justifyContent":"space-between"}} -->
<div class="wp-block-group alignwide">
<!-- wp:paragraph -->
<p>© ' .   esc_html( gmdate( 'Y' ) ). ' Your Company LLC · <a href="#">' .   esc_html__( 'Contact Us', 'lsx' ). '</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="#">Facebook</a> · <a href="#">Twitter</a> · <a href="#">Instagram</a></p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->',
);
