<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Sensei Messages Class
 *
 * All functionality pertaining to the Messages post type in Sensei.
 *
 * @package Users
 * @author Automattic
 *
 * @since 1.6.0
 */
class LSX_Sensei_Messages extends Sensei_Messages {

	/**
	 * Instance of class.
	 *
	 * @var self
	 */
	private static $instance;

	/**
	 * Constructor.
	 *
	 * @since  1.6.0
	 */
	public function __construct() {

		//$this->post_type   = 'sensei_message';

		//add_action( 'sensei_before_main_content', array( $this, 'lsx_test_sensei' ), 10 );

	} // End __construct()

	/**
	 * Link to the users my messages page
	 *
	 * @since 1.9.0
	 */
	public static function the_my_messages_link() {
		if ( ! Sensei()->settings->get( 'messages_disable' ) ) {
			?>
			<p class="my-messages-link-container">
				<a class="my-messages-link btn border-btn" href="<?php echo esc_url( get_post_type_archive_link( 'sensei_message' ) ); ?>"
				title="<?php esc_attr_e( 'View & reply to private messages sent to your course & lesson teachers.', 'sensei-lms' ); ?>">
					<?php esc_html_e( 'My Messages', 'sensei-lms' ); ?>
				</a>
			</p>
			<?php
		}
	}

	public function lsx_test_sensei() {
		echo '<h1>test</h1>';
	}

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

} // End Class

/**
 * Class WooThemes_Sensei_Messages
 *
 * @ignore only for backward compatibility
 * @since 1.9.0
 */
//class LSX_Sensei_Messages extends Sensei_Messages{}
new LSX_Sensei_Messages();
