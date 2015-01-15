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
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
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
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function lsx_caption($output, $attr, $content) {
  if (is_feed()) {
    return $output;
  }

  $defaults = array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => '',
    'caption' => ''
  );

  $attr = shortcode_atts($defaults, $attr);

  // If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
  if ($attr['width'] < 1 || empty($attr['caption'])) {
    return $content;
  }

  // Set up the attributes for the caption <figure>
  $attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
  $attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
  $attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

  $output  = '<figure' . $attributes .'>';
  $output .= do_shortcode($content);
  $output .= '<figcaption class="caption wp-caption-text">' . esc_html($attr['caption'])	 . '</figcaption>';
  $output .= '</figure>';

  return $output;
}
add_filter('img_caption_shortcode', 'lsx_caption', 10, 3);

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


/**
 * Adds the Site Title in Settings->General as a "title" attribute for the logo link.
 * @param string $html The HTML of the Logo
 * @return string
 */

function lsx_site_logo_title_tag( $html) {
	
	$html = str_replace('<a', '<a title="'.get_bloginfo('name').'" ', $html);
	return $html;
}
add_filter( 'jetpack_the_site_logo', 'lsx_site_logo_title_tag');


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
 * Adds portfolio to the related posts.
 */
function lsx_allowed_related_post_types($allowed_post_types) {
	$allowed_post_types[] = 'jetpack-portfolio';
	foreach($allowed_post_types as $key => $value){
		if('page' == $value){
			unset($allowed_post_types[$key]);
		}
	}
	return $allowed_post_types;
}

/**
 * Set the Portfolio to 9 posts per page
 */
function lsx_portfolio_archive_pagination( $query ) {
	if ( $query->is_post_type_archive(array('jetpack-portfolio')) && $query->is_main_query() ) {
		$query->set( 'posts_per_page', get_option( 'jetpack_portfolio_posts_per_page', '9' ) );
	}
}
add_action( 'pre_get_posts', 'lsx_portfolio_archive_pagination' );

/**
 * Remove the Category from the Jetpack related posts.
 */
function lsx_remove_related_post_context(){
	add_filter( 'jetpack_relatedposts_filter_post_context', '__return_empty_string' );
	add_filter( 'rest_api_allowed_post_types', 'lsx_allowed_related_post_types' );
}
add_action('init','lsx_remove_related_post_context',20);


/**
 * return the responsive images.
 */
function lsx_get_thumbnail($size){
	
	$post_id = ( null === $post_id ) ? get_the_ID() : $post_id;
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );
	
	if('thumbnail-single' == $size){
		$thumbnail = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail-single' );
		$tablet = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );
		$mobile = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail-wide' );
		
		$img = '<img class="attachment-responsive wp-post-image lsx-responsive" src="" data-desktop="'.$thumbnail[0].'" data-tablet="'.$tablet[0].'" data-mobile="'.$mobile[0].'" />';
	}
	return $img;
}

/**
 * Output the Resonsive Images
 */
function lsx_thumbnail($size = 'thumbnail'){
	echo lsx_get_thumbnail($size);
}