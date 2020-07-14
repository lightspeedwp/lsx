<?php
/**
 * LSX functions and definitions - Welcome page.
 *
 * @package    lsx
 * @subpackage welcome-page
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'lsx_activation_admin_notice_dismiss' ) ) :

	/**
	 * Dismiss the admin notice (successful activation).
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_activation_admin_notice_dismiss() {
		update_option( 'lsx-notice-dismissed', '1' );
		wp_die();
	}

endif;

add_action( 'wp_ajax_lsx_dismiss_theme_notice', 'lsx_activation_admin_notice_dismiss' );

if ( ! function_exists( 'lsx_activation_admin_notice' ) ) :

	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_activation_admin_notice() {
		if ( empty( get_option( 'lsx-notice-dismissed' ) ) ) {
			add_action( 'admin_notices', 'lsx_welcome_admin_notice', 99 );
		}
	}

endif;

add_action( 'admin_notices', 'lsx_activation_admin_notice' );

if ( ! function_exists( 'lsx_welcome_admin_notice' ) ) :

	/**
	 * Display an admin notice linking to the welcome screen.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_admin_notice() {
		?>
			<div class="lsx-theme-notice notice notice-success is-dismissible">
				<p>
					<?php
						printf(
							/* Translators: 1: HTML open tag link, 2: HTML close tag link */
							esc_html_e( 'Thanks for choosing LSX! You can read hints and tips on how get the most out of your new theme on the %1$swelcome screen%2$s.', 'lsx' ),
							'<a href="' . esc_url( admin_url( 'themes.php?page=lsx-welcome' ) ) . '">',
							'</a>'
						);
					?>
				</p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=lsx-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php esc_html_e( 'Get started with LSX', 'lsx' ); ?></a></p>
			</div>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_welcome_style' ) ) :

	/**
	 * Load welcome screen css.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 *
	 * @param string $hook_suffix the current page hook suffix.
	 */
	function lsx_welcome_style( $hook_suffix ) {
		if ( 'appearance_page_lsx-welcome' === $hook_suffix ) {
			wp_enqueue_style( 'lsx-welcome-screen-mailchimp', '//cdn-images.mailchimp.com/embedcode/classic-10_7.css', array(), LSX_VERSION );
			wp_enqueue_style( 'lsx-welcome-screen', get_template_directory_uri() . '/assets/css/admin/welcome.css', array( 'lsx-welcome-screen-mailchimp' ), LSX_VERSION );
			wp_style_add_data( 'lsx-welcome-screen', 'rtl', 'replace' );
		}
	}

endif;

add_action( 'admin_enqueue_scripts', 'lsx_welcome_style' );

if ( ! function_exists( 'lsx_welcome_register_menu' ) ) :

	/**
	 * Creates the dashboard page.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_register_menu() {
		add_theme_page( 'LSX', 'LSX', 'activate_plugins', 'lsx-welcome', 'lsx_welcome_screen' );
	}

endif;

add_action( 'admin_menu', 'lsx_welcome_register_menu' );

if ( ! function_exists( 'lsx_welcome_screen' ) ) :

	/**
	 * The welcome screen.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_screen() {
		require_once ABSPATH . 'wp-load.php';
		require_once ABSPATH . 'wp-admin/admin.php';
		require_once ABSPATH . 'wp-admin/admin-header.php';
		?>
		<div class="wrap about-wrap">
			<?php
			/**
			 * Functions hooked into lsx_welcome action
			 *
			 * @hooked lsx_welcome_header  - 10
			 * @hooked lsx_welcome_enhance - 20
			 * @hooked lsx_welcome_footer  - 30
			 */
			do_action( 'lsx_welcome' );
			?>
		</div>
		<?php
	}

endif;

if ( ! function_exists( 'lsx_welcome_header' ) ) :

	/**
	 * Welcome screen intro.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_header() {
		require_once get_template_directory() . '/includes/admin/welcome-screen/component-header.php';
	}

endif;

add_action( 'lsx_welcome', 'lsx_welcome_header', 10 );

if ( ! function_exists( 'lsx_welcome_enhance' ) ) :

	/**
	 * Welcome screen enhance section.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_enhance() {
		require_once get_template_directory() . '/includes/admin/welcome-screen/component-enhance.php';
	}

endif;

add_action( 'lsx_welcome', 'lsx_welcome_enhance', 20 );

if ( ! function_exists( 'lsx_welcome_footer' ) ) :

	/**
	 * Welcome screen contribute section.
	 *
	 * @package    lsx
	 * @subpackage welcome-page
	 */
	function lsx_welcome_footer() {
		require_once get_template_directory() . '/includes/admin/welcome-screen/component-footer.php';
	}

endif;

add_action( 'lsx_welcome', 'lsx_welcome_footer', 30 );
