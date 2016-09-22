# LSX
* Contributors: the LightSpeed team
* Author: LightSpeed
* Author URI: https://www.lsdev.biz/
* Theme Name: LSX
* Theme URI: https://www.lsdev.biz/product/lsx-wordpress-theme/
* Tags: one-column, two-columns, left-sidebar, right-sidebar, custom-background, custom-colors, custom-menu, editor-style, featured-images, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
* Requires at least: 4.5
* Tested up to: 4.5.2
* Stable tag: 4.5.2
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

LSX is a fully responsive theme that’s built with clarity in mind. Instead of flooding you with an overwhelming amount of theme
options, LSX keeps it clear and help you make decisions. Its lightweight build ensures better load times, a bonus for both user
experience and SEO.

LSX has been designed to be minimal and lean, while still having rich customizer options, like allowing you to control fonts, color
options, home page configuration, widget areas and much more.

It’s a great choice for your next WooCommerce project, supporting the eCommerce plugin beautifully out the box. 

LSX also supports a variety of other top quality plugins like Sensei, WP Job Manager and JetPack. 

## Installation

* In your admin panel, go to Appearance -> Themes and click the Add New button.
* Alternatively you can download the file, unzip it and move the unzipped contents to the "wp-content/themes" folder of your WordPress installation. You will then be able to activate the theme.
* Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
* Click Activate to use your new theme right away.

## Documentation & Support

Theme documentation is available on https://www.lsdev.biz/documentation/lsx/ 

Support - https://www.lsdev.biz/contact-us/ 

## Frequently Asked Questions

### How do I change the color scheme?

You can change the colors of your site really easily using LSX.

1. In your admin panel, go to Appearance -> Customize.
4. Now you will see the Customizer and a tab called 'Colors'. Click this tab.
5. You can now change your color scheme by selecting one of the predefined ones. Choose a color scheme you want from Base Color Scheme dropdown. You can preview the change in the Customizer.
6. Once you are happy with your color changes you can click save and your changes will be reflected on your live site.

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
`add_action('lsx_body_top','your_function_name'); 
`function your_function_name() { echo 'content'; }


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
		
		lsx_banner_content();
	
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

'lsx_allowed_post_type_banners' - receives 1 parameter, allow you 'enable' the banners on any custom post types you have registered.
`$post_types = array('post','page');
 
'lsx_thumbnail_size' - receives 1 parameter, allows you to change the size of the thumbnail being called. Without having to edit the templates.
`$size = 'lsx-thumbnail-wide' or array('width','height');`
 
'lsx_wp_nav_menu_item' - receives 1 parameter, allows you to change the HTML output of a nav item.
`$item_html = <a href="#">Home</a>;
 
'lsx_archive_column_number' - receives 1 parameter, allows you to change the number of columns on a masonry layout.
`$column = 3;`
 
'lsx_post_navigation_labels' - receives 1 parameter, allows you to change the posts navigation text.
`$labels = array(
		'next' 		=> '<span class="meta-nav">&larr;</span> '.__( 'Older posts', 'lsx' ),
		'previous' 	=> __( 'Newer posts', 'lsx' ).' <span class="meta-nav">&rarr;</span>',
		'title' 	=> __( 'Posts navigation', 'lsx' )
	);`
	
'lsx_customizer_controls' - receives 1 parameter, allows you to add and remove Customizer options, You can see examples of different customizer field in 'functions.php line 32'. 
`$lsx_controls = array();`

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

### 3: Install Composer

Run the following two commands, this will install all the Composer Modules. 

This you need to do while inside the themes directory.
`curl -sS https://getcomposer.org/installer | php`
 
Wait for the terminal to finish and test by running
`php composer.phar install`

## Development Workflow
 
### Components Upgrade
Please note,  you will only ever run this to upgrade the vendor packages we use.  Otherwise you dont need these as the minified version of these are included in the theme.

CD to the themes directory, if you are not there already.  You will be working in here from now on.
 
#### Step 1
This part we actualy use Gulp to move and concatenate the files we need. So run the command below,  to read the package.json and download the "node_modules".
`npm install`
 
#### Step 2
Here is finally where we use gulp,  there are a few tasks set up.
`gulp upgrade-components`
 
This will do the following

 * Grab the Sass files from the components folder and move them into /sass/bootstrap/ so app.css can use the mixins
 * Concatenate and Minify all of the bootstraps js file and moves them into /js/ as scripts.min.js 

#### Install a new component for Node
Change bootstrap to the name of the component here - https://www.npmjs.com/
Its important to have the parameter --save,  so it save the package and version of the componenet to the package.json file.
`npm install bootstrap --save`

## Developer Help - Usefull Gists

### Banners

 * Enable banners on custom post types - https://gist.github.com/krugazul/5eeb9482160a43f7afdb 
 * Add aditional content to the banner - https://gist.github.com/krugazul/7d855205857b76887094 

### Templates

 * Redirect a user to a login form if they are logged out (with template) - https://gist.github.com/krugazul/e92749510d31d4a10906

## Resources
* WP-Bootstrap-Navwalker (https://github.com/twittem/wp-bootstrap-navwalker) licensed under the GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* Bootstrap (http://getbootstrap.com/) licensed under MIT license (https://github.com/twbs/bootstrap/blob/master/LICENSE)
* Font Awesome (http://fontawesome.io/) licensed under SIL OFL 1.1 (http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL)
* lazysizes (https://github.com/aFarkas/lazysizes) licensed under MIT license (https://github.com/twbs/bootstrap/blob/master/LICENSE)
