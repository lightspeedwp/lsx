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

	}

endif;

return new LSX_Sensei();
