# LSX
* Contributors: the LightSpeed team
* Author: LightSpeed
* Author URI: https://www.lsdev.biz/
* Theme Name: LSX
* Theme URI: https://www.lsdev.biz/project/lsx/
* Tags: black, blue, gray, white, one-column, two-columns, left-sidebar, right-sidebar, fixed-layout, responsive-layout, custom-background, custom-colors, custom-menu, editor-style, featured-images, post-formats, rtl-language-support, sticky-post, threaded-comments, translation-ready
* Requires at least: 4.1
* Tested up to: 4.4.1
* Stable tag: 4.4.1
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description
LSX is a clean, modern, minimal and fully responsive parent theme that is ideal for developers looking for a Bootstrap parent theme.
 
LSX has been designed to be minimal and lean, while still having rich features and customizability options, such allowing you to control fonts, color options, home page configuration and much more.
 
The theme is built using Twitter Bootstrap 3 and Underscores by Automattic, which ensure that sites built with LSX put your content front and center and are responsive and mobile friendly.  Its lightweight build ensures better load times, a bonus for both user experience and SEO.
 
LSX comes out the box with a complete set of page templates that are intuitively named so that you can get that particular layout you need when creating your pages without having to labour through formatting.
 
* Responsive Layout
* Custom Colors
* Custom Background
* Social Links
* Menu Description
* Post Formats
* The GPL v2.0 or later license.

## Installation

* In your admin panel, go to Appearance -> Themes and click the Add New button.
* Alternatively you can download the file, unzip it and move the unzipped contents to the "wp-content/themes" folder of your WordPress installation. You will then be able to activate the theme.
* Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
* Click Activate to use your new theme right away.

## Page Templates

* Sitemap
* Archives
* Full width layout

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

## Documentation & Support

Theme documentation is available on hhttps://www.lsdev.biz/lsx/documentation/ 

Support - https://www.lsdev.biz/contact-us/ 

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
'lsx_allowed_post_type_banners' - receives 1 paramter, allow you 'enable' the banners on any custom post types you have registered.
`$post_types = array('post','page');
 
'lsx_thumbnail_size' - receives 1 paramter, allows you to change the size of the thumbnail being called. Without having to edit the templates.
`$size = 'lsx-thumbnail-wide' or array('width','height');`
 
'lsx_wp_nav_menu_item' - receives 1 paramter, allows you to change the HTML output of a nav item.
`$item_html = <a href="#">Home</a>;
 
'lsx_archive_column_number' - receives 1 paramter, allows you to change the number of columns on a masonry layout.
`$column = 3;`
 
'lsx_post_navigation_labels' - receives 1 paramter, allows you to change the posts navigation text.
`$labels = array(
		'next' 		=> '<span class="meta-nav">&larr;</span> '.__( 'Older posts', 'lsx' ),
		'previous' 	=> __( 'Newer posts', 'lsx' ).' <span class="meta-nav">&rarr;</span>',
		'title' 	=> __( 'Posts navigation', 'lsx' )
	);`
	
'lsx_customizer_controls' - receives 1 paramter, allows you to add and remove Customizer options, You can see examples of different customizer field in 'functions.php line 32'. 
`$lsx_controls = array();`
 

## Gulp + Bower Files 
 * Open your terminal
 * Open another terminal tab, and use "sudo bash" to log in as the administrator.
 * Always have a terminal window open.

## Setup
If you have Gulp and Bower installed already. Skip the next 2 steps.

### 1: Install Node.js
This is also know as Node Package Manager, this is what we will use to install Gulp and Bower
 
 * First test to see if you have Node installed already, run "npm -v".
 * You will either see a version number, or it will comlain and say Node isnt installed.
 * If its not installed, run "sudo npm install npm -g".

### 2: Install Bower
Run the following two commands,   this will install Gulp and Bower. 

This you can do from any directory,  it is installing the files GLOBALY,  so you can run Gulp and Bower command inside different project folders 
`npm install -g bower`
 
Wait for the terminal to finish and test by running
`bower -v`

NB: GULP we will download on a per project basis, this is how it works.


## Development Workflow
There are two types terminal scripts you can run on the LSX theme

 * Firstly,  if you want to upgrade bootstrap or the components that LSX uses, follow the "Bower Componenets" heading.
 * Secondly,  if you want to minify/write the themes custom JS and SASS files. Follow the "Gulp Componenets" heading.
 
### Bower Components Upgrade
Please note,  you will only ever run this to upgrade the vendor packages we use.  Otherwise you dont need these as the minified version of these are included in the theme.

CD to the themes directory, if you are not there already.  You will be working in here from now on.

#### Step 1
Run the command below in your terminal window,  this will read the bower.json file in the theme and download the list of components (e.g bootstrap).
`bower install`
 
#### Step 2
This part we actualy use Gulp to move and concatenate the files we need. So run the command below,  to read the package.json and download the "node_modules".
`npm install`
 
#### Step 3
Here is finally where we use gulp,  there are a few tasks set up.
`gulp upgrade-components`
 
This will do the following

 * Grab the Sass files from the components folder and move them into /sass/bootstrap/ so app.css can use the mixins
 * Concatenate and Minify all of the bootstraps js file and moves them into /js/ as scripts.min.js 
 
#### Install a new component for bower
Change bootstrap to the name of the component here - http://bower.io/search/
Its important to have the parameter --save,  so it save the package and version of the componenet to the bower.json file.
`bower install bootstrap --save`
 
### Gulp Componenets
Run the command below in your terminal window,  this will install the sass and unminified Bootstrap 
`bower install`


## Developer Help - Usefull Gists

### Banners

 * Enable banners on custom post types - https://gist.github.com/krugazul/5eeb9482160a43f7afdb 
 * Add aditional content to the banner - https://gist.github.com/krugazul/7d855205857b76887094 
 
### Templates

 * Redirect a user to a login form if they are logged out (with template) - https://gist.github.com/krugazul/e92749510d31d4a10906


## Changlog
### 1.4.2
* Added in three missing text encapsulations
* Fixed the background image size on single Jetpack Portfolio pages.
* Fixed the active state highlighting for 2nd tier menu items.
* Removed the unused 'Footer Widgets' title and CSS

### 1.4.1
* Fixed the Fatal error with the Caldera forms class
* Fixed the output of the lsx-thumbnail-single and lsx-thumbnail-wide size
* Fixed the styling of the WPML Language switcher dropdown

### 1.4
* Added in a "Continue Reading" link for excerpts.
* Added in the singular.php template
* Added support for the WordPress Responsive images.
* Fixed the Post Format Link handeling
* Fixed the post meta not showing on a custom homepage (child theme)
* Fixed the archive layout support when BuddyPress is active.
* Fixed the mobile nav menu toggle text in the orange color scheme
* Fixed the Mobile menu showing up when no Primary menu is assigned
* Fixed various translatable string errors.
* Removed the Page Hero Page template
* Removed our custom code that controls responsive images.
* Renamed the Full Width Narrow template to No Sidebar.
* Renamed content-single.php to content-post.php
* Renamed the Color Scheme CSS files with a "color-scheme-prefix"


### 1.3
* Added in support for 'post formats'.
* Improved Blog Template Styling; Single, Archive and Author pages.
* Updated Responsive CSS for all templates.
* Updated the Colour Scheme stylesheets.
* Renamed the scripts being included more intuitively.
* Removed unused JS and CSS files.
* Added in a Customizer option to create a "Fixed" header.
* Added in a Page Template "Metaplate".
* Fixed RTL styling fixes for the various header layouts
* Added in translation encapsulation for missing strings.
* Added in support for BuddyPress Pages (forced to 1 column)

### 1.2.4
* Removed the unused readme.txt in the languages directory.
* Fixed responsive header CSS and JS
* Added more styles to the Colour Scheme CSS files.

### 1.2.3
* Removed the Genericons example.html file for Security Reasons

### 1.2.2
* Responsive Layouts
* The portfolio column layout for masonry on tablet and mobile.

### 1.2.1
* Updated the ScreenShot
* The including of the genericons from the parent theme (for child themes)
* Removed extra class code from the lsx_avatar function
* Fixed the Masonry layout selecting different column layouts.
* Added in an info box for the naviagation panel
* Added in the sidebar for the sitemap template, and changed the amount of items called through on each section.


### 1.2
* Fixed the mixed content warning for the Google Fonts API calls.
* Fixed the banner responsive JS on single posts
* Fixed the Isotope filtering using the Packery Library
* Changed the names of the Google Font Classes
* Stoped the page banner from showing on the Homepage if the Reading settings are set to show a static page. 
* Fixed the banner class for the body tag, no longer show up on all pages.
* Fixed the header layout customiser js, and moved it into the "Layouts" Panel
* Changed the content_width for the single 'jetpack-portfolio' post type to 1140px
* Fixed the blog images not triggering on jetpack infinite scroll loading
* Isotope jQuery Library 2.1.1
* Set the Jetpack Portfolio post type archive to only call portfolio items that have a featured image set. i.e. Complete
* Packery jQuery Library 1.1.1
* WordPress Customizer options for controlling the layout of the header
* Added in a filter 'lsx_allowed_post_type_banners' so child themes can add banner support for additional post types.
* Added in a filter 'lsx_post_navigation_labels' which allows you to edit the labels outputted on the post type archive.

### 0.1
* First Version

## Upgrade Notice

### 1.2.4
* Upgrade to remove the security related bug with the Genericons Example.html file.

## Resources
* WP-Bootstrap-Navwalker (https://github.com/twittem/wp-bootstrap-navwalker) licensed under the GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* Bootstrap (http://getbootstrap.com/) licensed under MIT license (https://github.com/twbs/bootstrap/blob/master/LICENSE)
* Genericons (http://genericons.com/) licensed under the GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html) 