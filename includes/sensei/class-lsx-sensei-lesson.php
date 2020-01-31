<?php
/**
 * LSX Sensei Lesson Class
 *
 * @package    lsx
 * @subpackage sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * LSX Sensei Lesson Class
 */
class LSX_Sensei_Lesson {

	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'widgets_init', array( $this, 'lsx_widget_area_sensei_init' ), 100 );
		add_filter( 'body_class', array( $this, 'lsx_widget_area_sensei_is_active' ) );
	} // End __construct()

	/**
	 * Fetches an instance of the class.
	 *
	 * @return self
	 */
	public static function instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Run our changes.
	 */
	public function init() {
		add_action( 'lsx_content_top', array( $this, 'lsx_sensei_lesson_sidebar' ) );

	}

	/**
	 * Register a sidebar when Sensei Participants or Sensei Progress plugins are active.
	 *
	 * @return void
	 */
	public function lsx_widget_area_sensei_init() {
		if ( class_exists( 'Sensei_Course_Participants' ) || class_exists( 'Sensei_Course_Progress' ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'LSX Sensei Sidebar', 'lsx' ),
				'id'            => 'lsx-sensei-sidebar',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
	}

	/**
	 * Widget Area for sensei.
	 *
	 * @param [type] $classes
	 * @return classes
	 */
	public function lsx_widget_area_sensei_is_active( $classes ) {

		if ( class_exists( 'Sensei_Lesson' ) && is_active_sidebar( 'lsx-sensei-sidebar' ) ) {
			$classes[] = 'lsx-sensei-sidebar-active';
		}

		return $classes;
	}

	/**
	 * Adds the widget content to the lesson template if the lsx-sensei-sidebar is active.
	 *
	 * @return void
	 */
	public function lsx_sensei_lesson_sidebar() {
		if ( class_exists( 'Sensei_Lesson' ) && ( class_exists( 'Sensei_Course_Participants' ) || class_exists( 'Sensei_Course_Progress' ) ) ) {
			if ( ( is_single() && ( is_singular( 'lesson' ) ) ) || ( is_single() && ( is_singular( 'quiz' ) ) ) ) {
				if ( is_active_sidebar( 'lsx-sensei-sidebar' ) ) {
					echo '<div id="secondary" class="widget-area lsx-sensei-sidebar">';
					dynamic_sidebar( 'lsx-sensei-sidebar' );
					echo '</div>';
				}
			}
		}
	}

} // End Class
new LSX_Sensei_Lesson();
