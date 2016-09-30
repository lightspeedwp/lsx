<?php
/**
 * Sensei Layout and Functionality
 *
 * @package lsx
 * @subpackage sensei
 */

global $woothemes_sensei;

/*
 * Hooks
 */

remove_action( 'sensei_before_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper' ), 10 );
remove_action( 'sensei_after_main_content', array( $woothemes_sensei->frontend, 'sensei_output_content_wrapper_end' ), 10 );

add_action('sensei_before_main_content', 'lsx_sensei_before_content', 10);
add_action('sensei_after_main_content', 'lsx_sensei_after_content', 10);

//Switching the course filters and the headers around
remove_action('sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
remove_action ( 'sensei_archive_before_course_loop' , array( 'Sensei_Course', 'course_archive_sorting' ) );
remove_action ( 'sensei_archive_before_course_loop' , array( 'Sensei_Course', 'course_archive_filters' ) );
add_action('sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 11, 0 );
add_action ( 'sensei_archive_before_course_loop' , array( 'Sensei_Course', 'course_archive_sorting' ),12 );
add_action ( 'sensei_archive_before_course_loop' , array( 'Sensei_Course', 'course_archive_filters' ),12 );

// Moving course image up in DOM
remove_action('sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,10, 1 );
add_action('sensei_course_content_inside_before', array( Sensei()->course, 'course_image' ) ,1, 1 );

remove_action( 'sensei_single_course_content_inside_before', array( Sensei()->course , 'course_image'), 20 );
add_action( 'sensei_single_course_content_inside_before', array( Sensei()->course , 'course_image'), 12 );

/**
 * Adds the top and primary divs for the layout.
 * @package lsx
 * @subpackage sensei
 * @category 	layout
 */
function lsx_sensei_wp_head(){

	$layout = get_theme_mod('lsx_layout','2cr');
	$layout = apply_filters( 'lsx_layout', $layout );

	if('1c' === $layout && is_post_type_archive(array('course','lesson'))) {
		add_action('sensei_archive_before_course_loop', 'lsx_breadcrumbs', 11 );
	}
	
	if('1c' === $layout && is_tax(array('module','course-category'))) {
		remove_action('lsx_content_top', 'lsx_breadcrumbs');
		add_action( 'sensei_loop_course_before', 'lsx_breadcrumbs', 80 , 1 );
		
		if(is_tax('module')){
			remove_action( 'sensei_content_lesson_inside_before', array( 'Sensei_Lesson', 'the_lesson_meta' ), 20 );
			add_action( 'sensei_content_lesson_inside_before', array( 'Sensei_Lesson', 'the_lesson_meta' ), 40 );
			
			remove_action('sensei_content_lesson_inside_before', array('Sensei_Core_Modules', 'module_archive_description'), 11);
		}
	}
		
}
add_action('wp_head', 'lsx_sensei_wp_head', 10);

/*
 * Layout
 */

/**
 * Adds the top and primary divs for the layout.
 * @package lsx
 * @subpackage sensei
 * @category 	layout
 */
function lsx_sensei_before_content(){ ?>
	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main">
		
		<?php lsx_content_top(); ?>
<?php }


/**
 * Adds the closing divs for primary and main to sensei.
 * @package lsx
 * @subpackage sensei
 * @category 	layout
 */
function lsx_sensei_after_content(){ ?>
		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

	<?php lsx_content_wrap_after(); ?>

	<?php get_sidebar(); ?>
<?php }

/*
 * Styles
 */

/**
 * Removes Sensei plugin styles and enqueues Sensei styles from the theme instead.
 * @package lsx
 * @subpackage sensei
 * @category redirect
 */
add_filter( 'sensei_disable_styles', '__return_true' );

/**
 * Includes the sensei specific styles.
 * @package lsx
 * @subpackage sensei
 * @category styles
 */
function lsx_sensei_styles() {
    wp_enqueue_style( 'sensei', get_template_directory_uri() . '/css/sensei.css' );
}
add_action( 'wp_enqueue_scripts', 'lsx_sensei_styles' );

/**
 * Redirects Lessons Archive to Courses Overview
 * @package lsx
 * @subpackage woocommerce
 * @category 	styles
 */
function lsx_sensei_redirect_to_home( $query ){
    if(!is_admin() && is_post_type_archive( 'lesson' ) ) {
         wp_redirect( home_url() . '/courses-overview' );
         exit;
     }
}
add_action( 'parse_query', 'lsx_sensei_redirect_to_home' );

/**
 * Filters the archive title
 * @package lsx
 * @subpackage woocommerce
 * @category 	styles
 */
function lsx_sensei_category_title( $html,$term_id ){
	$html = str_replace('h2','h1',$html);
	$html = str_replace('sensei-category-title','archive-title',$html);
	
	return '<header class="archive-header">'.$html.'</header>';
}
add_filter( 'course_category_title', 'lsx_sensei_category_title',1,10 );