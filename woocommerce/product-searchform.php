<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="search-form form-inline" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php esc_attr_e( 'Search', 'lsx' ); ?> <?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<label class="hide"><?php esc_attr_e( 'Search for:', 'lsx' ); ?></label>

		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-default"><span class="fa fa-search"></span></button>
		</span>
	</div>

	<input type="hidden" name="post_type" value="product" />
</form>
