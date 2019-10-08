<?php
/**
 * LSX functions and definitions - Sensei.
 *
 * @package    lsx
 * @subpackage sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woothemes_sensei;

if ( ! function_exists( 'lsx_sensei_scripts_add_styles' ) ) :

	/**
	 * Sensei enqueue styles.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_scripts_add_styles() {
		wp_enqueue_style( 'sensei-lsx', get_template_directory_uri() . '/assets/css/sensei.css', array( 'lsx_main' ), LSX_VERSION );
		wp_style_add_data( 'sensei-lsx', 'rtl', 'replace' );
	}

	add_action( 'wp_enqueue_scripts', 'lsx_sensei_scripts_add_styles' );

endif;

if ( ! function_exists( 'lsx_sensei_theme_wrapper_start' ) ) :

	/**
	 * Sensei wrapper start.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_theme_wrapper_start() {
		lsx_content_wrap_before();
		echo '<div id="primary" class="content-area ' . esc_attr( lsx_main_class() ) . '">';
		lsx_content_before();
		echo '<main id="main" class="site-main" role="main">';
		lsx_content_top();
	}

	remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
	add_action( 'sensei_before_main_content', 'lsx_sensei_theme_wrapper_start' );

endif;

if ( ! function_exists( 'lsx_sensei_theme_wrapper_end' ) ) :

	/**
	 * Sensei wrapper end.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_theme_wrapper_end() {
		lsx_content_bottom();
		echo '</main>';
		lsx_content_after();
		echo '</div>';
		lsx_content_wrap_after();
	}

	remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );
	add_action( 'sensei_after_main_content', 'lsx_sensei_theme_wrapper_end' );

endif;

if ( ! function_exists( 'lsx_sensei_modify_archive_title' ) ) :

	/**
	 * Remove "Archives:"  from the courses archive title.
	 *
	 * @param [type] $title
	 * @return void
	 */
	function lsx_sensei_modify_archive_title( $title ) {
		$title = __( 'Courses', 'lsx' );
		return $title;
	}
	add_filter( 'get_the_archive_title', 'lsx_sensei_modify_archive_title', 10, 1 );

endif;

if ( ! function_exists( 'lsx_sensei_disable_lsx_banner' ) ) :

	/**
	 * Disable LSX Banners in some Sensei pages.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_disable_lsx_banner( $disabled ) {
		if ( is_sensei() ) {
			$disabled = true;
		}

		return $disabled;
	}

	// LSX
	add_filter( 'lsx_global_header_disable', 'lsx_sensei_disable_lsx_banner' );
	// LSX Banners - Plugin, Placeholders
	add_filter( 'lsx_banner_plugin_disable', 'lsx_sensei_disable_lsx_banner' );
	// LSX Banners - Banner
	add_filter( 'lsx_banner_disable', 'lsx_sensei_disable_lsx_banner' );

endif;

if ( ! function_exists( 'lsx_sensei_archive_title' ) ) :

	/**
	 * Filters the archive title.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_archive_title( $html ) {
		$html = preg_replace( '/<header class="archive-header"><h1>([^<]+)<\/h1><\/header>/i', '<h1>$1</h1>', $html );
		return $html;
	}

	add_filter( 'course_archive_title', 'lsx_sensei_archive_title', 10, 1 );
	add_filter( 'sensei_lesson_archive_title', 'lsx_sensei_archive_title', 10, 1 );

endif;

if ( ! function_exists( 'lsx_sensei_category_title' ) ) :

	/**
	 * Filters the archive title.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_category_title( $html ) {
		$html = str_replace( 'h2', 'h1', $html );
		return $html;
	}

	add_filter( 'course_category_title', 'lsx_sensei_category_title', 10, 1 );

endif;

// Switching the course filters and the headers around
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ) );
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ) );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 11, 0 );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ),12 );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ),12 );

// removes the course image above the content
remove_action( 'sensei_course_content_inside_before', array( $woothemes_sensei->course, 'course_image' ), 30, 1 );
// add the course image to the left of the content
add_action( 'lsx_sensei_course_content_inside_before', array( 'Sensei_Course', 'course_image' ), 30, 1 );


if ( ! function_exists( 'lsx_sensei_add_buttons' ) ) :

	/**
	 * Add extra buttons to the single view on lists.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_add_buttons( $course_id ) {
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

	add_action( 'sensei_course_content_inside_after', 'lsx_sensei_add_buttons', 9 );

endif;

if ( ! function_exists( 'lsx_sensei_add_to_cart_text' ) ) :

	/**
	 * Change add to cart button text.
	 *
	 * @package    lsx
	 * @subpackage sensei
	 */
	function lsx_sensei_add_to_cart_text( $text ) {
		$text = esc_html__( 'Add to cart', 'lsx' );
		return $text;
	}

	add_filter( 'sensei_wc_single_add_to_cart_button_text', 'lsx_sensei_add_to_cart_text' );

endif;


