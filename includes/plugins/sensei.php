<?php
/**
 * LSX functions and definitions - Integrations - Sensei.
 *
 * @package    lsx
 * @subpackage plugins
 * @category   sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woothemes_sensei;

// Switching the course filters and the headers around
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ) );
remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ) );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 11, 0 );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ),12 );
add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ),12 );

// Moving course image up in DOM
remove_action( 'sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,10, 1 );
remove_action( 'sensei_single_course_content_inside_before', array( Sensei()->course, 'course_image' ), 20 );
add_action( 'sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,1, 1 );
add_action( 'sensei_single_course_content_inside_before', array( Sensei()->course, 'course_image' ), 12 );

if ( ! function_exists( 'lsx_sensei_wp_head' ) ) :

	/**
	 * Adds the top and primary divs for the layout.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   sensei
	 */
	function lsx_sensei_wp_head() {
		$layout = get_theme_mod( 'lsx_layout', '2cr' );
		$layout = apply_filters( 'lsx_layout', $layout );

		if ( '1c' === $layout && is_post_type_archive( array( 'course', 'lesson' ) ) ) {
			add_action( 'sensei_archive_before_course_loop', 'lsx_breadcrumbs', 11 );
		}

		if ( '1c' === $layout && is_tax( array( 'module', 'course-category' ) ) ) {
			remove_action( 'lsx_content_top', 'lsx_breadcrumbs' );
			add_action( 'sensei_loop_course_before', 'lsx_breadcrumbs', 80, 1 );

			if ( is_tax( 'module' ) ) {
				remove_action( 'sensei_content_lesson_inside_before', array( 'Sensei_Lesson', 'the_lesson_meta' ), 20 );
				add_action( 'sensei_content_lesson_inside_before', array( 'Sensei_Lesson', 'the_lesson_meta' ), 40 );
				remove_action( 'sensei_content_lesson_inside_before', array( 'Sensei_Core_Modules', 'module_archive_description' ), 11 );
			}
		}

	}

endif;

add_action( 'wp_head', 'lsx_sensei_wp_head', 10 );

if ( ! function_exists( 'lsx_sensei_before_content' ) ) :

	/**
	 * Adds the top and primary divs for the layout.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   sensei
	 */
	function lsx_sensei_before_content() {
		lsx_content_wrap_before(); ?>

		<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">
			<?php lsx_content_before(); ?>

			<main id="main" class="site-main">
				<?php lsx_content_top();
	}

endif;

remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
add_action( 'sensei_before_main_content', 'lsx_sensei_before_content', 10 );

if ( ! function_exists( 'lsx_sensei_after_content' ) ) :

	/**
	 * Adds the closing divs for primary and main to sensei.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   sensei
	 */
	function lsx_sensei_after_content() {
				lsx_content_bottom(); ?>
			</main><!-- #main -->

			<?php lsx_content_after(); ?>
		</div><!-- #primary -->

		<?php lsx_content_wrap_after(); ?>
		<?php get_sidebar();
	}

endif;

remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );
add_action( 'sensei_after_main_content', 'lsx_sensei_after_content', 10 );

if ( ! function_exists( 'lsx_sensei_styles' ) ) :

	/**
	 * Adds Sensei custom stylesheet.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   sensei
	 */
	function lsx_sensei_styles() {
		wp_enqueue_style( 'sensei', get_template_directory_uri() . '/assets/css/plugins/sensei.css', array( 'lsx_main' ), LSX_VERSION );
	}

endif;

// @TODO - Sensei is currently on version 1.9.14, the styles package imported is 1.5
//add_filter( 'sensei_disable_styles', '__return_true' );
//add_action( 'wp_enqueue_scripts', 'lsx_sensei_styles' );

if ( ! function_exists( 'lsx_sensei_category_title' ) ) :

	/**
	 * Filters the archive title.
	 *
	 * @package    lsx
	 * @subpackage plugins
	 * @category   sensei
	 */
	function lsx_sensei_category_title( $html, $term_id ) {
		$html = str_replace( 'h2', 'h1', $html );
		$html = str_replace( 'sensei-category-title', 'archive-title', $html );
		return '<header class="archive-header">' . $html . '</header>';
	}

endif;

add_filter( 'course_category_title', 'lsx_sensei_category_title', 1, 10 );
