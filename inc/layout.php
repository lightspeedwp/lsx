<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Layout hooks
 *
 * @package lsx
 */

function lsx_layout_selector( $class, $area = 'site' ) {

	$layout = get_theme_mod('lsx_layout','2cr');

	$default_size = 'sm';
	$size = apply_filters( 'lsx_bootstrap_column_size', $default_size );

	switch ( $layout ) {
		case '1c':
			$main_class = 'col-' . $size . '-12';
			$sidebar_class = 'col-' . $size . '-12';
			break;
		case '2cr':
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
		case '2cl':
			$main_class = 'col-' . $size . '-8 col-' . $size . '-push-4';
			$sidebar_class = 'col-' . $size . '-4 col-' . $size . '-pull-8';
			break;
		default:
			$main_class = 'col-' . $size . '-8';
			$sidebar_class = 'col-' . $size . '-4';
			break;
	}

	if ( $class == 'main' ) {
		return $main_class;
	}

	if ( $class == 'sidebar' ) {
		return $sidebar_class;
	}
}

/**
 * .main classes
 */
function lsx_main_class() {
	return lsx_layout_selector( 'main' );
}

function lsx_home_main_class() {
	return lsx_layout_selector( 'main', 'home' );
}

/**
 * Outputs the class for the main div on the index.php page only
 */
function lsx_index_main_class() {

	$show_on_front = get_option('show_on_front');
	if('page' == $show_on_front){
		return lsx_layout_selector( 'main', 'home' );
	}else{
		return lsx_layout_selector( 'main', 'site' );
	}

}

/**
 * .sidebar classes
 */
function lsx_sidebar_class() {
	return lsx_layout_selector( 'sidebar' );
}

function lsx_home_sidebar_class() {
	return lsx_layout_selector( 'sidebar', 'home' );
}

add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) { 
	function lsx_add_footer_sidebar_area() {
		if ( is_active_sidebar( 'sidebar-footer-cta' ) ) : ?>
			<section id="footer-cta">
				<div class="container">
					<div class="lsx-full-width">
						<div class="lsx-hero-unit">
							<?php dynamic_sidebar( 'sidebar-footer-cta' ); ?>
						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section id="footer-widgets">
			<h2 class="footer-widgets-title"><?php _e('Footer Widgets','lsx'); ?></h2>
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</div>
			</div>
		</section>
		<?php
	}
}

add_action( 'lsx_footer_before', 'lsx_add_single_properties_bottom' );
if ( ! function_exists( 'lsx_add_single_properties_bottom' ) ) { 
	function lsx_add_single_properties_bottom() {
		if ( is_page_template( 'single_property.php' ) ) { ?>
			<div id="property-single-bottom">
				<script src="https://maps.googleapis.com/maps/api/js?"></script>
			    <script>
			        function initialize() {
			    	
			        var myLatlng = new google.maps.LatLng(-33.92945, 18.45345);

			        var mapOptions = {
				        center: myLatlng,
				        zoom: 15,
				        scrollwheel: false,
				        panControl: false,
					    zoomControl: false,
					    scaleControl: false,
						mapTypeControl: false,
						streetViewControl: false,
						overviewMapControl: false
			        }

			        var map = new google.maps.Map(document.getElementById('ssingle-property-map'),
			            mapOptions);

			        var marker = new google.maps.Marker({
					    position: myLatlng,
					    map: map
					});
			      }

			      google.maps.event.addDomListener(window, 'load', initialize);
			    </script>
				
			    <div id="single-property-map-wrapper">
					<div id="single-property-map" style="width:500px; height:500px;">OOOK</div>
				</div>


				<!-- Similar to the other masonry layouts markup, but note where I've put the excerpts (in the thumbnail anchor tag) -->
				<div id="related-properties" class="col-md-12">
					<h3>Related Properties</h3>

					<div class="lsx-property-wrapper filter-items-wrapper">
						<div id="property-infinite-scroll-wrapper" class="filter-items-container lsx-property masonry">
							<article id="post-3489" class="property">
								<div class="property-content-wrapper">
									<div class="property-thumbnail">
										<a href="http://mushara.feedmybeta.com/properties/mushara-outpost/">
											<span class="related-property-excerpt">This is where the related property excerpt is supposed to be...</span>
											<img class="attachment-responsive wp-post-image lsx-responsive-banner lsx-responsive" src="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Mushara-Outpost-slider-home-2-350x230.jpg" data-desktop="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Mushara-Outpost-slider-home-2-350x230.jpg" data-tablet="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Mushara-Outpost-slider-home-2-350x230.jpg" data-mobile="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Mushara-Outpost-slider-home-2-350x230.jpg" alt="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Mushara-Outpost-slider-home-2-350x230">		
										</a>
									</div>
									
									<div class="property-content">	
										<h3>
											<a href="http://mushara.feedmybeta.com/properties/mushara-outpost/" rel="bookmark">
												<span>Mushara Outpost</span>
											</a>
										</h3>		
										
									</div>
								</div>
							</article>
							
							<article id="post-3488" class="property">
								<div class="property-content-wrapper">
									<div class="property-thumbnail">
										<a href="http://mushara.feedmybeta.com/properties/mushara-bushcamp/">
											<span class="related-property-excerpt">This is where the related property excerpt is supposed to be...</span>
											<img class="attachment-responsive wp-post-image lsx-responsive-banner lsx-responsive" src="http://mushara.feedmybeta.com/wp-content/uploads/2015/04/Mushara-Bush-Camp-tents-exterior-body-350x230.jpg" data-desktop="http://mushara.feedmybeta.com/wp-content/uploads/2015/04/Mushara-Bush-Camp-tents-exterior-body-350x230.jpg" data-tablet="http://mushara.feedmybeta.com/wp-content/uploads/2015/04/Mushara-Bush-Camp-tents-exterior-body-350x230.jpg" data-mobile="http://mushara.feedmybeta.com/wp-content/uploads/2015/04/Mushara-Bush-Camp-tents-exterior-body-350x230.jpg" alt="http://mushara.feedmybeta.com/wp-content/uploads/2015/04/Mushara-Bush-Camp-tents-exterior-body-350x230">
										</a>

									</div>
									
									<div class="property-content">	
										<h3>
											<a href="http://mushara.feedmybeta.com/properties/mushara-bushcamp/" rel="bookmark">
												<span>Mushara Bushcamp</span>
											</a>
										</h3>	
									</div>
								</div>
							</article>
							
							<article id="post-3487" class="property">
								<div class="property-content-wrapper">
									<div class="property-thumbnail">
										<a href="http://mushara.feedmybeta.com/properties/mushara-villa/">
											<span class="related-property-excerpt">This is where the related property excerpt is supposed to be...</span>
											<img class="attachment-responsive wp-post-image lsx-responsive-banner lsx-responsive" src="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Villa-Mushara-Home-Slider-2-350x230.jpg" data-desktop="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Villa-Mushara-Home-Slider-2-350x230.jpg" data-tablet="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Villa-Mushara-Home-Slider-2-350x230.jpg" data-mobile="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Villa-Mushara-Home-Slider-2-350x230.jpg" alt="http://mushara.feedmybeta.com/wp-content/uploads/2015/03/Villa-Mushara-Home-Slider-2-350x230">				
										</a>
									</div>
									
									<div class="property-content">	
										<h3>
											<a href="http://mushara.feedmybeta.com/properties/mushara-villa/" rel="bookmark">
												<span>Mushara Villa</span>
											</a>
										</h3>	
									</div>
								</div>
							</article>
						</div>
					</div>
				</div>
			</div>
		<?php }
	}
}

/**
 * Displays the hompage slider if Soliliquy Lite is active and the Customizer settings are set.
 *
 * @package lsx-theme
 * @subpackage layout
 * @category slider
 */
if ( ! function_exists( 'lsx_homepage_slider' ) && function_exists('soliloquy')  ) { 
	add_action( 'lsx_header_after', 'lsx_homepage_slider' );
	function lsx_homepage_slider() {
		$slider = get_theme_mod( 'lsx_homepage_slider', 0 );
		$show_on_front = get_option('show_on_front');
		if('0' != $slider && (('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()))) {
			 ?>
				<section class="soliloquy-slider lsx-homepage-slider slider-<?php echo $slider;?>">
					<?php soliloquy_slider( $slider ); ?>

					<?php classybeds_enquire_bar(); ?>
				</section>
			<?php
		}
	}
};

/**
 * Displays the blog page title
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_blog_page_title() {
		
		if ('page' == get_option('show_on_front') && get_option('page_for_posts') == get_the_ID()) { ?>
			<header class="page-header">
					<h1 class="page-title"><?php echo get_the_title($blog_page); ?></h1>		
			</header>
		<?php } 
		
}
add_action('lsx_content_top','lsx_blog_page_title',20);