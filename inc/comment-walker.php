<?php
if ( ! defined( 'ABSPATH' ) ) return; // Exit if accessed directly

/**
 * lsx Comment Walker
 *
 * @package lsx
 */

/**
 * Use Bootstrap's media object for listing comments
 *
 * @link http://getbootstrap.com/components/#media
 */
class LSX_Walker_Comment extends Walker_Comment {
  function start_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1; ?>
    <ul <?php comment_class('media unstyled comment-' . get_comment_ID()); ?>>
    <?php
  }

  function end_lvl(&$output, $depth = 0, $args = array()) {
    $GLOBALS['comment_depth'] = $depth + 1;
    echo '</ul>';
  }

  function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;

    if (!empty($args['callback'])) {
      call_user_func($args['callback'], $comment, $args, $depth);
      return;
    }

    extract($args, EXTR_SKIP);?>

  	<li id="comment-<?php comment_ID(); ?>" <?php comment_class('media comment-' . get_comment_ID()); ?>>
    <?php get_template_part('comment'); ?>
  <?php
  }

  function end_el(&$output, $comment, $depth = 0, $args = array()) {
    if (!empty($args['end-callback'])) {
      call_user_func($args['end-callback'], $comment, $args, $depth);
      return;
    }
    echo "</div></li>\n";
  }
  
}

function lsx_get_avatar($avatar) {
  $avatar = str_replace("class='avatar", "class='avatar pull-left media-object ", $avatar);
  return $avatar;
}
add_filter('get_avatar', 'lsx_get_avatar');

/**
 * Comment Form Field Filter
 *
 * @package lsx-theme
 * @subpackage layout
 */
function lsx_comment_form_fields_filter($fields) {	
	foreach($fields as &$field){
		if(stristr('class=', $field)){
			$field = str_replace('class="', 'class="form-control ', $field);
		}else{
			$field = str_replace('<input', '<input class="form-control" ', $field);
		}
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'lsx_comment_form_fields_filter');
