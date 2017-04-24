<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly


if ( ! function_exists( 'lsx_activation_admin_notice' ) ) :
	/**
	 * Adds an admin notice upon successful activation.
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', 'lsx_welcome_admin_notice', 99 );
		}
	}
endif; // lsx_activation_admin_notice
add_action( 'load-themes.php', 'lsx_activation_admin_notice' );


if ( ! function_exists( 'lsx_welcome_admin_notice' ) ) :
	/**
	 * Display an admin notice linking to the welcome screen.
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Thanks for choosing LSX! You can read hints and tips on how get the most out of your new theme on the %1$swelcome screen%2$s.', 'lsx' ), '<a href="' . esc_url( admin_url( 'themes.php?page=lsx-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=lsx-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php esc_attr_e( 'Get started with LSX', 'lsx' ); ?></a></p>
			</div>
		<?php
	}
endif; // lsx_welcome_admin_notice


if ( ! function_exists( 'lsx_welcome_style' ) ) :
	/**
	 * Load welcome screen css.
	 *
	 * @param string $hook_suffix the current page hook suffix.
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_style( $hook_suffix ) {
		if ( 'appearance_page_lsx-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'lsx-welcome-screen', get_template_directory_uri() . '/css/admin/welcome-screen/welcome.css', array(), LSX_VERSION );
		}
	}
endif; // lsx_welcome_style
add_action( 'admin_enqueue_scripts', 'lsx_welcome_style' );


if ( ! function_exists( 'lsx_welcome_register_menu' ) ) :
	/**
	 * Creates the dashboard page.
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_register_menu() {
		add_theme_page( 'LSX', 'LSX', 'activate_plugins', 'lsx-welcome', 'lsx_welcome_screen' );
	}
endif; // lsx_welcome_register_menu
add_action( 'admin_menu', 'lsx_welcome_register_menu' );


if ( ! function_exists( 'lsx_welcome_screen' ) ) :
	/**
	 * The welcome screen.
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_screen() {
		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
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
			do_action( 'lsx_welcome' ); ?>
		</div>
		<?php
	}
endif; // lsx_welcome_screen


if ( ! function_exists( 'lsx_welcome_header' ) ) :
	/**
	 * Welcome screen intro
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_header() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/component-header.php' );
	}
endif; // lsx_welcome_header
add_action( 'lsx_welcome', 'lsx_welcome_header', 10 );


if ( ! function_exists( 'lsx_welcome_enhance' ) ) :
	/**
	 * Welcome screen enhance section
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_enhance() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/component-enhance.php' );
	}
endif; // lsx_welcome_enhance
add_action( 'lsx_welcome', 'lsx_welcome_enhance', 20 );


if ( ! function_exists( 'lsx_welcome_footer' ) ) :
	/**
	 * Welcome screen contribute section
	 *
	 * @since 1.8.0
	 * @package lsx
	 */
	function lsx_welcome_footer() {
		require_once( get_template_directory() . '/includes/admin/welcome-screen/component-footer.php' );
	}
endif; // lsx_welcome_footer
add_action( 'lsx_welcome', 'lsx_welcome_footer', 30 );
