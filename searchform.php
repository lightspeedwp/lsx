<?php
/**
 * The template for displaying search forms in lsx
 *
 * @package lsx
 */
?>
<form role="search" method="get" class="search-form form-inline" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="input-group">
		<input type="search" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" class="search-field form-control" placeholder="<?php esc_attr_e('Search', 'lsx'); ?> <?php esc_attr_e(get_bloginfo('name')); ?>">
		<label class="hide"><?php _e('Search for:', 'lsx'); ?></label>
		<span class="input-group-btn">
			<button type="submit" class="search-submit btn btn-default"><?php _e('Search', 'lsx'); ?></button>
		</span>
	</div>
</form>
