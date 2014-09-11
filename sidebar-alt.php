<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package lsx
 */
?>
<?php 

	$sidebar = 'sidebar-2';
	$layout = lsx_get_option('site_layout','2c-l'); 
	
	$supported = array( '3c-l', '3c-,' , '3c-m', '3c-r' );
?>
<?php if ( in_array( $layout, $supported ) ) : ?>

	<?php lsx_sidebars_before(); ?>

	<div id="tertiary" class="widget-area <?php echo lsx_sidebar_alt_class(); ?>" role="complementary">

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