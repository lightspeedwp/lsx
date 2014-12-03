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
			
			if(function_exists('soliloquy')){
				add_action( 'customize_register', array($this,'soliloquy_customizer'), 11 );
			}
		}
		
		/**
		 * Slider Settings
		 *
		 * @since     1.0.0
		 */		
		public function soliloquy_customizer( $wp_customize ) {		
		
			//Register a section
			$wp_customize->add_section( 'lsx-soliloquy', array(
					'title' => 'Soliloquy', // The title of section
					'description' => 'Configure your Soliloquy slider.', // The description of section
			) );
			
			
			/* Add setting do you want to show header image or Soliloquy Slider. */
			$wp_customize->add_setting('show_header_slider',
					array(
							'default'           => 0,
							'type'              => 'theme_mod'
					)
			);
			
			/*$wp_customize->add_control('show_soliloquy_slider',
					array(
							'label'    => __( 'Choose whether to show Header Image or Soliloquy Slider in Header?', 'lsx-theme' ),
							'section'  => 'lsx-soliloquy',
							'type'     => 'radio',
							'choices'  => array(
									'0'   => esc_html__( 'No', 'lsx-theme' ),
									'1'   => esc_html__( 'Yes', 'lsx-theme' )
							)
					)
			);		*/	
	
	
			$wp_customize->add_setting( 'lsx_soliliquy_slider', array(
					'default'           => 0,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'absint'
			) );
	
			$slider_choices = $this->get_slider_post_type_choices();
			
			$wp_customize->add_control( 'lsx_soliliquy_slider', 
					array(
						'label'    => esc_html__( 'Select Soliloquy Slider', 'lsx-theme' ),
						'section'  => 'lsx-soliloquy',
						'type'     => 'select',
						'choices'  => $slider_choices
			) );
		
			// The latter code snippets go here.
		}		
		
		
		function get_slider_post_type_choices() {
		
			/* Set an array. */
			$slider_data = array(
					0 => __( 'Select Slider', 'lsx-theme' )
			);
		
			/* Get Soliloquy Sliders. */
			$soliloquy_args = array(
					'post_type' 		=> 'soliloquy',
					'posts_per_page' 	=> -1
			);
		
			$sliders = get_posts( $soliloquy_args );
		
			/* Loop sliders data. */
			foreach ( $sliders as $slider ) {
				$slider_data[$slider->ID] = $slider->post_title;
			}
		
			/* Return array. */
			return $slider_data;
		
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