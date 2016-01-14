<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

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

   if (function_exists('yoast_breadcrumb')) {
	  $output = '<div class="breadcrumbs-container" xmlns="http://rdf.data-vocabulary.org/#"> <ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';
	  $output = '<div class="breadcrumbs-container"> <ul class="breadcrumb">' . implode("", $crumb) . '</ul></div>';
  }

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



/**
 * Add customisable post meta.
 *
 * Add customisable post meta, using shortcodes,
 * to be added/modified where necessary.
 */

if ( ! function_exists( 'lsx_post_meta' ) ) {
	function lsx_post_meta() {
		if ( (is_page() && !(is_home() || is_front_page())) && ! is_page_template( 'page-templates/template-blog.php' ) ) { return; } ?>
		
		<div class="post-meta">
				<?php
					$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
					
					$time_string = sprintf( $time_string,
						esc_attr( get_the_date( 'c' ) ),
						get_the_date(),
						esc_attr( get_the_modified_date( 'c' ) ),
						get_the_modified_date()
					);
					printf( '%1$s <a href="%2$s" rel="bookmark">%3$s</a>',
						_x( 'Posted on', 'Used before publish date.', 'lsx' ),
						esc_url( get_permalink() ),
						$time_string
					);
				?>

				<?php printf( 'by <a class="url fn n" href="%2$s">%3$s</a>',
					_x( 'Author', 'Used before post author name.', 'lsx' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					get_the_author()
				); ?>


			<?php 
		    	$post_categories = wp_get_post_categories( get_the_ID() );
		    	$cats = array();
		    	foreach($post_categories as $c){
		    			$cat = get_category( $c );
		    			$cats[] = '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" , 'lsx' ), $cat->name ) . '" ' . '>' . $cat->name.'</a>';
		    	}
		    	if(!empty($cats)){ ?>
						<?php _e('in','lsx'); ?> <?php echo implode(', ', $cats); ?>
			<?php } ?>
			
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
				'next' 		=> '<span class="meta-nav">&larr;</span> '.__( 'Older posts', 'lsx' ),
				'previous' 	=> __( 'Newer posts', 'lsx' ).' <span class="meta-nav">&rarr;</span>',
				'title' 	=> __( 'Posts navigation', 'lsx' )
			);
			$labels = apply_filters('lsx_post_navigation_labels',$labels);
			
			extract($labels);
			?>
			<nav class="navigation paging-navigation" role="navigation">
				<div class="lsx-breaker"></div>
				<h1 class="screen-reader-text"><?php echo $title; ?></h1>
				<div class="nav-links">
					<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( $next ); ?></div>
					<?php endif; ?>
		
					<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( $previous ); ?></div>
					<?php endif; ?>
					
					<div class="clearfix"></div>
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
		<div class="lsx-breaker"></div>

		<div class="nav-links pager row">

			<?php
				$previous_post = get_previous_post_link( '%link', '<div class="previous col-md-6"><p class="nav-links-description">'._x( 'Previous Post', 'Previous post link', 'lsx' ).':</p><h3>%title</h3></div>' );
				$previous_post = str_replace('<a','<a',$previous_post);
				echo $previous_post;
			?>
			<?php
				$next_post = get_next_post_link( '%link', '<div class="next col-md-6"><p class="nav-links-description">'._x( 'Next Post', 'Next post link', 'lsx' ).':</p><h3>%title</h3></div>' );
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
 * @category	header
 */
if(!function_exists('lsx_site_identity')){
	function lsx_site_identity(){

		if ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		}else{
			// shouldn't show both together.. its just strange
			if(true == get_theme_mod('site_logo_header_text',1)){
				lsx_site_title();
			}
		}
	}
}


/**
 * Outputs the Nav Menu
 *
 * @package 	lsx
 * @subpackage	template-tags
 * @category	navigation
 */
if(!function_exists('lsx_navbar_header')){
	function lsx_navbar_header(){ ?>
	   	<div class="navbar-header">
	   	
	   		<?php 
	   		$nav_menu = get_theme_mod('nav_menu_locations',false);
			//print_r(get_nav_menu_locations());

	   		if(false != $nav_menu && isset($nav_menu['primary']) && 0 != $nav_menu['primary']){ ?>
		   		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".primary-navbar">
		        	<span class="sr-only"><?php _e('Toggle navigation','lsx'); ?></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		        	<span class="icon-bar"></span>
		   		</button>
	   			<span class="mobile-menu-title">Menu</span>
	   		<?php } ?>
			<?php lsx_site_identity(); ?>
	    </div>
	<?php }
}
//the if statement is for backwards compatability with previous versions of the theme.
add_action('lsx_nav_before','lsx_navbar_header');

/**
 * Outputs the Nav Menu
 *
 * @package 	lsx
 * @subpackage	template-tags
 * @category	navigation
 */
if(!function_exists('lsx_nav_menu')){
	function lsx_nav_menu(){
		$nav_menu = get_theme_mod('nav_menu_locations',false);
		
		//print_r(get_nav_menu_locations());

	    if(false != $nav_menu && isset($nav_menu['primary']) && 0 != $nav_menu['primary']){ ?>
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
	    <?php } elseif(is_customize_preview()) { ?>
	    		<nav class="primary-navbar collapse navbar-collapse" role="navigation">
	    			<div class="alert alert-info" role="alert"><?php _e('Create a menu and assign it here via the "Navigation" panel.','lsx');?></div>
	    		</nav>
	    </div>
	  	<?php }
	}
}

/**
 * Outputs Pages for the Sitemap Template
 *
 * @package 	lsx
 * @subpackage	template-tags
 * @category	sitemap
 */
function lsx_sitemap_pages(){
	$posts_per_page = get_option('posts_per_page');
	if(false == $posts_per_page){
		$posts_per_page = 10;
	}
	
	$page_args = array(
		'post_type'		=>	'page',
		'posts_per_page'=>	$posts_per_page,
		'post_status'	=>	'publish',
		'post_type'		=>	'page',
	);
	$pages = new WP_Query($page_args);
	if($pages->have_posts()){

		echo '<h2>'.__( 'Pages', 'lsx' ).'</h2>';

		echo '<ul>';
		while($pages->have_posts()){ $pages->the_post();
			echo '<li class="page_item page-item-'.get_the_ID().'"><a href="'.get_permalink().'" title="">'.get_the_title().'</a></li>';
		}
		echo '</ul>';
		
		wp_reset_postdata();
	}
}

/**
 * Outputs a custom post type section
 *
 * @package 	lsx
 * @subpackage	template-tags
 * @category	sitemap
 */
function lsx_sitemap_custom_post_type(){
	
	$posts_per_page = get_option('posts_per_page');
	if(false == $posts_per_page){
		$posts_per_page = 10;
	}
	
	$args = array(
			'public'				=> true,
			'_builtin' 				=> false
	);
	$post_types = get_post_types($args , 'names');
	foreach($post_types as $post_type){	

		$post_type_args = array(
				'post_type'		=>	'page',
				'posts_per_page'=>	$posts_per_page,
				'post_status'	=>	'publish',
				'post_type'		=>	$post_type,
		);
		$post_type_items = new WP_Query($post_type_args);
		
		$post_type_object = get_post_type_object($post_type);
		if(null != $post_type_object){
			$title = $post_type_object->labels->name;
		}else{
			$title = ucwords($post_type);
		}
		
		if($post_type_items->have_posts()){
	
			printf( '<h2>'.__( '%1$s', 'lsx' ).'</h2>', $title );
	
			echo '<ul>';
			while($post_type_items->have_posts()){ $post_type_items->the_post();
				echo '<li class="'.get_post_type().'_item '.get_post_type().'-item-'.get_the_ID().'"><a href="'.get_permalink().'" title="">'.get_the_title().'</a></li>';
			}
			echo '</ul>';
	
			wp_reset_postdata();
		}
	}	
}

/**
 * Outputs the public taxonomies
 *
 * @package 	lsx
 * @subpackage	template-tags
 * @category	sitemap
 */
function lsx_sitemap_taxonomy_clouds(){

		$taxonomy_args =  array(
			'public'				=> true,
			'_builtin' 				=> false
		);
		$taxonomies = get_taxonomies($taxonomy_args);
		if(!empty($taxonomies)){
			foreach($taxonomies as $taxonomy_id => $taxonomy) {

				$tag_cloud = wp_tag_cloud(array('taxonomy'=>$taxonomy_id,'echo'=>false));
				if(null != $tag_cloud){
					printf( '<h2>'.__( '%1$s', 'lsx' ).'</h2>', $taxonomy );
					echo '<aside id="'.$taxonomy_id.'" class="widget widget_'.$taxonomy_id.'">'.$tag_cloud.'</aside>';
		        }
	        }
        } 
}

/**
 * Adds subscribe form above footer
 *
 * @package 	lsx
 * @subpackage	hooks
 * @category	forms
 */
add_action( 'lsx_footer_before', 'lsx_footer_subscription_cta', 10 );
function lsx_footer_subscription_cta() {
	if(!function_exists('lsx_is_form_enabled')){ return; }
	$subscribe_form_id = lsx_is_form_enabled('subscribe');
	if(false == $subscribe_form_id) { return; }

	//add Caldera Forms Fields Scripts
	if( defined( 'CFCORE_VER' ) ){
		wp_enqueue_script( 'cf-frontend-fields', CFCORE_URL . 'assets/js/fields.min.js', array('jquery'), CFCORE_VER );
	}

	?>
	<section class="footer-subscribe">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><?php _e( 'Subscribe to Our Newsletter', 'lsx' ); ?></h2>
					<?php echo do_shortcode( '[caldera_form id="'.$subscribe_form_id.'"]' ); ?>
				</div>
			</div>
		</div>
	</section>
	<?php
}

/**
 * Adds our top menu to the theme
 *
 * @package 	lsx
 * @subpackage	hooks
 * @category	menu
 */
add_action( 'lsx_header_top', 'lsx_add_top_menu' );
function lsx_add_top_menu() {
	if (has_nav_menu('top-menu')) { ?>
		<div id="top-menu" class="<?php lsx_top_menu_classes(); ?>">
			<div class="container">
				<nav class="top-menu" role="navigation">
		    		<?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
		    	</nav>	
	    	</div>
	    </div>
	<?php }
}

/**
 * Checks if a caldera form with your slug exists
 *
 * @package 	lsx
 * @subpackage	template-tag
 * @category 	forms
 */
if ( class_exists('Caldera_Forms') && !function_exists( 'lsx_is_form_enabled' ) ) {
	function lsx_is_form_enabled($slug = false) {
		if(false == $slug){ return false; }
	
		$match = false;
		$forms = get_option( '_caldera_forms' , false );
		if(false !== $forms ) {
			foreach($forms as $form_id=>$form_maybe){
				if( trim(strtolower($slug)) == strtolower($form_maybe['name']) ){
					$match = $form_id;
					break;
				}
			}
		}
		if( false === $match ){
			$is_form = Caldera_Forms::get_form( strtolower( $slug ) );
			if( !empty( $is_form ) ){
				return strtolower( $slug );
			}
		}
	
		return $match;
	}
}

/**
 * Return URL from a link in the content
 * 
 * @package 	lsx
 * @subpackage 	extras
 * @category 	urls
 */
function lsx_get_my_url() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return false;

	return esc_url_raw( $matches[1] );
}