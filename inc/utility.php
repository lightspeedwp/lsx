<?php
/**
 * Utility functions
 */
function add_filters($tags, $function) {
	foreach ($tags as $tag) {
		add_filter($tag, $function);
	}
}

function is_element_empty($element) {
	$element = trim($element);
	return empty($element)?false:true;
}

if (!function_exists('get_attachment_id')) {
	/**
	 * Get the Attachment ID for a given image URL.
	 *
	 * @link   http://wordpress.stackexchange.com/a/7094
	 *
	 * @param  string $url
	 *
	 * @return boolean|integer
	 */
	function get_attachment_id($url) {

		$dir = wp_upload_dir();

		// baseurl never has a trailing slash
		if (false === strpos($url, $dir['baseurl'].'/')) {
			// URL points to a place outside of upload directory
			return false;
		}

		$file  = basename($url);
		$query = array(
			'post_type'  => 'attachment',
			'fields'     => 'ids',
			'meta_query' => array(
				array(
					'value'   => $file,
					'compare' => 'LIKE',
				),
			)
		);

		$query['meta_query'][0]['key'] = '_wp_attached_file';

		// query attachments
		$ids = get_posts($query);

		if (!empty($ids)) {

			foreach ($ids as $id) {

				// first entry of returned array is the URL
				$temp_url = wp_get_attachment_image_src($id, 'full');
				if ($url === array_shift($temp_url)) {
					return $id;
				}
			}
		}

		$query['meta_query'][0]['key'] = '_wp_attachment_metadata';

		// query attachments again
		$ids = get_posts($query);

		if (empty($ids)) {
			return false;
		}

		foreach ($ids as $id) {

			$meta = wp_get_attachment_metadata($id);

			foreach ($meta['sizes'] as $size => $values) {

				if ($values['file'] === $file && $url === array_shift(wp_get_attachment_image_src($id, $size))) {
					return $id;
				}
			}
		}

		return false;
	}
}

function get_avatar_url($author_id, $size) {
	$get_avatar = get_avatar($author_id, $size);
	preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	return ($matches[1]);
}