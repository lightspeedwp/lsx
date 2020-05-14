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
		 * Holds class instance
		 *
		 * @since 1.0.0
		 * @var      object
		 */
		protected static $instance = null;

		/**
		 * Holds the LSX_Sensei_Course() variable.
		 *
		 * @var LSX_Sensei_Course()
		 */
		public $lsx_sensei_course = false;

		/**
		 * Holds the LSX_Sensei_Lesson() variable.
		 *
		 * @var LSX_Sensei_Lesson()
		 */
		public $lsx_sensei_lesson = false;

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			$this->lsx_sensei_course = require_once get_template_directory() . '/includes/sensei/class-lsx-sensei-course.php';
			$this->lsx_sensei_lesson = require_once get_template_directory() . '/includes/sensei/class-lsx-sensei-lesson.php';

			global $woothemes_sensei;

			add_action( 'wp_enqueue_scripts', array( $this, 'lsx_sensei_scripts_add_styles' ) );

			remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
			add_action( 'sensei_before_main_content', array( $this, 'lsx_sensei_theme_wrapper_start' ) );

			remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );
			add_action( 'sensei_after_main_content', array( $this, 'lsx_sensei_theme_wrapper_end' ) );

			add_filter( 'get_the_archive_title', array( $this, 'lsx_sensei_modify_archive_title' ), 99, 1 );

			add_filter( 'lsx_banner_allowed_post_types', array( $this, 'lsx_banner_allowed_post_types_sensei' ) );

			// LSX.
			add_filter( 'lsx_global_header_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );
			// LSX Banners - Plugin, Placeholders.
			add_filter( 'lsx_banner_plugin_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );
			// LSX Banners - Banner.
			add_filter( 'lsx_banner_disable', array( $this, 'lsx_sensei_disable_lsx_banner' ) );

			add_filter( 'course_archive_title', array( $this, 'lsx_sensei_archive_title' ), 10, 1 );
			add_filter( 'sensei_lesson_archive_title', array( $this, 'lsx_sensei_archive_title' ), 10, 1 );

			add_filter( 'course_category_title', array( $this, 'lsx_sensei_category_title' ), 10, 1 );

			add_action( 'sensei_course_content_inside_after', array( $this, 'lsx_sensei_add_buttons' ), 9 );

			add_filter( 'sensei_wc_paid_courses_add_to_cart_button_text', array( $this, 'lsx_sensei_add_to_cart_text' ) );

			add_action( 'lsx_content_wrap_before', array( $this, 'lsx_sensei_results_header' ) );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_course_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_course_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_lesson_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_lesson_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_module_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_module_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_learner_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_learner_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_quiz_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_quiz_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_messages_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_messages_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_single_message_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_single_message_breadcrumb_filter' ), 40, 1 );

			add_filter( 'wpseo_breadcrumb_links', array( $this, 'lsx_sensei_results_breadcrumb_filter' ), 40, 1 );
			add_filter( 'woocommerce_get_breadcrumb', array( $this, 'lsx_sensei_results_breadcrumb_filter' ), 40, 1 );

			add_action( 'sensei_archive_before_message_loop', array( $this, 'lsx_sensei_back_message_button' ) );
			add_action( 'sensei_content_message_after', array( $this, 'lsx_sensei_view_message_button' ) );

		}

		/**
		 * Return an instance of this class.
		 *
		 * @since 1.0.0
		 * @return    object    A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
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
		 * @return @title
		 */
		public function lsx_sensei_modify_archive_title( $title ) {
			if ( is_archive() && is_post_type_archive( 'course' ) ) {
				$title = __( 'Courses', 'lsx' );
			}
			if ( is_archive() && is_post_type_archive( 'sensei_message' ) ) {
				$title = __( 'Messages', 'lsx' );
			}
			if ( is_archive() && is_post_type_archive( 'lesson' ) ) {
				$title = __( 'Lessons', 'lsx' );
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
			if ( is_sensei() && ( ! is_singular( 'lesson' ) ) ) {
				$disabled = true;
			}

			return $disabled;
		}

		/**
		 * Enable project custom post type on LSX Banners.
		 */
		public function lsx_banner_allowed_post_types_sensei( $post_types ) {
			$post_types[] = 'lesson';
			return $post_types;
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
			$is_user_taking_course = Sensei_Course::is_user_enrolled( $post->ID, $current_user->ID );
			$course_purchasable    = '';
			if ( class_exists( 'Sensei_WC' ) ) {
				$course_purchasable = Sensei_WC::is_course_purchasable( $post->ID );
			}

			?>
				<section class="entry-actions">
					<?php
					if ( ( ! $is_user_taking_course ) && $course_purchasable ) {
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
			global $post, $current_user;
			$is_user_taking_course = Sensei_Utils::has_started_course( $post->ID, $current_user->ID );
			$is_course_on_cart     = Sensei_WC::is_course_in_cart( $post->ID, $current_user->ID );

			$text = esc_html__( 'Add to cart', 'lsx' );

			if ( ( $is_user_taking_course ) ) {
				return;
			}
			if ( ( $is_course_on_cart ) ) {
				$text = esc_html__( 'Course added to cart', 'lsx' );
			}
			return $text;
		}

		/**
		 * Displays the Results header.
		 *
		 * @package    lsx
		 * @subpackage layout
		 */
		public function lsx_sensei_results_header( $user ) {

			$default_size = 'sm';
			$size         = apply_filters( 'lsx_bootstrap_column_size', $default_size );
			global $wp_query;
			if ( isset( $wp_query->query_vars['course_results'] ) ) {
				$is_results = $wp_query->query_vars['course_results'];
			} else {
				$is_results = false;
			}
			if ( isset( $wp_query->query_vars['learner_profile'] ) ) {
				$is_profile = $wp_query->query_vars['learner_profile'];
			} else {
				$is_profile = false;
			}

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

			if ( $is_profile ) :
				$query_var    = $wp_query->query_vars['learner_profile'];
				$learner_user = Sensei_Learner::find_by_query_var( $query_var );
				$learner_name = $learner_user->display_name;
				?>
				<div class="archive-header-wrapper banner-single col-<?php echo esc_attr( $size ); ?>-12">
					<?php lsx_global_header_inner_bottom(); ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php echo esc_html( $learner_name ); ?></h1>
					</header>

				</div>
				<?php
			endif;
		}

		/**
		 * Add the Parent Course link to the course breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_course_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_single() && ( is_singular( 'course' ) ) ) {
				global $course;
				$lesson          = get_the_title();
				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );

				if ( $lesson ) {

					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						$new_crumbs[1] = array(
							0 => __( 'All Courses', 'lsx' ),
							1 => $course_page_url,
						);
						$new_crumbs[2] = array(
							0 => $lesson,
						);
					} else {
						$new_crumbs[1] = array(
							'text' => __( 'All Courses', 'lsx' ),
							'url'  => $course_page_url,
						);
						$new_crumbs[2] = array(
							'text' => $lesson,
						);
					}
					$crumbs = $new_crumbs;
				}
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the lessons breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_lesson_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_sensei() && is_single() && ( is_singular( 'lesson' ) ) ) {
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
		 * Add the Parent Course link to the module breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_module_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( ! empty( get_queried_object()->name ) ) {
				$title = apply_filters( 'sensei_module_archive_title', get_queried_object()->name );
			}

			if ( is_sensei() && is_tax() && is_archive() && ( ! empty( $title ) ) ) {

				$lesson          = get_the_archive_title();
				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				$new_crumbs    = array();
				$new_crumbs[0] = $crumbs[0];

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {
					$new_crumbs[1] = array(
						0 => __( 'Courses', 'lsx' ),
						1 => $course_page_url,
					);
					$new_crumbs[2] = array(
						0 => $lesson,
					);
				} else {
					$new_crumbs[1] = array(
						'text' => __( 'Courses', 'lsx' ),
						'url'  => $course_page_url,
					);
					$new_crumbs[2] = array(
						'text' => $lesson,
					);
				}
				$crumbs = $new_crumbs;
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the Learner breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_learner_breadcrumb_filter( $crumbs, $id = 0 ) {
			global $wp_query;

			if ( isset( $wp_query->query_vars['learner_profile'] ) ) {
				$is_profile = $wp_query->query_vars['learner_profile'];
			} else {
				$is_profile = false;
			}

			if ( $is_profile ) {

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				$query_var    = $wp_query->query_vars['learner_profile'];
				$learner_user = Sensei_Learner::find_by_query_var( $query_var );
				$learner_name = $learner_user->display_name;

				$new_crumbs    = array();
				$new_crumbs[0] = $crumbs[0];

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {
					$new_crumbs[1] = array(
						0 => __( 'Learners', 'lsx' ),
					);
					$new_crumbs[2] = array(
						0 => $learner_name,
					);
				} else {
					$new_crumbs[1] = array(
						'text' => __( 'Learners', 'lsx' ),
					);
					$new_crumbs[2] = array(
						'text' => $learner_name,
					);
				}
				$crumbs = $new_crumbs;
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the messages breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_messages_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_archive() && ( is_post_type_archive( 'sensei_message' ) ) ) {

				$course_page_url = intval( Sensei()->settings->settings['course_page'] );
				$course_page_url = get_permalink( $course_page_url );

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				if ( $id ) {

					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						$new_crumbs[1] = array(
							0 => __( 'Courses', 'lsx' ),
							1 => $course_page_url,
						);
						$new_crumbs[2] = array(
							0 => __( 'Messages', 'lsx' ),
						);
					} else {
						$new_crumbs[1] = array(
							'text' => __( 'Courses', 'lsx' ),
							'url'  => $course_page_url,
						);
						$new_crumbs[2] = array(
							'text' => __( 'Messages', 'lsx' ),
						);
					}
					$crumbs = $new_crumbs;
				}
			}
			return $crumbs;
		}

		/**
		 * Add the Parent Course link to the single messages breadcrumbs
		 * @param $crumbs
		 * @return array
		 */
		public function lsx_sensei_single_message_breadcrumb_filter( $crumbs, $id = 0 ) {
			if ( is_single() && ( is_singular( 'sensei_message' ) ) ) {

				$messages_page_url = '/messages/';

				if ( empty( $id ) ) {
					$id = get_the_ID();
				}

				if ( $id ) {

					$new_crumbs    = array();
					$new_crumbs[0] = $crumbs[0];

					if ( function_exists( 'woocommerce_breadcrumb' ) ) {
						$new_crumbs[1] = array(
							0 => __( 'Messages', 'lsx' ),
							1 => $messages_page_url,
						);
						$new_crumbs[2] = array(
							0 => __( 'Message', 'lsx' ),
						);
					} else {
						$new_crumbs[1] = array(
							'text' => __( 'Messages', 'lsx' ),
							'url'  => $messages_page_url,
						);
						$new_crumbs[2] = array(
							'text' => __( 'Message', 'lsx' ),
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
				$course_id = '';
				if ( isset( $wp_query->query_vars['course_results'] ) ) {
					$is_results = $wp_query->query_vars['course_results'];
				}
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

		/**
		 * Show the 'View Message' button on messages.
		 *
		 * @param [type] $message_post_id
		 * @return void
		 */
		public function lsx_sensei_view_message_button( $message_post_id ) {
			$message_link = get_the_permalink( $message_post_id );
			echo '<a href="' . esc_url_raw( $message_link ) . '" class="btn view-msg-btn">' . wp_kses_post( 'View Message', 'lsx' ) . '</a>';
		}

		/**
		 * Show the 'Back to My Courses' button on messages.
		 *
		 * @param [type] $message_post_id
		 * @return void
		 */
		public function lsx_sensei_back_message_button( $courses_link ) {
			$courses_link = '/my-courses/';
			echo '<a href="' . esc_url_raw( $courses_link ) . '" class="btn border-btn my-courses-btn">' . wp_kses_post( 'My Courses', 'lsx' ) . '</a>';
		}
	}

endif;

LSX_Sensei::get_instance();
