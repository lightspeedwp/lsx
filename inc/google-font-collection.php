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
	 * getFontFamilyNameArray Function
	 * this function returns an array containing all of the font family names
	**/
	function getFontFamilyNameArray()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[] = $value->__get("title");
		}
		return $result;
	}

	/**
	 * getTitle
	 * this function returns the font title
	**/
	function getTitle($key)
	{
		return $this->fonts[$key]->__get("title");
	}

	/**
	 * getLocation
	 * this function returns the font location
	**/
	function getLocation($key)
	{
		return $this->fonts[$key]->__get("location");
	}

	/**
	 * getCssDeclaration
	 * this function returns the font css declaration
	**/
	function getCssDeclaration($key)
	{
		return $this->fonts[$key]->__get("cssDeclaration");
	}


	/**
	 * getCssClassArray
	 * this function returns an array of css classes
	 * this function is used when displaying the fancy list of fonts in the theme customizer
	 * this function is used to send a JS file an array for the postMessage transport option in the theme customizer
	**/
	function getCssClassArray()
	{
		$result;
		foreach ($this->fonts as $key => $value) 
		{
			$result[$value->__get("title")] = $value->__get("cssClass");
		}
		return $result;
	}

	/**
	 * getTotalNumberOfFonts
	 * this function returns the total number of fonts
	**/
	function getTotalNumberOfFonts()
	{
		return count($this->fonts);
	}

	/**
	 * printThemeCustomizerCssLocations
	 * this function prints the links to the css files for the theme customizer
	**/
	function printThemeCustomizerCssLocations()
	{
		foreach ($this->fonts as $key => $value) 
		{
			$protocol = 'http';
			if(is_ssl()){ $protocol.='s'; }
			?>
			<link href="<?php echo $protocol; ?>://fonts.googleapis.com/css?family=<?php echo $value->__get("location"); ?>" rel='stylesheet' type='text/css'>
			<?php
		}
	}

	/**
	 * printThemeCustomizerCssClasses
	 * this function prints the theme customizer css classes necessary to display all of the fonts
	**/
	function printThemeCustomizerCssClasses()
	{
		?>
		<style type="text/css">
			<?php
			foreach ($this->fonts as $key => $value) 
			{
				?>
				.<?php echo $value->__get("cssClass")?>{
					font-family: <?php echo $value->__get("cssDeclaration"); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php 
	}

} // Font_Collection