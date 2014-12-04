<?php

/**
 *
 * Adds Yoast Breadcrumbs to lsx_content_top
 *
 * @package activeafrica-lsx-child
 * @subpackage Action
 * @author LightSpeed (Domenico)
 * @since 1.0
 */
function lsx_yoast_breadcrumbs(){
	
	$show_on_front = get_option('show_on_front');	
	
	if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) {
		return;
	}
	
	lsx_breadcrumbs();
}
add_action( 'lsx_content_top', 'lsx_yoast_breadcrumbs', 10 );


function lsx_placeholder_image( $html, $post_id = false, $post_thumbnail_id = false, $size = 'thumbnail', $attr = array() )
{
    if ( '' !== $html )
    {
        return $html;
    }

    $placeholder_url = lsx_get_option('placeholder_image');

    $placeholder_id = get_attachment_id( $placeholder_url );

   return wp_get_attachment_image( $placeholder_id, $size );

}
add_filter( 'post_thumbnail_html', 'lsx_placeholder_image' );
/**
 * Add and remove body_class() classes
 */
function lsx_body_class($classes) {
  // Add post/page slug
  if (is_single() || is_page() && !is_front_page()) {
    $classes[] = basename(get_permalink());
  }
  
  //Add the banner class if neccesary
  $show_on_front = get_option('show_on_front');
  if(lsx_get_option('enable_banner',false) && (('page' == $show_on_front && is_front_page()) || ('posts' == $show_on_front && is_home()) )) {
  	$classes[] = 'banner';
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
  $output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
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