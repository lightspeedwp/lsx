<?php
/**
 * Customizer Configuration File
 *
 * @package lsx-theme
 */


/**
 * @package lsx-theme
 * @author  warwick@feedmymedia.com <lsdev.biz>
 */
if(!class_exists('LSX_Theme_Customizer')){
	class LSX_Theme_Customizer {

		/**
		 * An array of post_type shared accross the post types
		 */
		public $post_types = array();
		
		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since     1.0.0
		 */
		public function __construct() {
		
			
			$post_types = array();
			add_action( 'customize_register', array($this,'customizer'), 11 );
			
		}
		
		/**
		 * Slider Settings
		 *
		 * @since     1.0.0
		 */		
		public function customizer( $wp_customize ) {		
		
			//Register a section
			$wp_customize->add_section( 'lsx-homepage', array(
					'title' => 'Homepage', // The title of section
					'description' => '', // The description of section
			) );
	
			
			
			//Hompage Slider Settings
			if(function_exists('soliloquy')){
				$wp_customize->add_setting( 'lsx_homepage_slider', array(
						'default'           => 0,
						'type'              => 'theme_mod',
						'sanitize_callback' => 'absint'
				) );
		
				
				$slider_choices = $this->get_slider_post_type_choices();
				$wp_customize->add_control( 'lsx_homepage_slider', 
						array(
							'label'    => esc_html__( 'Select Slider', 'lsx-theme' ),
							'section'  => 'lsx-homepage',
							'type'     => 'select',
							'choices'  => $slider_choices
				) );
			}
		
		}		
		
		
		function get_slider_post_type_choices() {
		
			/* Set an array. */
			$data = array(
					0 => __( 'Disable', 'lsx-theme' )
			);
		
			/* Get Soliloquy Sliders. */
			$query_args = array(
					'post_type' 		=> 'soliloquy',
					'posts_per_page' 	=> -1
			);
		
			$items = get_posts( $query_args );
		
			/* Loop sliders data. */
			foreach ( $items as $item ) {
				$data[$item->ID] = $item->post_title;
			}
		
			/* Return array. */
			return $data;
		
		}		
		
	}
	
}

$lsx_customizer = new LSX_Theme_Customizer();
/**
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * Not in a class to support backwards compatibility in themes.
 */

if ( ! function_exists( 'lsx_get_option' ) ) :

function lsx_get_option( $name, $default = false ) {
	$config = get_option( 'optionsframework' );

	if ( ! isset( $config['id'] ) ) {
		return $default;
	}

	$options = get_option( $config['id'] );

	if ( isset( $options[$name] ) ) {
		return $options[$name];
	}

	return $default;
}
endif;