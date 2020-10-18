# LSX Theme Changelog

# [[2.9.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.9.0) - 17-10-2020

### Added

- [#425](https://github.com/lightspeeddevelopment/lsx/issues/425) Added support for native Lazy-loading images on WordPress 5.5 version.
- [#384](https://github.com/lightspeeddevelopment/lsx/issues/380) Added "Cover Template" page template with customizer options for alt image, colours. Displays title, post meta & excerpt.
- [#364](https://github.com/lightspeeddevelopment/lsx/issues/364) Added support for LSX Search & FacetWP filtering on all the Blog archive layouts.
- [#366](https://github.com/lightspeeddevelopment/lsx/issues/366) Added support for the Mix and Match Woocommerce plugin.
- Added in a filter `lsx_layout_customizer_controls` to allow 3rd party plugins to inject layout customizer controls.
- Added styling support for WooCommerce Blocks 3.6 Cart & Checkout versions. 

### Added Block Editor Support

- Added support for the WordPress 5.5 latest block editor tools.
- Added compatibility for the LSX Blocks "disable title" functionality.
- [#391](https://github.com/lightspeeddevelopment/lsx/issues/391) Added dedicated styles for specific blocks.
- [#385](https://github.com/lightspeeddevelopment/lsx/issues/385) Added `lsx-subheading` class for group blocks.
- [#395](https://github.com/lightspeeddevelopment/lsx/issues/395) Added styling support for Yoast SEO's internal linking blocks .
- [#363](https://github.com/lightspeeddevelopment/lsx/issues/363) Added styling support for the Yoast SEO plugin FAQ block .
- [#362](https://github.com/lightspeeddevelopment/lsx/issues/362) Added styling support for the Yoast SEO plugin's HowTo block. 
- [#370](https://github.com/lightspeeddevelopment/lsx/issues/370) Added WPForms submit button block editor styling
- [#370](https://github.com/lightspeeddevelopment/lsx/issues/370) Added theme support for responsive embedded content `add_theme_support( 'responsive-embeds' )`
- [#370](https://github.com/lightspeeddevelopment/lsx/issues/370) Added theme support for custom editor font sizes `add_theme_support('editor-font-sizes')`
- [#370](https://github.com/lightspeeddevelopment/lsx/issues/370) Added theme support for block default gradient presets add_theme_support`add_theme_support( 'editor-gradient-presets' )`
- Added theme support for editor styles - `add_theme_support( 'editor-styles' )`
- Added theme support for full and wide align images `add_theme_support( 'align-wide' )`
- Added theme support for block styles for the the group, cover, columns, heading, paragraph, image & gallery core blocks `add_theme_support( 'wp-block-styles' )`
- Added theme support for Custom Line Heights `add_theme_support( 'custom-line-height' )`
- Added theme support for Custom Units `add_theme_support( 'custom-units' )`
- Added theme support for block link colors experimental feature `add_theme_support( 'experimental-link-color' )`
- Added theme support for custom color scheme `add_theme_support( 'editor-color-palette'`
- Added theme support for block default font sizes, `add_theme_support( 'editor-font-sizes' )`

### Updated

- Updated the Welcome screen.
- Updated the theme `screenshot.png` file.
- [#373](https://github.com/lightspeeddevelopment/lsx/pull/373) Updated styles spacing improvements for WordPress core blocks.
- [#378](https://github.com/lightspeeddevelopment/lsx/issues/378) Updated the padding on LSX Buttons.
- [#370](https://github.com/lightspeeddevelopment/lsx/issues/370) Updated Block Editor Theme Support.
- [#365](https://github.com/lightspeeddevelopment/lsx/pull/365) Updated Yoast & WooCommerce breadcrumb placement & styling.
- [#366](https://github.com/lightspeeddevelopment/lsx/issues/366) Updated styling for Woocommerce Wishlist plugin.
- [#366](https://github.com/lightspeeddevelopment/lsx/issues/366) Updated styling for Woocommerce Quick View plugin.
- [#366](https://github.com/lightspeeddevelopment/lsx/issues/366) Updated styling for WooCommerce Cart and Checkout pages.
- Updated single blog layout to support block editor first and foremost.
- Updated sensei shortcode styles to work on block pages.
- Updated styling for the Tribe Events Community Events forms.

### Changed

- [#387](https://github.com/lightspeeddevelopment/lsx/issues/387) Merged the two WooCommerce panels within the customizer sidebar.
- Skiped the loading attribute for the custom logo.
- Reduced the left and right padding on LSX Buttons from 40px to 15px.
- The WooCommerce bar will be showed if active and the screen is less than 678px.
- Default block widths changed.

### Fixed

- [#381](https://github.com/lightspeeddevelopment/lsx/pull/381) Fixed the search bar spacing issues.
- [#386](https://github.com/lightspeeddevelopment/lsx/pull/386) Fixed the margin issue when some titles are too long.
- [#377](https://github.com/lightspeeddevelopment/lsx/issues/377) Fixed the search bar spacing issues.
- [#358](https://github.com/lightspeeddevelopment/lsx/issues/358) Fixed alignment issues with post header containing long titles.
- [#380](https://github.com/lightspeeddevelopment/lsx/issues/380) Fixed event archive page banner that duplicates when switching views.
- [#396](https://github.com/lightspeeddevelopment/lsx/issues/396) Fixed Sensei single lesson notification message bug.
- [#397](https://github.com/lightspeeddevelopment/lsx/issues/397) Fixed Sensei single lesson placeholder image.
- Fixed the mobile widths.
- Fixed blog archive spacing.
- Fixed the margin issue when some titles are too long.
- Fixed minor issues on Sensei single lesson images and messages.

### Removed

- [#369](https://github.com/lightspeeddevelopment/lsx/issues/369) Removed older Gutenberg block styling.
- Removed the [Front Page](https://github.com/lightspeeddevelopment/lsx/blob/2.8.0/page-templates/template-front-page.php) page template.
- Removed the [No Sidebar](https://github.com/lightspeeddevelopment/lsx/blob/2.8.0/page-templates/template-no-sidebar.php) page template.
- Removed the [Full Width](https://github.com/lightspeeddevelopment/lsx/blob/2.8.0/page-templates/template-full-width.php) page template.
- Removed the [Full Width No Margins](https://github.com/lightspeeddevelopment/lsx/blob/2.8.0/page-templates/template-full-width-no-margins.php) page template.
- Removed the [WC Thank You](https://github.com/lightspeeddevelopment/lsx/blob/2.8.0/page-templates/template-wc-thank-you.php) page template.

### Security

- [#383](https://github.com/lightspeeddevelopment/lsx/issues/383) Tested the theme files with the [theme check plugin](https://wordpress.org/plugins/theme-check/). Updated theme files to support the latest WordPress theme coding & theme review standards. 
- Updating dependencies to prevent vulnerabilities.
- Updating PHPCS options for better code.
- General testing to ensure compatibility with latest WordPress version (5.5.1).
- General testing to ensure compatibility with latest LSX Theme version of al LSX extensions.

### Third Party Plugin Compatibility Testing

- WordPress 5.5.1
- Gutenberg 9.1.1
- Yoast SEO 15.1.1
- WooCommerce 4.6.0
- WooCommerce Blocks 3.6.0
- Woocommerce Wishlist 
- Woocommerce Quick View 1.2.12
- WooCommerce Subscriptions 3.0.9
- WooCommerce Memberships 1.19.1
- WooCommerce Bookings 1.15.29
- WooCommerce Product Vendors 2.1.43
- WooCommerce Tab Manager 1.13.1
- WooCommerce Mix and Match 1.10.4
- WooCommerce Checkout Field Editor 1.5.36
- WooCommerce Social Login 2.10.1
- Sensei 3.5.2 
- Events 5.2.0
- WPForms 1.6.2.3
- GravityForms 2.4.21
- Envira Gallery 1.9.0.2
- Soliloquy Slider 2.6.0
- FacetWP 3.6.6
- SearchWP 4.0.31

# [[2.8.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.8.0) - 2020-05-21

### Added

- One new hooks/actions added in layouts: `lsx_entry_inside_top` to hook into a page content.
- WooCommerce 4.1 compatibility.
- Adding Yoast 14.0.+ compatibility.
- Added compatibility for LSX Banners for Sensei single lessons.

### Changed

- Woocommerce Cart, Checkout, Thank You and Restricted styling improved.
- Layout changed on Cart, Checkout, Thank You and Restricted woocommerce pages.
- Updated Sensei related functions to replace deprecated functions.

### Fixed

- Fixed issue #346 'If LSX banners is not enabled there is a simple banner showing on each page.'.
- [#353](https://github.com/lightspeeddevelopment/lsx/issues/383) Body class `using-gutenberg` affecting other custom post type single pages was removed from any custom post type single page.
- Fixed a few styling issues related to Sensei templates.

### Security

- Testing compatibility with WordPress 5.4.1

## [[2.7.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.7.0) - 2020-03-30

### Added

- Adding styling for captions on WP core image and video blocks.
- Added in a `lsx_display_global_header_description` filter to allow the code disabling of the `is_archive()` description.
- Adding `title` tag to `lsx_get_thumbnail` function.
- Adding compatibility for the WC Blocks (filters and all proguts grid).
- Adding Popup Maker plugin compatibility.
- Adding WC Blocks (Review block) compatibility.
- Adding Event Calendar 5.0 compatibility.
- Adding compatibility for the Media & Content block.
- Adding compatibility for the Cover block.
- New mobile menu theme option.
- Adding compatibility for `btn-scroll-to` and `search-form` for the cover block.
- Adding compatibility for WordPress 5.4.
- Adding `lsx_header_wrap_after` to allow actions above the .wrap.container.
- Adding `lsx_get_template_part()` allowing 3rd part plugin to overwrite the index.php content template.
- Adding class `lsx-wc-filter-block` that will create mobile styles for the WooCommerce filter blocks.

### Fixed

- Fixed the top bar menu icon on smaller screens.
- Fixing warnings and format issues following code sniffer rules to follow wordpress standards.
- Improving styles for WP Forms compatibility.
- Improving Sensei Course Participants widget behavior.
- Fixing the default banner title for the events archives.
- Fixing the custom banner title for the events archives.

### Changed

- Changing Changelog file format.

### Security

- Code standardization following theme sniffer results.
- Testing compatibility with WordPress 5.4.

## [[2.6.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.6.1) - 2019-12-19

### Fixed

- Removing `lsx_defer_parsing_of_js` and `preload_css` because they have conflicts with cache plugins.

## [[2.6.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.6) - 2019-12-19

### Added

- Added in a `lsx_defer_parsing_of_js` filter to allow plugins to skip their files.
- Added an additional thumbnail image size for post carousel blocks `lsx-thumbnail-carousel`.
- Added in a filter `lsx_sticky_menu_selector` to allow 3rd party plugins to change the sticky menu element.
- Sensei plugin compatibility (styles for Sensei templates, new layout and compatibility with Woocommerce Sensei courses).
- Registering Sensei sidebars for Sensei Participants or Sensei Progress plugins on single lessons and quiz.
- Improving gutenberg compatibility styles.
- Added in font-display: swap; to all of the font-face declarations to help with optimization.
- Allowing the sitemap loops to show items to a depth of 3.
- Adding better breadcrumbs for woocommerce categories and taxonomies.
- Adding simple title banner to WC pages (not product pages).
- Updating Event Calendar Organizer styles.
- Adding hierarchy for the sitemap.
- Improvements on the code to follow WordPress core coding standards.

### Changed

- Better support for Tribe Events templates and styling.
- When LSX Banners is active, the single events will not show a featured image on the body.
- Folder restructuring for all non LSX plugins supported.
- Changing the parent class for tribe event styling.

### Fixed

- The width for the login form (logged out) will not affect widgets anymore.
- Fixing the `WC_Cart::get_cart_url is deprecated since version 2.5! Use wc_get_cart_url instead.` error.
- Sensei classes will be called from the parent LSX not child themes.
- Fix for 'Content wider than screen' Google Console issue.
- Fixed the archive pages, to make them 100% width but leaving the option fo narrow or full width for the blog archive.

## [[2.5.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.5.1) - 2019-10-10

### Fixed

- Fix - Adding in a conditional to check if an interface exists before trying to include the Yoast Schema.

## [[2.5.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.5.0) - 2019-09-30

### Added

- Added in a filter to allow plugins to lazy load the sliders
- Added in a function to remove the Popup Maker plugin admin bar tools.
- Added in a function to defer all JS files enqueued except jquery.js
- Added in a schema class which creates the Article Schema using the Yoast API.

### Changed

- Preloaded all font declaration files.
- Removed the Block styles into a its own CSS file.

### Deprecated

- Removed the unused Bootstrap SCSS and Glyphicon files.

### Fixed

- Fixing the pagination pointers.
- Reducing the excerpt to 30 words.
- Fixed minor CSS bugs with the post and page Block layouts.

## [[2.4.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.4.2)

### Added

- Added in a filter to order the sitemap loops.
- Added in a taxonomy loops for the sitemap template.
- Adding the .gitattributes file to remove unnecessary files from the WordPress version.

### Fixed

- Fixing the top bar menu spacing for mobile version.

## [[2.4.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.4.1)

### Fixed

- Adding the class 'using-gutenberg' only to pages or posts.
- The filter 'lsx_global_header_disable' will not affect search pages.
- Fixed the width of GB and non GB posts to be the same.
- Fixed the thumbnails of the blog so the image does not look pixilated.

## [[2.4.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.4.0) - 2019-08-06

### Added

- Updates y styles and structures to match the new LSX BLOG Customizer.
- Adding more styling for banners, single, archive pages and search pages.
- Improving search form styles.

### Changed

- Separating the content.php and the related content.php.
- Changing the lsx-thumbnail-wide image size to 360x168.

### Fixed

- Removing the post meta, as it is being added via an action.
- Fixed the issue where Nav menu widgets are missing titles on single events pages.
- Fixed core PHP issue.
- Adding function to show trimmed content if there is no excerpt.

## [[2.3.3]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.3.3) - 2019-06-20

### Added

- Adding the button scroll banner styles.
- Adding styles for search field on banner block.

### Fixed

- Various Breadcrumb fixes.
- Fixing error `Undefined property: WP_Post_Type::$ID`.
- Fixings spaces after breadcrumb.

## [[2.3.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.3.2) - 2019-06-14

### Added

- Update of the Node NPM dependencies to secure versions.
- Added lsx styles to restricted content login button.

### Changed

- Hiding WooCommerce styles on excerpts.

### Fixed

- Updated LSX Banners to show on all pages.
- Fixed mobile column widths viewport.

## [[2.3.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.3.1)

### Added

- Added in a function to disable The Event Calendar body post archive and single title and move it into the Global Header.
- Added in the correct titles for The Events Calendar Community Events.
- Extended the breadcrumb filter to include handling for The Events Calendar Community Events.
- Added in the posts page archive to the breadcrumbs (Yoast and WooCommerce) when viewing the Category and Tag archives.
- Added in a `lsx_404_search_form` filter to allow the 404 content to be changed by third party plugins.
- Added in a function to move the OptinMonster JS registration to the footer.
- Removed the font options and replaced it with a disable font checkbox.

### Deprecated

- Removing the filter that disables the banner for events.

### Fixed

- Added in a conditional statement that disables the page header if WordPress Blocks are being used on the page.
- Added in a post type archive Breadcrumb for The Events Calendar Venue and Organizer pages, Yoast and Woocommerce Breadcrumbs.
- Fixed the missing archive header on the Blog Archives.

## [[2.3.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.3) - 2019-02-28

### Added

- Styling the Events Community Add New Event Page.
- Updating the LSX Landing Page for the Admin.
- Community Events Styling.
- Adding the `gutenberg compatible` class to home page.

### Changed

- Changing the Services Link for Videos on the LSX Admin Page.

### Deprecated

- Removing Top and Bottom Margins for Gutenberg Compatible Templates.

### Fixed

- Fixes and updates for WordPress coding standards.
- Fixing width for event calendar image.
- Block columns spacing fix.
- Fixing the breadcrumbs issue for gutenberg pages.
- Fixing the Button Styling for the Tribe My Events List Page.
- Removing full width Images padding for Mobile.
- Removing the max width for the Gutenberg Posts.

## [[2.2.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.2.2)

### Added

- Added in a filter to disable the LSX Banners if the page is using Blocks.

### Fixed

- Recompiled Minified JS.
- Making sure the Theme is pre 5.0 compatible.
- Fixing the breadcrumb for The Events Calendar Community Event when using Yoast SEO Breadcrumbs.
- Fixing the Front Page Template conditional statements.

## [[2.2.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.2.1) - 2018-12-14

### Fixed

- Fixed the white screen error when not using the Gutenberg editor.

## [[2.2.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.2.0)

### Added

- Prepared the theme for Wordpress 5.0.
- Added Gutenberg compatibility.
- The breadcrumbs are now at the top of the banner.
- Moved the platform.js to the footer.
- Added in error handling for the `add_class_browser_to_html` function.
- Fixed the translation of the Author Page.

### Fixed

- General bug fixes.
- Fixed the `title` attribute not being used in the Nav Walker class.
- Fixed the FontAwesome select icons for the Stripe payment gateway in WooCommerce.
- Fixed the lsx-full-width-base class in core of theme.
- Added style for product buttons on WooCommerce featured products widget.

## [[2.1.7]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.7)

### Added

- Added in Bootstrap Styling for the Gravity Forms plugin.

## [[2.1.6]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.6) - 2018-09-19

### Added

- Added core Styling Support for the bbPress Forum Software.
- Added inputs to the wp_kses_post filter to fix the WooCommerce Product reviews button.
- Changed the css to output as compressed when processed.
- Updating packages tough-cookie ~> 2.3.3 and hoek ~> 4.2.1.

## [[2.1.5]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.5) - 2018-06-26

### Fixed

- Fixed the compatibility issue with the WooCommerce select2 fields.

## [[2.1.4]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.4) - 2018-06-22

### Added

- Removed the edit links from the logged in view.
- Added in integration with the WP Forms Plugin.
- Event Calendar Ticket Styling.

### Fixed

- Removed the WC Select2 from the Checkout page as a temporary fix.

## [[2.1.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.2)

### Added

- Removed the hentry class from the `post_class` output.
- Added in a vcard schema for the author post meta.
- Added in the updated class for the hentry schema.
- Removed the WooCommerce product form template and customized it via the `get_product_search_form` filter.
- Removed the tabs php file conflicting with WP updates.
- Changed the way the woocommerce pagination is styled.
- Removed the overwritten templates for the WC products and WC reviews widgets.

## [[2.1.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.1)

### Added

- Added in a filter to handle which post formats are forced to show the full content.
- Added in a filter to allow which post formats show a thumbnail.
- Added in the Bacs Bank details on the WC "Thank You" page.
- Allowing the cart to show on the Logged out menu as well. (LSX Login and WooCommerce integration).

### Fixed

- Added the Sass files for child theme development.

## [[2.1.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.1.0)

### Added

- Added new filter to disable the global pagination: lsx_paging_nav_disable.
- WooCommerce mobile footer bar.
- New button class (red colours) for top menu: cta-red.
- Add WooCommerce Wishlist compatibility.
- Add WooCommerce Smart Coupon compatibility.
- Add WooCommerce image lightbox effect compatibility.
- Add WooCommerce image slider effect compatibility.
- Add WooCommerce Advanced Product Labels compatibility.
- Add WooCommerce Quick View compatibility.
- Add Sensei compatibility.
- Add The Events Calendar compatibility.
- Default colours scheme updated (top menu colors).
- Add WooCommerce Bookings compatibility.
- Add WooCommerce Product Reviews compatibility.
- Add WooCommerce thank you page template.
- Add The Events Calendar compatibility.
- Add WooCommerce Subscriptions compatibility.
- Add WooCommerce Product Retailers compatibility.
- Extended alert-danger Bootstrap class to alert-error class.

### Changed

- Small changes to allow LSX Customizer to change WooCommerce cart menu item position.
- Small changes to allow LSX Customizer to change WooCommerce cart menu item style.
- Small changes to allow LSX Customizer to change WooCommerce My Account menu item.
- Change WooCommerce Bundle Product visual on single.
- Change WooCommerce Variation Swatches visual on single.
- Change WooCommerce Ship Multiple Addresses visual on single.
- Change WooCommerce Products Addon visual on single.

### Fixed

- Fixed conflict from global style affecting slick dots.
- Removed the setting that turned LSX as LSX (itself) child theme.
- Fixed blog/search results - Custom post type visual.
- Fixed blog/search results - Botttom image only used by LSX Blog Customizer.
- Added dynamic class to WooCommerce archive wrapper.
- Fixed <main> close tag in WooCommerce archive.
- Improve menu cart item visual.
- Improve WooCommerce visual experience.
- Bootstrap modal z-index.
- Remove WC Shipping Multiple Addresses specific script causing issues on checkout.
- Make the menu background image full-width (infinite) when it is a 100% column.

## [[2.0.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/2.0.0)

### Added

- New totally awesome version! The visual was fully redesigned.
- Restricting the #searchform so it does not submit empty searches.
- Changed WordPress versions: Requires at least: 4.3, Tested up to: 4.8, Stable tag: 4.8.
- New project structure.
- Update CSS’s vendors structure.
- Added.editorconfig specs for unifying the coding style for different editors and IDEs.
- LSX extensions integration updated.
- WooCommerce integration updated.
- Caldera Forms integration updated.
- New filter available (for LSX Blog Customizer): `lsx_blog_display_text_on_list`.
- New global class `.lsx-full-width-base`.
- New global class `.lsx-full-width-base-small`.
- New global class `.lsx-title`.
- New template `full-width-no-margins`.

### Deprecated

- Removed from compiled Bootstrap: Glyphicons and Jumbotron.
- Removed from compiled Bootstrap: Carousel.
- Removed from compiled Bootstrap: Advanced buttons, Carousel, Affix.
- Removed from compiled Bootstrap: Breadcrumbs, Pagination, Progress Bars, List Groups, Wells.
- Removed reference to glyphicons.
- Modernizer lib removed.
- Jetpack integration removed.
- BudyPress integration removed.
- Job Manager integration removed.
- Tribe Events integration removed.
- Sensei integration removed.

### Added

- Added WordPress core pagination.
- Load RTL style from child theme.
- Added selective refresh in the LSX Customizer options.
- Added LSX Sharing integration.
- Fonts optimization (try first load theme fonts; only after - if necessary - load google fonts).
- Enabled shortcode for text widget.

### Fixed

- Fixed the display of top menu right without the top menu left.
- Fixed issues from GitHub (many issues).
- Fixed issues from Code Sniffer (PHP and WordPress).

## [[1.8.7]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.7)

### Added

- Added in a conditional tag to allow the LSX sharing to show.
- LSX Sharing integrated.
- Added styles for Bootstrap's modal.
- Removed reference/link to sitemap on 404 page.

### Fixed

- Fixed lsx thumbnail parameter from 'wide' to 'single' at list entries.

## [[1.8.6]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.6)

### Fixed

- Fixed CSS enqueue (parent > child themes).
- Removed remove_filter: the_excerpt/wpautop.
- Small Sass files change (without affect CSS).
- Fixed duplicated breadcrumb for custom taxonomy archives.
- Fixed CSS for radio and checkboxes (forms).
- Delaying the the child theme CSS loading.

## [[1.8.5]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.5)

### Fixed

- Footer widgets changed breakpoint.
- Keep default behavior from sliders on mobile.
- Adjusted content.php to be more flexible for styles (LSX Blog Customizer requirement).
- Small adjust on post archive - post item footer style.
- Fixed post author when 'get_the_author' is not available.
- Fixed breadcrumb display position on archive.php, author.php and search.php.
- Small issue (style) with Pagenavi pagination.
- Fixed CSS enqueue (parent > child themes).
- Removed remove_filter: the_excerpt/wpautop.
- Small Sass files change (without affect CSS).

## [[1.8.4]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.4)

### Fixed

- Re-added the get_comments_number() fix.

## [[1.8.3]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.3)

### Fixed

- Removed custom image classes from avatar in admin bar.
- Top menu dropdown in large screens (first level link didn’t works).
- Moved the get_comments_number() out of the empty() statement, causing a Fatal PHP Error.

## [[1.8.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.2)

### Added

- Enabled compatibility between LSX Banners (Soliloquy) and LSX Theme.
- Enabled compatibility between LSX Blog Customizer (categories BS carousel) and LSX Theme.
- Enabled compatibility between LSX Blog Customizer (display full content on blog pages) and LSX Theme.
- Enabled compatibility between LSX Blog Customizer (display grid layout on blog pages) and LSX Theme.
- Added a JavaScript option to avoid hide top menu on scroll.
- Adjusted the next/previous post navigation (wider columns).
- Adjusted comment author thumbnail display.

## [[1.8.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/v1.8.1)

### Added

- Starter content (new feature available in WordPress 4.7).

### Fixed

- Avoided use a return function inside the PHP function `empty` (compatibility with PHP 5.5 and lower).
- Compatibility with WPML 3.6.
- Fixed Sensei redirect for lessons archive.

## [[1.8.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.8.0)

### Added

- Made LSX compatible (visual) with Ninja Forms.
- Made LSX compatible with LSX Blog Customizer (plugin).
- Made LSX compatible (visual) with LSX Banners new feature: background videos.
- Spinning preloader: added an option to enable/disable it in WP Customizer.
- Main menu: made highlight items use button CTA colours.
- Main menu: float to right always the last menu item with dropdown.
- Top menu: implemented style for WPML (plugin).
- Top menu: added the social icons as social menu at the bottom.
- Improved the mobile navigation and header display.
- Changed the site width (WordPress variable) from 750 to 1140.
- Customizer Colors: print the custom styles in <head> (moved from <body>).
- Customizer Colors: improve the performance in front-end.
- Customizer Colors: implement the CSS inline using SCSS.
- Code sniffers: Travis CI configured.
- Badges: added two badges (Travis CI deploy; Gulp.js).
- Updated WooCommerce assets to the latest version (version 2.6.4).
- Updated FontAwesome to the latest version (version 4.6.3).
- Updated Bootstrap to the latest version (version 3.3.7).
- Added in a lsx_get_template_part function, which check for templates in a plugin before it loads the usual templates.
- Added in a lsx_sidebar_enable filter so that plugins and child themes can disable the sidebar by force if they need to.
- LSX Banners: making LSX compatible with new LSX Banners slider.
- Enabled extra attributes (srcset, sizes) in img tag (add_filter: wp_kses_allowed_html).
- Uses the theme version to add the styles and scripts resources.
- Moved Customizer Colors to a plugin (LSX Customizer).
- Made theme and Give core and recurring donations compatible.
- Increased the limit from pages to display in sitemap.
- Adjusted LSX border button size.
- Created a welcome page.
- Added a new menu option: top menu (left).

### Deprecated

- Removed WP Customizer prompt for empty main navigation.
- In excerpts (only in posts lists), allowed these tags: <blockquote>,<p>,<br>,<b>,<strong>,<i>,<u>,<ul>,<li>,<span>,<div> (all others will be removed).
- Removed TGM (plugin) feature.

### Fixed

- Main menu: small caret style fix for wider menu items.
- Breadcrumbs: small fix in visual.
- Search results: small fix in visual.
- Blog/archive sticker (featured): small fix in position.
- Made some fixes for W3C HTML validation.
- Customizer Colors: fixed/implemented several CSS/SASS selectors.
- Parallax banner: fixed parallax effect (doesn't run it when don't exist a image and container).
- Code sniffers: fixed the code sniffers alerts (basic alerts).

## [[1.7.3]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.7.3)

### Added

- Added a wrap in banner to fix IE10/11 vertical alignment.

### Deprecated

- Removed blue banner (with title) from the homepage (always).
- Small fix: removed height:auto from default images.

### Fixed

- Small fixes in customizer colours: improved selectors.
- Fixed customizer colours: live changes were not working.

## [[1.7.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.7.2)

### Added

- Envira Gallery: added "Lazy Load Images" to Envira Gallery.
- Responsive: added new class for buttons full width in mobile (btn-mobile-fullwidth).
- LSX Mega Menus: created compatibility with LSX Mega Menus plugin.
- Added gulp command to auto-generate WordPress language files (gulp wordpress-lang).
- Added option to use LSX Mega Menus in Top Menu.

### Deprecated

- Bootstrap: removed `!important` from some general classes.
- Removed blue banner (with title) from the homepage (always).

### Fixed

- Default pagination: fixed wrap spacing.
- General small fixes.

## [[1.7.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.7.1)

### Added

- Customizer colour swatch: printing the custom styles in footer.
- Lazy Loading Images: added a class to bypass a image.
- Lazy Loading Images: improved the regular expressions for only replace the images with source.
- Lazy Loading Images: added an option in WP admin to enable/disable it.
- Added in a filter to remove the "Custom Fields" meta box.
- Two new hooks/actions added in all layouts: lsx_content_wrap_before and lsx_content_wrap_after.
- Titles for pages and posts standardized.

### Fixed

- Customizer colour swatch: fixed the box-shadow color from articles in blog pages.
- Fixed with fallback: for some reason sometimes wp_get_attachment_image_srcset fails.
- Fixed: sometimes the image banner show up without an image set.
- Banners: resolved conflict between LSX Banners and LSX.

## [[1.7.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.7.0)

### Added

- Added a colour swatch to customizer.
- Added in a conditional statement so the footer widgets container does not show unless there are widgets active.
- Added a filter to excerpt (what post types show excerpt or full content).
- Improved title styling when no featured image is set.
- Added Lazy Loading Images.
- Speed Optimization: minified all script and style files.

### Deprecated

- Removed the deprecated tags (readme, style).
- Removed unnecessary Google font file.

### Fixed

- Fixed a bug with the banner paralax type scrolling and the LSX TO Plugin Banner Google Map.
- Fixed a problem with CSS z-index (Footer CTA conflicting with Banner).
- Fixed HTML input styles (missing textarea and input:email).
- General small fixes.

## [[1.6.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.6.2)

### Added

- Added a conditional statement so the footer widgets container does not show unless there are widgets active.

- Post (single): improved sharing experience in small devices.
- Post (archive): anchored the comments counter to comments section in single post.
- Post (single): the tags could use more space to the right before wrapping onto a second line.
- Improved grandchild menu item.
- Improved vertical alignment in homepage banner.

### Changed

- Changed (Jetpack) related posts headline to "Related Posts".

### Fixed

- Page 404: fixed big gap below the banner when the main menu is not fixed.
- Fixed comment reply.
- Fixed paginated posts.
- Post (archive, single): fixed long title.
- Fixed in small screens the easing scroll with big content banner.
- Improved (fixed) spacing below the posts list and single post.
- Fixed the email sharing (modal) on mobile.

## [[1.6.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.6.1)

### Added

- Changed the meta viewport to recommended solution for mobile.
- Cleared out unused image files in /img folder.

### Fixed

- Fixed Bootstrap modal in small devices (< 768px).
- Fixed font customizer.
- Fixed title display in homepage.
- Fixed lateral paddings in all pages.

## [[1.6.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.6.0)

### Added

- New global loading.
- New top banner (code refactored, parallax).
- Restoring compatibility with WPML.
- Improve visual from Bootstrap Carousel.
- Show custom post format content in excerpt (posts list).
- New blog archive and single template design.
- Added Glyphicons resources (icons font from Bootstrap).
- IE 11: polyfill for img[srcset].
- Bootstrap Modal: increase size of modal close button.
- Home banner: in home banner, check if the WP admin bar is enable to decrease 32px in banner height.
- Home parallax: improve parallax effect.
- Nav menu: always require the CSS for nav menu (small screens devices).
- Nav menu: use the correct window.width information.

### Changed

- Defer parsing of JavaScript to allow visual elements to be loaded first.

### Deprecated

- Removed Genericons, switched to Font Awesome.
- Removed LST styles (custom styles from a deprecated plugin).
- Removed extra stylesheets for the colour schemes and removed the customizer option.
- Removed Soliloquy homepage slider code.

### Fixed

- IE 11: fixed issues (banner alignment).
- Sensei: fix pages (lessons) divisors.
- Sensei: fix pages with breadcrumb.

## [[1.5.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.5.2)

### Added

- Updated the readme.txt.
- Removed old page templates (metaplates).
- Added RDFA markup for breadcrumbs.

### Fixed

- Fixed Bootstrap HTML structure.
- Fixed Bootstrap mediaqueries.
- Fixed height from items without image in Portfolio (Jetpack).
- Fixed the fixed menu behavior.
- Fixed the removal "Footer Widgets" title.
- Fixed main menu behavior in small screens.
- Fixed the active menu state for second level main menu.
- Fixed third level main menu dropdowns.

## [[1.5.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.5.1)

### Added

- Updated the readme.txt file with the Workflow Changes.

### Deprecated

- Removed help.txt and install.txt, they have been included in the readme files.

### Fixed

- Fixed the missing breadcrumbs on post type archives by removing the is_archive() conditional call.
- Fixed the duplicate logo and the duplicate nav menus with child themes.
- Fixed the display of the single breadcrumbs and the styling of the archives breadcrumbs.
- Fixed the support of the WordPress Custom Logo.

## [[1.5.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.5.0)

### Added

- Added in support for the following plugins, with their own stylesheets.
- Jetpack.
- Soliloquy Slider.
- Envira Gallery.
- WP Job Manager.
- WooCommerce.
- Sensei.
- Support added for new WordPress 4.5 Site Logo.
- Add backwards compatibility for Jetpack Site Logo.
- Updated the Development workflow to only use Node and Gulp, Bower is no longer needed. (see the readme for details).
- Added in support for third level dropdowns - https://github.com/lightspeeddevelopment/lsx/issues/16.

### Deprecated

- Removed the Footer Widget title - https://github.com/lightspeeddevelopment/lsx/issues/37.

### Fixed

- Fixed the Display of the Breadcrumbs.
- Fixed the display of images in a blog post set to full width - https://github.com/lightspeeddevelopment/lsx/issues/33.
- Fixed the primary nav toggle displaying if no menu has been assigned - https://github.com/lightspeeddevelopment/lsx/issues/34.

## [[1.4.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.4.2)

### Added

- Added in three missing text encapsulations.

### Fixed

- Fixed the background image size on single Jetpack Portfolio pages.
- Fixed the active state highlighting for 2nd tier menu items.

### Deprecated

- Removed the unused 'Footer Widgets' title and CSS.

## [[1.4.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.4.1)

### Fixed

- Fixed the Fatal error with the Caldera forms class.
- Fixed the output of the lsx-thumbnail-single and lsx-thumbnail-wide size.
- Fixed the styling of the WPML Language switcher dropdown.

## [[1.4.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.4.0)

### Added

- Added in a "Continue Reading" link for excerpts.
- Added in the singular.php template.
- Added support for the WordPress Responsive images.

### Fixed

- Fixed the Post Format Link handeling.
- Fixed the post meta not showing on a custom homepage (child theme).
- Fixed the archive layout support when BuddyPress is active.
- Fixed the mobile nav menu toggle text in the orange color scheme.
- Fixed the Mobile menu showing up when no Primary menu is assigned.
- Fixed various translatable string errors.

### Deprecated

- Removed the Page Hero Page template.
- Removed our custom code that controls responsive images.

### Changed

- Renamed the Full Width Narrow template to No Sidebar.
- Renamed content-single.php to content-post.php.
- Renamed the Color Scheme CSS files with a `color-scheme-prefix`.

## [[1.3.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.3.0)

### Added

- Added in support for 'post formats'.
- Improved Blog Template Styling; Single, Archive and Author pages.
- Updated Responsive CSS for all templates.
- Updated the Colour Scheme stylesheets.
- Added in a Customizer option to create a "Fixed" header.
- Added in a Page Template "Metaplate".
- Added in translation encapsulation for missing strings.
- Added in support for BuddyPress Pages (forced to 1 column).

### Fixed

- Fixed RTL styling fixes for the various header layouts.

### Chaged

- Renamed the scripts being included more intuitively.

### Deprecated

- Removed unused JS and CSS files.

## [[1.2.4]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.2.4)

### Added

- Added more styles to the Colour Scheme CSS files.

### Deprecated

- Removed the unused readme.txt in the languages directory.

### Fixed

- Fixed responsive header CSS and JS.

## [[1.2.3]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.2.3)

### Deprecated

- Removed the Genericons example.html file for Security Reasons.

## [[1.2.2]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.2.2)

### Added

- Responsive Layouts.
- The portfolio column layout for masonry on tablet and mobile.

## [[1.2.1]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.2.1)

### Added

- Updated the ScreenShot.
- The including of the genericons from the parent theme (for child themes).
- Added in an info box for the navigation panel.
- Added in the sidebar for the sitemap template, and changed the amount of items called through on each section.

### Deprecated

- Removed extra class code from the lsx_avatar function.

### Fixed

- Fixed the Masonry layout selecting different column layouts.

## [[1.2.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.2.0)

### Added

- Stopped the page banner from showing on the Homepage if the Reading settings are set to show a static page.
- Isotope jQuery Library 2.1.1.
- Set the Jetpack Portfolio post type archive to only call portfolio items that have a featured image set. i.e. Complete.
- Packery jQuery Library 1.1.1.
- WordPress Customizer options for controlling the layout of the header.
- Added in a filter 'lsx_allowed_post_type_banners' so child themes can add banner support for additional post types.
- Added in a filter 'lsx_post_navigation_labels' which allows you to edit the labels outputted on the post type archive.

### Changed

- Changed the names of the Google Font Classes.
- Changed the content_width for the single 'jetpack-portfolio' post type to 1140px.

### Fixed

- Fixed the mixed content warning for the Google Fonts API calls.
- Fixed the banner responsive JS on single posts.
- Fixed the Isotope filtering using the Packery Library.
- Fixed the banner class for the body tag, no longer show up on all pages.
- Fixed the header layout customizer js, and moved it into the "Layouts" Panel.
- Fixed the blog images not triggering on jetpack infinite scroll loading.

## [[1.0.0]](https://github.com/lightspeeddevelopment/lsx/releases/tag/1.0.0)

### Added

- First Version.
