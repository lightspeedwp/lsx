<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */

?>
<?php
	$show_on_front = get_option('show_on_front');

 	if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) { 
		$layout = lsx_get_option('home_layout'); 
		$sidebar = 'homepage-col-2';
	} else {
		
		$page_layout = get_post_meta( get_the_ID(), 'lsx_layout', true );
		
		if ( $page_layout && $page_layout != "default" ) {
			$layout = $page_layout;
		} else {
			
			if ( is_page_template('page-templates/template-blog.php') ) {
				$layout = lsx_get_option('post_layout');
			}else{
				$layout = lsx_get_option('site_layout');
			}	
		}
		$sidebar = 'sidebar-1';
	}
	if ( $layout !== '1col' ) : ?>

	<?php lsx_sidebars_before(); ?>

	<?php if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) : ?>
	
		<div id="secondary" class="widget-area <?php echo lsx_home_sidebar_class(); ?>" role="complementary">
		
	<?php elseif ( is_page_template('page-templates/template-blog.php') ) : ?>
	
		<div id="secondary" class="widget-area <?php echo lsx_post_sidebar_class(); ?>" role="complementary">
		
	<?php else : ?>
	
		<div id="secondary" class="widget-area <?php echo lsx_sidebar_class(); ?>" role="complementary">
		
	<?php endif ; ?>

		<?php lsx_sidebar_top(); ?>

		<?php if ( ! dynamic_sidebar( $sidebar ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', 'lsx' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'lsx' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>

		<?php lsx_sidebar_bottom(); ?>
		
	</div><!-- #secondary -->

	<?php lsx_sidebars_after(); ?>

<?php endif; ?>