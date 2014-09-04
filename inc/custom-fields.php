<?php
if ( ! class_exists('CMB_Meta_Box'))
	require_once( get_template_directory() . '/inc/Custom-Meta-Boxes/custom-meta-boxes.php' );

add_filter( 'cmb_meta_boxes', 'lsx_field_setup' );

function lsx_field_setup( $meta_boxes ) {
	    $prefix = 'lsx_'; // Prefix for all fields

	    $imagepath =  get_template_directory_uri() . '/assets/img/';

	    $banner_fields = array(
	    	array(
	            'name' => 'Banner Heading',
	            'desc' => 'Enter a heading to display in the banner, or leave blank to use the page title.',
	            'id' => $prefix . 'heading',
	            'type' => 'text'
	        ),
	        array(
	            'name' => 'Banner Tagline',
	            'desc' => 'Enter a tagline to display in the banner.',
	            'id' => $prefix . 'tagline',
	            'type' => 'text'
	        ),
	        array(
	            'name' => 'Banner Image',
	            'desc' => 'Choose a background image for the banner.',
	            'id' => $prefix . 'banner_image',
	            'type' => 'image'
	        ),	        
	    );

		$layout_fields = array(	    	
	        array( 
	            'id'      => $prefix . 'layout', 
	            'name'    => 'Layout', 
	            'type'    => 'radio',
	            'default' => 'default',
	            'options' => array(
	            	'default' => 'Default',
	                '1col' => 'One Column',
					'2c-l' => 'Two Column Left',
					'2c-r' => 'Two Column Right',
					'3c-,' => 'Three Column',
					'3c-l' => 'Three Column Left',
					'3c-r' => 'Three Column Right'
	            )
	        )       
	    );

	    $meta_boxes[] = array(
			'title' => 'Banner Options',
			'pages' => array( 'post', 'page' ),
			'fields' => $banner_fields
		);

		$meta_boxes[] = array(
			'title' => 'Layout Options',
			'pages' => array( 'post', 'page' ),
			'fields' => $layout_fields
		);

		return $meta_boxes;
	}
	

function lsx_field_types($array){
	$array['numeric'] = 'LSX_HTML5_Field';
	return $array;
}	

/**
 * Standard numeric field.
 *
 * @extends CMB_Field
 */
class LSX_HTML5_Field extends CMB_Field {

	public function html() { print_r($this); ?>

		<input type="text" <?php $this->id_attr(); ?> <?php $this->boolean_attr(); ?> <?php $this->class_attr(); ?> <?php $this->name_attr(); ?> value="<?php echo esc_attr( $this->get_value() ); ?>" />

	<?php }
}