<?php
/**
 * Advanced Mobile Pages Functionality
 *
 * @package lsx
 * @subpackage buddypress
 */

/**
 * Loads the Advanced Mobile Pages Functionality
 * 
 * @package lsx
 * @subpackage amp
 * @category setup
 */

function lsx_amp_init() {
    add_post_type_support( 'jetpack-portfolio', AMP_QUERY_VAR );
    add_post_type_support( 'pages', AMP_QUERY_VAR );
    add_post_type_support( 'product', AMP_QUERY_VAR );
}
add_action( 'amp_init', 'lsx_amp_init' );


/**
 * Loads the Advanced Mobile Pages Functionality
 * 
 * @package lsx
 * @subpackage amp
 * @category template
 */
function lxs_amp_custom_template( $file, $type, $post ) {
    if ( 'single' === $type) {
        $file = get_template_directory() . '/mobile-templates/single-'.$post->post_type.'.php';
    }
    return $file;
}
add_filter( 'amp_post_template_file', 'lxs_amp_custom_template', 10, 3 );

/**
 * @package     YoastSEO_AMP_Glue
 * @author      Joost de Valk
 * @copyright   2016 Yoast BV
 * @license     GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Glue for Yoast SEO & AMP
 * Plugin URI:  https://yoast.com/yoast-seo-amp-glue/
 * Description: Makes sure the default WordPress AMP plugin uses the proper Yoast SEO metadata
 * Version:     0.1
 * Author:      Joost de Valk
 * Author URI:  https://yoast.com
 */
/**
 * Defines the YoastSEO AMP class. In a wrapper function so we can overwrite this from within Yoast SEO later on.
 */
if ( ! class_exists( 'YoastSEO_AMP' ) ) {
	/**
	 * This class improves upon the AMP output by the default WordPress AMP plugin using Yoast SEO metadata.
	 */
	class YoastSEO_AMP {
		/**
		 * @var WPSEO_Frontend
		 */
		private $front;
		/**
		 * @var array
		 */
		private $options;
		/**
		 * YoastSEO_AMP constructor.
		 */
		public function __construct() {
			$this->front   = WPSEO_Frontend::get_instance();
			$this->options = WPSEO_Options::get_all();
			add_filter( 'amp_post_template_data', array( $this, 'fix_amp_post_data' ), 10, 2 );
			add_filter( 'amp_post_template_metadata', array( $this, 'fix_amp_post_metadata' ), 10, 2 );
		}
		/**
		 * Fix the basic AMP post data
		 *
		 * @param array $data
		 * @param object $post
		 *
		 * @return array
		 */
		public function fix_amp_post_data( $data, $post ) {
			$data['canonical_url'] = $this->front->canonical( false );
			return $data;
		}
		/**
		 * Fix the AMP metadata for a post
		 *
		 * @param array $metadata
		 * @param object $post
		 *
		 * @return array
		 */
		public function fix_amp_post_metadata( $metadata, $post ) {
			$this->build_organization_object( $metadata );
			$desc = $this->front->metadesc( false );
			if ( $desc ) {
				$metadata['description'] = $desc;
			}
			$og_img = $this->get_image_object( WPSEO_Meta::get_value( 'opengraph-image', $post->ID ) );
			if ( is_array( $og_img ) ) {
				$metadata['image'] = $og_img;
			}
			return $metadata;
		}
		/**
		 * Builds the organization object if needed.
		 *
		 * @param array $metadata
		 */
		private function build_organization_object( &$metadata ) {
			// While it's using the blog name, it's actually outputting the company name
			if ( ! empty( $this->options['company_name'] ) ) {
				$metadata['publisher']['name'] = $this->options['company_name'];
			}
			// The logo needs to be 600px wide max, 60px high max
			$logo = $this->get_image_object( $this->options['company_logo'], array( 600, 60 ) );
			if ( is_array( $logo ) ) {
				$metadata['publisher']['logo'] = $logo;
			}
		}
		/**
		 * Builds an image object array from an image URL
		 *
		 * @param string $image_url
		 * @param string|array $size Optional. Image size. Accepts any valid image size, or an array of width
		 *                                    and height values in pixels (in that order). Default 'full'.
		 *
		 * @return bool|array
		 */
		private function get_image_object( $image_url, $size = 'full' ) {
			if ( empty( $image_url ) ) {
				return false;
			}
			$image_id  = attachment_url_to_postid( $image_url );
			$image_src = wp_get_attachment_image_src( $image_id, $size );
			if ( is_array( $image_src ) ) {
				return array(
					'@type'  => 'ImageObject',
					'url'    => $image_src[0],
					'width'  => $image_src[1],
					'height' => $image_src[2]
				);
			}
			return false;
		}
	}
}
/**
 * Initialize the Yoast SEO AMP Glue plugin
 */
function lsx_yoast_seo_amp_glue_init() {
	if ( class_exists( 'WPSEO_Frontend' ) ) {
		new YoastSEO_AMP();
	}
}
add_action( 'init', 'lsx_yoast_seo_amp_glue_init', 12 );

/**
 * Load custom CSS
 */
function lsx_add_amp_css() { 
	?>
		<link href="<?php echo get_stylesheet_directory_uri(); ?>/css/amp.css" rel="stylesheet" type="text/css">
	<?php
}
add_action( 'amp_post_template_head', 'lsx_add_amp_css');