<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * Customizer Configuration File
 *
 * @package lsx-theme
 * @subpackage inc
 * 
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
		 * An array of the customizer CSS settings
		 */
		private $css = array();
		

		/**
		 * Initialize the plugin by setting localization and loading public scripts
		 * and styles.
		 *
		 * @since     1.0.0
		 */
		public function __construct( $controls ) {
			
			// get custom controls
			require get_template_directory() . '/inc/google-font.php';
			require get_template_directory() . '/inc/google-font-collection.php';
			require get_template_directory() . '/inc/customizer-layout.php';
			require get_template_directory() . '/inc/customizer-font.php';
			require get_template_directory() . '/inc/customizer-colour.php';
			require get_template_directory() . '/inc/customizer-header-layout.php';

			$this->controls = $controls;

			add_action( 'customize_preview_init', array($this,'customize_preview_js' ),20);
			add_action( 'customize_register', array($this,'customizer'), 11 );
			
			add_action( 'wp_ajax_customizer_site_title', array($this,'ajax_site_title') );
			add_action('wp_ajax_nopriv_customizer_site_title', array($this,'ajax_site_title'));			

			// write CSS customisations to live site
			add_action( 'wp_head' , array( $this , 'header_output' ), 55 );
		}
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function customize_preview_js() {			
			
			wp_enqueue_script( 'lsx_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ) , wp_get_theme()->Version, true );
			wp_localize_script( 'lsx_customizer', 'lsx_customizer_params', array(
			'template_directory' => get_template_directory_uri()
			) );
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
			
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
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
			
			// add css live setting for output
			if( !empty( $args['css'] ) ){
				unset( $args['css'] );
			}

			$wp_customize->add_setting( $slug, //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
				array_merge( array(
					'default' 			=> null, //Default setting/value to save
					'type' 				=> 'theme_mod', //Is this an 'option' or a 'theme_mod'?
					'capability'		=> 'edit_theme_options', //Optional. Special permissions for accessing this setting.
					'transport' 		=> 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
					'sanitize_callback'	=> 'lsx_sanitize_choices'
				), $args )
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
		
		/**
		* This will generate a line of CSS for use in header output. If the setting
		* ($mod_name) has no defined value, the CSS will not be output.
		* 
		* @uses get_theme_mod()
		* @param string $selector CSS selector
		* @param string $style The name of the CSS *property* to modify
		* @param string $mod_name The name of the 'theme_mod' option to fetch
		* @param string $prefix Optional. Anything that needs to be output before the CSS property
		* @param string $postfix Optional. Anything that needs to be output after the CSS property
		* @param bool $echo Optional. Whether to print directly to the page (default: true).
		* @return string Returns a single line of CSS with selectors and a property.
		* @since 1.0.0
		*/
		public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
			$return = '';
			$mod = get_theme_mod($mod_name);
			if ( ! empty( $mod ) ) {
				
				$return = sprintf('%s { %s:%s; }',
					$selector,
					$style,
					$prefix.$mod.$postfix
				);
				
				if ( $echo ) {
					echo $return;
				}
			}
			return $return;
		}		

		/**
		* This will output the custom WordPress settings to the live theme's WP head.
		* 
		* Used by hook: 'wp_head'
		* 
		* @see add_action('wp_head',$func)
		* @since 1.0.0
		*/
		public function header_output() {

			if( empty( $this->controls['settings'] ) ){
				return;
			}
			foreach( $this->controls['settings'] as $setting_slug=>$args){
				if( empty( $args['css'] ) || !is_array( $args['css'] ) ){
					continue;
				}
				if( empty( $args['css']['selector'] ) || empty( $args['css']['style_name'] ) ){
					continue;
				}

				$this->css[$setting_slug] = $args['css'];
			}
		?>
		<!--Customizer CSS--> 
		<style type="text/css">
			<?php 
			foreach( $this->css as $slug=>$args ){
				// needs selector and style, else skip
				$defaults = array(
					'prefix'      =>  null,
					'postfix'     =>  null,
				);
				$args = array_merge( $defaults, $args );
				self::generate_css( $args['selector'], $args['style_name'], $slug, $args['prefix'], $args['postfix']);
			}
			?>
		</style> 
		<!--/Customizer CSS-->
		<?php

		}

		public static function get_slider_post_type_choices() {
		
			/* Set an array. */
			$data = array(
					'0' => __( 'Disable', 'lsx' )
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
		
		/**
		 * Returns the site title via ajax
		 */
		public function ajax_site_title() {
			lsx_site_identity();
		}
		
		/**
		 * Returns a registered field
		 */
		public function get_control($id) {
			$field = $this->controls['fields'][$id];
			return $field;
		}

		/**
		 * Returns a registered setting
		 */
		public function get_setting($id) {
			$setting = $this->controls['fields'][$id];
			return $setting;
		}		
		
	}	
}