<?php
/**
 * Pricing table block pattern
 */
return array(
	'title'      => __( 'Pricing table', 'lsx' ),
	'categories' => array( 'featured', 'columns', 'buttons' ),
	'content'    => '<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"100%"} -->
<div class="wp-block-column" style="flex-basis:100%"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"100%"} -->
<div class="wp-block-column" style="flex-basis:100%"><!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"","style":{"spacing":{"padding":{"top":"20px","right":"10px","bottom":"20px","left":"10px"}},"border":{"width":"0px","style":"none"}},"gradient":"very-light-gray-to-cyan-bluish-gray","layout":{"inherit":false}} -->
<div class="wp-block-column has-very-light-gray-to-cyan-bluish-gray-gradient-background has-background" style="border-style:none;border-width:0px;padding-top:20px;padding-right:10px;padding-bottom:20px;padding-left:10px"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"black","fontSize":"large"} -->
<h3 class="has-text-align-center has-black-color has-text-color has-large-font-size"><strong>Free</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>$0</strong>/<em>Month</em></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" />
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>- Lorem Ipsum<br>- Pellentesque malesuada<br>- Maecenas vel velit<br>- Nam molestie<br>- Phasellus in turpis</strong><br><strong>- Nunc ornare enim</strong></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"spacing":{"padding":{"top":"10px","right":"25px","bottom":"10px","left":"25px"}},"border":{"radius":"50px"}},"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link" style="border-radius:50px;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">Buy Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"","style":{"spacing":{"padding":{"top":"20px","right":"10px","bottom":"20px","left":"10px"}},"border":{"width":"0px","style":"none"}},"gradient":"very-light-gray-to-cyan-bluish-gray","layout":{"inherit":false}} -->
<div class="wp-block-column has-very-light-gray-to-cyan-bluish-gray-gradient-background has-background" style="border-style:none;border-width:0px;padding-top:20px;padding-right:10px;padding-bottom:20px;padding-left:10px"><!-- wp:heading {"textAlign":"center","level":3,"textColor":"black","fontSize":"large"} -->
<h3 class="has-text-align-center has-black-color has-text-color has-large-font-size"><strong>Premium</strong></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>$50</strong>/<em>Month</em></p>
<!-- /wp:paragraph -->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide" />
<!-- /wp:separator -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><strong>- Lorem Ipsum<br>- Pellentesque malesuada<br>- Maecenas vel velit<br>- Nam molestie<br>- Phasellus in turpis</strong><br><strong>- Nunc ornare enim</strong></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"style":{"spacing":{"padding":{"top":"10px","right":"25px","bottom":"10px","left":"25px"}},"border":{"radius":"50px"}},"className":"is-style-fill"} -->
<div class="wp-block-button is-style-fill"><a class="wp-block-button__link" style="border-radius:50px;padding-top:10px;padding-right:25px;padding-bottom:10px;padding-left:25px">Buy Now</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->',
);
