<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */
?>
<?php 

	$sidebar = 'sidebar-2';
	$show_on_front = get_option('show_on_front');

	if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) {
		$layout = lsx_get_option('home_layout','2c-l'); 
		$sidebar = 'homepage-col-3';
	}else{
		if ( is_page_template('page-templates/template-blog.php') ) {
			$layout = lsx_get_option('post_layout','2c-l'); 
		} else {
			$layout = lsx_get_option('site_layout','2c-l'); 
		}
	}
	
	$supported = array( '3c-l', '3c-,' , '3c-m', '3c-r' );
?>
<?php if ( in_array( $layout, $supported ) ) : ?>

	<?php lsx_sidebars_before(); ?>

	<?php if ( ('posts' == $show_on_front && is_home()) || ('page' == $show_on_front && is_front_page()) ) : ?>
	<div id="tertiary" class="widget-area <?php echo lsx_home_sidebar_alt_class(); ?>" role="complementary">
	<?php elseif ( is_page_template('page-templates/template-blog.php') ) : ?>
	<div id="tertiary" class="widget-area <?php echo lsx_post_sidebar_alt_class(); ?>" role="complementary">
	<?php else : ?>
	<div id="tertiary" class="widget-area <?php echo lsx_sidebar_alt_class(); ?>" role="complementary">
	<?php endif; ?>

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
		
	</div><!-- #tertiary -->

	<?php lsx_sidebars_after(); ?>

<?php endif; ?>