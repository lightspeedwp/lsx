<?php
/**
 * LSX functions and definitions - Integrations - Template Tags
 *
 * @package    lsx
 * @subpackage template-tags
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_breadcrumbs' ) ) :

	/**
	 * Breadcrumbs.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_breadcrumbs() {
		if ( ! function_exists( 'yoast_breadcrumb' ) && ! function_exists( 'woocommerce_breadcrumb' ) ) {
			return null;
		}

		$show_on_front = get_option( 'show_on_front' );

		if ( ( 'posts' === $show_on_front && is_home() ) || ( 'page' === $show_on_front && is_front_page() ) ) {
			return;
		}

		if ( function_exists( 'woocommerce_breadcrumb' ) ) {
			ob_start();

			woocommerce_breadcrumb(
				array(
					'wrap_before' => '<div class="breadcrumbs-container breadcrumbs-woocommerce"><div class="container"><div class="row"><div class="col-xs-12">',
					'wrap_after'  => '</div></div></div></div>',
					'before'      => '<span>',
					'after'       => '</span>',
				)
			);

			$output = ob_get_clean();
		} elseif ( function_exists( 'yoast_breadcrumb' ) ) {
			$output = yoast_breadcrumb( null, null, false );
			$output = '<div class="breadcrumbs-container breadcrumbs-yoast"><div class="container"><div class="row"><div class="col-xs-12">' . $output . '</div></div></div></div>';
		}

		$output = apply_filters( 'lsx_breadcrumbs', $output );

		echo wp_kses_post( $output );
	}

endif;

add_action( 'lsx_header_after', 'lsx_breadcrumbs', 1 );
//add_action( 'lsx_banner_inner_bottom', 'lsx_breadcrumbs', 100 );
//add_action( 'lsx_global_header_inner_bottom', 'lsx_breadcrumbs', 100 );

if ( ! function_exists( 'lsx_breadcrumbs_wpseo_seperator_filter' ) ) :

	/**
	 * Replaces the seperator.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_breadcrumbs_wpseo_seperator_filter( $seperator ) {
		$seperator = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		return $seperator;
	}

endif;

add_filter( 'wpseo_breadcrumb_separator', 'lsx_breadcrumbs_wpseo_seperator_filter' );

if ( ! function_exists( 'lsx_breadcrumbs_woocommerce_seperator_filter' ) ) :

	/**
	 * Replaces the seperator.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_breadcrumbs_woocommerce_seperator_filter( $defaults ) {
		$defaults['delimiter'] = '<i class="fa fa-angle-right" aria-hidden="true"></i>';
		return $defaults;
	}

endif;

add_filter( 'woocommerce_breadcrumb_defaults', 'lsx_breadcrumbs_woocommerce_seperator_filter' );

if ( ! function_exists( 'lsx_site_title' ) ) :

	/**
	 * Displays logo when applicable.
	 *
	 * @package    lsx
	 * @subpackage template-tags
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

if ( ! function_exists( 'lsx_post_meta_list_top' ) ) :

	/**
	 * Add customizable post meta (post list - above title).
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_list_top() {
		?>
		<div class="post-meta post-meta-top">
			<?php //lsx_post_meta_avatar(); ?>
			<?php lsx_post_meta_author(); ?>
			<?php lsx_post_meta_date(); ?>
			<div class="clearfix"></div>
		</div>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_post_meta_single_top' ) ) :

	/**
	 * Add customizable post meta (single post - above title).
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_single_top() {
		?>
		<div class="post-meta post-meta-top">
			<?php lsx_post_meta_top(); ?>
			<div class="clearfix"></div>
		</div>
		<?php
	}

endif;

//add_action( 'lsx_post_meta_top', 'lsx_post_meta_avatar' );
add_action( 'lsx_post_meta_top', 'lsx_post_meta_author' );
add_action( 'lsx_post_meta_top', 'lsx_post_meta_date' );
add_action( 'lsx_post_meta_top', 'lsx_post_meta_category' );

if ( ! function_exists( 'lsx_post_meta_single_bottom' ) ) :

	/**
	 * Add customizable post meta (single post - below title).
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_single_bottom() {
		?>
		<div class="post-meta">
			<?php lsx_post_meta_category(); ?>
			<div class="clearfix"></div>
		</div>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_post_meta_avatar' ) ) :

	/**
	 * Add customizable post meta: author's avatar.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_avatar() {
		$author        = get_the_author();
		$author_id     = get_the_author_meta( 'ID' );
		$author_avatar = get_avatar( $author_id, 80 );
		$author_url    = get_author_posts_url( $author_id );

		printf(
			'<a href="%1$s" class="post-meta-avatar">%2$s</a>',
			esc_url( $author_url ),
			wp_kses_post( $author_avatar )
		);
	}

endif;

if ( ! function_exists( 'lsx_post_meta_date' ) ) :

	/**
	 * Add customizable post meta: post date.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_date() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			get_the_date(),
			esc_attr( get_the_modified_date( 'c' ) ),
			get_the_modified_date()
		);

		printf(
			'<span class="post-meta-time updated"><a href="%1$s" rel="bookmark">%2$s</a></span>',
			esc_url( get_permalink() ),
			wp_kses_post( $time_string )
		);
	}

endif;

if ( ! function_exists( 'lsx_post_meta_author' ) ) :

	/**
	 * Add customizable post meta: post author.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_author() {
		$author     = get_the_author();
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

		if ( empty( $author ) ) {
			global $post;

			$author     = get_user_by( 'ID', $post->post_author );
			$author     = $author->display_name;
			$author_url = get_author_posts_url( $post->post_author );
		}

		printf(
			'<span class="vcard post-meta-author"><span>%1$s</span> <span class="fn"><a href="%2$s">%3$s</a>, </span></span>',
			esc_html__( 'By ', 'lsx' ),
			esc_url( $author_url ),
			esc_html( $author )
		);
	}

endif;

if ( ! function_exists( 'lsx_post_meta_category' ) ) :

	/**
	 * Add customizable post meta: post category(ies).
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_meta_category() {
		$post_categories = wp_get_post_categories( get_the_ID() );
		$cats            = array();

		foreach ( $post_categories as $c ) {
			$cat = get_category( $c );
			/* Translators: %s: category name */
			$cats[] = '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '" title="' . sprintf( esc_html__( 'View all posts in %s', 'lsx' ), $cat->name ) . '">' . $cat->name . '</a>';
		}

		if ( ! empty( $cats ) ) {
			?>
			<span class="post-meta-categories"><span><?php esc_html_e( 'Posted in: ', 'lsx' ); ?></span> <?php echo wp_kses_post( implode( ', ', $cats ) ); ?></span>
			<?php
		}
	}

endif;

if ( ! function_exists( 'lsx_post_tags' ) ) :

	/**
	 * Add customizable post meta: post tag(s).
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_tags() {
		if ( has_tag() ) :
			?>
			<div class="post-tags">
				<span><?php echo esc_html__( 'Tags: ', 'lsx' ); ?></span><?php echo wp_kses_post( get_the_tag_list( '' ) ); ?>
			</div>
			<?php
		endif;
	}

endif;

add_action( 'lsx_content_post_tags', 'lsx_post_tags', 10 );

if ( ! function_exists( 'lsx_sharing_output' ) ) :

	/**
	 * Display sharing buttons.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_sharing_output() {
		global $lsx_sharing;
		echo wp_kses_post( $lsx_sharing->sharing_buttons() );
	}

endif;

add_action( 'lsx_content_sharing', 'lsx_sharing_output', 20 );

if ( ! function_exists( 'lsx_translate_format_to_fontawesome' ) ) :

	/**
	 * Translate post format to Font Awesome class.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_translate_format_to_fontawesome( $format ) {
		switch ( $format ) {
			case 'image':
				$format = 'camera';
				break;
			case 'video':
				$format = 'play';
				break;
			case 'gallery':
				$format = 'picture-o';
				break;
			case 'audio':
				$format = 'volume-up';
				break;
			case 'link':
				$format = 'link';
				break;
			case 'quote':
				$format = 'quote-right';
				break;
			case 'aside':
				$format = 'circle-o';
				break;
			default:
				$format = 'file-text-o';
				break;
		}

		return $format;
	}

endif;

if ( ! function_exists( 'lsx_paging_nav' ) ) :

	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_paging_nav() {
		global $wp_query;

		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		if ( true === apply_filters( 'lsx_paging_nav_disable', false ) ) {
			return true;
		} elseif ( current_theme_supports( 'infinite-scroll' ) && class_exists( 'The_Neverending_Home_Page' ) ) {
			return true;
		} else {
			$html  = '';
			$html .= '<div class="lsx-pagination-wrapper">' . PHP_EOL;
			$html .= '<div class="lsx-breaker"></div>' . PHP_EOL;
			$html .= '<div class="lsx-pagination">' . PHP_EOL;
			$html .= paginate_links(
				array(
					'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'    => '?paged=%#%',
					'total'     => $wp_query->max_num_pages,
					'current'   => max( 1, intval( get_query_var( 'paged' ) ) ),
					'prev_text' => '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Previous', 'lsx' ),
					'next_text' => esc_html__( 'Next', 'lsx' ) . ' <span class="meta-nav">&rarr;</span>',
				)
			);
			$html .= '</div>' . PHP_EOL;
			$html .= '</div>' . PHP_EOL;

			echo wp_kses_post( $html );
		}
	}

endif;

if ( ! function_exists( 'lsx_post_nav' ) ) :

	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_post_nav() {
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		$default_size = 'sm';
		$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );
		?>
		<nav class="navigation post-navigation" role="navigation">
			<div class="lsx-breaker"></div>
			<div class="nav-links pager row">
				<div class="previous <?php echo 'col-' . esc_attr( $size ) . '-6'; ?>">
					<?php previous_post_link( '%link', '<p class="nav-links-description">' . esc_html_x( 'Previous Post', 'Previous post link', 'lsx' ) . '</p><h3>%title</h3>' ); ?>
				</div>
				<div class="next <?php echo 'col-' . esc_attr( $size ) . '-6'; ?>">
					<?php next_post_link( '%link', '<p class="nav-links-description">' . esc_html_x( 'Next Post', 'Next post link', 'lsx' ) . '</p><h3>%title</h3>' ); ?>
				</div>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}

endif;

if ( ! function_exists( 'lsx_cover_custom_logo' ) ) :

	/**
	 * Outputs the Custom Logo on the Cover page if available.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_cover_custom_logo() {
		if ( is_page_template( 'page-templates/template-cover.php' ) ) {

			$custom_logo_id = get_theme_mod( 'lsx_cover_template_alt_logo' );

			if ( $custom_logo_id ) {

				$site_url   = get_site_url();
				$site_title = get_bloginfo( 'name' );
				$image      = wp_get_attachment_image_src( $custom_logo_id , 'full' );

				echo '<a href="' . $site_url . '" class="custom-logo-link" rel="home"><img class="custom-logo" src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" loading="eager" alt="' . $site_title . '"></a>';

			} else {
				the_custom_logo();
			}


		}
	}

endif;

if ( ! function_exists( 'lsx_site_identity' ) ) :

	/**
	 * Outputs either the Site Title or the Site Logo.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_site_identity() {
		if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
			if ( is_page_template( 'page-templates/template-cover.php' ) ) {
				lsx_cover_custom_logo();
			} else {
				the_custom_logo();
			}
		} else {
			if ( get_theme_mod( 'site_logo_header_text', 1 ) ) {
				lsx_site_title();
			}
		}
	}

endif;

if ( ! function_exists( 'lsx_navbar_header' ) ) :
	/**
	 * Outputs the Nav Menu.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_navbar_header() {
		$mobile_header_layout = get_theme_mod( 'lsx_header_mobile_layout', 'navigation-bar' );
		if ( 'hamburger' === $mobile_header_layout ) {
			?>
			<div class="navbar-header" itemscope itemtype="http://schema.org/WebPage">
				<?php
				lsx_header_search_form();
				lsx_site_identity();
				if ( has_nav_menu( 'primary' ) ) :
					?>
					<div class="wrapper-toggle" data-toggle="collapse" data-target=".primary-navbar">
						<button type="button" class="navbar-toggle">
							<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'lsx' ); ?></span>
							<span class="icon-bar icon-bar-1"></span>
							<span class="icon-bar icon-bar-2"></span>
							<span class="icon-bar icon-bar-3"></span>
						</button>
					</div>
					<?php
				endif;
				?>
			</div>
			<?php
		} else {
			?>
			<div class="navbar-header" itemscope itemtype="http://schema.org/WebPage">
				<?php
				if ( has_nav_menu( 'primary' ) ) :
					?>
					<div class="wrapper-toggle" data-toggle="collapse" data-target=".primary-navbar">
						<button type="button" class="navbar-toggle">
							<span class="sr-only"><?php esc_html_e( 'Toggle navigation', 'lsx' ); ?></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<span class="mobile-menu-title"><?php esc_html_e( 'Menu', 'lsx' ); ?></span>
					</div>
					<?php
				endif;

				lsx_site_identity();
				?>
			</div>
			<?php
		}
	}

endif;

add_action( 'lsx_nav_before', 'lsx_navbar_header' );

if ( ! function_exists( 'lsx_nav_menu' ) ) :
	/**
	 * Outputs the Nav Menu.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_nav_menu() {
		if ( has_nav_menu( 'primary' ) ) :
			?>
			<nav class="primary-navbar collapse navbar-collapse">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'depth'          => 3,
							'container'      => false,
							'menu_class'     => 'nav navbar-nav',
							'walker'         => new LSX_Bootstrap_Navwalker(),
						)
					);
				?>
			</nav>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'lsx_sitemap_loops' ) ) {
	/**
	 * Outputs the loops on the sitemap
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_sitemap_loops() {
		$sitemap_loops  = array(
			'page'     => array(
				'type'      => 'post_type',
				'label'     => __( 'Pages', 'lsx' ),
				'heirarchy' => true,
			),
			'post'     => array(
				'type'  => 'post_type',
				'label' => __( 'Posts', 'lsx' ),
			),
			'category' => array(
				'type'      => 'taxonomy',
				'label'     => __( 'Categories', 'lsx' ),
				'heirarchy' => true,
			),
		);
		$post_type_args = array(
			'public'   => true,
			'_builtin' => false,
			'show_ui'  => true,
		);
		$post_types     = get_post_types( $post_type_args, 'objects' );
		if ( ! empty( $post_types ) ) {
			foreach ( $post_types as $post_type_key => $post_type_obj ) {
				$sitemap_loops[ $post_type_key ] = array(
					'type'  => 'post_type',
					'label' => $post_type_obj->label,
				);
			}
		}
		$taxonomy_args = array(
			'public'   => true,
			'_builtin' => false,
			'show_ui'  => true,
		);
		$taxonomies    = get_taxonomies( $taxonomy_args, 'objects' );
		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $tax_key => $tax_obj ) {
				$sitemap_loops[ $tax_key ] = array(
					'type'  => 'taxonomy',
					'label' => $tax_obj->label,
				);
			}
		}
		$sitemap_loops = apply_filters( 'lsx_sitemap_loops_list', $sitemap_loops );
		foreach ( $sitemap_loops as $sitemap_key => $sitemap_values ) {
			if ( 'post_type' === $sitemap_values['type'] ) {
				if ( isset( $sitemap_values['heirarchy'] ) && true === $sitemap_values['heirarchy'] ) {
					lsx_sitemap_pages( $sitemap_key, $sitemap_values['label'] );
				} else {
					lsx_sitemap_custom_post_type( $sitemap_key, $sitemap_values['label'] );
				}
			} else {
				if ( isset( $sitemap_values['heirarchy'] ) && true === $sitemap_values['heirarchy'] ) {
					lsx_sitemap_taxonomy( $sitemap_key, $sitemap_values['label'], true );
				} else {
					lsx_sitemap_taxonomy( $sitemap_key, $sitemap_values['label'], false );
				}
			}
		}
	}
}

if ( ! function_exists( 'lsx_sitemap_pages' ) ) :

	/**
	 * Outputs Pages for the Sitemap Template.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_sitemap_pages( $forced_type = '', $label = '' ) {
		$page_args = array(
			'depth'        => 3,
			'title_li'     => '',
			'echo'         => 1,
			'sort_column'  => 'menu_order, post_title',
			'post_type'    => $forced_type,
			'item_spacing' => 'preserve',
		);
		echo '<h2>' . esc_html( $label ) . '</h2>';
		echo '<ul>';
		wp_list_pages( $page_args );
		echo '</ul>';
	}

endif;

if ( ! function_exists( 'lsx_sitemap_custom_post_type' ) ) :

	/**
	 * Outputs a custom post type section.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_sitemap_custom_post_type( $forced_type = '', $label = '' ) {
		if ( '' !== $forced_type ) {
			$post_types = array( $forced_type );
		} else {
			$args       = array(
				'public'   => true,
				'_builtin' => false,
			);
			$post_types = get_post_types( $args, 'names' );
		}

		foreach ( $post_types as $post_type ) {
			$post_type_args = array(
				'post_type'      => 'page',
				'posts_per_page' => 99,
				'post_status'    => 'publish',
				'post_type'      => $post_type,
			);

			$post_type_items  = new WP_Query( $post_type_args );
			$post_type_object = get_post_type_object( $post_type );

			if ( '' !== $label ) {
				$title = $label;
			} elseif ( ! empty( $post_type_object ) ) {
				$title = $post_type_object->labels->name;
			} else {
				$title = ucwords( $post_type );
			}

			if ( $post_type_items->have_posts() ) {
				echo '<h2>' . esc_html( $title ) . '</h2>';
				echo '<ul>';

				while ( $post_type_items->have_posts() ) {
					$post_type_items->the_post();
					echo '<li class="' . esc_attr( get_post_type() ) . '_item ' . esc_attr( get_post_type() ) . '-item-' . esc_attr( get_the_ID() ) . '"><a href="' . esc_url( get_permalink() ) . '" title="">' . get_the_title() . '</a></li>';
				}

				echo '</ul>';
				wp_reset_postdata();
			}
		}
	}

endif;

/**
 * Sitemap Travel Style
 *
 * @return void
 */
function lsx_sitemap_taxonomy( $taxonomy = '', $label = '', $hierarchical = false ) {
	if ( '' !== $taxonomy ) {

		$tax_args   = array(
			'echo'                => 0,
			'depth'               => 0,
			'hide_empty'          => 1,
			'hide_title_if_empty' => false,
			'hierarchical'        => $hierarchical,
			'separator'           => '<br />',
			'show_count'          => 0,
			'show_option_none'    => __( 'None', 'lsx' ),
			'style'               => 'list',
			'taxonomy'            => $taxonomy,
			'title_li'            => '',
		);
		$categories = wp_list_categories( $tax_args );
		if ( ! empty( $categories ) ) {
			echo '<div class="sitemap-rows">';
			echo '<h2>' . wp_kses_post( $label ) . '</h2>';
			echo '<ul>';
			echo wp_kses_post( $categories );
			echo '</ul>';
			echo '</div>';
		}
	}
}

if ( ! function_exists( 'lsx_sitemap_taxonomy_clouds' ) ) :

	/**
	 * Outputs the public taxonomies.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_sitemap_taxonomy_clouds() {
		$taxonomy_args = array(
			'public'   => true,
			'_builtin' => false,
		);

		$taxonomies = get_taxonomies( $taxonomy_args );

		if ( ! empty( $taxonomies ) ) {
			foreach ( $taxonomies as $taxonomy_id => $taxonomy ) {
				$tag_cloud = wp_tag_cloud(
					array(
						'taxonomy' => $taxonomy_id,
						'echo'     => false,
					)
				);

				if ( ! empty( $tag_cloud ) ) {
					echo '<h2>' . esc_html( $taxonomy ) . '</h2>';
					echo '<aside id="' . esc_attr( $taxonomy_id ) . '" class="widget widget_' . esc_attr( $taxonomy_id ) . '">' . esc_html( $tag_cloud ) . '</aside>';
				}
			}
		}
	}

endif;

if ( ! function_exists( 'lsx_add_top_menu' ) ) :

	/**
	 * Adds our top menu to the theme.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_add_top_menu() {
		if ( has_nav_menu( 'top-menu' ) || has_nav_menu( 'top-menu-left' ) ) :
			?>
			<div id="top-menu" class="<?php lsx_top_menu_classes(); ?>">
				<div class="container">
					<?php if ( has_nav_menu( 'top-menu' ) ) : ?>
						<nav class="top-menu">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'top-menu',
										'walker'         => new LSX_Bootstrap_Navwalker(),
									)
								);
							?>
						</nav>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'top-menu-left' ) ) : ?>
						<nav class="top-menu pull-left">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'top-menu-left',
										'walker'         => new LSX_Bootstrap_Navwalker(),
									)
								);
							?>
						</nav>
					<?php endif; ?>
				</div>
			</div>
			<?php
		endif;
	}

endif;

add_action( 'lsx_header_before', 'lsx_add_top_menu' );

if ( ! function_exists( 'lsx_get_my_url' ) ) :

	/**
	 * Return URL from a link in the content.
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_get_my_url() {
		if ( ! preg_match( '/^<a\s[^>]*?href=[\'"](.+?)[\'"]$/is', get_the_content(), $matches ) ) {
			return false;
		}

		return esc_url_raw( $matches[1] );
	}

endif;

if ( ! function_exists( 'lsx_get_template_part' ) ) :

	/**
	 * Gets a custom template part if the filters is populated,  or does the normal WP get_content_part()
	 *
	 * @package    lsx
	 * @subpackage template-tags
	 */
	function lsx_get_template_part() {
		$custom_template = apply_filters( 'lsx_get_template_part', '' );
		if ( '' !== $custom_template && file_exists( $custom_template ) ) {
			include $custom_template;
		} else {
			get_template_part( 'partials/content', get_post_format() );
		}
	}

endif;


