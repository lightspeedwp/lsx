<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

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
  
  if(!class_exists('Lsx_Banners')){
		$post_types = array('page','post');
		$post_types = apply_filters('lsx_allowed_post_type_banners',$post_types);  

		if((is_singular($post_types) && has_post_thumbnail()) 
		|| (is_singular('jetpack-portfolio'))){
			$classes[] = 'page-has-banner';
		}
	}

  if (has_nav_menu('top-menu')) {
  	$classes[] = 'has-top-menu';
  }

	if ( get_theme_mod( 'lsx_preloader_content_status', '1' ) === '1' ) {
		$classes[] = 'preloader-content-enable';
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
	 * @param  string $url
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
	
	if(false === $image_src){
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
	$img = false;
	if($size === 'lsx-thumbnail-wide' || $size === 'thumbnail'){
		$srcset = false;
		$img = wp_get_attachment_image_src($post_thumbnail_id,$size);
		$img = $img[0];
	}else{
		$srcset = true;
		$img = wp_get_attachment_image_srcset($post_thumbnail_id,$size);
		if($img == false) {
			$srcset = false;
			$img = wp_get_attachment_image_src($post_thumbnail_id,$size);
			$img = $img[0];
		}
	}
	if ($srcset) {
		$img = '<img alt="'.get_the_title(get_the_ID()).'" class="attachment-responsive wp-post-image lsx-responsive" srcset="'.$img.'" />';
	} else {
		$img = '<img alt="'.get_the_title(get_the_ID()).'" class="attachment-responsive wp-post-image lsx-responsive" src="'.$img.'" />';
	}
	$img = apply_filters('lsx_lazyload_filter_images',$img);
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
	$post_id = $wpdb->get_var($query);
	return $post_id;
}


/**
 * Add Featured Image as Banner on Single Pages.
 *
 * @package lsx
 * @subpackage extras
 * @category banner
 */
if (!function_exists('lsx_page_banner')) {
	function lsx_page_banner() {

		$post_types = array('page','post');
		$post_types = apply_filters('lsx_allowed_post_type_banners',$post_types);	
		
		if ( (is_singular($post_types) && has_post_thumbnail())
		 || (is_singular('jetpack-portfolio')) ) { ?>
	        
	        <?php 
	        	$bg_image = '';
	        	if(has_post_thumbnail()){
	        		$bg_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
	        		$bg_image = $bg_image[0];
	        	}
	        ?>

	   		<?php if ( ! empty( $bg_image ) ) : ?>
	        
	        <div class="page-banner-wrap">
		        <div class="page-banner">
		        	<div class="page-banner-image" style="background-image:url(<?php echo $bg_image; ?>);"></div>

		        	<div class="container">
			            <header class="page-header">
			            	<h1 class="page-title"><?php the_title(); ?></h1> 
			           		<?php lsx_banner_content(); ?>
			            </header>
			        </div>
		        </div>
		    </div>

	    	<?php endif ?>

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


/**
 * Adding browser and user-agent classes to body
 */
function mv_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
                $classes[] = 'ie';
                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
           }
        return $classes;
}
add_filter('body_class','mv_browser_body_class');


/**
 * filter the Gravity Forms button type
 * 
 * @subpackage 	extras
 * @category 	gforms
 * 
 * @param		$button		String
 * @param		$form		Object
 * @return		String
 */
function lsx_form_submit_button($button, $form){
	return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
}
add_filter("gform_submit_button", "lsx_form_submit_button", 10, 2);


/**
 * Replaces the excerpt "more" text by a link
 */
function lsx_excerpt_more($more) {
	global $post;
	//return ' ... <a class="moretag" href="'. get_permalink($post->ID) . '">'.__('Continue reading','lsx').'</a>';
	return '...';
}
add_filter( 'excerpt_more', 'lsx_excerpt_more' );


/**
 * Add a continue reading link to the excerpt
 */
function lsx_the_excerpt_filter($excerpt) {
	$show_full_content = has_post_format(apply_filters('lsx_the_excerpt_filter_post_types', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio')));
	
	if (!$show_full_content) {
		if ('' !== $excerpt  && !stristr($excerpt, 'moretag')) {
			$pagination = wp_link_pages( array(
							'before' => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
							'after' => '</div></div>',
							'link_before' => '<span>',
							'link_after' => '</span>',
							'echo' => 0
						) );

			if ( ! empty( $pagination ) ) {
				$excerpt .= $pagination;
			}
			else {
				$excerpt .= '<p><a class="moretag" href="'.get_permalink().'">'.__('Continue reading','lsx').'</a></p>';
			}
		}
	}

	return $excerpt;
}
add_filter( 'the_excerpt', 'lsx_the_excerpt_filter' , 1 , 20 );


/**
 * Allow HTML tags in excerpt
 */
if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) {
	function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
		global $post;
		$raw_excerpt = $wpse_excerpt;

		if ( '' == $wpse_excerpt ) {
			$wpse_excerpt = get_the_content('');
			$show_full_content = has_post_format(array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio'));

			if (!$show_full_content) {
				$wpse_excerpt = strip_shortcodes( $wpse_excerpt );
				$wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
				$wpse_excerpt = str_replace(']]>', ']]>', $wpse_excerpt);
				//$wpse_excerpt = strip_tags($wpse_excerpt, '<blockquote>,<p>');

				$excerpt_word_count = 50;
				$excerpt_word_count = apply_filters('excerpt_length', $excerpt_word_count);
				$tokens = array();
				$excerptOutput = '';
				$has_more = false;
				$count = 0;

				preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

				foreach ($tokens[0] as $token) { 
					if ($count >= $excerpt_word_count && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) {
						$excerptOutput .= trim($token);
						$has_more = true;
						break;
					}

					$count++;
					$excerptOutput .= $token;
				}

				$wpse_excerpt = trim(force_balance_tags($excerptOutput));

				if ($has_more) {
					$excerpt_end = '<a class="moretag" href="'.get_permalink().'">'.__('More','lsx').'</a>';
					$excerpt_end = apply_filters('excerpt_more', ' ' . $excerpt_end); 

					$pos = strrpos($wpse_excerpt, '</');

					if ($pos !== false) {
						// Inside last HTML tag
						$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
					} else {
						// After the content
						$wpse_excerpt .= $excerpt_end; /*Add read more in new paragraph */
					}
				}
			} else {
				$wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
				$wpse_excerpt = str_replace(']]>', ']]>', $wpse_excerpt);
				//$wpse_excerpt = strip_tags($wpse_excerpt, '<blockquote>,<p>');
				$wpse_excerpt = trim(force_balance_tags($wpse_excerpt));
			}

			return $wpse_excerpt;
		}

		return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
	}
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt');
remove_filter( 'the_excerpt', 'wpautop' );
