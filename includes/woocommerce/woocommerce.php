<?php
/**
 * LSX functions and definitions - WooCommerce.
 *
 * @package    lsx
 * @subpackage woocommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_wc_support' ) ) :

	/**
	 * WooCommerce support.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}

	add_action( 'after_setup_theme', 'lsx_wc_support' );

endif;

if ( ! function_exists( 'lsx_wc_scripts_add_styles' ) ) :

	/**
	 * WooCommerce enqueue styles.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_scripts_add_styles() {
		wp_enqueue_style( 'woocommerce-lsx', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', array( 'lsx_main' ), LSX_VERSION );
		wp_style_add_data( 'woocommerce-lsx', 'rtl', 'replace' );

		// Remove WC Shipping Multiple Addresses specific script causing issues on checkout.
		wp_dequeue_script( 'wcms-country-select' );
	}

	add_action( 'wp_enqueue_scripts', 'lsx_wc_scripts_add_styles' );

endif;

if ( ! function_exists( 'lsx_wc_checkout_cart_title' ) ) :

	/**
	 * Add title to Woocommerce Cart page anc Checkout page.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_checkout_cart_title() {
		$default_size = 'sm';
		$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );
		if ( function_exists( 'is_woocommerce' ) && ( is_checkout() || is_cart() ) ) {
			?>
			<div class="checkout-header-wrapper cart-checkout-page col-<?php echo esc_attr( $size ); ?>-12">
				<h1 class="archive-title"><?php the_title(); ?></h1>
			</div>
			<?php
		}
	}

	add_action( 'lsx_entry_inside_top', 'lsx_wc_checkout_cart_title' );

endif;

if ( ! function_exists( 'lsx_simple_checkout' ) ) :

	/**
	 * Remove footer widgets to make Checkout and Cart simpler.
	 *
	 * @package    lsx
	 * @subpackage config
	 */
	function lsx_simple_checkout() {

		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_checkout() || is_cart() ) {
				remove_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
			}
		}
	}

	add_action( 'wp_head', 'lsx_simple_checkout' );

endif;

if ( ! function_exists( 'lsx_wc_form_field_args' ) ) :

	/**
	 * WooCommerce form fields.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_form_field_args( $args, $key, $value ) {
		$args['input_class'][] = 'form-control';

		return $args;
	}

	add_action( 'woocommerce_form_field_args', 'lsx_wc_form_field_args', 10, 3 );

endif;

if ( ! function_exists( 'lsx_wc_theme_wrapper_start' ) ) :

	/**
	 * WooCommerce wrapper start.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_theme_wrapper_start() {
		lsx_content_wrap_before();
		echo '<div id="primary" class="content-area ' . esc_attr( lsx_main_class() ) . '">';
		lsx_content_before();
		echo '<main id="main" class="site-main" role="main">';
		lsx_content_top();
	}

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	add_action( 'woocommerce_before_main_content', 'lsx_wc_theme_wrapper_start' );

endif;

if ( ! function_exists( 'lsx_wc_theme_wrapper_end' ) ) :

	/**
	 * WooCommerce wrapper end.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_theme_wrapper_end() {
		lsx_content_bottom();
		echo '</main>';
		lsx_content_after();
		echo '</div>';
		lsx_content_wrap_after();
	}

	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	add_action( 'woocommerce_after_main_content', 'lsx_wc_theme_wrapper_end' );

endif;

if ( ! function_exists( 'lsx_wc_disable_lsx_banner_plugin' ) ) :

	/**
	 * Disable LSX Banners plugin in some WC pages.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_disable_lsx_banner_plugin( $disabled ) {
		global $post;

		if ( $post && class_exists( 'WC_Wishlists_Pages' ) && WC_Wishlists_Pages::is_wishlist_page( $post->post_name ) ) {
			$disabled = true;
		}

		return $disabled;
	}

	add_filter( 'lsx_banner_plugin_disable', 'lsx_wc_disable_lsx_banner_plugin' );

endif;

if ( ! function_exists( 'lsx_wc_disable_lsx_banner' ) ) :

	/**
	 * Disable LSX Banners banner in some WC pages.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_disable_lsx_banner( $disabled ) {
		if ( is_shop() || is_product_category() || is_product_tag() || is_product() ) {
			$disabled = true;
		}

		return $disabled;
	}

	add_filter( 'lsx_banner_disable', 'lsx_wc_disable_lsx_banner' );

endif;

if ( ! function_exists( 'lsx_wc_categories_breadcrumb_filter' ) ) :
	/**
	 * Improves the category and taxonomy breadcrumbs for woocommerce.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_categories_breadcrumb_filter( $crumbs ) {

		$shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );

		if ( is_product_category() || is_product_tag() ) {
			$new_crumbs    = array();
			$new_crumbs[0] = $crumbs[0];

			if ( function_exists( 'woocommerce_breadcrumb' ) ) {
				$new_crumbs[1] = array(
					0 => __( 'Shop', 'lsx' ),
					1 => $shop_page_url,
				);
			} else {
				$new_crumbs[1] = array(
					'text' => __( 'Shop', 'lsx' ),
					'url'  => $shop_page_url,
				);
			}

			$new_crumbs[2] = $crumbs[1];

			$crumbs = $new_crumbs;
		}
		return $crumbs;
	}
	add_filter( 'wpseo_breadcrumb_links', 'lsx_wc_categories_breadcrumb_filter', 30, 1 );
	add_filter( 'woocommerce_get_breadcrumb', 'lsx_wc_categories_breadcrumb_filter', 30, 1 );

endif;

if ( ! function_exists( 'lsx_wc_add_cart' ) ) :

	/**
	 * Adds WC cart to the header.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_wc_add_cart( $items, $args ) {
		$cart_menu_item_position = apply_filters( 'lsx_wc_cart_menu_item_position', 'primary' );

		$cart_logged_out_position = $cart_menu_item_position . '_logged_out';

		if ( $cart_menu_item_position === $args->theme_location || $cart_logged_out_position === $args->theme_location ) {
			$customizer_option = get_theme_mod( 'lsx_header_wc_cart', false );

			if ( ! empty( $customizer_option ) ) {
				ob_start();
				the_widget( 'WC_Widget_Cart', 'title=' );
				$widget = ob_get_clean();

				if ( is_cart() ) {
					$class = 'current-menu-item';
				} else {
					$class = '';
				}

				$item_class = 'menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown lsx-wc-cart-menu-item ' . $class;
				$item_class = apply_filters( 'lsx_wc_cart_menu_item_class', $item_class );

				$item = '<li class="' . $item_class . '">' .
							'<a title="' . esc_attr__( 'View your shopping cart', 'lsx' ) . '" href="' . esc_url( wc_get_cart_url() ) . '" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">' .
								'<span class="lsx-wc-cart-amount">' . wp_kses_data( WC()->cart->get_cart_subtotal() ) . '</span>' .
								/* Translators: %s: items quantity */
								'<span class="lsx-wc-cart-count">' . wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'lsx' ), WC()->cart->get_cart_contents_count() ) ) . '</span>' .
								( ! empty( WC()->cart->get_cart_contents_count() ) ? '<span class="lsx-wc-cart-count-badge">' . wp_kses_data( WC()->cart->get_cart_contents_count() ) . '</span>' : '' ) .
							'</a>' .
							'<ul role="menu" class=" dropdown-menu lsx-wc-cart-sub-menu">' .
								'<li>' .
									'<div class="lsx-wc-cart-dropdown">' . $widget . '</div>' .
								'</li>' .
							'</ul>' .
						'</li>';

				if ( 'top-menu' === $args->theme_location ) {
					$items = $item . $items;
				} else {
					$items = $items . $item;
				}
			}
		}

		return $items;
	}

	add_filter( 'wp_nav_menu_items', 'lsx_wc_add_cart', 10, 2 );

endif;

if ( ! function_exists( 'lsx_wc_products_widget_wrapper_before' ) ) :

	/**
	 * Change WC products widget wrapper (before).
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_products_widget_wrapper_before( $html ) {
		$html = '<div class="lsx-woocommerce-slider lsx-woocommerce-shortcode">';
		return $html;
	}

	add_filter( 'woocommerce_before_widget_product_list', 'lsx_wc_products_widget_wrapper_before', 15 );

endif;

if ( ! function_exists( 'lsx_wc_products_widget_wrapper_after' ) ) :

	/**
	 * Change WC products widget wrapper (after).
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_products_widget_wrapper_after( $html ) {
		$html = '</div>';
		return $html;
	}

	add_filter( 'woocommerce_after_widget_product_list', 'lsx_wc_products_widget_wrapper_after', 15 );

endif;

if ( ! function_exists( 'lsx_wc_reviews_widget_override' ) ) :

	/**
	 * Override WC ewviews widget.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_reviews_widget_override() {
		if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
			unregister_widget( 'WC_Widget_Recent_Reviews' );
			require get_template_directory() . '/includes/classes/class-lsx-wc-widget-recent-reviews.php';
			register_widget( 'LSX_WC_Widget_Recent_Reviews' );
		}
	}

	add_action( 'widgets_init', 'lsx_wc_reviews_widget_override', 15 );

endif;

if ( ! function_exists( 'lsx_wc_change_price_html' ) ) :

	/**
	 * Change WC ZERO price to "free".
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 *
	 * @param $price string
	 * @param $product WC_Product
	 * @return string
	 */
	function lsx_wc_change_price_html( $price, $product ) {
		if ( empty( $product->get_price() ) ) {
			if ( $product->is_on_sale() && $product->get_regular_price() ) {
				$regular_price = wc_get_price_to_display( $product,
					array(
						'qty'   => 1,
						'price' => $product->get_regular_price(),
					)
				);

				$price = wc_format_price_range( $regular_price, esc_html__( 'Free!', 'lsx' ) );
			} else {
				$price = '<span class="amount">' . esc_html__( 'Free!', 'lsx' ) . '</span>';
			}
		}

		return $price;
	}

	add_filter( 'woocommerce_get_price_html', 'lsx_wc_change_price_html', 15, 2 );

endif;

if ( ! function_exists( 'lsx_wc_cart_link_fragment' ) ) :

	/**
	 * Cart Fragments.
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		lsx_wc_cart_link();
		$fragments['li.lsx-wc-cart-menu-item > a'] = ob_get_clean();

		ob_start();
		lsx_wc_items_counter();
		$items_counter = ob_get_clean();

		if ( ! empty( $items_counter ) ) {
			$fragments['div.widget_shopping_cart_content'] = preg_replace( '/(.+)(<\/ul>)[\s\n]*(<p class="woocommerce-mini-cart__total)(.+)/', '$1' . $items_counter . '$2$3$4', $fragments['div.widget_shopping_cart_content'] );
		}

		return $fragments;
	}

endif;

if ( ! function_exists( 'lsx_wc_cart_link' ) ) :

	/**
	 * Cart Link.
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_cart_link() {
		?>
			<a title="<?php esc_attr_e( 'View your shopping cart', 'lsx' ); ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">
				<span class="lsx-wc-cart-amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>

				<?php /* Translators: %s: items quantity */ ?>
				<span class="lsx-wc-cart-count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'lsx' ), WC()->cart->get_cart_contents_count() ) ); ?></span>

				<?php if ( ! empty( WC()->cart->get_cart_contents_count() ) ) : ?>
					<span class="lsx-wc-cart-count-badge"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
				<?php endif; ?>
			</a>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_wc_items_counter' ) ) :

	/**
	 * Add car item hidden items counter.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_items_counter() {
		$count         = (int) WC()->cart->get_cart_contents_count();
		$items_counter = '';

		if ( ! empty( $count ) ) {
			$count -= 3;

			if ( 1 === $count ) {
				$items_counter = esc_html__( '1 other item in cart', 'lsx' );
			} elseif ( $count > 1 ) {
				/* Translators: %s: items counter */
				$items_counter = sprintf( esc_html__( '%s other items in cart', 'lsx' ), $count );
			}
		}
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
		if ( ! empty( $items_counter ) ) :
			?>
				<li class="woocommerce-mini-cart-item mini_cart_item" style="display: block;">
					<a href="<?php echo esc_url( $cart_url ); ?>"><?php echo esc_html( $items_counter ); ?></a>
				</li>
			<?php
		endif;
	}

endif;

if ( ! function_exists( 'lsx_wc_loop_shop_per_page' ) ) :

	/**
	 * Changes the number of products to display on shop.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_loop_shop_per_page( $items ) {
		$items = 12;
		return $items;
	}

	add_filter( 'loop_shop_per_page', 'lsx_wc_loop_shop_per_page', 20 );

endif;

if ( ! function_exists( 'lsx_wc_add_to_cart_message_html' ) ) :

	/**
	 * Changes the "added to cart" message HTML.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_add_to_cart_message_html( $message, $products ) {
		$message = '<div class="woocommerce-message-added-to-cart">' . $message . '</div>';
		return $message;
	}

	add_filter( 'wc_add_to_cart_message_html', 'lsx_wc_add_to_cart_message_html', 20, 2 );

endif;

if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'lsx_wc_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'lsx_wc_cart_link_fragment' );
}

remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

add_action( 'woocommerce_after_shop_loop', 'lsx_wc_sorting_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
add_action( 'woocommerce_after_shop_loop', 'lsx_wc_sorting_wrapper_close', 31 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_shop_loop', 'lsx_wc_sorting_wrapper', 9 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'lsx_wc_woocommerce_pagination', 30 );
add_action( 'woocommerce_before_shop_loop', 'lsx_wc_sorting_wrapper_close', 31 );

if ( ! function_exists( 'lsx_wc_sorting_wrapper' ) ) :

	/**
	 * Sorting wrapper.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_sorting_wrapper() {
		echo '<div class="lsx-wc-sorting">';
	}

endif;

if ( ! function_exists( 'lsx_wc_sorting_wrapper_close' ) ) :

	/**
	 * Sorting wrapper close.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_sorting_wrapper_close() {
		echo '</div>';
	}

endif;

if ( ! function_exists( 'lsx_wc_product_columns_wrapper_close' ) ) :

	/**
	 * Product columns wrapper close.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_product_columns_wrapper_close() {
		echo '</div>';
	}

endif;

if ( ! function_exists( 'lsx_wc_woocommerce_pagination' ) ) :

	/**
	 * LSX WooCommerce Pagination
	 * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
	 * but since LSX adds pagination before that function is excuted we need a separate function to
	 * determine whether or not to display the pagination.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}

endif;

if ( ! function_exists( 'lsx_customizer_wc_controls' ) ) :

	/**
	 * Returns an array of the core panel.
	 *
	 * @package    lsx
	 * @subpackage customizer
	 *
	 * @return $lsx_controls array()
	 */
	function lsx_customizer_wc_controls( $lsx_controls ) {
		$lsx_controls['panels']['woocommerce'] = array(
			'title'       => esc_html__( 'WooCommerce', 'lsx' ),
			'description' => esc_html__( 'Change the WooCommerce settings.', 'lsx' ),
			'priority'    => 23,
		);

		/**
		 * Global.
		 */

		$lsx_controls['sections']['lsx-wc-global'] = array(
			'title'       => esc_html__( 'LSX Global', 'lsx' ),
			'description' => esc_html__( 'Change the WooCommerce global settings.', 'lsx' ),
			'panel'       => 'woocommerce',
			'priority'    => 1,
		);

		$lsx_controls['settings']['lsx_wc_trust_footer_bar_status'] = array(
			'default'           => '1',
			'sanitize_callback' => 'lsx_sanitize_checkbox',
		);

		$lsx_controls['fields']['lsx_wc_trust_footer_bar_status'] = array(
			'label'       => esc_html__( 'Footer Trust Factors Section', 'lsx' ),
			'description' => esc_html__( 'Enable the footer trust factors section.', 'lsx' ),
			'section'     => 'lsx-wc-global',
			'type'        => 'checkbox',
			'priority'    => 1,
		);

		$lsx_controls['settings']['lsx_wc_mobile_footer_bar_status'] = array(
			'default'           => '1',
			'sanitize_callback' => 'lsx_sanitize_checkbox',
		);

		$lsx_controls['fields']['lsx_wc_mobile_footer_bar_status'] = array(
			'label'       => esc_html__( 'Footer Bar', 'lsx' ),
			'description' => esc_html__( 'Enable the mobile footer bar.', 'lsx' ),
			'section'     => 'lsx-wc-global',
			'type'        => 'checkbox',
			'priority'    => 1,
		);

		/**
		 * Cart.
		 */

		$lsx_controls['sections']['lsx-wc-cart'] = array(
			'title'       => esc_html__( 'LSX Cart', 'lsx' ),
			'description' => esc_html__( 'Change the WooCommerce cart settings.', 'lsx' ),
			'panel'       => 'woocommerce',
			'priority'    => 2,
		);

		$lsx_controls['settings']['lsx_header_wc_cart'] = array(
			'default'           => false,
			'sanitize_callback' => 'lsx_sanitize_checkbox',
		);

		$lsx_controls['fields']['lsx_header_wc_cart'] = array(
			'label'       => esc_html__( 'Menu Item', 'lsx' ),
			'description' => esc_html__( 'Enable the cart menu item.', 'lsx' ),
			'section'     => 'lsx-wc-cart',
			'type'        => 'checkbox',
			'priority'    => 1,
		);

		return $lsx_controls;
	}

	add_filter( 'lsx_customizer_controls', 'lsx_customizer_wc_controls' );

endif;

if ( ! function_exists( 'lsx_wc_global_header_title' ) ) :

	/**
	 * Move the shop title into the global header
	 *
	 * @package    lsx
	 * @subpackage the-events-calendar
	 */
	function lsx_wc_global_header_title( $title ) {

		if ( is_woocommerce() && is_shop() ) {

			$title = __( 'Shop', 'lsx' );
		}

		return $title;
	}
	add_filter( 'lsx_global_header_title', 'lsx_wc_global_header_title', 200, 1 );

endif;


if ( ! function_exists( 'lsx_wc_footer_bar' ) ) :

	/**
	 * Display WC footer bar.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_footer_bar() {
		$cart_url = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
		if ( ! empty( get_theme_mod( 'lsx_wc_mobile_footer_bar_status', '1' ) ) ) :
			?>
			<div class="lsx-wc-footer-bar">
				<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>" class="lsx-wc-footer-bar-form">
					<fieldset>
						<legend class="screen-reader-text"><?php esc_html_e( 'Search products', 'lsx' ); ?></legend>
						<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search products...', 'lsx' ); ?>" class="form-control">
					</fieldset>
				</form>

				<ul class="lsx-wc-footer-bar-items">
					<li class="lsx-wc-footer-bar-item">
						<a href="<?php echo esc_url( home_url() ); ?>" class="lsx-wc-footer-bar-link">
							<i class="fa fa-home" aria-hidden="true"></i>
							<span><?php esc_html_e( 'Home', 'lsx' ); ?></span>
						</a>
					</li>

					<li class="lsx-wc-footer-bar-item">
						<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="lsx-wc-footer-bar-link">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span><?php esc_html_e( 'Account', 'lsx' ); ?></span>
						</a>
					</li>

					<li class="lsx-wc-footer-bar-item">
						<a href="#" class="lsx-wc-footer-bar-link lsx-wc-footer-bar-link-toogle">
							<i class="fa fa-search" aria-hidden="true"></i>
							<span><?php esc_html_e( 'Search', 'lsx' ); ?></span>
						</a>
					</li>

					<li class="lsx-wc-footer-bar-item">
						<a href="<?php echo esc_url( $cart_url ); ?>" class="lsx-wc-footer-bar-link">
							<i class="fa fa-shopping-basket" aria-hidden="true"></i>
							<?php $count = WC()->cart->get_cart_contents_count(); ?>
							<?php if ( ! empty( $count ) ) : ?>
								<span class="lsx-wc-footer-bar-count"><?php echo wp_kses_data( $count ); ?></span>
							<?php endif; ?>
							<span><?php esc_html_e( 'Cart', 'lsx' ); ?></span>
						</a>
					</li>
				</ul>
			</div>
			<?php
		endif;
	}

	add_action( 'lsx_body_bottom', 'lsx_wc_footer_bar', 15 );

endif;

if ( ! function_exists( 'lsx_wc_body_class' ) ) :

	/**
	 * Changes body class.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_body_class( $classes ) {
		global $post;

		if ( $post && class_exists( 'WC_Wishlists_Pages' ) && WC_Wishlists_Pages::is_wishlist_page( $post->post_name ) ) {
			$classes[] = 'woocommerce-page woocommerce-wishlist';
		}

		if ( ! empty( get_theme_mod( 'lsx_wc_mobile_footer_bar_status', '1' ) ) ) {
			$classes[] = 'lsx-wc-has-footer-bar';
		}

		return $classes;
	}

	add_filter( 'body_class', 'lsx_wc_body_class', 2999 );

endif;

if ( ! function_exists( 'lsx_wc_downloadable_products' ) ) :

	/**
	 * Changes downloads "download" button text.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_downloadable_products( $downloads ) {
		foreach ( $downloads as $i => $download ) {
			$downloads[ $i ]['download_name'] = esc_html__( 'Download', 'lsx' );
		}

		return $downloads;
	}

	add_filter( 'woocommerce_customer_get_downloadable_products', 'lsx_wc_downloadable_products', 2999 );

endif;

if ( ! function_exists( 'lsx_wc_move_bundle_products' ) ) :

	/**
	 * WooCommerce - Move the bundle products to a tab.
	 *
	 * @package    lsx
	 * @subpackage woocommerce
	 */
	function lsx_wc_move_bundle_products( $tabs ) {
		global $product, $post;

		if ( method_exists( $product, 'get_bundled_items' ) ) {
			$bundled_items = $product->get_bundled_items();

			if ( ! empty( $bundled_items ) ) {
				$tabs['bundled_products'] = array(
					'title'    => __( 'Included Products', 'lsx' ),
					'priority' => 10,
					'callback' => 'lsx_wc_bundle_products',
				);
			}
		}

		if ( isset( $tabs['description'] ) ) {
			$tabs['description']['priority'] = 5;
		}

		if ( isset( $tabs['reviews'] ) ) {
			$tabs['reviews']['priority'] = 15;
		}

		if ( isset( $tabs['product_enquiry'] ) ) {
			$tabs['product_enquiry']['priority'] = 20;
		}

		return $tabs;
	}

	add_action( 'woocommerce_product_tabs', 'lsx_wc_move_bundle_products', 50 );

endif;

if ( ! function_exists( 'lsx_wc_bundle_products' ) ) :

	function lsx_wc_bundle_products() {
		global $product, $post;

		if ( method_exists( $product, 'get_bundled_items' ) ) {
			$bundled_items = $product->get_bundled_items();

			// do_action( 'woocommerce_before_bundled_items', $product );

			// foreach ( $bundled_items as $bundled_item ) {
			// 	do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
			// }

			// do_action( 'woocommerce_after_bundled_items', $product );

			$product_original = $product;

			// $this->widget_start( $args, $instance );

			// @codingStandardsIgnoreLine
			echo apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' );

			foreach ( $bundled_items as $bundled_item ) {
				$product = wc_get_product( $bundled_item->item_data['product_id'] );
				wc_get_template( 'content-widget-product.php' );
				$product = $product_original;
			}

			// @codingStandardsIgnoreLine
			echo apply_filters( 'woocommerce_after_widget_product_list', '</ul>' );
		}

		// $this->widget_end( $args );
	}

endif;


if ( ! function_exists( 'lsx_wc_product_searchform' ) ) :
	/**
	 * woo_custom_product_searchform
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	 */
	function lsx_wc_product_searchform( $form ) {

		$form = '
			<form role="search" method="get" class="search-form form-inline" id="searchform" action="<?php echo esc_url( home_url( \'/\' ) ); ?>">
				<div class="input-group">
					<input type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php esc_attr_e( \'Search\', \'lsx\' ); ?> <?php echo esc_attr( get_bloginfo( \'name\' ) ); ?>">
					<label class="hide"><?php esc_html_e( \'Search for:\', \'lsx\' ); ?></label>

					<span class="input-group-btn">
						<button type="submit" class="search-submit btn btn-default"><span class="fa fa-search"></span></button>
					</span>
				</div>

				<input type="hidden" name="post_type" value="product" />
			</form>
		';

		return $form;

	}
endif;
add_filter( 'get_product_search_form', 'lsx_wc_product_searchform', 10, 1 );

	/**
	 * Output the pagination.
	 */
function woocommerce_pagination() {
	if ( ! wc_get_loop_prop( 'is_paginated' ) || ! woocommerce_products_will_display() ) {
		return;
	}
	$args = array(
		'total'   => wc_get_loop_prop( 'total_pages' ),
		'current' => wc_get_loop_prop( 'current_page' ),
	);

	if ( wc_get_loop_prop( 'is_shortcode' ) ) {
		$args['base']   = esc_url_raw( add_query_arg( 'product-page', '%#%', false ) );
		$args['format'] = '?product-page = %#%';
	} else {
		$args['base']   = esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
		$args['format'] = '';
	}

	echo wp_kses_post( '<div class="lsx-pagination-wrapper">' );
	$template = wc_get_template_html( 'loop/pagination.php', $args );
	$template = str_replace( 'woocommerce-pagination', 'lsx-pagination', $template );
	echo wp_kses_post( $template );
	echo wp_kses_post( '</div>' );
}

function lsx_wc_pagination_args( $args ) {
	$args['prev_text'] = '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Previous', 'lsx' );
	$args['next_text'] = esc_html__( 'Next', 'lsx' ) . ' <span class="meta-nav">&rarr;</span>';
	$args['type']      = 'plain';
	return $args;
}
add_filter( 'woocommerce_pagination_args', 'lsx_wc_pagination_args', 10, 1 );


/**
 * Returns the location of our product widget
 *
 * @param $located
 * @param $template_name
 *
 * @return array
 */
function lsx_wc_product_widget_template( $located, $template_name ) {
	if ( 'content-widget-product.php' === $template_name || 'content-widget-review.php' === $template_name ) {

		$new_location = get_stylesheet_directory() . '/partials/' . $template_name;
		if ( file_exists( $new_location ) ) {
			$located = $new_location;
		} else {
			$new_location = get_parent_theme_file_path() . '/partials/' . $template_name;
			if ( file_exists( $new_location ) ) {
				$located = $new_location;
			}
		}
	}
	return $located;
}
add_filter( 'wc_get_template', 'lsx_wc_product_widget_template', 90, 2 );

if ( ! function_exists( 'lsx_payment_gateway_logos' ) ) {
	/**
	 * Add Lets Encrypt and PayFast logos to cart.
	 **/
	function lsx_payment_gateway_logos() {
		$encript_image        = get_template_directory_uri() . '/assets/images/lets-encript.svg';
		$payfast_image        = get_template_directory_uri() . '/assets/images/payfast-footer-logo.svg';
		$payment_logos        = get_template_directory_uri() . '/assets/images/payment-logos.svg';
		$payment_logos_mobile = get_template_directory_uri() . '/assets/images/payment-logos-mobile.svg';
		if ( ( is_checkout() || is_cart() ) && ( ! empty( get_theme_mod( 'lsx_wc_trust_footer_bar_status', '1' ) ) ) ) {
		?>
		<div class="row text-center vertical-align lsx-full-width-base-small checkout-cta-bottom">
			<div class="col-md-12 img-payfast">
				<img src="<?php echo esc_url( $payfast_image ); ?>" alt="payfast"/>
			</div>
			<div class="col-md-12 img-payments hidden-xs">
				<img src="<?php echo esc_url( $payment_logos ); ?>" alt="payments"/>
			</div>
			<div class="col-md-12 img-payments hidden-sm hidden-md hidden-lg">
				<img src="<?php echo esc_url( $payment_logos_mobile ); ?>" alt="payments"/>
			</div>
			<div class="col-md-12 img-encrypt">
				<img src="<?php echo esc_url( $encript_image ); ?>" alt="lets_encrypt"/>
			</div>
		</div>

		<?php
		}
	}
	add_action( 'lsx_footer_before', 'lsx_payment_gateway_logos' );
}
