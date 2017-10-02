[![built with gulp.js](https://img.shields.io/badge/built%20with-gulp.js-green.svg)](http://gulpjs.com/)
[![build status](https://travis-ci.org/lightspeeddevelopment/lsx.svg?branch=master)](https://travis-ci.org/lightspeeddevelopment/lsx)
[![Code Climate](https://codeclimate.com/github/lightspeeddevelopment/lsx/badges/gpa.svg)](https://codeclimate.com/github/lightspeeddevelopment/lsx)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lightspeeddevelopment/lsx/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lightspeeddevelopment/lsx/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/lightspeeddevelopment/lsx/badge.svg?branch=master)](https://coveralls.io/github/lightspeeddevelopment/lsx?branch=master)

# LSX
* Contributors: the LightSpeed team
* Author: LightSpeed
* Author URI: https://www.lsdev.biz/
* Theme Name: LSX
* Theme URI: https://www.lsdev.biz/product/lsx-wordpress-theme/
* Tags: one-column, two-columns, left-sidebar, right-sidebar, custom-background, custom-colors, custom-menu, editor-style, featured-images, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
* Requires at least: 4.7
* Tested up to: 4.7.4
* Stable tag: 4.7.4
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

LSX is a light-weight, minimalistic and responsive WordPress theme that allows users to create fast, efficient and attractive websites that are feature-rich. We've built it to be fully compatible with WooCommerce, making it an ideal choice for your next eCommerce build. Its lightweight build ensures better load times, a bonus for both user experience and SEO.

LSX has been designed to be minimal and lean, while still having rich customizer options, like allowing you to control fonts, color options, home page configuration, widget areas and much more.

## Installation

* In your admin panel, go to Appearance -> Themes and click the Add New button.
* Alternatively you can download the file, unzip it and move the unzipped contents to the "wp-content/themes" folder of your WordPress installation. You will then be able to activate the theme.
* Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
* Click Activate to use your new theme right away.

## Documentation & Support

You can find documentation for the theme and its various extensions below: 

* [LSX Core](https://www.lsdev.biz/documentation/lsx/)
* [Banners](https://www.lsdev.biz/documentation/lsx-banners/)
* [Currencies](https://www.lsdev.biz/documentation/lsx-currencies/)
* [Customizer](https://www.lsdev.biz/documentation/lsx-customizer/)
* [Mega Menus](https://www.lsdev.biz/documentation/lsx-mega-menus/)
* [Team](https://www.lsdev.biz/documentation/lsx-team/)
* [Testimonials](https://www.lsdev.biz/documentation/lsx-testimonials/)

For support please [contact us](https://www.lsdev.biz/contact-us/).

## Frequently Asked Questions

### How do I add the social links to the sidebar?

LSX allows you display links to your social media profiles, like Twitter and Facebook, with icons.

1. Create a new Custom Menu, and assign it to the Social Links Menu location.
2. Add links to each of your social services using the Links panel.
3. Icons for your social links will automatically appear if it’s available.
4. The menu appears in the footer.

Available icons: (Linking to any of the following sites will automatically display its icon in your social menu).

* Codepen
* Digg
* Dribbble
* Dropbox
* Facebook
* Flickr
* Foursquare
* GitHub
* Google+
* Instagram
* LinkedIn
* Email (mailto: links)
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (urls with /feed/)
* Spotify
* StumbleUpon
* Tumblr
* Twitch
* Twitter
* Vimeo
* WordPress
* YouTube

Social networks that aren't currently supported will be indicated by a generic share icon.

## Quick Specs 

* The main content width is 750px
* The sidebar width is 360px
* Featured Images are 750px wide by 300px high
* Portfolio feature images are 360px wide by 270px high
* Portfolio single gallery images are minimum 1140px wide

## Hooks / Actions
```
add_action('lsx_body_top','your_function_name');
function your_function_name() { echo 'content'; }
```

Below is a layout of where the actions are located, so you can easily position you HTML.
```
<head>

	lsx_head_top();
	
	lsx_head_bottom();
	
</head>

<body>

	lsx_body_top();
		
	lsx_header_before();
	
		<header>
		
			lsx_header_top();
			
				lsx_nav_before();
				
				lsx_nav_after();
			
			lsx_header_bottom();
	
		</header>
	
	lsx_header_after();
		
		lsx_content_wrap_before();
		
		<div id="primary">
		
			lsx_content_before();
			
				<main id="main">
				
					lsx_content_top();
					
					lsx_entry_before();
					
						<article>
						
							lsx_entry_top();
							
							lsx_entry_bottom();
						
						</article>
						
					lsx_entry_after();
					
					lsx_comments_before();
						<section id="comments">
						</section>
 					lsx_comments_after();
											
					lsx_content_bottom();
					
				</main>
			
			lsx_content_after();
		
		</div>

		lsx_content_wrap_after();
		
		lsx_sidebars_before();
		
			<div id="secondary">
			
				lsx_sidebar_top();
				
 				lsx_sidebar_bottom();
 				
			</div>
			
 		lsx_sidebars_after();
 		
 		
 		lsx_footer_before();
 			
 			<footer>
 			
 				lsx_footer_top();
 				
 				lsx_footer_bottom();
 			
 			</footer>
 			
 		lsx_footer_after();
	
	lsx_body_bottom();
	
</body>
```

## Filters

`lsx_layout`

`lsx_lazyload_is_enabled`

`lsx_lazyload_placeholder_image`

`lsx_the_excerpt_filter_post_types`

`lsx_sidebar_enable`

`lsx_blog_force_content_on_list`

`lsx_blog_layout`

`lsx_breadcrumbs`

`lsx_bootstrap_column_size`

`lsx_allowed_post_type_banners` - receives 1 parameter, allow you 'enable' the banners on any custom post types you have registered. `$post_types = array('post','page');`
 
`lsx_thumbnail_size` - receives 1 parameter, allows you to change the size of the thumbnail being called. Without having to edit the templates. `$size = 'lsx-thumbnail-wide' or array('width','height');`
 
`lsx_wp_nav_menu_item` - receives 1 parameter, allows you to change the HTML output of a nav item. `$item_html = <a href="#">Home</a>;
 
`lsx_archive_column_number` - receives 1 parameter, allows you to change the number of columns on a masonry layout. `$column = 3;`
 
`lsx_post_navigation_labels` - receives 1 parameter, allows you to change the posts navigation text.
```
$labels = array(
	'next' 		=> '<span class="meta-nav">&larr;</span> '.__( 'Older posts', 'lsx' ),
	'previous' 	=> __( 'Newer posts', 'lsx' ).' <span class="meta-nav">&rarr;</span>',
	'title' 	=> __( 'Posts navigation', 'lsx' )
);
```
	
`lsx_customizer_controls` - receives 1 parameter, allows you to add and remove Customizer options, You can see examples of different customizer field in 'functions.php line 32'. `$lsx_controls = array();`

`lsx_credit_link`

## Setup

 * Open your terminal
 * Open another terminal tab, and use "sudo bash" to log in as the administrator.
 * Always have a terminal window open.

### 1: Install Node.js

This is also know as Node Package Manager, this is what we will use to install Gulp
 
 * First test to see if you have Node installed already, run "npm -v".
 * You will either see a version number, or it will comlain and say Node isnt installed.
 * If its not installed, run "sudo npm install npm -g".

### 2: Install Gulp

Run the following two commands, this will install all the Node Modules including Gulp. 

This you need to do while inside the themes directory.
`npm install`
 
Wait for the terminal to finish and test by running
`gulp`

## Developer Help - Usefull Gists

### Banners

 * Enable banners on custom post types - https://gist.github.com/krugazul/5eeb9482160a43f7afdb 
 * Add aditional content to the banner - https://gist.github.com/krugazul/7d855205857b76887094 

### Templates

 * Redirect a user to a login form if they are logged out (with template) - https://gist.github.com/krugazul/e92749510d31d4a10906

## Third-party resources

* [WP-Bootstrap-Navwalker](https://github.com/twittem/wp-bootstrap-navwalker) is licensed under the terms of the GNU GPL, Version 3
* [Bootstrap](http://getbootstrap.com/) is licensed under the terms of the MIT license
* [Font Awesome](http://fontawesome.io/) icons are licensed under the terms of the SIL OFL 1.1, and code licensed under the terms of MIT License
* [Modernizr](https://modernizr.com/) is licensed under the terms of the MIT license
* [imagesLoaded](http://imagesloaded.desandro.com/) is licensed under the terms of the MIT license
* [ScrollToFixed](https://github.com/bigspotteddog/ScrollToFixed) is licensed under the terms of the MIT license
* [Picturefill](https://scottjehl.github.io/picturefill/) is licensed under the terms of the MIT license
* [lazysizes](https://github.com/aFarkas/lazysizes) is licensed under MIT license
