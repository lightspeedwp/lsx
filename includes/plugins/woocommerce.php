<?php
/**
 * LSX functions and definitions - Integrations - WooCommerce.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   woocommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_woocommerce_before_content' ) ) :

	/**
	 * Adds the top and primary divs for the layout.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   woocommerce
	 */
	function lsx_woocommerce_before_content() {
		lsx_content_wrap_before(); ?>

		<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">
			<?php lsx_content_before(); ?>

			<main id="main" class="site-main">
				<?php lsx_content_top();
	}

endif;

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'lsx_woocommerce_before_content', 10 );

if ( ! function_exists( 'lsx_woocommerce_after_content' ) ) :

	/**
	 * Adds the closing divs for primary and main to woocommerce.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   woocommerce
	 */
	function lsx_woocommerce_after_content() {
				lsx_content_bottom(); ?>
			</main><!-- #main -->

			<?php lsx_content_after(); ?>
		</div><!-- #primary -->

		<?php lsx_content_wrap_after();
	}

endif;

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'lsx_woocommerce_after_content', 10 );

if ( ! function_exists( 'lsx_woocommerce_styles' ) ) :

	/**
	 * Removes WooCommerce plugin styles and enqueues WooCommerce styles from the theme instead.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   woocommerce
	 */
	function lsx_woocommerce_styles() {
		wp_enqueue_style( 'woocommerce-layout', get_template_directory_uri() . '/assets/css/plugins/woocommerce-layout.css', array( 'lsx_main' ), LSX_VERSION, 'all' );
		wp_enqueue_style( 'woocommerce-smallscreen', get_template_directory_uri() . '/assets/css/plugins/woocommerce-smallscreen.css', array( 'lsx_main', 'woocommerce-layout' ), LSX_VERSION, 'only screen and (max-width: 767px)' );
		wp_enqueue_style( 'woocommerce-general', get_template_directory_uri() . '/assets/css/plugins/woocommerce.css', array( 'lsx_main' ), LSX_VERSION, 'all' );
	}

endif;

// @TODO - WooCommerce is currently on version 3.0.4, the styles package imported is 2.6.4
//add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
//add_action( 'wp_enqueue_scripts', 'lsx_woocommerce_styles' );
