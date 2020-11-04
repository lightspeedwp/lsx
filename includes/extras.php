<?php
/**
 * LSX functions and definitions - Integrations - Extras
 *
 * @package    lsx
 * @subpackage extras
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enable shortcode for text widget.
 *
 * @package    lsx
 * @subpackage extras
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

if ( ! function_exists( 'lsx_kses_allowed_html' ) ) :

	/**
	 * Enable extra attributes (srcset, sizes) in img tag.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_kses_allowed_html( $allowedtags, $context ) {
		$allowedtags['img']['srcset'] = true;
		$allowedtags['img']['sizes']  = true;

		$allowedtags['input']['name']  = true;
		$allowedtags['input']['type']  = true;
		$allowedtags['input']['value'] = true;
		$allowedtags['input']['class'] = true;
		$allowedtags['input']['id']    = true;
		$allowedtags['script']['type'] = true;
		return $allowedtags;
	}

endif;

add_filter( 'wp_kses_allowed_html', 'lsx_kses_allowed_html', 10, 2 );

if ( ! function_exists( 'lsx_body_class' ) ) :

	/**
	 * Add and remove body_class() classes.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_body_class( $classes ) {
		global $post;

		$header_layout = get_theme_mod( 'lsx_header_layout', 'inline' );
		$classes[]     = 'header-' . $header_layout;

		$mobile_header_layout = get_theme_mod( 'lsx_header_mobile_layout', 'navigation-bar' );
		$classes[]            = 'mobile-header-' . $mobile_header_layout;

		if ( isset( $post ) ) {
			$classes[] = $post->post_name;
		}

		if ( class_exists( 'LSX_Banners' ) && empty( apply_filters( 'lsx_banner_plugin_disable', false ) ) ) {
			$post_types = array( 'page', 'post' );
			$post_types = apply_filters( 'lsx_allowed_post_type_banners', $post_types );

			$img_group = get_post_meta( $post->ID, 'image_group', true );

			if ( is_singular( $post_types ) && ! empty( $img_group ) && is_array( $img_group ) && ! empty( $img_group['banner_image'] ) ) {
				$classes[] = 'page-has-banner';
			}

			if ( is_singular( $post_types ) && empty( $img_group['banner_image'] ) && ( ! has_post_thumbnail( $post->ID ) ) ) {
				$classes[] = 'page-has-no-banner';
			}
		}

		if ( function_exists( 'tour_operator' ) ) {
			$post_types = array( 'page', 'post' );

			$classes[] = 'to-active';
		}

		if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'top-menu-left' ) ) {
			$classes[] = 'has-top-menu';
		}

		$fixed_header = get_theme_mod( 'lsx_header_fixed', false );

		if ( ( false !== $fixed_header ) && ( ! is_page_template( 'page-templates/template-cover.php' ) ) ) {
			$classes[] = 'top-menu-fixed';
		}

		$search_form = get_theme_mod( 'lsx_header_search', false );

		if ( false !== $search_form ) {
			$classes[] = 'has-header-search';
		}

		$register_enabled = get_option( 'users_can_register', false );
		if ( ( $register_enabled ) && is_page( 'my-account' ) && is_singular() ) {
			$classes[] = 'register-enabled';
		}

		return $classes;
	}

endif;

add_filter( 'body_class', 'lsx_body_class' );

if ( ! function_exists( 'lsx_embed_wrap' ) ) :

	/**
	 * Wrap embedded media as suggested by Readability.
	 *
	 * @package    lsx
	 * @subpackage extras
	 *
	 * @link https://gist.github.com/965956
	 * @link http://www.readability.com/publishers/guidelines#publisher
	 */
	function lsx_embed_wrap( $cache, $url, $attr = '', $post_id = '' ) {
		if ( false !== strpos( $cache, '<iframe' ) ) {
			return '<div class="entry-content-asset">' . $cache . '</div>';
		}

		return $cache;
	}

endif;

add_filter( 'embed_oembed_html', 'lsx_embed_wrap', 10, 4 );

if ( ! function_exists( 'lsx_remove_self_closing_tags' ) ) :

	/**
	 * Remove unnecessary self-closing tags.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_remove_self_closing_tags( $input ) {
		return str_replace( ' />', '>', $input );
	}

endif;

add_filter( 'get_avatar', 'lsx_remove_self_closing_tags' ); // <img />
add_filter( 'comment_id_fields', 'lsx_remove_self_closing_tags' ); // <input />
add_filter( 'post_thumbnail_html', 'lsx_remove_self_closing_tags' ); // <img />

if ( ! function_exists( 'lsx_is_element_empty' ) ) :

	/**
	 * Checks if a Nav $element is empty or not.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_is_element_empty( $element ) {
		$element = trim( $element );
		return empty( $element ) ? false : true;
	}

endif;

if ( ! function_exists( 'lsx_get_thumbnail' ) ) :

	/**
	 * return the responsive images.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_get_thumbnail( $size, $image_src = false ) {
		global $wp_version;

		if ( false === $image_src ) {
			$post_id           = get_the_ID();
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			if ( empty( $post_thumbnail_id ) ) {
				$post_thumbnail_id = apply_filters( 'lsx_get_thumbnail_post_placeholder_id', $post_thumbnail_id, $post_id );
			}
		} elseif ( false !== $image_src ) {
			if ( is_numeric( $image_src ) ) {
				$post_thumbnail_id = $image_src;
			} else {
				$post_thumbnail_id = lsx_get_attachment_id_from_src( $image_src );
				if ( empty( $post_thumbnail_id ) ) {
					$post_thumbnail_id = apply_filters( 'lsx_get_thumbnail_post_placeholder_id', $post_thumbnail_id, $post_id );
				}
			}
		}

		$size      = apply_filters( 'lsx_thumbnail_size', $size );
		$img       = '';
		$lazy_img  = '';
		$image_url = '';

		if ( 'lsx-thumbnail-single' === $size || 'lsx-thumbnail-wide' === $size || 'lsx-thumbnail-square' === $size || 'thumbnail' === $size ) {
			$srcset = false;
			if ( ( ( 'team' === get_post_type() ) || ( 'testimonial' === get_post_type() ) ) && is_search() ) {
				$img = get_the_post_thumbnail_url( get_the_ID(), 'lsx-thumbnail-wide' );
			} else {
				$temp_img = wp_get_attachment_image_src( $post_thumbnail_id, $size );
				if ( ! empty( $temp_img ) ) {
					$img = $temp_img[0];
				}
			}
		} else {
			$srcset = true;
			$img    = wp_get_attachment_image_srcset( $post_thumbnail_id, $size );

			$temp_lazy = wp_get_attachment_image_src( $post_thumbnail_id, $size );
			if ( ! empty( $temp_lazy ) ) {
				$lazy_img = $temp_lazy[0];
			}

			if ( empty( $img ) ) {
				$srcset = false;
				if ( ! empty( $lazy_img ) ) {
					$img = $lazy_img;
				}
			}
		}

		if ( '' !== $img ) {

			$image_url = $img;

			$img = '<img title="' . the_title_attribute( 'echo=0' ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="attachment-responsive wp-post-image lsx-responsive" ';

			if ( version_compare( $wp_version, '5.5', '>=' ) ) {
				$img = '<img loading="lazy" title="' . the_title_attribute( 'echo=0' ) . '" alt="' . the_title_attribute( 'echo=0' ) . '" class="attachment-responsive wp-post-image lsx-responsive wp-lazy" ';
			}

			if ( $srcset ) {
				$img .= 'srcset="' . esc_attr( $image_url ) . '" ';
			} else {
				$img .= 'src="' . esc_url( $image_url ) . '" ';
			}
			$img .= '/>';

			if ( ! version_compare( $wp_version, '5.5', '>=' ) ) {
				$img = apply_filters( 'lsx_lazyload_filter_images', $img );
				$img = apply_filters( 'lsx_lazyload_slider_images', $img, $post_thumbnail_id, $size, $srcset, $image_url );
			}
		}

		return $img;
	}

endif;

if ( ! function_exists( 'lsx_thumbnail' ) ) :

	/**
	 * Output the Resonsive Images.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_thumbnail( $size = 'thumbnail', $image_src = false ) {
		echo wp_kses_post( lsx_get_thumbnail( $size, $image_src ) );
	}

endif;

if ( ! function_exists( 'lsx_get_attachment_id_from_src' ) ) :

	/**
	 * Gets the attachments ID from the src.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_get_attachment_id_from_src( $image_src ) {
		$post_id = wp_cache_get( $image_src, 'lsx_get_attachment_id_from_src' );

		if ( false === $post_id ) {
			global $wpdb;
			$post_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s' LIMIT 1", $image_src ) );
			wp_cache_set( $image_src, $post_id, 'lsx_get_attachment_id_from_src', 3600 );
		}

		return $post_id;
	}

endif;

if ( ! function_exists( 'lsx_page_banner' ) ) :

	/**
	 * Add Featured Image as Banner on Single Pages.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_page_banner() {
		if ( true === apply_filters( 'lsx_page_banner_disable', false ) ) {
			return;
		}

		$post_types = array( 'page', 'post' );
		$post_types = apply_filters( 'lsx_allowed_post_type_banners', $post_types );

		if ( is_singular( $post_types ) && has_post_thumbnail() ) :
			$bg_image = '';

			if ( has_post_thumbnail() ) {
				$temp_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
				if ( ! empty( $temp_bg_image ) ) {
					$bg_image = $temp_bg_image[0];
				}
			}

			if ( '' !== $bg_image ) :
				?>
					<div class="page-banner-wrap">
						<div class="page-banner">
							<?php lsx_banner_inner_top(); ?>

							<div class="page-banner-image" style="background-image:url(<?php echo esc_attr( $bg_image ); ?>);"></div>

							<div class="container">
								<header class="page-header">
									<h1 class="page-title"><?php the_title(); ?></h1>
									<?php lsx_banner_content(); ?>
								</header>
							</div>

							<?php lsx_banner_inner_bottom(); ?>
						</div>
					</div>
				<?php
			endif;
		endif;
	}

endif;

add_filter( 'lsx_banner_disable', 'lsx_disable_banner_for_blocks' );
add_filter( 'lsx_global_header_disable', 'lsx_disable_banner_for_blocks' );


if ( ! function_exists( 'lsx_disable_banner_for_blocks' ) ) :

	/**
	 * Disable the Banner if the page is using Blocks
	 *
	 * @package    lsx
	 * @subpackage extras
	 *
	 * @param  $disable boolean
	 * @return boolean
	 */
	function lsx_disable_banner_for_blocks( $disable ) {
		$queried_object = get_queried_object_id();
		$show_on_front  = get_option( 'show_on_front' );

		if ( 'page' === $show_on_front && (int) get_option( 'page_for_posts' ) === $queried_object ) {
			return $disable;
		}

		if ( function_exists( 'has_blocks' ) && has_blocks() && ( ! is_archive() ) ) {
			$disable = true;
		}

		// Single projects will still have banners.
		if ( function_exists( 'has_blocks' ) && has_blocks() && ( is_singular( 'project' ) ) ) {
			$disable = false;
		}
		return $disable;
	}

endif;

add_action( 'lsx_header_after', 'lsx_page_banner' );

if ( ! function_exists( 'lsx_form_submit_button' ) ) :

	/**
	 * filter the Gravity Forms button type.
	 *
	 * @package    lsx
	 * @subpackage extras
	 *
	 * @param  $button String
	 * @param  $form   Object
	 * @return String
	 */
	function lsx_form_submit_button( $button, $form ) {
		return "<button class='btn btn-primary' id='gform_submit_button_{$form["id"]}'><span>Submit</span></button>";
	}

endif;

add_filter( 'gform_submit_button', 'lsx_form_submit_button', 10, 2 );

if ( ! function_exists( 'lsx_excerpt_more' ) ) :

	/**
	 * Replaces the excerpt "more" text by a link.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_excerpt_more( $more ) {
		return '...';
	}

endif;

add_filter( 'excerpt_more', 'lsx_excerpt_more' );

if ( ! function_exists( 'lsx_the_excerpt_filter' ) ) :

	/**
	 * Add a continue reading link to the excerpt.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_the_excerpt_filter( $excerpt ) {

		$post_formats = array(
			'aside'   => 'aside',
			'gallery' => 'gallery',
			'link'    => 'link',
			'image'   => 'image',
			'quote'   => 'quote',
			'status'  => 'status',
			'video'   => 'video',
			'audio'   => 'audio',
		);

		$show_full_content = has_post_format( apply_filters( 'lsx_the_excerpt_filter_post_types', $post_formats ) );

		if ( ! $show_full_content ) {
			if ( '' !== $excerpt && ! stristr( $excerpt, 'moretag' ) ) {
				$pagination = wp_link_pages(
					array(
						'before'      => '<div class="lsx-postnav-wrapper"><div class="lsx-postnav">',
						'after'       => '</div></div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'echo'        => 0,
					)
				);

				if ( ! empty( $pagination ) ) {
					$excerpt .= $pagination;
				} else {
					$excerpt_more = '<p><a class="moretag" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read More', 'lsx' ) . '</a></p>';
					$excerpt .= apply_filters( 'excerpt_more_p', $excerpt_more );
				}
			}
		}

		return $excerpt;
	}

endif;

add_filter( 'the_excerpt', 'lsx_the_excerpt_filter', 1, 20 );

if ( ! function_exists( 'lsx_full_width_widget_classes' ) ) :

	/**
	 * Filter sidebar widget params, to add the widget_lsx_full_width_alt or widget_lsx_full_width classes to the text widget.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_full_width_widget_classes( $params ) {
		if ( is_admin() ) {
			return $params;
		}

		global $wp_registered_widgets;

		$widget_id   = $params[0]['widget_id'];
		$widget_name = $params[0]['widget_name'];

		if ( 'Text' === $widget_name ) {
			$wp_registered_widgets[ $widget_id ]['original_callback'] = $wp_registered_widgets[ $widget_id ]['callback'];
			$wp_registered_widgets[ $widget_id ]['callback']          = 'lsx_full_width_widget_custom_callback';
		}

		return $params;
	}

endif;

add_filter( 'dynamic_sidebar_params', 'lsx_full_width_widget_classes' );

if ( ! function_exists( 'lsx_full_width_widget_custom_callback' ) ) :

	/**
	 * Filter sidebar widget params, to add the widget_lsx_full_width_alt or widget_lsx_full_width classes to the text widget.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function full_width_widget_custom_callback() {
		global $wp_registered_widgets;

		$original_callback_params = func_get_args();
		$widget_id                = $original_callback_params[0]['widget_id'];

		$original_callback                               = $wp_registered_widgets[ $widget_id ]['original_callback'];
		$wp_registered_widgets[ $widget_id ]['callback'] = $original_callback;

		$widget_id_base = $wp_registered_widgets[ $widget_id ]['callback'][0]->id_base;

		$widget_classname = '';

		if ( is_callable( $original_callback ) ) {
			ob_start();
			call_user_func_array( $original_callback, $original_callback_params );
			$widget_output = ob_get_clean();

			echo wp_kses_post( apply_filters( 'lsx_widget_output', $widget_output, $widget_id_base, $widget_classname, $widget_id ) );
		}
	}

endif;

if ( ! function_exists( 'lsx_full_width_widget_output' ) ) :

	/**
	 * Filter sidebar widget params, to add the widget_lsx_full_width_alt or widget_lsx_full_width classes to the text widget.
	 *
	 * @package    lsx
	 * @subpackage extras
	 */
	function lsx_full_width_widget_output( $widget_output, $widget_id_base, $widget_id ) {
		if ( 'text' === $widget_id_base ) {
			if ( false !== strpos( $widget_output, '<div class="lsx-full-width-alt">' ) ) {
				$widget_output = str_replace( 'class="widget widget_text"', 'class="widget widget_text widget_lsx_full_width_alt"', $widget_output );
			} elseif ( false !== strpos( $widget_output, '<div class="lsx-full-width">' ) ) {
				$widget_output = str_replace( 'class="widget widget_text"', 'class="widget widget_text widget_lsx_full_width"', $widget_output );
			}
		}

		return $widget_output;
	}

endif;

add_filter( 'lsx_widget_output', 'lsx_full_width_widget_output', 10, 3 );

/**
 * Check if the content has a restricted post format that needs to show a full excerpt.
 */
function lsx_post_format_force_content_on_list() {
	$post_formats = apply_filters( 'lsx_post_format_force_content_on_list',
		array(
			'video' => 'video',
			'audio' => 'audio',
			'quote' => 'quote',
			'link'  => 'link',
		)
	);
	$return       = false;
	if ( ! has_post_format( $post_formats ) ) {
		$return = true;
	}
	return $return;
}

/**
 * Remove the Hentry Class Every
 */
function lsx_remove_hentry( $classes ) {
	if ( 'post' !== get_post_type() ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
	}
	return $classes;
}
add_filter( 'post_class', 'lsx_remove_hentry' );

/**
 * Strip Excerpts.
 */
function lsx_strip_excerpt( $content ) {
	if ( is_search() || is_archive() || ( is_blog_installed() && ! is_single() && ! is_page() ) ) {
		$content = strip_shortcodes( $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		$content = strip_tags( $content );
	}
	return $content;
}
add_filter( 'the_content', 'lsx_strip_excerpt' );

/**
 * Disable Gutenberg for LSX Custom Post Types.
 */
function lsx_disable_gutenberg_product_type( $is_enabled, $post_type ) {
	if ( 'testimonial' === $post_type || 'team' === $post_type || 'project' === $post_type ) {
		return false;
	}

	return $is_enabled;
}
add_filter( 'gutenberg_add_edit_link_for_post_type', 'lsx_disable_gutenberg_product_type', 10, 2 );

/**
 * Add the "Blog" link to the breadcrumbs
 *
 * @param $crumbs
 * @return array
 */
function lsx_breadcrumbs_blog_link( $crumbs ) {

	$show_on_front = get_option( 'show_on_front' );

	if ( 'page' === $show_on_front && ( is_category() || is_tag() ) ) {

		$blog_page = get_option( 'page_for_posts' );
		if ( false !== $blog_page && '' !== $blog_page ) {

			$new_crumbs    = array();
			$new_crumbs[0] = $crumbs[0];

			if ( function_exists( 'woocommerce_breadcrumb' ) ) {
				$new_crumbs[1] = array(
					0 => get_the_title( $blog_page ),
					1 => get_permalink( $blog_page ),
				);
			} else {
				$new_crumbs[1] = array(
					'text' => get_the_title( $blog_page ),
					'url'  => get_permalink( $blog_page ),
				);
			}
			$new_crumbs[2] = $crumbs[1];
			$crumbs        = $new_crumbs;

		}
	}
	return $crumbs;
}
add_filter( 'wpseo_breadcrumb_links', 'lsx_breadcrumbs_blog_link', 30, 1 );
add_filter( 'woocommerce_get_breadcrumb', 'lsx_breadcrumbs_blog_link', 30, 1 );

/**
 * Cover template custom styles
 *
 * @return void
 */
function lsx_cover_template_custom_enqueue() {

	if ( ! is_page_template( 'page-templates/template-cover.php' ) ) {
		return;
	}
	$color_overlay_classes = '';

	$cover_text_color  = get_theme_mod( 'lsx_cover_template_overlay_text_color' );
	$cover_menu_color  = get_theme_mod( 'lsx_cover_template_menu_text_color' );
	$cover_hover_color = get_theme_mod( 'lsx_cover_template_text_hover_color' );

	$cover_bg_color         = get_theme_mod( 'lsx_cover_template_cover_background_color' );
	$cover_bg_overlay_color = get_theme_mod( 'lsx_cover_template_overlay_background_color' );

	$color_overlay_opacity = get_theme_mod( 'lsx_cover_template_overlay_opacity' );
	$color_overlay_opacity = ( false === $color_overlay_opacity ) ? 80 : $color_overlay_opacity;
	$color_overlay_opacity = $color_overlay_opacity / 100;

	$color_overlay_opacity_header = $color_overlay_opacity - 0.3;

	$color_overlay_classes .= $color_overlay_opacity;

	$custom_css = ".page-template-template-cover.mobile-header-hamburger #masthead.masthead-open >.container, .post-template-template-cover.mobile-header-hamburger #masthead.masthead-open >.container { background: {$cover_bg_color};color: transparent; } .page-template-template-cover.mobile-header-hamburger #masthead.masthead-open >.container:before, .post-template-template-cover.mobile-header-hamburger #masthead.masthead-open >.container:before { background: currentColor; content: ''; opacity: {$color_overlay_opacity_header}; position: absolute; bottom: 0; left: 0; right: 0; top: 0; display: block; } .page-template-template-cover .entry-header .entry-title, .post-template-template-cover .entry-header .entry-title, .post-template-template-cover #primary #main .entry-categories-inner a, .page-template-template-cover #primary #main .entry-header *, .post-template-template-cover #primary #main .entry-header * {color: {$cover_text_color};} .page-template-template-cover .entry-header .entry-title, .post-template-template-cover .entry-header .entry-title, .page-template-template-cover #primary #main .entry-header a:hover, .post-template-template-cover #primary #main .entry-header a:hover {color: {$cover_hover_color};} .page-template-template-cover .cover-header .cover-header-inner-wrapper .cover-header-inner .cover-color-overlay, .page-template-template-cover .cover-header .cover-header-inner-wrapper .cover-header-inner .cover-color-overlay::before, .post-template-template-cover .cover-header .cover-header-inner-wrapper .cover-header-inner .cover-color-overlay, .post-template-template-cover .cover-header .cover-header-inner-wrapper .cover-header-inner .cover-color-overlay::before {opacity: {$color_overlay_opacity};} .page-template-template-cover.mobile-header-hamburger #masthead .wrapper-toggle .navbar-toggle:hover .icon-bar, .post-template-template-cover.mobile-header-hamburger #masthead .wrapper-toggle .navbar-toggle:hover .icon-bar {background-color: {$cover_hover_color};} @media (min-width: 1200px) {.page-template-template-cover .header-wrap #masthead .primary-navbar > .nav > .menu-item > a, .page-template-template-cover .header-wrap #masthead .primary-navbar > .nav > .menu-item.active > a, .post-template-template-cover .header-wrap #masthead .primary-navbar > .nav > .menu-item > a, .post-template-template-cover .header-wrap #masthead .primary-navbar > .nav > .menu-item.active > a { color: {$cover_menu_color};} }";
		wp_add_inline_style( 'lsx_main', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'lsx_cover_template_custom_enqueue' );

/**
 * Determines if the request is an REST API request.
 *
 * @return bool True if it's a REST API request, false otherwise.
 */
function lsx_is_rest_api_request() {
	$rest_helper = LSX_Rest_Helper::get_instance();
	return $rest_helper->is_rest_api_request();
}

/**
 * Remove lazy loading on Custom logo.
 *
 * @param [type] $attributes
 * @return void
 */
function lsx_custom_logo_attributes( $attributes ) {
	$attributes['loading'] = 'eager';
	return $attributes;
}
add_filter( 'get_custom_logo_image_attributes', 'lsx_custom_logo_attributes' );

/**
 * Redirects non admin users to home.
 *
 * @return void
 */
function lsx_blockusers_init() {
	if ( is_admin() && ( current_user_can( 'teacher' ) || current_user_can( 'customer' ) ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		wp_safe_redirect( home_url() );
		exit;
	}
}
add_action( 'init', 'lsx_blockusers_init' );
