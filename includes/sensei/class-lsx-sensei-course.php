<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * LSX Sensei Course Class
 */
class LSX_Sensei_Course {

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

		global $woothemes_sensei;

		//Switching the course filters and the headers around
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ) );
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ) );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 11, 0 );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ), 12 );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ), 12 );

		// First add the thumbnail.
		add_action( 'sensei_course_content_inside_before', array( $this, 'get_course_thumbnail' ), 1 );

		// This is for our wrapper, we run it on 2, after the thumbnail we added.
		add_action( 'sensei_course_content_inside_before', array( $this, 'course_body_div_open' ), 2 );
		add_action( 'sensei_course_content_inside_after', array( $this, 'course_body_div_close' ), 50 );

		// removes the course image above the content
		remove_action( 'sensei_course_content_inside_before', array( $woothemes_sensei->course, 'course_image' ), 30, 1 );
		// add the course image to the left of the content
		add_action( 'lsx_sensei_course_content_inside_before', array( 'Sensei_Course', 'course_image' ), 30, 1 );
	}

	/**
	 * Gets the current courses thumbnail for content-course.php
	 *
	 * @return void
	 */
	public function get_course_thumbnail() {
		?>
		<div class="course-thumbnail">
			<?php do_action( 'lsx_sensei_course_content_inside_before', get_the_ID() ); ?>
		</div>
		<?php
	}

	/**
	 * <div class="course-body"> for content-course.php
	 *
	 * @return void
	 */
	public function course_body_div_open() {
		?>
		<div class="course-body">
		<?php
	}

	/**
	 * The closing </div> for <div class="course-body"> content-course.php
	 *
	 * @return void
	 */
	public function course_body_div_close() {
		?>
		</div>
		<?php
	}
} // End Class
new LSX_Sensei_Course();
