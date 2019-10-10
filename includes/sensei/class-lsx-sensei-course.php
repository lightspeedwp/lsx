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

		// First add the thumbnail.
		add_action( 'sensei_course_content_inside_before', array( $this, 'get_course_thumbnail' ), 1 );

		// This is for our wrapper, we run it on 2, after the thumbnail we added.
		add_action( 'sensei_course_content_inside_before', array( $this, 'course_body_div_open' ), 2 );
		add_action( 'sensei_course_content_inside_after', array( $this, 'course_body_div_close' ), 50 );
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
