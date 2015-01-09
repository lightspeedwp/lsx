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
		 * An array of the customizer controls
		 */
		private $controls = array();
		


		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since     1.0.0
		 */
		public function __construct( $controls ) {
			
			$this->controls = $controls;

			add_action( 'customize_preview_init', array($this,'customize_preview_js' ));
			add_action( 'customize_register', array($this,'customizer'), 11 );
		}
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function customize_preview_js() {
			wp_enqueue_script( 'lsx_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
		}
			
		
		/**
		 * create customiser controls
		 *
		 * @since     1.0.0
		 */		
		public function customizer( $wp_customize ) {
			
			
			// start panels
			if( !empty( $this->controls['panels'] ) ){

				foreach( $this->controls['panels'] as $panel_slug => $args ){
					$this->add_panel( $panel_slug, $args, $wp_customize );
				}

			}

			// start sections
			if( !empty( $this->controls['sections'] ) ){

				foreach( $this->controls['sections'] as $section_slug => $args ){
					$this->add_section( $section_slug, $args, $wp_customize );
				}

			}

			// start sections
			if( !empty( $this->controls['settings'] ) ){

				foreach( $this->controls['settings'] as $settings_slug => $args ){
					$this->add_setting( $settings_slug, $args, $wp_customize );
				}

			}

			// start fields
			if( !empty( $this->controls['fields'] ) ){

				foreach( $this->controls['fields'] as $field_slug => $args ){
					$this->add_control( $field_slug, $args, $wp_customize );
				}

			}

		
		}
		

		/**
		 * create a panel
		 *
		 * @since     1.0.0
		 */		
		private function add_panel( $slug, $args, $wp_customize ) {
			
			$default_args = array(
				'title' 		=> null,
				'description' 	=> null,
			);

			$wp_customize->add_panel(
				$slug,
				array_merge( $default_args, $args )
			);
			
		}


		/**
		 * create a section
		 *
		 * @since     1.0.0
		 */		
		private function add_section( $slug, $args, $wp_customize ) {
			
			$default_args = array(
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => null, //Descriptive tooltip
			);

			$wp_customize->add_section( $slug, 
				array_merge( $default_args, $args )
			);
			
		}

		/**
		 * create a setting
		 *
		 * @since     1.0.0
		 */		
		private function add_setting( $slug, $args, $wp_customize ) {
			
			$default_args =	array(
				'default' 		=> null, //Default setting/value to save
				'type' 			=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability'	=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' 	=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
			);


			$wp_customize->add_setting( $slug, //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array_merge( $default_args, $args )
			);    

		}

		/**
		 * create a control
		 *
		 * @since     1.0.0
		 */		
		private function add_control( $slug, $args, $wp_customize ) {
			
			$default_args = array(

			);

			if( isset( $args['control'] ) && class_exists( $args['control'] )){
				
				$control_class = $args['control'];
				unset( $args['control'] );

				$control = new $control_class( $wp_customize, $slug, array_merge( $default_args, $args ) );
				$wp_customize->add_control( $control );
			
			}else{
				
				if( isset( $args['control'] ) ){
					unset( $args['control'] );
				}

				$wp_customize->add_control(
					$slug,
					array_merge( $default_args, $args )
				);
			}

		}
		



		public static function get_slider_post_type_choices() {
		
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