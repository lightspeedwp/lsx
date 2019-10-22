<?php
/**
 * LSX Sensei Class
 *
 * @package    lsx
 * @subpackage sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSX_Sensei' ) ) :

	/**
	 * The LSX Sensei integration class
	 */
	class LSX_Sensei {

		/**
		 * Holds the LSX_Sensei_Course() variable.
		 *
		 * @var LSX_Sensei_Course()
		 */
		public $lsx_sensei_course = false;

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {

			$this->lsx_sensei_course = require_once get_stylesheet_directory() . '/includes/sensei/class-lsx-sensei-course.php';

			global $woothemes_sensei;

			add_action( 'wp_enqueue_scripts', array( $this, 'lsx_sensei_scripts_add_styles' ) );

			remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
			add_action( 'sensei_before_main_content', array( $this, 'lsx_sensei_theme_wrapper_start' ) );

			remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );
			add_action( 'sensei_after_main_content', array( $this, 'lsx_sensei_theme_wrapper_end' ) );

			add_filter( 'get_the_archive_title', array( $this, 'lsx_sensei_modify_archive_title' ), 10, 1 );

			// LSX
			add_filter( 'lsx_global_header_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );
			// LSX Banners - Plugin, Placeholders
			add_filter( 'lsx_banner_plugin_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );
			// LSX Banners - Banner
			add_filter( 'lsx_banner_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );

			add_filter( 'course_archive_title', array( $this, 'lsx_sensei_archive_title' ), 10, 1 );
			add_filter( 'sensei_lesson_archive_title', array( $this, 'lsx_sensei_archive_title' ), 10, 1 );

			add_filter( 'course_category_title', array( $this, 'lsx_sensei_category_title' ), 10, 1 );

			add_action( 'sensei_course_content_inside_after', array( $this, 'lsx_sensei_add_buttons' ), 9 );

			add_filter( 'sensei_wc_single_add_to_cart_button_text', array( $this, 'lsx_sensei_add_to_cart_text' ) );

			add_action( 'lsx_content_wrap_before', array( $this, 'lsx_sensei_results_header' ) );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_lesson_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_lesson_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_quiz_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_quiz_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_results_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_results_breadcrumb_filter' ), 40, 1 );

		}

		/**
		 * Sensei enqueue styles.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_scripts_add_styles() {
			wp_enqueue_style( 'sensei-lsx', get_template_directory_uri() . '/assets/css/sensei/sensei.css', array( 'lsx_main' ), LSX_VERSION );
			wp_style_add_data( 'sensei-lsx', 'rtl', 'replace' );
		}

		/**
		 * Sensei wrapper start.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_theme_wrapper_start() {
			lsx_content_wrap_before();
			echo '<div id="primary" class="content-area ' . esc_attr( lsx_main_class() ) . '">';
			lsx_content_before();
			echo '<main id="main" class="site-main" role="main">';
			lsx_content_top();
		}

		/**
		 * Sensei wrapper end.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_theme_wrapper_end() {
			lsx_content_bottom();
			echo '</main>';
			lsx_content_after();
			echo '</div>';
			lsx_content_wrap_after();
		}

		/**
		 * Remove "Archives:"  from the courses archive title.
		 *
		 * @param [type] $title
		 * @return void
		 */
		public function lsx_sensei_modify_archive_title( $title ) {
			if ( is_archive() && is_post_type_archive( 'course' ) ) {
				$title = __( 'Courses', 'lsx' );
			}
			if ( is_archive() && is_post_type_archive( 'sensei_message' ) ) {
				$title = __( 'Messages', 'lsx' );
			}
			if ( is_archive() && is_tax() ) {
				$title = single_term_title( '', false );
			}
			return $title;
		}

		/**
		 * Disable LSX Banners in some Sensei pages.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_disable_lsx_banner( $disabled ) {
			if ( is_sensei() ) {
				$disabled = true;
			}

			return $disabled;
		}

		/**
		 * Filters the archive title.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_archive_title( $html ) {
			$html = preg_replace( '/<header class="archive-header"><h1>([^<]+)<\/h1><\/header>/i', '<h1>$1</h1>', $html );
			return $html;
		}

		/**
		 * Filters the archive title.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_category_title( $html ) {
			$html = str_replace( 'h2', 'h1', $html );
			return $html;
		}

		/**
		 * Add extra buttons to the single view on lists.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_add_buttons( $course_id ) {
			global $post, $current_user;
			$is_user_taking_course = Sensei_Utils::user_started_course( $post->ID, $current_user->ID );
			?>
				<section class="entry-actions">
					<a class="button" href="<?php echo esc_url( tribe_get_event_link() ); ?>"><?php esc_html_e( 'View course', 'lsx' ); ?></a>

					<?php
					if ( is_user_logged_in() && ! $is_user_taking_course ) {
						Sensei_WC::the_add_to_cart_button_html( $post->ID );
					}
					?>
				</section>
			<?php
		}

		/**
		 * Change add to cart button text.
		 *
		 * @package    lsx
		 * @subpackage sensei
		 */
		public function lsx_sensei_add_to_cart_text( $text ) {
			$text = esc_html__( 'Add to cart', 'lsx' );
			return $text;
		}

		/**
		 * Displays the Results header.
		 *
		 * @package    lsx
		 * @subpackage layout
		 */
		public function lsx_sensei_results_header() {

			$default_size = 'sm';
			$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );
			global $wp_query;
			$is_results = $wp_query->query_vars['course_results'];

			if ( is_sticky() && $is_results ) :
				$course_for_results = get_page_by_path( $is_results, OBJECT, 'course' );

					$course_title = esc_html( $course_for_results->post_title );
				?>
				<div class="archive-header-wrapper banner-single col-<?php echo esc_attr( $size ); ?>-12">
					<?php lsx_global_header_inner_bottom(); ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php echo wp_kses_post( $course_title ); ?></h1>
					</header>

				</div>
				<?php
			endif;
		}

		/**
		 * Add the Parent Course link to the lessons breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_lesson_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_single() && ( is_singular( 'lesson' ) ) ) {
				global $course;
				$lesson          = get_the_title();
				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				if ( 0 < intval( $id ) ) {
					$course       = intval( get_post_meta( $id, '_lesson_course', true ) );
					$course_id    = esc_url( get_permalink( $course ) );
					$course_title = esc_html( get_the_title( $course ) );
					if ( ! $course ) {
						return;
					}
				}

				if ( $course_id ) {

					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						$new_crumbs[1] = array(
							0 => __( 'Courses', 'lsx' ),
							1 => $course_page_url,
						);
						$new_crumbs[2] = array(
							0 => $course_title,
							1 => $course_id,
						);
						$new_crumbs[3] = array(
							0 => $lesson,
						);
					} else {
						$new_crumbs[1] = array(
							'text' => __( 'Courses', 'lsx' ),
							'url'  => $course_page_url,
						);
						$new_crumbs[2] = array(
							'text' => $course_title,
							'url'  => $course_id,
						);
						$new_crumbs[3] = array(
							'text' => $lesson,
						);
					}
					$crumbs = $new_crumbs;
				}
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the quiz breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_quiz_breadcrumb_filter( $crumbs, $id = 0 ) {

			if ( ( is_single() && ( is_singular( 'quiz' ) ) ) ) {
				global $course;
				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );
				$lesson          = get_the_title();

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				if ( 0 < intval( $id ) ) {

					$course       = intval( get_post_meta( $id, '_quiz_lesson', true ) );
					$course_id    = esc_url( get_permalink( $course ) );
					$course_title = esc_html( get_the_title( $course ) );
					if ( ! $course ) {
						return;
					}
				}

				if ( $course_id ) {

					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						$new_crumbs[1] = array(
							0 => __( 'Courses', 'lsx' ),
							1 => $course_page_url,
						);
						$new_crumbs[2] = array(
							0 => $course_title,
							1 => $course_id,
						);
						$new_crumbs[3] = array(
							0 => $lesson,
						);
					} else {
						$new_crumbs[1] = array(
							'text' => __( 'Courses', 'lsx' ),
							'url'  => $course_page_url,
						);
						$new_crumbs[2] = array(
							'text' => $course_title,
							'url'  => $course_id,
						);
						$new_crumbs[3] = array(
							'text' => $lesson,
						);
					}

					$crumbs = $new_crumbs;
				}
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the results breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_results_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_sticky() ) {
				global $wp_query;
				$is_results      = $wp_query->query_vars['course_results'];
				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				if ( isset( $is_results ) ) {
					$course_for_results = get_page_by_path( $is_results, OBJECT, 'course' );

					$course_id    = esc_url( get_permalink( $course_for_results ) );
					$course_title = esc_html( $course_for_results->post_title );

				}

				if ( $course_id ) {
					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( $is_results ) {
						if ( function_exists( 'woocommerce_breadcrumb' ) ) {
							$new_crumbs[1] = array(
								0 => __( 'Courses', 'lsx' ),
								1 => $course_page_url,
							);
							$new_crumbs[2] = array(
								0 => $course_title,
								1 => $course_id,
							);
							$new_crumbs[3] = array(
								0 => __( 'Results', 'lsx' ),
							);
						} else {
							$new_crumbs[1] = array(
								'text' => __( 'Courses', 'lsx' ),
								'url'  => $course_page_url,
							);
							$new_crumbs[2] = array(
								'text' => __( 'Results', 'lsx' ),
							);
						}
					}
					$crumbs = $new_crumbs;
				}
			}
			return $crumbs;
		}

	}

endif;

return new LSX_Sensei();
