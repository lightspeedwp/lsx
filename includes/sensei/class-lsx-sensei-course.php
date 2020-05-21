<?php
/**
 * LSX Sensei Course Class
 *
 * @package    lsx
 * @subpackage sensei
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
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
		global $sensei;
		global $woothemes_sensei;

		// Switching the course filters and the headers around.
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 10, 0 );
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ) );
		remove_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ) );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'archive_header' ), 11, 0 );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_sorting' ), 12 );
		add_action( 'sensei_archive_before_course_loop', array( 'Sensei_Course', 'course_archive_filters' ), 12 );

		// First add the thumbnail.
		add_action( 'sensei_course_content_inside_before', array( $this, 'get_course_thumbnail' ), 1 );

		// This is for our wrapper, we run it on 2, after the thumbnail we added.
		add_action( 'sensei_course_content_inside_before', array( $this, 'course_body_div_open' ), 1 );
		add_action( 'sensei_course_content_inside_after', array( $this, 'course_body_div_close' ), 50 );

		// This is for our wrapper, we run it on 2, after the thumbnail we added.
		add_action( 'sensei_course_content_inside_before', array( $this, 'course_body_div_results_open' ), 20 );
		add_action( 'sensei_course_content_inside_after', array( $this, 'course_body_div_results_close' ), 49 );

		add_action( 'sensei_single_course_content_inside_before', array( $this, 'display_course_amount' ), 20 );

		// removes the course image above the content.
		remove_action( 'sensei_course_content_inside_before', array( $woothemes_sensei->course, 'course_image' ), 30, 1 );
		// add the course image to the left of the content.
		add_action( 'lsx_sensei_course_content_inside_before', array( $woothemes_sensei->course, 'course_image' ), 30, 1 );

		add_filter( 'attach_shortcode_hooks', 'lsx_attach_shortcode_hooks', 10, 1 );

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
		global $post, $current_user;
		$is_user_taking_course    = Sensei_Utils::has_started_course( $post->ID, $current_user->ID );
		$user_taking_course_class = '';
		if ( ! empty( $is_user_taking_course ) ) {
			$user_taking_course_class = 'currently-in-course';
		}
		?>
		<div class="course-body <?php echo esc_html( $user_taking_course_class ); ?>">
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

	/**
	 * <div class="course-details-info"> for content-course.php, just for the info after the meta
	 *
	 * @return void
	 */
	public function course_body_div_results_open() {
		?>
		<div class="course-details-info">
		<?php
	}

	/**
	 * The closing </div> for <div class="course-details-info"> content-course.php, just for the info after the meta
	 *
	 * @return void
	 */
	public function course_body_div_results_close() {
		?>
		</div>
		<?php
	}

	/**
	 * Display the course price on a single course.
	 *
	 * @return void
	 */
	public function display_course_amount() {
		global $post, $current_user;
		$is_user_taking_course   = Sensei_Course::is_user_enrolled( $post->ID, $current_user->ID );
		$is_user_starting_course = Sensei_Utils::has_started_course( $post->ID, $current_user->ID );
		$wc_post_id              = absint( get_post_meta( $post->ID, '_course_woocommerce_product', true ) );
		$course_purchasable      = '';
		if ( class_exists( 'Sensei_WC' ) ) {
			$course_purchasable = Sensei_WC::is_course_purchasable( $post->ID );
			$currency           = get_woocommerce_currency_symbol();
			$product            = new WC_Product( $wc_post_id );
			if ( ( ! empty( $product->get_price() ) ) && ( ( ! $is_user_taking_course ) || ( ! $is_user_starting_course ) ) ) {
				echo '<span class="course-product-price price"><span>' . esc_html( $currency ) . ' </span>' . sprintf( '%0.2f', esc_html( $product->get_price() ) ) . '</span>';
			} elseif ( ( '' === $product->get_price() || 0 == $product->get_price() ) && $course_purchasable && ( ( ! $is_user_taking_course ) || ( ! $is_user_starting_course ) ) ) {
				echo '<span class="course-product-price price">' . wp_kses_post( 'Free!', 'lsx' ) . '</span>';
			}
		}
	}

} // End Class
new LSX_Sensei_Course();
