## LSX Changelog

### 2.1.2
* Dev - Removed the .hentry class from the `post_class` output
* Dev - Added in a .vcard schema for the author post meta
* Dev - Added in the .updated class for the hentry schema
* Dev - Removed the WooCommerce product form template and customized it via the `get_product_search_form` filter
* Dev - Removed the tabs.php file conflicting with WP updates.
* Dev - Changed the way the woocommerce pagination is styled.
* Dev - Removed the overwritten templates for the WC products and WC reviews widgets.

### 2.1.1
* Fix - Added the Sass files for child theme development
* Dev - Added in a filter to handle which post formats are forced to show the full content.
* Dev - Added in a filter to allow which post formats show a thumbnail
* Dev - Added in the Bacs Bank details on the WC "Thank You" page
* Dev - Allowing the cart to show on the Logged out menu as well.  (LSX Login and WooCommerce integration)

### 2.1.0
* Fix - Fixed conflict from global style affecting slick dots
* Fix - Removed the setting that turned LSX as LSX (itself) child theme
* Dev - Added new filter to disable the global pagination: lsx_paging_nav_disable
* Fix - Fixed blog/search results - Custom post type visual
* Fix - Fixed blog/search results - Botttom image only used by LSX Blog Customizer
* Fix - Added dynamic class to WooCommerce archive wrapper
* Tweak - WooCommerce mobile footer bar
* Fix - Fixed <main> close tag in WooCommerce archive
* Fix - Improve menu cart item visual
* Fix - Improve WooCommerce visual experience
* Tweak - New button class (red colours) for top menu: cta-red
* Tweak - Small changes to allow LSX Customizer to change WooCommerce cart menu item position
* Tweak - Small changes to allow LSX Customizer to change WooCommerce cart menu item style
* Tweak - Small changes to allow LSX Customizer to change WooCommerce My Account menu item
* Tweak - Add WooCommerce Wishlist compatibility
* Tweak - Add WooCommerce Smart Coupon compatibility
* Tweak - Add WooCommerce image lightbox effect compatibility
* Fix - Bootstrap modal z-index
* Tweak - Add WooCommerce image slider effect compatibility
* Tweak - Add WooCommerce Advanced Product Labels compatibility
* Tweak - Add WooCommerce Quick View compatibility
* Tweak - Add Sensei compatibility
* Tweak - Add The Events Calendar compatibility
* Tweak - Default colours scheme updated (top menu colors)
* Tweak - Change WooCommerce Bundle Product visual on single
* Tweak - Change WooCommerce Variation Swatches visual on single
* Tweak - Change WooCommerce Ship Multiple Addresses visual on single
* Fix - Remove WC Shipping Multiple Addresses specific script causing issues on checkout
* Tweak - Change WooCommerce Products Addon visual on single
* Tweak - Add WooCommerce Bookings compatibility
* Tweak - Add WooCommerce Product Reviews compatibility
* Tweak - Add WooCommerce thank you page template
* Tweak - Add The Events Calendar compatibility
* Fix - Make the menu background image full-width (infinite) when it is a 100% column
* Tweak - Add WooCommerce Subscriptions compatibility
* Tweak - Add WooCommerce Product Retailers compatibility
* Dev - Extended alert-danger Bootstrap class to alert-error class

### 2.0.0
* New totally awesome version! The visual was fully redesigned
* Dev - Restricting the #searchform so it does not submit empty searches
* Dev - Changed WordPress versions: Requires at least: 4.3, Tested up to: 4.8, Stable tag: 4.8
* Dev - New project structure
* Dev - Update CSS’s vendors structure
* Dev - Added .editorconfig specs for unifying the coding style for different editors and IDEs
* Dev - LSX extensions integration updated
* Dev - WooCommerce integration updated
* Dev - Caldera Forms integration updated
* Dev - Removed reference to glyphicons
* Dev - Modernizer lib removed
* Dev - Jetpack integration removed
* Dev - BudyPress integration removed
* Dev - Job Manager integration removed
* Dev - Tribe Events integration removed
* Dev - Sensei integration removed
* Dev - Removed from compiled Bootstrap: Glyphicons and Jumbotron
* Dev - Removed from compiled Bootstrap: Carousel
* Dev - Removed from compiled Bootstrap: Advanced buttons, Carousel, Affix
* Dev - Removed from compiled Bootstrap: Breadcrumbs, Pagination, Progress Bars, List Groups, Wells
* Dev - New filter available (for LSX Blog Customizer): lsx_blog_display_text_on_list
* Dev - New global class .lsx-full-width-base
* Dev - New global class .lsx-full-width-base-small
* Dev - New global class .lsx-title
* Dev - New template full-width-no-margins
* Fix - Fixed the display of top menu right without the top menu left
* Fix - Fixed issues from GitHub (many issues)
* Fix - Fixed issues from Code Sniffer (PHP and WordPress)
* Tweak - Added WordPress core pagination
* Tweak - Load RTL style from child theme
* Tweak - Added selective refresh in the LSX Customizer options
* Tweak - Added LSX Sharing integration
* Tweak - Fonts optimization (try first load theme fonts; only after - if necessary - load google fonts)
* Tweak - Enabled shortcode for text widget

### 1.8.5
* Fix - Footer widgets changed breakpoint
* Fix - Keep default behaviour from sliders on mobile
* Fix - Adjusted content.php to be more flexible for styles (LSX Blog Customizer requirement)
* Fix - Small adjust on post archive - post item footer style
* Fix - Fixed post author when 'get_the_author' is not available
* Fix - Fixed breadcrumb display position on archive.php, author.php and search.php
* Fix - Small issue (style) with Pagenavi pagination
* Fix - Fixed CSS enqueue (parent > child themes)
* Fix - Removed remove_filter: the_excerpt/wpautop
* Fix - Small Sass files change (wiyhout affect CSS)

### 1.8.4
* Fix - Re-added the get_comments_number() fix

### 1.8.3
* Fix - Removed custom image classes from avatar in admin bar
* Fix - Top menu dropdown in large screens (first level link didn’t works)
* Fix - Moved the get_comments_number() out of the empty() statement, causing a Fatal PHP Error

### 1.8.2
* Fix - Enabled compatibility between LSX Banners (Soliloquy) and LSX Theme
* Fix - Enabled compatibility between LSX Blog Customiser (categories BS carousel) and LSX Theme
* Fix - Enabled compatibility between LSX Blog Customiser (display full content on blog pages) and LSX Theme
* Fix - Enabled compatibility between LSX Blog Customiser (display grid layout on blog pages) and LSX Theme
* Fix - Added a JavaScript option to avoid hide top menu on scroll
* Fix - Adjusted the next/previous post navigation (wider columns)
* Fix - Adjusted comment author thumbnail display

### 1.8.1
* Fix - Avoided use a return function inside the PHP function "empty" (compatibility with PHP 5.5 and lower)
* Fix - Compatibility with WPML 3.6
* Fix - Fixed Sensei redirect for lessons archive
* Feature - Starter content (new feature available in WordPress 4.7)

### 1.8.0
* Made LSX compatible (visual) with Ninja Forms
* Made LSX compatible with LSX Blog Customizer (plugin)
* Made LSX compatible (visual) with LSX Banners new feature: background videos
* Spinning preloader: added an option to enable/disable it in WP Customizer
* Customizer Colors: fixed/implemented several CSS/SASS selectors
* Main menu: made highlight items use button CTA colours
* Main menu: small caret style fix for wider menu items
* Main menu: float to right always the last menu item with dropdown
* Top menu: implemented style for WPML (plugin)
* Top menu: added the social icons as social menu at the bottom
* Breadcrumbs: small fix in visual
* Search results: small fix in visual
* Blog/archive sticker (featured): small fix in position
* Improved the mobile navigation and header display
* In excerpts (only in posts lists), allowed these tags: <blockquote>,<p>,<br>,<b>,<strong>,<i>,<u>,<ul>,<li>,<span>,<div> (all others will be removed)
* Made some fixes for W3C HTML validation
* Removed TGM (plugin) feature
* Changed the site width (WordPress variable) from 750 to 1140
* Customizer Colors: print the custom styles in <head> (moved from <body>)
* Customizer Colors: improve the performance in front-end
* Customizer Colors: implement the CSS inline using SCSS
* Code sniffers: Travis CI configured
* Code sniffers: fixed the code sniffers alerts (basic alerts)
* Badges: added two badges (Travis CI deploy; Gulp.js)
* Updated WooCommerce assets to the latest version (version 2.6.4)
* Updated FontAwesome to the latest version (version 4.6.3)
* Updated Bootstrap to the latest version (version 3.3.7)
* Added in a lsx_get_template_part function, which check for templates in a plugin before it loads the usual templates
* Added in a lsx_sidebar_enable filter so that plugins and child themes can disable the sidebar by force if they need to
* Parallax banner: fixed parallax effect (doesn't run it when don't exist a image and container)
* LSX Banners: making LSX compatible with new LSX Banners slider
* Enabled extra attributes (srcset, sizes) in img tag (add_filter: wp_kses_allowed_html)
* Uses the theme version to add the styles and scripts resources
* Removed WP Customizer prompt for empty main navigation
* Moved Customizer Colors to a plugin (LSX Customizer)
* Made theme and Give core and recurring donations compatible
* Increased the limit from pages to display in sitemap
* Adjusted LSX border button size
* Created a welcome page
* Added a new menu option: top menu (left)

### 1.7.3
* Removed blue banner (with title) from the homepage (always)
* Added a wrap in banner to fix IE10/11 vertical alignment
* Small fix: removed height:auto from default images
* Small fixes in customizer colours: improved selectors
* Fixed customizer colours: live changes were not working

### 1.7.2
* Envira Gallery: added "Lazy Load Images" to Envira Gallery
* Default pagination: fixed wrap spacing
* Bootstrap: removed "!important" from some general classes
* Responsive: added new class for buttons full width in mobile (btn-mobile-fullwidth)
* LSX Mega Menus: created compatibility with LSX Mega Menus plugin
* Removed blue banner (with title) from the homepage (always)
* Added gulp command to auto-generate WordPress language files (gulp wordpress-lang)
* Added option to use LSX Mega Menus in Top Menu
* General small fixes

### 1.7.1
* Customizer colour swatch: printing the custom styles in footer
* Customizer colour swatch: fixed the box-shadow color from articles in blog pages
* Lazy Loading Images: added a class to bypass a image
* Lazy Loading Images: improved the regular expressions for only replace the images with source
* Lazy Loading Images: added an option in WP admin to enable/disable it
* Banners: resolved conflict between LSX Banners and LSX
* Fixed with fallback: for some reason sometimes wp_get_attachment_image_srcset fails
* Added in a filter to remove the "Custom Fields" meta box
* Two new hooks/actions added in all layouts: lsx_content_wrap_before and lsx_content_wrap_after
* Fixed: sometimes the image banner show up without an image set
* Titles for pages and posts standardised

### 1.7.0
* Added a colour swatch to customizer
* Added in a conditional statement so the footer widgets container does not show unless there are widgets active
* Removed the deprecated tags (readme, style)
* Added a filter to excerpt (what post types show excerpt or full content)
* Improved title styling when no featured image is set
* Fixed a bug with the banner paralax type scrolling and the LSX TO Plugin Banner Google Map
* Fixed a problem with CSS z-index (Footer CTA conflicting with Banner)
* Fixed HTML input styles (missing textarea and input:email)
* General small fixes
* Added Lazy Loading Images
* Speed Optimization: minified all script and style files
* Removed unnecessary Google font file

### 1.6.2
* Added a conditional statement so the footer widgets container does not show unless there are widgets active
* Page 404: fixed big gap below the banner when the main menu is not fixed
* Fixed comment reply
* Post (single): improved sharing experience in small devices
* Fixed paginated posts
* Post (archive): anchored the comments counter to comments section in single post
* Post (single): the tags could use more space to the right before wrapping onto a second line
* Post (archive, single): fixed long title
* Improved grandchild menu item
* Fixed in small screens the easing scroll with big content banner
* Improved (fixed) spacing below the posts list and single post
* Changed (Jetpack) related posts headline to "Related Posts"
* Fixed the email sharing (modal) on mobile
* Improved vertical alignment in homepage banner	

### 1.6.1
* Fixed Bootstrap modal in small devices (< 768px)
* Changed the meta viewport to recommended solution for mobile
* Cleared out unused image files in /img folder
* Fixed font customizer
* Fixed title display in homepage
* Fixed lateral paddings in all pages

### 1.6
* New global loading.
* New top banner (code refactored, parallax).
* Restoring compatibility with WPML
* Improve visual from Bootstrap Carousel
* Show custom post format content in excerpt (posts list)
* New blog archive and single template design
* Added Glyphicons resources (icons font from Bootstrap)
* Removed Genericons, switched to Font Awesome
* Removed LST styles (custom styles from a deprecated plugin)
* Removed extra stylesheets for the colour schemes and removed the customizer option
* Defer parsing of JavaScript to allow visual elements to be loaded first
* Removed Soliloquy homepage slider code
* IE 11: fixed issues (banner alignment)
* IE 11: polyfill for img[srcset]
* Bootstrap Modal: increase size of modal close button
* Home banner: in home banner, check if the WP admin bar is enable to decrease 32px in banner height
* Sensei: fix pages (lessons) divisors
* Sensei: fix pages with breadcrumb
* Home parallax: improve parallax effect
* Nav menu: always require the CSS for nav menu (small screens devices)
* Nav menu: use the correct window.width information

### 1.5.2
* Updated the readme.txt
* Fixed Bootstrap HTML structure
* Fixed Bootstrap mediaqueries
* Fixed height from items without image in Portfolio (Jetpack)
* Removed old page templates (metaplates)
* Fixed the fixed menu behavior
* Fixed the removal "Footer Widgets" title
* Fixed main menu behavior in small screens
* Fixed the active menu state for second level main menu
* Fixed third level main menu dropdowns
* Added RDFA markup for breadcrumbs

### 1.5.1
* Updated the readme.txt file with the Workflow Changes
* Fixed the missing breadcrumbs on post type archives by removing the is_archive() conditional call.
* Removed help.txt and install.txt, they have been included in the readme files.
* Fixed the duplicate logo and the duplicate nav menus with child themes.
* Fixed the display of the single breadcrumbs and the styling of the archives breadcrumbs
* Fixed the support of the WordPress Custom Logo 

### 1.5
* Added in support for the following plugins, with their own stylesheets.
 * Jetpack
 * Soliloquy Slider
 * Envira Gallery 
 * WP Job Manager
 * WooCommerce
 * Sensei
* Support added for new WordPress 4.5 Site Logo
* Add backwards compatibility for Jetpack Site Logo
* Updated the Development workflow to only use Node and Gulp,  Bower is no longer needed. (see the readme for details)
* Fixed the Display of the Breadcrumbs
* Fixed the display of images in a blog post set to full width - https://github.com/lightspeeddevelopment/lsx/issues/33
* Fixed the primary nav toggle displaying if no menu has been assigned - https://github.com/lightspeeddevelopment/lsx/issues/34
* Removed the Footer Widget title - https://github.com/lightspeeddevelopment/lsx/issues/37
* Added in support for third level dropdowns - https://github.com/lightspeeddevelopment/lsx/issues/16

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
