<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	$optionsframework_settings       = get_option('optionsframework');
	$optionsframework_settings['id'] = 'lsx_theme_options';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Returns an array of system fonts
 * Feel free to edit this, update the font fallbacks, etc.
 */

function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif'                                       => 'Arial',
		'"Avant Garde", sans-serif'                               => 'Avant Garde',
		'Cambria, Georgia, serif'                                 => 'Cambria',
		'Copse, sans-serif'                                       => 'Copse',
		'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',
		'Georgia, serif'                                          => 'Georgia',
		'"Helvetica Neue", Helvetica, sans-serif'                 => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif'                              => 'Tahoma',
	);
	return $os_faces;
}

/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Arvo, serif'                   => 'Arvo',
		'Copse, sans-serif'             => 'Copse',
		'Droid Sans, sans-serif'        => 'Droid Sans',
		'Droid Serif, serif'            => 'Droid Serif',
		'Lobster, cursive'              => 'Lobster',
		'Nobile, sans-serif'            => 'Nobile',
		'Open Sans, sans-serif'         => 'Open Sans',
		'Oswald, sans-serif'            => 'Oswald',
		'Pacifico, cursive'             => 'Pacifico',
		'Rokkitt, serif'                => 'Rokkit',
		'PT Sans, sans-serif'           => 'PT Sans',
		'Quattrocento, serif'           => 'Quattrocento',
		'Raleway, cursive'              => 'Raleway',
		'Ubuntu, sans-serif'            => 'Ubuntu',
		'Yanone Kaffeesatz, sans-serif' => 'Yanone Kaffeesatz',
	);
	return $google_faces;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */

function optionsframework_options() {

	$imagepath = get_template_directory_uri().'/assets/img/';

	$options = array();

	$options[] = array(
		'name' => __('Basic', 'lsx'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Top Navigation', 'lsx'),
		'desc' => __('Enable Bootstrap\'s top navigation bar.', 'lsx'),
		'id'   => 'top_nav',
		'std'  => 1,
		'type' => 'checkbox');

	$options['site_logo'] = array(
		'name' => __('Logo', 'lsx'),
		'desc' => __('Upload your logo to be displayed in the header.', 'lsx'),
		'id'   => 'site_logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Favicon', 'lsx'),
		'desc' => __('Upload a favicon.', 'lsx'),
		'id'   => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Placeholder Thumbnail', 'lsx'),
		'desc' => __('Upload a fallback placeholder image for post thumbnails.', 'lsx'),
		'id'   => 'placeholder_image',
		'type' => 'upload');
	
	$options[] = array(
			'name' => __('Footer Banner Image', 'bs-tourism'),
			'desc' => __('Banner image to display in the Footer.', 'bs-tourism'),
			'id'   => 'site_footer_banner_image',
			'type' => 'upload');	

	$options[] = array(
		'name' => __('Thumbnail Width', 'lsx'),
		'id'   => 'thumb_width',
		'type' => 'text');

	$options[] = array(
		'name' => __('Thumbnail Height', 'lsx'),
		'id'   => 'thumb_height',
		'type' => 'text');

	$options[] = array(
		'name' => __('Post Meta', 'lsx'),
		'desc' => __("Use these shortcodes to include dynamic data into your meta sections. \n
					[view_full_article] - Link to read the full post. \n
					[post_date] - The post date. \n
					[post_time] - The post time. \n
					[post_author_link] - The post author (link to the author's website). \n
					[post_author_posts_link] - The post author (link to the author's posts archive). \n
					[post_comments] - Comments for the post. \n
					[post_tags] - Tags for the post. \n
					[post_categories] - Categories for the post. \n
					[post_edit] - 'Edit' link for the post.", 'lsx'),
		'id'   => 'post_meta',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Fixed Layout', 'lsx'),
		'desc' => __('Enable fixed layout.', 'lsx'),
		'id'   => 'static_layout',
		'std'  => '0',
		'type' => 'checkbox');

	$options[] = array(
		'name'    => __('General Site Layout', 'lsx'),
		'desc'    => __('Choose general sitewide layout.', 'lsx'),
		'id'      => "site_layout",
		'std'     => "2c-l",
		'type'    => "images",
		'options' => array(
			'1col' => $imagepath.'1c.png',
			'2c-l' => $imagepath.'2cl.png',
			'2c-r' => $imagepath.'2cr.png',
			'3c-,' => $imagepath.'3cm.png',
			'3c-l' => $imagepath.'3cl.png',
			'3c-r' => $imagepath.'3cr.png')
	);

	$options[] = array('name' => 'Typography',
		'type'                   => 'heading');

	// Available Options for Header Font
	$typography_options_headers = array(
		'sizes' => array('12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36'),
		'faces' => array(
			'"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica',
			'"Open Sans", sans-serif'                        => 'Open Sans',
			'Arial, "Helvetica Neue", Helvetica, sans-serif' => 'Arial',
			'Georgia, Times, "Times New Roman", serif'       => 'Georgia',
		),
		'styles' => array('normal' => 'Normal', 'bold' => 'Bold')
	);	
	
	$typography_options_headers = apply_filters('lsx_header_typography_options', $typography_options_headers);
	

	$typography_mixed_fonts = array_merge(options_typography_get_os_fonts(), options_typography_get_google_fonts());
	asort($typography_mixed_fonts);

	$options['header_1_font'] = array('name' => 'Header 1',
		'id'                                    => 'header_1_font',
		'std'                                   => array('size' => '36px', 'color' => '#000000'),
		'type'                                                  => 'typography',
		'options'                                               => $typography_options_headers);

	$options['header_2_font'] = array('name' => 'Header 2',
		'id'                                    => 'header_2_font',
		'std'                                   => array('size' => '30px', 'color' => '#000000'),
		'type'                                                  => 'typography',
		'options'                                               => $typography_options_headers);

	$options['header_3_font'] = array('name' => 'Header 3',
		'id'                                    => 'header_3_font',
		'std'                                   => array('size' => '24px', 'color' => '#000000'),
		'type'                                                  => 'typography',
		'options'                                               => $typography_options_headers);

	$options['header_4_font'] = array('name' => 'Header 4',
		'id'                                    => 'header_4_font',
		'std'                                   => array('size' => '18px', 'color' => '#000000'),
		'type'                                                  => 'typography',
		'options'                                               => $typography_options_headers);

	$options['header_font'] = array('name' => 'Header 5',

		'id'  => 'header_5_font',
		'std' => array('size' => '14px', 'color' => '#000000'),
		'type'                => 'typography',
		'options'             => $typography_options_headers);

	$options['header_6_font'] = array('name' => 'Header 6',
		'id'                                    => 'header_6_font',
		'std'                                   => array('size' => '12px', 'color' => '#000000'),
		'type'                                                  => 'typography',
		'options'                                               => $typography_options_headers);

	// Available Options for Body Font
	$typography_options_body = array(
		'sizes' => array('12', '13', '14', '15', '16', '17'),
		'faces' => array(
			'"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica',
			'"Open Sans", sans-serif'                        => 'Open Sans',
			'Arial, "Helvetica Neue", Helvetica, sans-serif' => 'Arial',
			'Georgia, Times, "Times New Roman", serif'       => 'Georgia',

		),
		'styles' => false
	);
	
	$typography_options_body = apply_filters('lsx_body_typography_options', $typography_options_body);
	

	$options['body_font'] = array('name' => 'Body Font',
		'desc'                              => 'This font is used for all body text.',
		'id'                                => 'body_font',
		'std'                               => array('size' => '14px', 'face' => '"Helvetica Neue", Helvetica, Arial, sans-serif', 'color' => '#333333'),
		'type'                                              => 'typography',
		'options'                                           => $typography_options_body);

	$options['link_color'] = array('name' => 'Link color',
		"desc"                               => "Select the color for links.",
		"id"                                 => "link_color",
		"std"                                => "#428bca",
		"type"                               => "color");

	$options['link_hover_color'] = array('name' => 'Link hover color',
		"desc"                                     => 'Select the hover color for links.',
		"id"                                       => "link_hover_color",
		"std"                                      => "#3276b1",
		"type"                                     => "color");

	$options['button_color'] = array('name' => 'Button color',
		"desc"                                 => "Select the color for links.",
		"id"                                   => "button_color",
		"std"                                  => "#428bca",
		"type"                                 => "color");

	$options['button_hover_color'] = array('name' => 'Button hover color',
		"desc"                                       => 'Select the hover color for buttons.',
		"id"                                         => "button_hover_color",
		"std"                                        => "#3276b1",
		"type"                                       => "color");

	$options['disable_styles'] = array('name' => 'Disable Styles',
		'desc'                                   => 'Disable option styles and use theme defaults.',
		'id'                                     => 'disable_styles',
		'std'                                    => false,
		'type'                                   => 'checkbox');

	$options[] = array('name' => 'Homepage',
		'type'                   => 'heading');

	$options['enable_banner'] = array(
		'name' => __('Enable Intro Banner', 'lsx'),
		'desc' => __('Enable the intro banner below the header.', 'lsx'),
		'id'   => 'enable_banner',
		'std'  => '0',
		'type' => 'checkbox');

	$options['home_banner_heading'] = array(
		'name' => __('Homepage Banner Heading', 'lsx'),
		'id'   => 'home_banner_heading',
		'type' => 'text');

	$options['home_banner_tagline'] = array(
		'name' => __('Homepage Banner Tagline', 'lsx'),
		'id'   => 'home_banner_tagline',
		'type' => 'textarea');

	$options['home_layout'] = array(
		'name'    => __('Home Page Layout', 'lsx'),
		'desc'    => __('Choose homepage layout.', 'lsx'),
		'id'      => "home_layout",
		'std'     => "2c-l",
		'type'    => "images",
		'options' => array(
			'1col' => $imagepath.'1c.png',
			'2c-l' => $imagepath.'2cl.png',
			'2c-r' => $imagepath.'2cr.png',
			'3c-,' => $imagepath.'3cm.png',
			'3c-l' => $imagepath.'3cl.png',
			'3c-r' => $imagepath.'3cr.png')
	);
	
	$options[] = array(
			'name' => __('Banner 1', 'bs-tourism'),
			'desc' => __('Banner image to display on home.', 'bs-tourism'),
			'id'   => 'home_bg_image_1',
			'type' => 'upload');
	$options[] = array(
			'name' => __('Banner 2', 'bs-tourism'),
			'desc' => __('Banner image to display on home.', 'bs-tourism'),
			'id'   => 'home_bg_image_2',
			'type' => 'upload');
	$options[] = array(
			'name' => __('Banner 3', 'bs-tourism'),
			'desc' => __('Banner image to display on home.', 'bs-tourism'),
			'id'   => 'home_bg_image_3',
			'type' => 'upload');
	$options[] = array(
			'name' => __('Banner 4', 'bs-tourism'),
			'desc' => __('Banner image to display on home.', 'bs-tourism'),
			'id'   => 'home_bg_image_4',
			'type' => 'upload');
	$options[] = array(
			'name' => __('Banner 5', 'bs-tourism'),
			'desc' => __('Banner image to display on home.', 'bs-tourism'),
			'id'   => 'home_bg_image_5',
			'type' => 'upload');
	

	$options[] = array('name' => 'Post',
		'type'                   => 'heading');

	$options[] = array(
		'name' => __('Placeholder Image', 'bs-tourism'),
		'desc' => __('Placeholder image for tours without a thumbnail assigned.', 'bs-tourism'),
		'id'   => 'post_placeholder',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Archive Banner Image', 'bs-tourism'),
		'desc' => __('Banner image to display on tours archive page.', 'bs-tourism'),
		'id'   => 'post_banner_image',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Archive Banner Title', 'bs-tourism'),
		'desc' => __('Banner title to display on tours archive page.', 'bs-tourism'),
		'id'   => 'post_banner_title',
		'type' => 'text');

	$options[] = array(
		'name' => __('Archive Banner Tagline', 'bs-tourism'),
		'desc' => __('Banner tagline to display on tours archive page.', 'bs-tourism'),
		'id'   => 'post_banner_tagline',
		'type' => 'text');

	$options[] = array(
		'name' => __('Archive Intro Text', 'bs-tourism'),
		'desc' => __('Intro text to display on tours archive page.', 'bs-tourism'),
		'id'   => 'post_introduction',
		'type' => 'editor');

	$options[] = array(
		'name' => __('Archive Intro Image', 'bs-tourism'),
		'desc' => __('The image which sits inside the description.', 'bs-tourism'),
		'id'   => 'post_archive_introduction_image',
		'type' => 'upload');

	$options['author_box'] = array(
		'name' => __('Post Author Box', 'lsx'),
		'desc' => __('Display the Author Box below posts', 'lsx'),
		'id'   => 'author_box',
		'std'  => '0',
		'type' => 'checkbox');

	$options['related_posts'] = array(
		'name' => __('Related Posts', 'lsx'),
		'desc' => __('Display related posts on single posts', 'lsx'),
		'id'   => 'related_posts',
		'std'  => '1',
		'type' => 'checkbox');

	$options['related_by'] = array(
		'name'    => __('Related By', 'lsx'),
		'id'      => "related_by",
		'std'     => "category",
		'type'    => "radio",
		'options' => array(
			'category' => 'Category',
			'tag'      => 'Tag',
		)
	);

	$options['post_layout'] = array(
		'name'    => __('Post Layout', 'lsx'),
		'desc'    => __('Choose post layout.', 'lsx'),
		'id'      => "post_layout",
		'std'     => "2c-l",
		'type'    => "images",
		'options' => array(
			'1col' => $imagepath.'1c.png',
			'2c-l' => $imagepath.'2cl.png',
			'2c-r' => $imagepath.'2cr.png',
			'3c-,' => $imagepath.'3cm.png',
			'3c-l' => $imagepath.'3cl.png',
			'3c-r' => $imagepath.'3cr.png')
	);

	$options['single_thumbnails'] = array(
		'name' => __('Single Post Thumbnails', 'lsx'),
		'desc' => __('Display featured image on single posts', 'lsx'),
		'id'   => 'single_thumbnails',
		'std'  => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => 'Categories',
		'type' => 'heading');

	$options[] = array(
		'name' => __('Category Banner Image', 'lsx'),
		'desc' => __('Banner image to display on category archive pages.', 'lsx'),
		'id'   => 'category_banner_image',
		'type' => 'upload');

	/*$taxonomy_array = array();
	$taxonomy_defaults = array();
	foreach($this->post_types as $key => $value){
	$taxonomy_array[$key] = ucfirst($key);
	if(in_array($key,$tax_defaults)){
	$taxonomy_defaults[$key] = 1;
	}else{
	$taxonomy_defaults[$key] = 0;
	}
	}

	$options[] = array(
	'name' => __(ucwords(str_replace('-', '_', $tax_key)), 'bs-tourism'),
	'desc' => __('Choose which post types this taxonomy should be active on.', 'bs-tourism' ),
	'id' => 'tourism_'.str_replace('-', '_', $tax_key).'_post_types',
	'options' => $taxonomy_array,
	'std' => $taxonomy_defaults,
	'type' => 'multicheck');
	}*/

	$options[] = array(
		'name' => 'Contact',
		'type' => 'heading');

	$options['contact_name'] = array(
		'name' => __('Name', 'lsx'),
		'id'   => 'contact_name',
		'type' => 'text');

	$options['contact_address'] = array(
		'name' => __('Address', 'lsx'),
		'id'   => 'contact_address',
		'type' => 'editor');

	$options['contact_phone'] = array(
		'name' => __('Telephone', 'lsx'),
		'id'   => 'contact_phone',
		'type' => 'text');

	$options['contact_fax'] = array(
		'name' => __('Fax', 'lsx'),
		'id'   => 'contact_fax',
		'type' => 'text');

	$options['contact_email'] = array(
		'name' => __('Email', 'lsx'),
		'id'   => 'contact_email',
		'type' => 'text');

	$options['contact_map'] = array(
		'name' => __('Map Embed', 'lsx'),
		'id'   => 'contact_map',
		'type' => 'editor');

	$options['contact_form'] = array(
		'name' => __('Gravity Form ID', 'lsx'),
		'id'   => 'contact_form',
		'type' => 'text');

	$options = apply_filters('lsx_options_filter', $options);

	return $options;
}

/**
 * Front End Customizer
 *
 */
add_action('customize_register', 'options_theme_customizer_register');
function options_theme_customizer_register($wp_customize) {
	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */
	$options = optionsframework_options();
	/* Basic */
	$wp_customize->add_section('lsx_basic', array(
			'title'    => __('Basic', 'lsx'),
			'priority' => 35,
		));
	$wp_customize->add_setting('lsx[site_logo]', array(
			'type' => 'option',
		));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'site_logo', array(
				'label'    => $options['site_logo']['name'],
				'section'  => 'lsx_basic',
				'settings' => 'lsx[site_logo]',
			)));
}

/*
 * Outputs the selected option panel styles inline into the <head>
 */

function options_typography_styles() {

	// It's helpful to include an option to disable styles.  If this is selected
	// no inline styles will be outputted into the <head>

	if (!lsx_get_option('disable_styles')) {
		$output = '';
		$input  = '';

		if (lsx_get_option('body_font')) {
			$output .= options_typography_font_styles(lsx_get_option('body_font'), 'body');
		}

		if (lsx_get_option('header_1_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_1_font'), 'h1');
		}

		if (lsx_get_option('header_2_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_2_font'), 'h2');
		}

		if (lsx_get_option('header_3_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_3_font'), 'h3');
		}

		if (lsx_get_option('header_4_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_4_font'), 'h4');
		}

		if (lsx_get_option('header_5_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_5_font'), 'h5');
		}

		if (lsx_get_option('header_6_font')) {
			$output .= options_typography_font_styles(lsx_get_option('header_6_font'), 'h6');
		}

		if (lsx_get_option('link_color')) {
			$output .= 'a {color:'.lsx_get_option('link_color').'}';
		}

		if (lsx_get_option('link_hover_color')) {
			$output .= 'a:hover {color:'.lsx_get_option('link_hover_color').'}';
		}

		if (lsx_get_option('button_color')) {
			$output .= '.btn {background-color:'.lsx_get_option('button_color').'}';
		}

		if (lsx_get_option('button_hover_color')) {
			$output .= '.btn:hover {background-color:'.lsx_get_option('button_hover_color').'}';
		}

		if ($output != '') {
			$output = "\n<style>\n".$output."</style>\n";
			echo $output;
		}
	}
}
add_action('wp_head', 'options_typography_styles');

/*
 * Returns a typography option in a format that can be outputted as inline CSS
 */

function options_typography_font_styles($option, $selectors) {
	$output = $selectors.' {';
	$output .= ' color:'.$option['color'].'; ';
	$output .= 'font-family:'.$option['face'].'; ';
	$output .= 'font-weight:'.$option['style'].'; ';
	$output .= 'font-size:'.$option['size'].'; ';
	$output .= '}';
	$output .= "\n";
	return $output;
}

/**
 * Checks font options to see if a Google font is selected.
 * If so, options_typography_enqueue_google_font is called to enqueue the font.
 * Ensures that each Google font is only enqueued once.
 */

if (!function_exists('options_typography_google_fonts')) {
	function options_typography_google_fonts() {
		$all_google_fonts = array_keys(options_typography_get_google_fonts());
		// Define all the options that possibly have a unique Google font
		$google_font  = lsx_get_option('google_font', array('size' => '13px', 'face' => 'Rokkitt, serif', 'style' => 'normal', 'color' => '#333333'));
		$google_mixed = lsx_get_option('google_mixed', false);
		// Get the font face for each option and put it in an array
		// $google_font = of_get_option('google_font', 'Rokkitt, serif');

		$selected_fonts = array(
			$google_font['face'],
			$google_mixed['face']);
		// Remove any duplicates in the list
		$selected_fonts = array_unique($selected_fonts);
		// Check each of the unique fonts against the defined Google fonts
		// If it is a Google font, go ahead and call the function to enqueue it
		foreach ($selected_fonts as $font) {
			if (in_array($font, $all_google_fonts)) {
				options_typography_enqueue_google_font($font);
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'options_typography_google_fonts');

/**
 * Enqueues the Google $font that is passed
 */

function options_typography_enqueue_google_font($font) {
	$font = explode(',', $font);
	$font = $font[0];
	// Certain Google fonts need slight tweaks in order to load properly
	// Like our friend "Raleway"
	if ($font == 'Raleway') {
		$font = 'Raleway:100';
	}

	$font = str_replace(" ", "+", $font);
	wp_enqueue_style("options_typography_$font", "//fonts.googleapis.com/css?family=$font", false, null, 'all');
}