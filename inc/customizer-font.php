<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * LSX_Customize_Font_Control Class
**/
if( !class_exists( 'WP_Customize_Control' ) ){
	return;
}
class LSX_Customize_Font_Control extends WP_Customize_Control{
	public $fonts;

	/**
	 * Enqueue the styles and scripts
	**/
	public function enqueue(){
		// styles
		wp_enqueue_style( 'lsx-font-picker-custom-control', get_template_directory_uri() .'/css/customizer-font.css');
			
		// scripts
		wp_enqueue_script( 'lsx-font-picker-custom-control', get_template_directory_uri() .'/js/customizer-font.js');
	}

	/**
	 * Render the content on the theme customizer page
	**/
	public function render_content(){
		if ( empty( $this->choices ) ){
			// if there are no choices then don't print anything
			return;
		}
		$fonts = array();
		foreach( $this->choices as $slug=>$font ){
			$fonts[] = $font['header'];
			$fonts[] = $font['body'];
			$this->choices[$slug] = $font;
		}
		
		$this->fonts = new LSX_Google_Font_Collection( $fonts );

		$fonts = $this->fonts->get_font_family_name_array();
		//print links to css files
		$this->fonts->print_theme_customizer_css_locations();

		//print css to display individual fonts
		$this->fonts->print_theme_customizer_css_classes();
		
		$set_value = $this->value();

		?>
		<div class="fontPickerCustomControl">
			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $conf ){
					echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $value ) . '</option>';
				}
				?>
			</select>
			<div class="fancyDisplay">
				<ul>
					<?php
					//$cssClassArray = $this->fonts->get_css_class_array();
					foreach ($this->choices as $key => $font){
						$class = null;
						if( $key == $set_value ){
							$class = ' selected';
						}
						
						?>
						<li class="font-choice <?php echo esc_attr( $class ); ?>">
							<div class="<?php echo esc_attr( $font['header']['cssClass'] ); ?>"><?php echo esc_html( $font['header']['title'] ); ?></div>
							<small class="<?php echo esc_attr( $font['body']['cssClass'] ); ?>"><?php echo esc_html( $font['body']['title'] ); ?></small>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
		<script>
		jQuery(document).ready(function($) {
			$(".fontPickerCustomControl").fontPickerCustomControl();
		});
		</script>
		<?php
	}
}
?>