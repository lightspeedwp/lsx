<?php
/**
 * LSX functions and definitions - Integrations - Jetpack.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   jetpack
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_allowed_related_post_types' ) ) :

	/**
	 * Adds portfolio and removes pages to the jetpack related posts.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_allowed_related_post_types( $allowed_post_types ) {
		$allowed_post_types[] = 'jetpack-portfolio';

		foreach( $allowed_post_types as $key => $value ) {
			if ( 'page' === $value ) {
				unset( $allowed_post_types[ $key ] );
			}
		}

		return $allowed_post_types;
	}

endif;

if ( ! function_exists( 'lsx_remove_related_post_context' ) ) :

	/**
	 * Remove the Category from the Jetpack related posts.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_remove_related_post_context() {
		add_filter( 'jetpack_relatedposts_filter_post_context', '__return_empty_string' );
		add_filter( 'rest_api_allowed_post_types', 'lsx_allowed_related_post_types' );
	}

endif;

add_action( 'init', 'lsx_remove_related_post_context', 20 );

if ( ! function_exists( 'lsx_site_logo_title_tag' ) ) :

	/**
	 * Adds the Site Title in Settings->General as a "title" attribute for the logo link.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_site_logo_title_tag( $html ) {
		$html = str_replace( '<a', '<a title="' . get_bloginfo( 'name' ) . '" ', $html );
		return $html;
	}

endif;

add_filter( 'jetpack_the_site_logo', 'lsx_site_logo_title_tag' );

if ( ! function_exists( 'lsx_portfolio_infinite_scroll' ) ) :

	/**
	 * Set the Portfolio archive slug.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_portfolio_infinite_scroll() {
		global $_wp_theme_features, $wp_query;

		if ( is_post_type_archive( 'jetpack-portfolio' ) || is_tax( 'jetpack-portfolio-type' ) || is_tax( 'jetpack-portfolio-tag' ) ) {
			if ( class_exists( 'The_Neverending_Home_Page' ) ) {
				$_wp_theme_features['infinite-scroll'][0]['container']      = 'portfolio-infinite-scroll-wrapper';
				$_wp_theme_features['infinite-scroll'][0]['posts_per_page'] = 99;
			}
		}
	}

endif;

add_action( 'wp_head', 'lsx_portfolio_infinite_scroll', 1000 );

if ( ! function_exists( 'lsx_portfolio_infinite_scroll_disable' ) ) :

	/**
	 * Disables the infinite scroll on the portfolio archive.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_portfolio_infinite_scroll_disable( $supported ) {
		if ( is_post_type_archive('jetpack-portfolio' ) ) {
			$supported = false;
		}

		return $supported;
	}

endif;

add_filter( 'infinite_scroll_archive_supported', 'lsx_portfolio_infinite_scroll_disable', 1, 10 );

if ( ! function_exists( 'lsx_portfolio_archive_pagination' ) ) :

	/**
	 * Set the Portfolio to 9 posts per page.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	*/
	function lsx_portfolio_archive_pagination( $query ) {
		if ( ! is_admin() ) {
			if ( $query->is_post_type_archive( array( 'jetpack-portfolio' ) ) && $query->is_main_query() && class_exists( 'The_Neverending_Home_Page' ) ) {
				$query->set( 'posts_per_page', -1 );
			}
		}
	}

endif;

add_action( 'pre_get_posts', 'lsx_portfolio_archive_pagination' , 100 );

if ( ! function_exists( 'lsx_remove_portfolio_related_posts' ) ) :

	/**
	 * Remove the related posts from below the content area.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_remove_portfolio_related_posts() {
		if ( is_single() && 'jetpack-portfolio' === get_post_type() && class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}

endif;

add_filter( 'wp', 'lsx_remove_portfolio_related_posts', 20 );

if ( ! function_exists( 'lsx_remove_single_related_posts' ) ) :

	/**
	 * Remove the related posts from below the content area.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_remove_single_related_posts() {
		if ( is_single() && class_exists( 'Jetpack_RelatedPosts' ) ) {
			$jprp = Jetpack_RelatedPosts::init();
			$callback = array( $jprp, 'filter_add_target_to_dom' );
			remove_filter( 'the_content', $callback, 40 );
		}
	}

endif;

add_filter( 'wp', 'lsx_remove_single_related_posts', 20 );

if ( ! function_exists( 'lsx_portfolio_related_posts' ) ) :

	/**
	 * A template tag to call the Portfolios Related posts.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_portfolio_related_posts() {
		if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
			?>
			<div class="row">
				<div class="col-md-12">
					<?php echo do_shortcode( '[jetpack-related-posts]' ); ?>
				</div>
			</div>
			<?php
		}
	}

endif;

if ( ! function_exists( 'lsx_portfolio_remove_share' ) ) :

	/**
	 * Remove the sharing from below the content on single portfolio pages.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_portfolio_remove_share() {
		if ( ( is_single() && 'jetpack-portfolio' === get_post_type() ) || is_page_template( 'page-templates/template-portfolio.php' ) ) {
			remove_filter( 'the_content', 'sharing_display',19 );
			remove_filter( 'the_excerpt', 'sharing_display',19 );

			if ( class_exists( 'Jetpack_Likes' ) ) {
				remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
			}
		}
	}

endif;

add_action( 'loop_start', 'lsx_portfolio_remove_share' );

if ( ! function_exists( 'lsx_single_remove_share' ) ) :

	/**
	 * Remove the sharing from single.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_single_remove_share() {
		if ( is_single() ) {
			remove_filter( 'the_content', 'sharing_display',19 );
			remove_filter( 'the_excerpt', 'sharing_display',19 );

			if ( class_exists( 'Jetpack_Likes' ) ) {
				remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
			}
		}
	}

endif;

add_action( 'loop_start', 'lsx_single_remove_share' );

if ( ! function_exists( 'lsx_portfolio_taxonomy_template' ) ) :

	/**
	 * Redirect the template archive to our one.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	*/
	function lsx_portfolio_taxonomy_template( $template ) {
		if ( is_tax( array( 'jetpack-portfolio-type', 'jetpack-portfolio-tag' ) ) ) {
			$new_template = locate_template( array( 'archive-jetpack-portfolio.php' ) );

			if ( ! empty( $new_template ) ) {
				return $new_template ;
			}
		}

		return $template;
	}

endif;

add_filter( 'template_include', 'lsx_portfolio_taxonomy_template', 99 );

if ( ! function_exists( 'lsx_save_portfolio_post_meta' ) ) :

	/**
	 * Save the Portfolio Post Meta Options.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_save_portfolio_post_meta( $post_id, $post ) {
		if ( 'jetpack-portfolio' !== $post->post_type ) {
			return;
		}

		if ( ! isset( $_POST['lsx-website'] ) && ! isset( $_POST['lsx-client'] ) ) {
			return;
		}

		$post_type = get_post_type_object( $post->post_type );

		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return;
		}

		check_admin_referer( 'lsx_save_portfolio', '_lsx_client_nonce' );
		check_admin_referer( 'lsx_save_portfolio', '_lsx_website_nonce' );

		$meta_keys = array( 'lsx-website', 'lsx-client' );

		foreach ( $meta_keys as $meta_key ) {
			$new_meta_value = sanitize_text_field( wp_unslash( $_POST[$meta_key] ) );
			$new_meta_value = ! empty( $new_meta_value ) ? $new_meta_value : '';
			$meta_value     = get_post_meta( $post_id, $meta_key, true );

			if ( $new_meta_value && '' == $meta_value ) {
				add_post_meta( $post_id, $meta_key, $new_meta_value, true );
			}
			elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
				update_post_meta( $post_id, $meta_key, $new_meta_value );
			}
			elseif ( '' == $new_meta_value && $meta_value ) {
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}
	}

endif;

add_action( 'save_post', 'lsx_save_portfolio_post_meta', 100, 2 );

if ( ! function_exists( 'lsx_add_portfolio_post_meta_boxes' ) ) :

	/**
	 * Add the Portfolio Post Meta Options.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_add_portfolio_post_meta_boxes() {
		add_meta_box(
			'lsx_client_meta_box',
			esc_html__( 'Client', 'lsx' ),
			'lsx_client_meta_box',
			'jetpack-portfolio',
			'side',
			'default'
		);

		add_meta_box(
			'lsx_website_meta_box',
			esc_html__( 'Website', 'lsx' ),
			'lsx_website_meta_box',
			'jetpack-portfolio',
			'side',
			'default'
		);
	}

endif;

add_action( 'add_meta_boxes', 'lsx_add_portfolio_post_meta_boxes' );

if ( ! function_exists( 'lsx_client_meta_box' ) ) :

	/**
	 * Add the Portfolio Post Meta Options (Client).
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_client_meta_box( $object, $box ) {
		wp_nonce_field( 'lsx_save_portfolio', '_lsx_client_nonce' );
		?>
		<p>
			<input class="widefat" type="text" name="lsx-client" id="lsx-client" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lsx-client', true ) ); ?>" size="30">
			<br><br>
			<label for="lsx-client"><?php esc_html_e( 'Enter the name of the project client', 'lsx' ); ?></label>
		</p>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_website_meta_box' ) ) :

	/**
	 * Add the Portfolio Post Meta Options (Website).
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_website_meta_box( $object, $box ) {
		wp_nonce_field( 'lsx_save_portfolio', '_lsx_website_nonce' );
		?>
		<p>
			<input class="widefat" type="text" name="lsx-website" id="lsx-website" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lsx-website', true ) ); ?>" size="30">
			<br><br>
			<label for="lsx-website"><?php esc_html_e( 'Enter the URL of the project website', 'lsx' ); ?></label>
		</p>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_portfolio_sorter' ) ) :

	/**
	 * A project type filter for the portfolio template.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */

	function lsx_portfolio_sorter() {
		?>
		<ul id="filterNav" class="clearfix">
			<li class="allBtn"><a href="#" data-filter="*" class="selected"><?php esc_html_e( 'All', 'lsx' ); ?></a></li>

			<?php
				$types = get_terms( 'jetpack-portfolio-type' );

				if ( is_array( $types ) ) {
					foreach ( $types as $type ) {
						$content = '<li><a href="#" data-filter=".' . $type->slug . '">';
						$content .= $type->name;
						$content .= '</a></li>';

						echo wp_kses_post( $content );
						echo "\n";
					}
				}
			?>
		</ul>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_portfolio_naviagtion_labels' ) ) :

	/**
	 * A project type filter for the portfolio template.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_portfolio_naviagtion_labels( $labels ) {
		if ( is_post_type_archive( 'jetpack-portfolio' ) ) {
			$labels = array(
				'next'     => '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Older', 'lsx' ),
				'previous' => esc_html__( 'Newer', 'lsx' ).' <span class="meta-nav">&rarr;</span>',
				'title'    => esc_html__( 'Portfolio navigation', 'lsx' ),
			);
		}

		return $labels;
	}

endif;

add_filter( 'lsx_post_navigation_labels', 'lsx_portfolio_naviagtion_labels', 1, 10 );

if ( ! function_exists( 'lsx_jetpack_infinite_scroll_after_setup' ) ) :

	/**
	 * Adds the theme_support for Jetpacks Infinite Scroll.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_jetpack_infinite_scroll_after_setup() {
		$infinite_scroll_args = array(
			'container'      => 'main',
			'type'           => 'click',
			'posts_per_page' => get_option( 'posts_per_page', 10 ),
			'render'         => 'lsx_infinite_scroll_render',
		);

		add_theme_support( 'infinite-scroll', $infinite_scroll_args );
	}

endif;

add_action( 'after_setup_theme', 'lsx_jetpack_infinite_scroll_after_setup' );

if ( ! function_exists( 'lsx_infinite_scroll_render' ) ) :

	/**
	 * Set the code to be rendered on for calling posts,
	 * hooked to template parts when possible.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_infinite_scroll_render() {
		global $wp_query;

		while ( have_posts() ) {
			the_post();

			if ( 'jetpack-portfolio' === get_post_type() ) {
				get_template_part( 'partials/content', 'portfolio' );
			} else {
				get_template_part( 'partials/content', get_post_type() );
			}
		}
	}

endif;

if ( ! function_exists( 'lsx_related_posts_headline' ) ) :

	/**
	 * Change the Related headline at the top of the Related Posts section.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   jetpack
	 */
	function lsx_related_posts_headline( $headline ) {
		$headline = sprintf( '<h3 class="jp-relatedposts-headline"><em>%s</em></h3>', esc_html__( 'Related Posts', 'lsx' ) );
		return $headline;
	}

endif;

add_filter( 'jetpack_relatedposts_filter_headline', 'lsx_related_posts_headline' );
