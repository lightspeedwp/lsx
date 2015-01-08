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
			
			
			$inner_priority = 1;
			// go over the sections and add as needed
			if( !empty( $this->controls['sections'] ) ){
				
				foreach( $this->controls['sections'] as $group_slug=>$group){
					
					if( empty( $group['fields'] ) ){
						continue;
					}
					
					//$group['control_slug'] = null;

					$inner_priority = $this->add_section( $group_slug, $group, $wp_customize, $inner_priority++ );

				}

			}			


			// go over the panels and add as needed
			$inner_priority = 1;
			if( !empty( $this->controls['panels'] ) ){
				foreach( $this->controls['panels'] as $control_slug=>$control ){

					$wp_customize->add_panel(
						$control_slug,
						array(
							'title' 		=> $control['title'],
							'description' 	=> ( isset( $control['description'] ) ? $control['description'] : null ),
							)
						);

					// sections
					if( !empty( $control['sections'] ) ){
						
						foreach( $control['sections'] as $group_slug=>$group){
							
							$group['control_slug'] = $control_slug;

							if( empty( $group['fields'] ) ){
								continue;
							}

							$inner_priority = $this->add_section( $group_slug, $group, $wp_customize, $inner_priority++ );

						}

					}

				}
			}



			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';			
			
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
		

		/**
		 * create a section
		 *
		 * @since     1.0.0
		 */		
		private function add_section( $slug, $group, $wp_customize, $priority ) {

				// section args
				$section_args = array(
					'title' 		=> $group['title'],
					'description' 	=> ( isset( $group['description'] ) ? $group['description'] : null ),					
				);

				if( !empty( $group['control_slug'] ) ){
					$section_args['panel'] 		= $group['control_slug'];
					$section_args['priority'] 	= $priority;
				}

				$wp_customize->add_section(
					$slug,
					$section_args
				);

				foreach( $group['fields'] as $field_slug=>$field ){
					
					$setting_args = array(
						'default'	=> ( isset($field['default']) ? $field['default'] : null ),
						'transport'	=> $field['transport'],
					);
					// if provided a settings array, merge with current settings
					if( !empty( $field['settings'] ) && is_array( $field['settings'] ) ){
						$setting_args = array_merge( $field['settings'] );
					}
					// create setting control
					$wp_customize->add_setting(
						$field_slug,
						$setting_args
					);

					// build args for controll.
					$args = array(
						'label' 		=> $field['label'],
						'description' 	=> ( isset( $field['description'] ) ? $field['description'] : null ),
						'section' 		=> $slug,
						'settings'		=> $field_slug,
						'type' 			=> $field['type'],
						'config' 		=> $field,
						'priority' 		=> $priority++
					);

					// create control
					$this->add_control( $field_slug, $args, $wp_customize );

				}

			return $priority;
		}

		/**
		 * create a control
		 *
		 * @since     1.0.0
		 */		
		private function add_control( $slug, $args, $wp_customize ) {

			// add actual control.
			if(class_exists( "WP_Customize_" . $args['type'] . "_Control" )){
			
				$classname = "WP_Customize_" . $args['type'] . "_Control";
				$control = new $classname( $wp_customize, $slug, $args );
				$wp_customize->add_control( $control );
			
			}else{

				$wp_customize->add_control(
					$slug,
					$args
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



// define your controls here
$controls = array(

	// defines the root sections
	'sections'		=>	array(
		// defines a section
		'root_group_slug'	=>	array(
			'title'			=>	__( 'root Level', 'slug' ),
			'description'	=>	__( 'Details on this group in level', 'slug' ), // optional
			'fields'		=>	array(
				// Defines a Field
				'root_field_slug'		=>	array(
					'label'			=>	__( 'First Field', 'slug' ),
					'description'	=>	__( 'This is a field. the first.', 'slug' ), // optional
					'default'		=>	'default value', // optional
					'transport'		=>	'refresh', // transport or postMessage. see codex, required additional JS files.
					'type'			=>	'Text', // case sensitive for built int types: Text, Color, Upload, Image. Lowercase for html inputs like: text, textarea (select, checkboxes, radio require custom controls)
					'choices'		=>	array( 'LSX_Theme_Customizer', 'get_slider_post_type_choices' ),
					'settings'		=>	array(
						'sanitize_callback' => 'absint',
						'type'              => 'theme_mod',
					)

				), // add more as needed

			)
		), // add more sections as needed
	),
	// defines the panels
	'panels'			=>	array(
		'header_controls'	=>	array(
			'title'			=>	__( 'First Group', 'slug' ),
			'description'	=>	__( 'First Group Controls Here', 'slug' ), // optional
			'sections'		=>	array(
				// defines a section
				'first_group_slug'	=>	array(
					'title'			=>	__( 'First Level', 'slug' ),
					'description'	=>	__( 'Details on this group in level', 'slug' ), // optional
					'fields'		=>	array(
						// Defines a Field
						'field_slug'		=>	array(
							'label'			=>	__( 'First Field', 'slug' ),
							'description'	=>	__( 'This is a field. the first.', 'slug' ), // optional
							'default'		=>	'default value', // optional
							'transport'		=>	'refresh', // transport or postMessage. see codex, required additional JS files.
							'type'			=>	'Text', // case sensitive for built int types: Text, Color, Upload, Image. Lowercase for html inputs like: text, textarea (select, checkboxes, radio require custom controls)
							'choices'		=>	array( 'LSX_Theme_Customizer', 'get_slider_post_type_choices' ),
							'settings'		=>	array(
								'sanitize_callback' => 'absint',
								'type'              => 'theme_mod',
							)

						), // add more as needed

					)
				), // add more sections as needed

			)
		), // add more panels as needed
	),


);



$lsx_customizer = new LSX_Theme_Customizer( $controls );

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