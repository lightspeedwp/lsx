<?php

/**
 * Yoast Breadcrumbs on Twitter Bootstrap
 * 
 * @author Novrian <me@novrian.info>
 * @copyright (c) 2013. Novrian Y.F.
 * @license MIT License
 * @param string $sep Your custom separator
 */
function lsx_breadcrumbs() {
  if (!function_exists('yoast_breadcrumb')) {
    return null;
  }

  // Default Yoast Breadcrumbs Separator
  $old_sep = '\&raquo\;';

  // Get the crumbs
  $crumbs = yoast_breadcrumb(null, null, false);

  // Remove wrapper <span xmlns:v />
  $output = preg_replace("/^\<span xmlns\:v=\"http\:\/\/rdf\.data\-vocabulary\.org\/#\"\>/", "", $crumbs);
  $output = preg_replace("/\<\/span\>$/", "", $output);

  $crumb = preg_split("/\40(" . $old_sep . ")\40/", $output);

  $crumb = array_map(
    create_function('$crumb', '
      if (preg_match(\'/\<span\40class=\"breadcrumb_last\"/\', $crumb)) {
        return \'<li class="active">\' . $crumb . \'</li>\';
      }
      return \'<li>\' . $crumb . \' </li>\';
      '),
    $crumb
    );

  // Output HTML
  $output = '<div class="breadcrumbs-container" xmlns:v="http://rdf.data-vocabulary.org/#"\><ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';

  // Print
  echo $output;
}

/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lsx
 */

if ( ! function_exists( 'lsx_logo' ) ) :
/**
 * Displays logo when applicable
 *
 * @return void
 */
function lsx_logo() {
	$logo = lsx_get_option('site_logo');

	if ( ! empty( $logo ) ) { 
	
		?> <img src="<?php echo $logo; ?>" alt="<?php bloginfo('name'); ?>"> <?php
	
	} else {
		echo bloginfo('name');
	}
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Add customisable post meta */
/*-----------------------------------------------------------------------------------*/

/**
 * Add customisable post meta.
 *
 * Add customisable post meta, using shortcodes,
 * to be added/modified where necessary.
 *
 * @package WooFramework
 * @subpackage Actions
 */

if ( ! function_exists( 'lsx_post_meta' ) ) {
function lsx_post_meta() {
	if ( is_page() && ! is_page_template( 'page-templates/template-blog.php' ) ) { return; }

	if ( lsx_get_option('post_meta') ) {
		$post_info = lsx_get_option('post_meta');
	} else {
		$post_info = '<span class="small">' . __( 'By', 'lsx' ) . '</span> [post_author_posts_link] <span class="small">' . _x( 'on', 'post datetime', 'lsx' ) . '</span> [post_date] <span class="small">' . __( 'in', 'lsx' ) . '</span> [post_categories before=""] ';
	}

	$post_info = do_shortcode( $post_info );
	
	printf( '<div class="post-meta">%s</div>' . "\n", $post_info );

} // End lsx_post_meta()
}

if ( ! function_exists( 'lsx_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function lsx_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'lsx' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'lsx' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lsx' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lsx_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function lsx_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links pager">

			<?php previous_post_link( '%link', _x( '<div class="previous"><span class="meta-nav">&larr;</span> %title</div>', 'Previous post link', 'lsx' ) ); ?>
			<?php next_post_link(     '%link', _x( '<div class="next">%title <span class="meta-nav">&rarr;</span></div>', 'Next post link',     'lsx' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lsx_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lsx_posted_on() {
	global $post;

	echo 'by '; 
	the_author_posts_link(); 
	echo ' on ' . get_the_date( 'D jS F Y ' ) . ' in ' . get_the_category_list( ', ', '', $post->ID );
}
endif;