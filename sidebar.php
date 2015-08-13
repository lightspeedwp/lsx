<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */

?>
<?php
	$show_on_front = get_option('show_on_front');

 	if ('page' == $show_on_front && is_front_page()) { 
		$layout = '1c'; 
		$sidebar = 'home';
	} else {

		$layout = get_theme_mod('lsx_layout','2cr');
		$layout = apply_filters( 'lsx_layout', $layout );
		
		if('posts' == $show_on_front && is_home()){
			$sidebar = 'home';
		}else{
			$sidebar = 'sidebar-1';
		}
	}
	if ( $layout !== '1c' ) : ?>

	<?php lsx_sidebars_before(); ?>

	<?php if ('posts' == $show_on_front && is_home()) : ?>
	
		<div id="secondary" class="widget-area <?php echo esc_attr(lsx_home_sidebar_class()); ?>" role="complementary">
		
	<?php elseif ( is_page_template('page-templates/template-blog.php') ) : ?>
	
		<div id="secondary" class="widget-area <?php echo esc_attr(lsx_sidebar_class()); ?>" role="complementary">
		
	<?php else : ?>
	
		<div id="secondary" class="widget-area <?php echo esc_attr(lsx_sidebar_class()); ?>" role="complementary">
		
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

<?php endif;