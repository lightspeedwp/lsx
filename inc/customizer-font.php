<?php
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
		wp_register_style( 'font-picker-custom-control', get_template_directory_uri() .'/css/customizer-font.css');
		wp_enqueue_style( 'font-picker-custom-control' );
	
		// scripts
		wp_register_script( 'font-picker-custom-control', get_template_directory_uri() .'/js/customizer-font.js');
		wp_enqueue_script( 'font-picker-custom-control' );
	}

	/**
	 * Render the content on the theme customizer page
	**/
	public function render_content(){
		if ( empty( $this->choices ) ){
			// if there are no choices then don't print anything
			return;
		}
		$this->fonts = new Google_Font_Collection( $this->choices );

		$this->choices = $this->fonts->getFontFamilyNameArray();
		//print links to css files
		$this->fonts->printThemeCustomizerCssLocations();

		//print css to display individual fonts
		$this->fonts->printThemeCustomizerCssClasses();
		
		$set_value = $this->value();

		?>
		<div class="fontPickerCustomControl">
			<select <?php $this->link(); ?>>
				<?php
				foreach ( $this->choices as $value => $label ){
					echo '<option value="' . esc_attr( $label ) . '">' . $label . '</option>';
				}
				?>
			</select>
			<div class="fancyDisplay">
				<ul>
					<?php
					$cssClassArray = $this->fonts->getCssClassArray();
					foreach ($cssClassArray as $key => $font){
						$class = null;
						if( $key == $set_value ){
							$class = ' selected';
						}
						
						?>
						<li class="font-choice <?php echo $font.$class; ?>"><?php echo $key; ?></li>
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