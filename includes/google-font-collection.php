<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly
/**
 * Google Font_Collection Class
**/
// this file controls all of the data for the custom fonts used in the theme customizer

// the Google_Font_Collection object is a wrapper that holds all of the individual custom fonts
class LSX_Google_Font_Collection
{
	private $fonts;

	/**
	 * Constructor
	**/
	public function __construct($fonts)
	{
		if(empty($fonts))
		{
			//we didn't get the required data
			return false;
		}

		// create fonts
		foreach ($fonts as $key => $value) 
		{	
			if( empty( $value["system"] ) ){
				$this->fonts[$value["title"]] = new LSX_Google_Font($value["title"], $value["location"], $value["cssDeclaration"], $value["cssClass"]);
			}
		}
	}

	/**
	 * get_font_family_name_array Function
	 * this function returns an array containing all of the font family names
	**/
	function get_font_family_name_array()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[] = $value->__get("title");
		}
		return $result;
	}

	/**
	 * get_title
	 * this function returns the font title
	**/
	function get_title($key)
	{
		return $this->fonts[$key]->__get("title");
	}

	/**
	 * get_location
	 * this function returns the font location
	**/
	function get_location($key)
	{
		return $this->fonts[$key]->__get("location");
	}

	/**
	 * get_css_declaration
	 * this function returns the font css declaration
	**/
	function get_css_declaration($key)
	{
		return $this->fonts[$key]->__get("cssDeclaration");
	}


	/**
	 * get_css_class_array
	 * this function returns an array of css classes
	 * this function is used when displaying the fancy list of fonts in the theme customizer
	 * this function is used to send a JS file an array for the postMessage transport option in the theme customizer
	**/
	function get_css_class_array()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[$value->__get("title")] = $value->__get("cssClass");
		}
		return $result;
	}

	/**
	 * get_total_number_of_fonts
	 * this function returns the total number of fonts
	**/
	function get_total_number_of_fonts()
	{
		return count($this->fonts);
	}

	/**
	 * print_theme_customizer_css_locations
	 * this function prints the links to the css files for the theme customizer
	**/
	function print_theme_customizer_css_locations()
	{
		foreach ($this->fonts as $key => $value) 
		{
			$protocol = 'http';
			if(is_ssl()){ $protocol.='s'; }
			?>
			<link href="<?php echo esc_attr( $protocol ); ?>://fonts.googleapis.com/css?family=<?php echo esc_attr( $value->__get( "location" ) ); ?>" rel='stylesheet'>
			<?php
		}
	}

	/**
	 * print_theme_customizer_css_classes
	 * this function prints the theme customizer css classes necessary to display all of the fonts
	**/
	function print_theme_customizer_css_classes()
	{
		?>
		<style type="text/css">
			<?php
			foreach ($this->fonts as $key => $value) 
			{
				?>
				.<?php echo esc_attr( $value->__get( "cssClass" ) ); ?>{
					font-family: <?php echo esc_attr( $value->__get( "cssDeclaration" ) ); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php 
	}

} // Font_Collection