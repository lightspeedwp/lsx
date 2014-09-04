<?php
/**
 *
 * @package lsx
 */

/**
 * 3. Post Date
 *
 * This function produces the date the post in question was published.
 *
 * @example <code>[post_date]</code> is the default usage
 */
if ( ! function_exists( 'lsx_shortcode_post_date' ) ) {
function lsx_shortcode_post_date ( $atts ) {
	$defaults = array(
		'format' => get_option( 'date_format' ),
		'before' => '',
		'after' => '',
		'label' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$output = sprintf( '<abbr class="date time published" title="%5$s">%1$s%3$s%4$s%2$s</abbr> ', $atts['before'], $atts['after'], $atts['label'], get_the_time($atts['format']), get_the_time('Y-m-d\TH:i:sO') );
	return apply_filters( 'lsx_shortcode_post_date', $output, $atts );
} // End lsx_shortcode_post_date()
}

add_shortcode( 'post_date', 'lsx_shortcode_post_date' );

/**
 * 4. Post Time
 *
 * This function produces the time the post in question was published.
 *
 * @example <code>[post_time]</code> is the default usage
 * @example <code>[post_time format="g:i a" before="<b>" after="</b>"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_time' ) ) {
function lsx_shortcode_post_time ( $atts ) {
	$defaults = array(
		'format' => get_option( 'time_format' ),
		'before' => '',
		'after' => '',
		'label' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$output = sprintf( '<abbr class="time published" title="%5$s">%1$s%3$s%4$s%2$s</abbr> ', $atts['before'], $atts['after'], $atts['label'], get_the_time($atts['format']), get_the_time('Y-m-d\TH:i:sO') );
	return apply_filters( 'lsx_shortcode_post_time', $output, $atts );
} // End lsx_shortcode_post_time()
}

add_shortcode( 'post_time', 'lsx_shortcode_post_time' );

/**
 * 5. Post Author
 *
 * This function produces the author of the post (display name)
 *
 * @example <code>[post_author]</code> is the default usage
 * @example <code>[post_author before="<b>" after="</b>"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_author' ) ) {
function lsx_shortcode_post_author ( $atts ) {
	$defaults = array(
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', esc_html( get_the_author() ), $atts['before'], $atts['after']);
	return apply_filters( 'lsx_shortcode_post_author', $output, $atts );
} // End lsx_shortcode_post_author()
}

add_shortcode( 'post_author', 'lsx_shortcode_post_author' );

/**
 * 6. Post Author Link
 *
 * This function produces the author of the post (link to author URL)
 *
 * @example <code>[post_author_link]</code> is the default usage
 * @example <code>[post_author_link before="<b>" after="</b>"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_author_link' ) ) {
function lsx_shortcode_post_author_link ( $atts ) {
	$defaults = array(
		'nofollow' => FALSE,
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$author = get_the_author();

	//	Link?
	if ( '' != get_the_author_meta( 'url' ) ) {
		//	Build the link
		$author = '<a href="' . esc_url( get_the_author_meta( 'url' ) ) . '" title="' . esc_attr( sprintf( __( 'Visit %s&#8217;s website', 'woothemes' ), $author ) ) . '" rel="external">' . esc_html( $author ) . '</a>';
	}

	$output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after']);
	return apply_filters( 'lsx_shortcode_post_author_link', $output, $atts );
} // End lsx_shortcode_post_author_link()
}

add_shortcode( 'post_author_link', 'lsx_shortcode_post_author_link' );

/**
 * 7. Post Author Posts Link
 *
 * This function produces the display name of the post's author, with a link to their
 * author archive screen.
 *
 * @example <code>[post_author_posts_link]</code> is the default usage
 * @example <code>[post_author_posts_link before="<b>" after="</b>"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_author_posts_link' ) ) {
function lsx_shortcode_post_author_posts_link ( $atts ) {
	$defaults = array(
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	// Darn you, WordPress!
	ob_start();
	the_author_posts_link();
	$author = ob_get_clean();

	$output = sprintf('<span class="author vcard">%2$s<span class="fn">%1$s</span>%3$s</span>', $author, $atts['before'], $atts['after']);
	return apply_filters( 'lsx_shortcode_post_author_posts_link', $output, $atts );
} // End lsx_shortcode_post_author_posts_link()
}

add_shortcode( 'post_author_posts_link', 'lsx_shortcode_post_author_posts_link' );

/**
 * 8. Post Comments
 *
 * This function produces the comment link, or a message if comments are closed.
 *
 * @example <code>[post_comments]</code> is the default usage
 * @example <code>[post_comments zero="No Comments" one="1 Comment" more="% Comments"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_comments' ) ) {
function lsx_shortcode_post_comments ( $atts ) {
	global $post;

	$defaults = array(
		'zero' => '<i class="icon-comment"></i> 0',
		'one' => '<i class="icon-comment"></i> 1',
		'more' => '<i class="icon-comment"></i> %',
		'hide_if_off' => 'enabled',
		'closed_text' => apply_filters( 'lsx_post_more_comment_closed_text', __( 'Comments are closed', 'woothemes' ) ),
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	if ( ( ! get_option( 'lsx_comments' ) || ! comments_open() ) && $atts['hide_if_off'] === 'enabled' )
		return;

	if ( $post->comment_status == 'open' ) {
		// Darn you, WordPress!
		ob_start();
		comments_number( $atts['zero'], $atts['one'], $atts['more'] );
		$comments = ob_get_clean();
		$comments = sprintf( '<a href="%s">%s</a>', get_comments_link(), $comments );
	} else {
		$comments = $atts['closed_text'];
	}

	$output = sprintf('<span class="post-comments comments">%2$s%1$s%3$s</span>', $comments, $atts['before'], $atts['after']);
	return apply_filters( 'lsx_shortcode_post_comments', $output, $atts );
} // End lsx_shortcode_post_comments()
}

add_shortcode( 'post_comments', 'lsx_shortcode_post_comments' );

/**
 * 9. Post Tags
 *
 * This function produces a collection of tags for this post, linked to their
 * appropriate archive screens.
 *
 * @example <code>[post_tags]</code> is the default usage
 * @example <code>[post_tags sep=", " before="Tags: " after="bar"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_tags' ) ) {
function lsx_shortcode_post_tags ( $atts ) {
	$defaults = array(
		'sep' => ', ',
		'before' => __('Tags: ', 'woothemes'),
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$tags = get_the_tag_list( $atts['before'], trim($atts['sep']) . ' ', $atts['after'] );

	if ( !$tags ) return;

	$output = sprintf('<p class="tags"><i class="icon-tag"></i> %s</p> ', $tags);
	return apply_filters( 'lsx_shortcode_post_tags', $output, $atts );
} // End lsx_shortcode_post_tags()
}

add_shortcode( 'post_tags', 'lsx_shortcode_post_tags' );

/**
 * 10. Post Categories
 *
 * This function produces the category link list
 *
 * @example <code>[post_categories]</code> is the default usage
 * @example <code>[post_categories sep=", "]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_categories' ) ) {
function lsx_shortcode_post_categories ( $atts ) {
	$defaults = array(
		'sep' => ', ',
		'before' => '',
		'after' => '',
		'taxonomy' => 'category'
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	$terms = get_the_terms( get_the_ID(), esc_html( $atts['taxonomy'] ) );
	$cats = '';

	if ( is_array( $terms ) && 0 < count( $terms ) ) {
		$links_array = array();
		foreach ( $terms as $k => $v ) {
			$term_name = get_term_field( 'name', $v->term_id, $atts['taxonomy'] );
			$links_array[] = '<a href="' . esc_url( get_term_link( $v, $atts['taxonomy'] ) ) . '" title="' . esc_attr( sprintf( __( 'View all items in %s', 'woothemes' ), $term_name ) ) . '">' . esc_html( $term_name ) . '</a>';
		}

		$cats = join( $atts['sep'], $links_array );
	}

	$output = sprintf('<span class="categories">%2$s%1$s%3$s</span> ', $cats, $atts['before'], $atts['after']);
	return apply_filters( 'lsx_shortcode_post_categories', $output, $atts );
} // End lsx_shortcode_post_categories()
}

add_shortcode( 'post_categories', 'lsx_shortcode_post_categories' );

/**
 * 11. Post Edit
 *
 * This function produces the "edit post" link for logged in users.
 *
 * @example <code>[post_edit]</code> is the default usage
 * @example <code>[post_edit link="Edit", before="<b>" after="</b>"]</code>
 */
if ( ! function_exists( 'lsx_shortcode_post_edit' ) ) {
function lsx_shortcode_post_edit ( $atts ) {
	$defaults = array(
		'link' => '<i class="icon-edit"></i>',
		'before' => '',
		'after' => ''
	);
	$atts = shortcode_atts( $defaults, $atts );

	$atts = array_map( 'wp_kses_post', $atts );

	// Darn you, WordPress!
	ob_start();
	edit_post_link( $atts['link'], $atts['before'], $atts['after'] ); // if logged in
	$edit = ob_get_clean();

	$output = $edit;
	return apply_filters( 'lsx_shortcode_post_edit', $output, $atts );
} // End lsx_shortcode_post_edit()
}

add_shortcode( 'post_edit', 'lsx_shortcode_post_edit' );