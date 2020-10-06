<?php
/**
 * LSX functions and definitions - Layout.
 *
 * @package    lsx
 * @subpackage layout
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_layout_selector' ) ) :
	/**
	 * Layout selector.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_layout_selector( $class, $area = 'site' ) {
		$return_class = '';
		$layout       = get_theme_mod( 'lsx_layout', '1c' );
		$layout       = apply_filters( 'lsx_layout', $layout );
		$default_size = 'sm';
		$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );

		switch ( $layout ) {
			case '1c':
				$main_class    = 'col-' . $size . '-12';
				$sidebar_class = 'col-' . $size . '-12';
				break;
			case '2cr':
				$main_class    = 'col-' . $size . '-8';
				$sidebar_class = 'col-' . $size . '-4';
				break;
			case '2cl':
				$main_class    = 'col-' . $size . '-8 col-' . $size . '-push-4';
				$sidebar_class = 'col-' . $size . '-4 col-' . $size . '-pull-8';
				break;
			default:
				$main_class    = 'col-' . $size . '-8';
				$sidebar_class = 'col-' . $size . '-4';
				break;
		}

		if ( 'main' === $class ) {
			$return_class = apply_filters( 'lsx_layout_selector', $main_class, $class, $layout, $size );
		}

		if ( 'sidebar' === $class ) {
			$return_class = apply_filters( 'lsx_layout_selector', $sidebar_class, $class, $layout, $size );
		}

		return $return_class;
	}
endif;

if ( ! function_exists( 'lsx_main_class' ) ) :
	/**
	 * .main classes.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_main_class() {
		return lsx_layout_selector( 'main' );
	}
endif;

if ( ! function_exists( 'lsx_sidebar_class' ) ) :
	/**
	 * .sidebar classes.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_sidebar_class() {
		return lsx_layout_selector( 'sidebar' );
	}
endif;

if ( ! function_exists( 'lsx_header_classes' ) ) :
	/**
	 * Output the classes for the header.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_header_classes( $additional = false ) {
		$classes = 'banner navbar navbar-default';

		if ( false !== $additional ) {
			$classes .= ' ' . $additional;
		}

		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'lsx_top_menu_classes' ) ) :
	/**
	 * Output the classes for the top-menu.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_top_menu_classes( $additional = false ) {
		$classes = 'top-menu-default';

		if ( false !== $additional ) {
			$classes .= ' ' . $additional;
		}

		echo esc_attr( $classes );
	}
endif;

if ( ! function_exists( 'lsx_post_wrapper_class' ) ) :
	/**
	 * Output the classes for the top-menu.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_post_wrapper_class() {
		return apply_filters( 'lsx_post_wrapper_class', '' );
	}
endif;



if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) :
	/**
	 * Output the Footer CTA and/pr Footer Widgets.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_add_footer_sidebar_area() {
		if ( is_active_sidebar( 'sidebar-footer-cta' ) ) : ?>
			<div id="footer-cta">
				<div class="container">
					<div class="lsx-full-width">
						<div class="lsx-hero-unit">
							<?php dynamic_sidebar( 'sidebar-footer-cta' ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<div id="footer-widgets">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'sidebar-footer' ); ?>
					</div>
				</div>
			</div>
			<?php
		endif;
	}
	add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
endif;

if ( ! function_exists( 'lsx_global_header' ) ) :
	/**
	 * Displays the global header.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_global_header() {
		$show_on_front  = get_option( 'show_on_front' );
		$queried_object = get_queried_object();
		$default_size   = 'sm';
		$size           = apply_filters( 'lsx_bootstrap_column_size', $default_size );

		// Cart and Checkout won't have banners of any kind.
		if ( function_exists( 'is_woocommerce' ) && ( is_checkout() || is_cart() ) ) {
			return;
		}

		// Product pages have their own banner function 'lsx_page_banner()'.
		if ( function_exists( 'is_woocommerce' ) && ( is_product() ) ) {
			return;
		}

		// Events wont have banners.
		if ( function_exists( 'tribe_is_event' ) && ( ! is_tag() ) && ( tribe_is_event() || tribe_is_organizer() || tribe_is_venue() ) ) {
			return;
		}

		if ( function_exists( 'lsx_is_rest_api_request' ) && lsx_is_rest_api_request() ) {
			return;
		}

		if ( is_page() && ( 'page' !== $show_on_front || ! is_front_page() ) ) :
			if ( class_exists( 'LSX_Banners' ) && empty( apply_filters( 'lsx_banner_plugin_disable', false ) && ( ! has_post_thumbnail() ) ) ) {
				return;
			}
				?>
			<div class="archive-header-wrapper banner-page col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php the_title(); ?></h1>
				</header>

			</div>
			<?php

		elseif ( is_single() && ! is_singular( 'post' ) ) :
			?>
			<div class="archive-header-wrapper banner-single col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php echo wp_kses_post( apply_filters( 'lsx_global_header_title', get_the_title() ) ); ?></h1>
				</header>

			</div>
			<?php
		elseif ( is_search() ) :
			?>
			<div class="archive-header-wrapper banner-search col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title">
						<?php
							printf(
								/* Translators: %s: search term/query */
								esc_html__( 'Search Results for: %s', 'lsx' ),
								'<span>' . get_search_query() . '</span>'
							);
						?>
					</h1>
				</header>

			</div>
			<?php
		elseif ( is_author() ) :
			$author        = get_the_author();
			$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 256 );
			$author_bio    = get_the_archive_description();
			?>
			<div class="archive-header-wrapper banner-archive-author col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php the_archive_title(); ?></h1>
				</header>

			</div>
			<?php
		elseif ( is_archive() ) :
			?>
			<div class="archive-header-wrapper banner-archive col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title">
						<?php if ( has_post_format() && ! is_category() && ! is_tag() && ! is_date() && ! is_tax( 'post_format' ) ) { ?>
							<?php the_archive_title( esc_html__( 'Type:', 'lsx' ) ); ?>
						<?php } else { ?>
							<?php echo wp_kses_post( apply_filters( 'lsx_global_header_title', get_the_archive_title() ) ); ?>
						<?php } ?>
					</h1>

					<?php
					if ( false === apply_filters( 'lsx_display_global_header_description', false ) ) {
						the_archive_description();
					}
					?>
				</header>
			</div>
			<?php
		elseif ( 'page' === $show_on_front && (int) get_option( 'page_for_posts' ) === $queried_object->ID ) :
			?>
			<div class="archive-header-wrapper banner-page col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php esc_html_e( 'Blog', 'lsx' ); ?></h1>
				</header>

			</div>
			<?php
		elseif ( ! is_singular( 'post' ) ) :
			// Display only the breadcrumbs.
			?>
			<div class="archive-header-wrapper banner-singular col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
			</div>
			<?php
		elseif ( ( true === apply_filters( 'lsx_global_header_disable', false ) ) && ( ! is_search() ) ) :
			// Display only the breadcrumbs.
			?>
			<div class="archive-header-wrapper banner-global col-<?php echo esc_attr( $size ); ?>-12">
				<?php lsx_global_header_inner_bottom(); ?>
			</div>
			<?php
		endif;
	}
	add_action( 'lsx_content_wrap_before', 'lsx_global_header' );
endif;

if ( ! function_exists( 'lsx_author_extra_info' ) ) :
	/**
	 * Displays the author extra info.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_author_extra_info() {
		$default_size = 'sm';
		$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );

		if ( is_author() ) :
			$author_id         = get_the_author_meta( 'ID' );
			$author            = get_the_author();
			$author_avatar     = get_avatar( $author_id, 400 );
			$author_bio        = get_the_archive_description();
			$author_url        = get_the_author_meta( 'url', $author_id );
			$author_email      = get_the_author_meta( 'email', $author_id );
			$author_facebook   = get_the_author_meta( 'facebook', $author_id );
			$author_linkedin   = get_the_author_meta( 'linkedin', $author_id );
			$author_twitter    = get_the_author_meta( 'twitter', $author_id );
			?>
			<div class="col-<?php echo esc_attr( $size ); ?>-12">
				<div class="archive-author-data">
					<div class="row">
						<?php if ( ! empty( $author_avatar ) ) : ?>
							<div class="col-xs-12 col-sm-4 col-md-3">
							<figure class="archive-author-avatar"><?php echo wp_kses_post( $author_avatar ); ?></figure>
							</div>
						<?php endif; ?>
						<div class="col-xs-12 col-sm-8 col-md-9">
							<a class="back-to-blog" href="<?php echo ( esc_url( get_post_type_archive_link( 'post' ) ) ); ?>"><?php echo esc_html__( 'Back To Blog', 'lsx' ); ?></a>
							<!-- Name -->
							<h2 class="archive-author-title">
								<?php
								if ( '' !== $author ) {
									echo esc_html( $author );
								}
								?>
							</h2>
							<!-- Social -->
							<?php if ( ! empty( $author_url ) || ! empty( $author_email ) || ! empty( $author_facebook ) || ! empty( $author_twitter ) ) : ?>
								<div class="archive-author-social-links">
									<?php if ( ! empty( $author_url ) ) : ?>
										<a href="<?php echo esc_url( $author_url ); ?>" target="_blank" rel="nofollow noreferrer noopener" class="archive-author-social-link archive-author-social-link-url"><i class="fa fa-link" aria-hidden="true"></i></a>
									<?php endif; ?>

									<?php if ( ! empty( $author_email ) ) : ?>
										<a href="mailto:<?php echo esc_attr( $author_email ); ?>" class="archive-author-social-link archive-author-social-link-email"><i class="fa fa-envelope" aria-hidden="true"></i></a>
									<?php endif; ?>

									<?php if ( ! empty( $author_facebook ) ) : ?>
										<a href="<?php echo esc_url( $author_facebook ); ?>" target="_blank" rel="nofollow noreferrer noopener" class="archive-author-social-link archive-author-social-link-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
									<?php endif; ?>

									<?php if ( ! empty( $author_twitter ) ) : ?>
										<a href="https://twitter.com/<?php echo esc_attr( $author_twitter ); ?>" target="_blank" rel="nofollow noreferrer noopener" class="archive-author-social-link archive-author-social-link-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
									<?php endif; ?>

									<?php if ( ! empty( $author_linkedin ) ) : ?>
										<a href="<?php echo esc_url( $author_linkedin ); ?>" target="_blank" rel="nofollow noreferrer noopener" class="archive-author-social-link archive-author-social-link-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
									<?php endif; ?>
								</div>
							<?php endif; ?>

							<!-- Bio -->
							<?php if ( ! empty( $author_bio ) ) : ?>
								<p class="archive-author-bio"><?php echo wp_kses_post( $author_bio ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<h2><?php echo esc_html__( 'Posts', 'lsx' ); ?></h2>
			</div>
			<?php
		endif;
	}
	add_action( 'lsx_content_wrap_before', 'lsx_author_extra_info', 11 );
endif;

if ( ! function_exists( 'lsx_post_header' ) ) :
	/**
	 * Displays the post header.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_post_header() {
		$default_size = 'sm';
		$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );

		$disable_title = get_post_meta( get_the_ID(), 'lsx_disable_title', true );
		if ( 'yes' === $disable_title && is_singular( 'post' ) ) {
			return;
		}

		if ( is_singular( 'post' ) ) :
			$format = get_post_format();

			if ( false === $format ) {
				$format = 'standard';
			}

			$format = lsx_translate_format_to_fontawesome( $format );
			?>
			<div class="archive-header-wrapper banner-post-header col-<?php echo esc_attr( $size ); ?>-12">
				<header class="archive-header">
					<h1 class="archive-title">
						<i class="format-link fa fa-<?php echo esc_attr( $format ); ?>"></i>
						<span><?php the_title(); ?></span>
					</h1>
				</header>
			</div>
			<?php
		endif;
	}
	add_action( 'lsx_entry_top', 'lsx_post_header' );
endif;

if ( ! function_exists( 'lsx_add_viewport_meta_tag' ) ) :
	/**
	 * Add Viewport Meta Tag to head.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_add_viewport_meta_tag() {
		?>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
		<?php
	}
	add_action( 'wp_head', 'lsx_add_viewport_meta_tag' );
endif;

if ( ! function_exists( 'lsx_header_search_form' ) ) :
	/**
	 * Add a search form to just above the nav menu.
	 *
	 * @package    lsx
	 * @subpackage layout
	 */
	function lsx_header_search_form() {
		$search_form = get_theme_mod( 'lsx_header_search', false );

		if ( false !== $search_form || is_customize_preview() ) {
			get_search_form( true );
		}
	}
	$mobile_header_layout = get_theme_mod( 'lsx_header_mobile_layout', 'navigation-bar' );
	add_action( 'lsx_nav_before', 'lsx_header_search_form', 0 );
endif;

// Add entry meta to single post if active.
if ( ! function_exists( 'lsx_add_entry_meta' ) ) :
	function lsx_add_entry_meta() {
		$disable_title = get_post_meta( get_the_ID(), 'lsx_disable_title', true );
		if ( 'yes' === $disable_title && is_singular( 'post' ) ) {
			return;
		}
		if ( is_single() && is_singular( 'post' ) ) {
			?>
			<div class="entry-meta">
				<?php lsx_post_meta_single_top(); ?>
			</div><!-- .entry-meta -->
			<?php
		}
	}
	add_action( 'lsx_entry_top', 'lsx_add_entry_meta', 999 );
endif;
