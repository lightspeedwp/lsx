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
	<div id="primary" class="content-area <?php echo lsx_main_class(); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">
		
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
function redirect_to_home( $query ){
    if(is_post_type_archive( 'lesson' ) ) {
         wp_redirect( home_url() . '/courses-overview' );
         exit;
     }
}
add_action( 'parse_query', 'redirect_to_home' );