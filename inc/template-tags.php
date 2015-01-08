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
  //$output = '<div class="breadcrumbs-container" xmlns="http://rdf.data-vocabulary.org/#"> <ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';
  $output = '<div class="breadcrumbs-container"> <ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';

  // Print
  echo $output;
}

/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lsx
 */
if ( ! function_exists( 'lsx_site_title' ) ) :
	/**
	 * Displays logo when applicable
	 *
	 * @return void
	*/
	function lsx_site_title() {
		?>
			<div class="site-branding">
				<h1 class="site-title"><a title="<?php bloginfo( 'name' ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<p class="site-description"><?php bloginfo( 'description' ); ?></p>
			</div>		
		<?php 
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
 */

if ( ! function_exists( 'lsx_post_meta' ) ) {
	function lsx_post_meta() {
		if ( is_page() && ! is_page_template( 'page-templates/template-blog.php' ) ) { return; } ?>
		
		<div class="post-meta">
			<div class="post-date">
				<span class="genericon genericon-month"></span>
				<?php
					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
					
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						get_the_date(),
						esc_attr( get_the_modified_date( 'c' ) ),
						get_the_modified_date()
					);
					printf( '<a href="%2$s" rel="bookmark">%3$s</a>',
						_x( 'Posted on', 'Used before publish date.', 'lsx' ),
						esc_url( get_permalink() ),
						$time_string
					);
				?>
			</div>

			<div class="post-author">

				<?php
					if ( ! is_sticky() ) { ?>
						<span class="genericon genericon-user"></span>

						<?php printf( '<a class="url fn n" href="%2$s">%3$s</a>',
							_x( 'Author', 'Used before post author name.', 'lsx' ),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
							get_the_author()
						);
					}
				?>
			</div>

			<div class="post-categories">
				<span class="genericon genericon-category"></span>
				<?php 
					$categories = get_categories($args);

					foreach ( $categories as $category ) {
			    	echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ';
			    	} 
		    	?>
			</div>

			<?php echo get_the_tag_list('<div class="post-tags"><span class="genericon genericon-tag"></span> ',', ','</div>'); ?>

		</div>

	<?php } // End lsx_post_meta() 
}

/**
 * Add customisable post format html.
 */

if ( ! function_exists( 'lsx_post_format' ) ) {
	function lsx_post_format() {
		global $post;
		
		$post_format = get_post_format($post);
		
		if('standard' != $post_format && '' != $post_format) {
			$format_link = get_post_format_link($post_format);
			?>
	    	<div class="post-format">
	    		<?php echo '<span class="genericon"></span><a href="' . $format_link . '" title="' . sprintf( __( "View all %s posts" ), ucfirst($post_format) ) . '" ' . '>' . $post_format . '</a> '; ?>
	    	</div>			
			<?php 
		}
	} // End lsx_post_format()
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
		
		
		if(true == get_option('infinite_scroll',1) && function_exists('the_neverending_home_page_init')){
			return true;
		}elseif(function_exists('wp_pagenavi')){
			wp_pagenavi();
		}else{
		
			$args = array(
					'prev_text'          => __( '<span class="meta-nav">&larr;</span> Older posts', 'lsx' ),
					'next_text'          => __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lsx' ),
					'screen_reader_text' => ' '
			);
			the_post_navigation($args);
		}
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
		
		$args = array(
				'prev_text'          => '<span class="meta-nav">&larr;</span> %title',
				'next_text'          => '%title <span class="meta-nav">&rarr;</span>',
				'screen_reader_text' => ' ',
		);
		the_post_navigation($args);
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