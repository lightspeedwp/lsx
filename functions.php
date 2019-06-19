<?php
use function Aws\serialize;

/**
 * LSX functions and definitions.
 *
 * @package lsx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'LSX_VERSION', '2.3.1' );

if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/includes/plugins/woocommerce.php';
}

if ( class_exists( 'Tribe__Events__Main' ) ) {
	require get_template_directory() . '/includes/plugins/the-events-calendar.php';
}

if ( class_exists( 'Sensei_WC' ) ) {
	require get_template_directory() . '/includes/plugins/sensei.php';
}

if ( class_exists( 'bbPress' ) ) {
	require get_template_directory() . '/includes/plugins/bbpress.php';
}

require get_template_directory() . '/includes/config.php';
require get_template_directory() . '/includes/classes/class-lsx-theme-customizer.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/includes/sanitize.php';
require get_template_directory() . '/includes/layout.php';
require get_template_directory() . '/includes/hooks.php';
require get_template_directory() . '/includes/widgets.php';
require get_template_directory() . '/includes/scripts.php';
require get_template_directory() . '/includes/classes/class-lsx-nav-walker.php';
require get_template_directory() . '/includes/nav-navwalker.php';
require get_template_directory() . '/includes/classes/class-lsx-bootstrap-navwalker.php';
require get_template_directory() . '/includes/nav-bootstrap-navwalker.php';
require get_template_directory() . '/includes/classes/class-lsx-walker-comment.php';
require get_template_directory() . '/includes/walker-comment.php';
require get_template_directory() . '/includes/classes/class-lsx-lazy-load-images.php';
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/extras.php';
require get_template_directory() . '/includes/welcome.php';
require get_template_directory() . '/includes/404-widget.php';
require get_template_directory() . '/includes/gutenberg.php';




function lsx_importer_tester() {
	$value = 'a:3:{s:12:""workouttitle"";s:15:""Weighted lunges"";s:4:""reps"";s:7:""20 REPS"";s:16:""video_to_workout"";s:3:""273"";}|a:3:{s:12:""workouttitle"";s:8:""Knee-Ins"";s:4:""reps"";s:7:""20 REPS"";s:16:""video_to_workout"";s:3:""709"";}|a:3:{s:12:""workouttitle"";s:17:""Criss-cross jumps"";s:4:""reps"";s:7:""30 SECS"";s:16:""video_to_workout"";s:3:""710"";}';

	cb_explode_workouts( 3150, 'extable_1', $value );
}
//add_action( 'init', 'lsx_importer_tester' );

function cb_explode_workouts_2( $value ) {
	if ( '' !== $value ) {
		$new_values = array();

		$value = explode( '|', $value );	
		if ( ! is_array( $value ) ) {
			$value = array( $value );
		}
		if ( ! empty( $value ) ) {

			foreach ( $value as $serial_string ) {
				$serial_string = str_replace( '""', '"', $serial_string );
				$old_array = maybe_unserialize( $serial_string );
				if ( is_array( $old_array ) && ! empty( $old_array ) ) {
					$old_values = array();

					foreach( $old_array as $old_key => $old_value ){
						switch( $old_key ) {
							case 'workouttitle':
								$old_values['name'] = $old_value;
							break;

							case 'reps':
								$old_values['reps'] = $old_value;
							break;

							case 'video_to_workout':
								$old_values['connected_video'] = '';
							break;							

							default:
							break;
						}
					};

					if ( ! empty( $old_values ) ) {
						$new_values[] = $old_values;
					}
				}
			}
		}	
		if ( ! empty( $new_values ) ) {
			$value = maybe_serialize( $new_values );
		}
	}
	return $value;
}
