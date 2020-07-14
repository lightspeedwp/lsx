<?php
/**
 * The template for displaying search forms in LSX.
 *
 * @package lsx
 */

$style = 'body #searchform { display: block; }';

if ( is_customize_preview() ) {
	$search_form = get_theme_mod( 'lsx_header_search', false );

	if ( false === $search_form ) {
		$style = 'body #searchform { display: none; }';
	}
}
?>

<form role="search" method="get" class="search-form form-inline" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" value="<?php if ( is_search() ) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php esc_attr_e( 'Search', 'lsx' ); ?> <?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		<label class="hide"><?php esc_html_e( 'Search for:', 'lsx' ); ?></label>

		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-default"><span class="fa fa-search"></span></button>
		</span>
	</div>

	<?php if ( is_customize_preview() ) : ?>
		<style id="lsx-header-search-css">
			<?php echo esc_attr( $style ); ?>
		</style>
	<?php endif; ?>
</form>
