<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Adds Yoast Breadcrumbs to lsx_content_top
 */
function lsx_yoast_breadcrumbs(){
	
	$show_on_front = get_option('show_on_front');	
	
	if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) {
		return;
	}
	lsx_breadcrumbs();
}
add_action( 'lsx_content_top', 'lsx_yoast_breadcrumbs', 10 );

/**
 * Add and remove body_class() classes
 */
function lsx_body_class($classes) {
	/*
	 * Add the header layout class
	 */
	$header_layout = get_theme_mod('lsx_header_layout','inline');
	$classes[] = 'header-'.$header_layout;
		
	
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }
  
  $post_types = array('page','post');
  $post_types = apply_filters('lsx_allowed_post_type_banners',$post_types);  

  if((is_singular($post_types) && has_post_thumbnail() && !is_front_page())
  	 || (is_page_template('contact.php') && !is_front_page()) 
  || (is_singular('jetpack-portfolio'))){
  	$classes[] = 'page-has-banner';
  }

  if (has_nav_menu('top-menu')) {
  	$classes[] = 'has-top-menu';
  }

  // Remove unnecessary classes
  $home_id_class = 'page-id-' . get_option('page_on_front');
  $remove_classes = array(
    'page-template-default',
    $home_id_class
  );
  $classes = array_diff($classes, $remove_classes);

  return $classes;
}
add_filter('body_class', 'lsx_body_class');

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function lsx_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'lsx' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'lsx_wp_title', 10, 2 );

/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function lsx_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
  return '<div class="entry-content-asset">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'lsx_embed_wrap', 10, 4);

// function lsx_excerpt_more($more) {
//   return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
// }
// add_filter('excerpt_more', 'lsx_excerpt_more');

/**
 * Remove unnecessary self-closing tags
 */
function lsx_remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}
add_filter('get_avatar',          'lsx_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'lsx_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'lsx_remove_self_closing_tags'); // <img />


/**
 * Clean up output of stylesheet <link> tags
 */
function lsx_clean_style_tag($input) {
  preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
  // Only display media if it is meaningful
  $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}
add_filter('style_loader_tag', 'lsx_clean_style_tag');

if (!function_exists('lsx_get_attachment_id')) {
	/**
	 * Get the Attachment ID for a given image URL.
	 *
	 * @link   http://wordpress.stackexchange.com/a/7094
	 *
	 * @param  string $url
	 *
	 * @return boolean|integer
	 */
	function lsx_get_attachment_id($url) {

		$dir = wp_upload_dir();

		// baseurl never has a trailing slash
		if (false === strpos($url, $dir['baseurl'].'/')) {
			// URL points to a place outside of upload directory
			return false;
		}

		$file  = basename($url);
		$query = array(
				'post_type'  => 'attachment',
				'fields'     => 'ids',
				'meta_query' => array(
						array(
								'value'   => $file,
								'compare' => 'LIKE',
						),
				)
		);

		$query['meta_query'][0]['key'] = '_wp_attached_file';

		// query attachments
		$ids = get_posts($query);

		if (!empty($ids)) {

			foreach ($ids as $id) {

				// first entry of returned array is the URL
				$temp_url = wp_get_attachment_image_src($id, 'full');
				if ($url === array_shift($temp_url)) {
					return $id;
				}
			}
		}

		$query['meta_query'][0]['key'] = '_wp_attachment_metadata';

		// query attachments again
		$ids = get_posts($query);

		if (empty($ids)) {
			return false;
		}

		foreach ($ids as $id) {

			$meta = wp_get_attachment_metadata($id);

			foreach ($meta['sizes'] as $size => $values) {

				if ($values['file'] === $file && $url === array_shift(wp_get_attachment_image_src($id, $size))) {
					return $id;
				}
			}
		}

		return false;
	}
}

/**
 * Get the Avatar Url
 */
function lsx_get_avatar_url($author_id, $size) {
	$get_avatar = get_avatar($author_id, $size);
	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	return ($matches[1]);
}

/**
 * Checks if a Nav $element is empty or not
 */
function lsx_is_element_empty($element) {
	$element = trim($element);
	return empty($element)?false:true;
}


/**
 * return the responsive images.
 * 
 * @package lsx
 * @subpackage extras
 * @category thumbnails
 */
function lsx_get_thumbnail($size,$image_src = false){
	
	if(false == $image_src){
		$post_id = get_the_ID();
		$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	}elseif(false != $image_src	){
		if(is_numeric($image_src)){
			$post_thumbnail_id = $image_src;
		}else{
			$post_thumbnail_id = lsx_get_attachment_id_from_src($image_src);
		}
	}
	
	$size = apply_filters('lsx_thumbnail_size',$size);
	
	if('lsx-thumbnail-single' == $size){
		$thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-single' );
		$tablet = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-single' );
		$mobile = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-wide' );

		$img = '<img class="attachment-responsive wp-post-image lsx-responsive" src="'.$thumbnail[0].'" data-desktop="'.$thumbnail[0].'" data-tablet="'.$tablet[0].'" data-mobile="'.$mobile[0].'" />';

	}elseif('lsx-thumbnail-wide' == $size){
		$thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, $size );
		$tablet = wp_get_attachment_image_src( $post_thumbnail_id, $size );
		$mobile = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-wide' );

		$img = '<img class="attachment-responsive wp-post-image lsx-responsive-banner lsx-responsive" src="'.$thumbnail[0].'" data-desktop="'.$thumbnail[0].'" data-tablet="'.$tablet[0].'" data-mobile="'.$mobile[0].'" />';
	
	}elseif('banner' == $size){
		
		$thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, $image_src );
		$tablet = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-single' );
		$mobile = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-wide' );
				
		$img = ' src="'.$thumbnail[0].'" data-desktop="'.$thumbnail[0].'" data-tablet="'.$tablet[0].'" data-mobile="'.$mobile[0].'"';
		
	}elseif(is_array($size)){
		
		$thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, $size );
		$img = '<img class="attachment-responsive wp-post-image lsx-responsive" src="'.$thumbnail[0].'" data-desktop="'.$thumbnail[0].'" data-tablet="'.$tablet[0].'" data-mobile="'.$mobile[0].'" />';
		
	}
	return $img;
}

/**
 * Output the Resonsive Images
 * 
 * @package lsx
 * @subpackage extras
 * @category thumbnails
 */
function lsx_thumbnail($size = 'thumbnail',$image_src = false){
	echo lsx_get_thumbnail($size,$image_src);
}

/**
 * Gets the attachments ID from the src
 * @package lsx
 * @subpackage extras
 * @category thumbnails
 */
function lsx_get_attachment_id_from_src($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src' LIMIT 1";
	$id = $wpdb->get_var($query);
	return $id;
}

/**
 * Gets the attachments ID from the src
 * @package lsx
 * @subpackage extras
 * @category thumbnails
 */
function lsx_the_content_responsive_image_filter($content) {
	if('post' == get_post_type() && is_single()){
		/*$content = preg_replace('#<img.+?src="([^"]*)".*?/?>#i', '<a href="$1">$0</a>', $content);*/
		
		$content = preg_replace_callback(
				'#<img.+?src="([^"]*)".*?/?>#i',
				function ($matches) {
					
					$post_thumbnail_id = lsx_get_attachment_id_from_src($matches[1]);
					if(false != $post_thumbnail_id){
						$data_tablet = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-single' );
						$data_mobile = wp_get_attachment_image_src( $post_thumbnail_id, 'lsx-thumbnail-wide' );					
						$data_desktop = $matches[1];
						
						return '<img class="attachment-responsive wp-post-image lsx-responsive" data-desktop="'.$data_desktop.'" data-tablet="'.$data_tablet[0].'" data-mobile="'.$data_mobile[0].'" />';
						
					}else{
						return $matches[0];
					}
				},
				$content
		);	
		
	}
	return $content;
}
add_action('the_content','lsx_the_content_responsive_image_filter');

/**
 * A callback function for the preg_replace that changes the images stored in post_content to their responsive counterparts.
 * @package lsx
 * @subpackage extras
 * @category thumbnails
 */

/**
 * Add Featured Image as Banner on Single Pages.
 *
 * @package lsx
 * @subpackage extras
 * @category banner
 */
if(!function_exists('lsx_page_banner')){
	function lsx_page_banner() {

		$show_on_front = get_option('show_on_front','posts');
		$full_experience = get_theme_mod('home_full_experience_enable',false);
		$slider = get_theme_mod( 'lsx_homepage_slider', 0 );
		
		if('page' == $show_on_front && is_front_page() && false != $full_experience) { return; }
		
		$post_types = array('page','post');
		$post_types = apply_filters('lsx_allowed_post_type_banners',$post_types);	
		
		if ( (is_singular($post_types) && has_post_thumbnail())
		 || (is_singular('jetpack-portfolio')) ) { ?>
	        
	        <?php 
	        	$bg_image = '';
	        	if(has_post_thumbnail()){
	        		$bg_image = lsx_get_thumbnail('banner',get_post_thumbnail_id(get_the_ID()));
	        	}
	        ?>
	        
	        <div class="page-banner" style="background-position: 50% 50%" <?php echo $bg_image;  ?>>
	          <header class="page-header">
	            <h1 class="page-title"><?php the_title(); ?></h1>   
	            <?php lsx_banner_content(); ?>
	          </header><!-- .entry-header -->
	        </div>
	    <?php } 
	}
}
add_action( 'lsx_header_after', 'lsx_page_banner' );


/**
 * Add SMS support
 *
 * @package lsx
 * @subpackage extras
 * @category mobile
 */
function lsx_allow_sms_protocol( $protocols ) {
    $protocols[] = 'sms';
    return $protocols;
}

add_filter( 'kses_allowed_protocols', 'lsx_allow_sms_protocol' );
