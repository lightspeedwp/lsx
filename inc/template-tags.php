<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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
  $output = preg_replace("/\<\/span\><\/span\>$/", "", $output);

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
 * Replaces the seperator with a blank space.
 *
 */
function lsx_breadcrumbs_seperator_filter($seperator) {
	return '';
}
add_filter( 'wpseo_breadcrumb_separator', 'lsx_breadcrumbs_seperator_filter' );

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

				<span class="genericon genericon-user"></span>

				<?php printf( '<a class="url fn n" href="%2$s">%3$s</a>',
					_x( 'Author', 'Used before post author name.', 'lsx' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				); ?>
			</div>


			<?php 
		    	$post_categories = wp_get_post_categories( get_the_ID() );
		    	$cats = array();
		    	foreach($post_categories as $c){
		    			$cat = get_category( $c );
		    			$cats[] = '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" , 'lsx' ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';
		    	}
		    	if(!empty($cats)){ ?>
					<div class="post-categories">
						<span class="genericon genericon-category"></span>		    	
						<?php echo implode(', ', $cats); ?>
					</div>					
			<?php } ?>


			<?php echo get_the_tag_list('<div class="post-tags"><span class="genericon genericon-tag"></span> ',', ','</div>'); ?>

			
			<div class="clearfix"></div>
		</div>

	<?php } // End lsx_post_meta() 
}

/**
 * Add customisable post format html.
 */

if ( ! function_exists( 'lsx_post_format' ) ) {
	function lsx_post_format() {
		
		$post_format = get_post_format();
		
		if('standard' != $post_format && '' != $post_format) {
			$format_link = get_post_format_link($post_format);
			?>
	    	<div class="post-format">
	    		<?php echo '<span class="genericon"></span><a href="' . esc_url($format_link) . '" title="' . sprintf( __( "View all %s posts" , 'lsx' ), ucfirst($post_format) ) . '" ' . '>' . ucfirst($post_format) . '</a> '; ?>
	    	</div>			
			<?php 
		}
	} // End lsx_post_format()
}

/**
 * Add customisable portfolio meta.
 *
 * Add customisable portfolio meta, using shortcodes,
 * to be added/modified where necessary.
 */

if ( ! function_exists( 'lsx_portfolio_meta' ) ) {
	function lsx_portfolio_meta() {
		?>
		<div id="portfolio-meta" class="portfolio-meta info-box-sticky info-box sticky-wrapper">
			<?php 
				$client = get_post_meta(get_the_ID(),'lsx-client',true);
				if(false != $client){ ?>
					<div class="portfolio-client">
						<span><span class="genericon genericon-user"></span><?php _e('Client','lsx'); ?></span>
						<span><?php echo $client ?></span>
					</div>				
			<?php }	?>

			<?php 
				$portfolio_type = get_the_term_list( get_the_ID(), 'jetpack-portfolio-type', '', ', ', '' );
				
				if($portfolio_type){
					?>
					<div class="portfolio-industry">
						<span><span class="genericon genericon-category"></span><?php _e('Industry','lsx'); ?></span>
						<?php echo $portfolio_type; ?>
					</div>			
			<?php } ?>

			<?php 
				$services = get_the_term_list( get_the_ID(), 'jetpack-portfolio-tag', '', ', ', '' );
				if(false != $services){ ?>
					<div class="portfolio-services">
						<span><span class="genericon genericon-cog"></span><?php _e('Services','lsx'); ?></span>
						<?php echo $services ?>
					</div>				
			<?php }	?>

			<?php 
				$website = esc_url( get_post_meta(get_the_ID(),'lsx-website',true) );
				if(false != $website){ ?>
					<div class="portfolio-website">
						<span><span class="genericon genericon-link"></span><?php _e('Website','lsx'); ?></span>
						<a target="_blank" href="<?php echo esc_url($website); ?>"><?php echo $website ?></a>
					</div>				
			<?php }	?>

		</div>

	<?php } // End lsx_portfolio_meta() 
}

/**
 * Add customisable portfolio gallery.
 *
 */

if ( ! function_exists( 'lsx_portfolio_gallery' ) ) {
	function lsx_portfolio_gallery() {

		$media = get_attached_media( 'image' );
		$media_array = array();
		$post_thumbnail_id = get_post_thumbnail_id(get_the_ID());
		
		if(!empty($media)){
			foreach($media as $media_item){
				if($post_thumbnail_id != $media_item->ID) {
					$media_array[] = $media_item->ID;
				}
			}
				
			if(!empty($media_array)){
				echo gallery_shortcode(array('size'=>'full','ids'=>implode(',', $media_array)));
			}
		}
		
	}
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
		
		if(current_theme_supports('infinite-scroll') && class_exists('The_Neverending_Home_Page')){
			return true;
		}elseif(function_exists('wp_pagenavi')){
			wp_pagenavi();
		}else{
			
			$labels = array(
				'next' 		=> __( '<span class="meta-nav">&larr;</span> Older posts', 'lsx' ),
				'previous' 	=> __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'lsx' ),
				'title' 	=> __( 'Posts navigation', 'lsx' )
			);
			$labels = apply_filters('lsx_post_navigation_labels',$labels);
			
			extract($labels);
			?>
			<nav class="navigation paging-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php echo $title; ?></h1>
				<div class="nav-links">
					<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( $next ); ?></div>
					<?php endif; ?>
		
					<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( $previous ); ?></div>
					<?php endif; ?>
		
				</div><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php
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
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links pager row">

			<?php
				$previous_post = get_previous_post_link( '%link', _x( '<div class="previous"><p class="nav-links-description">Previous Post:</p><span class="meta-nav">&larr;</span> %title</div>', 'Previous post link', 'lsx' ) );
				$previous_post = str_replace('<a','<a',$previous_post);
				echo $previous_post;
			?>
			<?php
				$next_post = get_next_post_link(     '%link', _x( '<div class="next"><p class="nav-links-description">Next Post:</p>%title <span class="meta-nav">&rarr;</span></div>', 'Next post link',     'lsx' ) );
				$next_post = str_replace('<a','<a',$next_post);
				echo $next_post;
			?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Outputs either the Site Title or the Site Logo
 *
 * @package 	lsx
 * @subpackage	template-tags
 */
if(!function_exists('lsx_site_identity')){
	function lsx_site_identity(){

		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} 
		
		if(true == get_theme_mod('site_logo_header_text',1)){
			lsx_site_title();
		}
	}
}

/**
 * Outputs the Nav Menu
 *
 * @package 	lsx
 * @subpackage	template-tags
 */
if(!function_exists('lsx_nav_menu')){
	function lsx_nav_menu(){
		$nav_menu = get_theme_mod('nav_menu_locations',array());
	    if(isset($nav_menu['primary']) && 0 != $nav_menu['primary']){ ?>
			<nav class="primary-navbar collapse navbar-collapse" role="navigation">
		    	<?php
				wp_nav_menu( array(
					'menu' => $nav_menu['primary'],
					'depth' => 2,
					'container' => false,
					'menu_class' => 'nav navbar-nav',
					'walker' => new lsx_bootstrap_navwalker())
				);
				?>
		   		</nav>
	    	<?php } else { ?>
	    		<nav class="primary-navbar collapse navbar-collapse" role="navigation">
		  	<?php
			wp_nav_menu( array(
				'menu' => $nav_menu,
				'depth' => 2,
				'container' => false,
				'menu_class' => 'nav navbar-nav',
				'walker' => new lsx_bootstrap_navwalker())
			);
			?>
	    	</nav>
	    </div>
	  	<?php }
	}
}