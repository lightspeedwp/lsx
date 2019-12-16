<?php
/**
 * LSX functions and definitions - Comment Walker.
 *
 * @package    lsx
 * @subpackage comment
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Walker_Comment' ) ) {
	return;
}

if ( ! class_exists( 'LSX_Walker_Comment' ) ) :

	/**
	 * Use Bootstrap's media object for listing comments.
	 *
	 * @link http://getbootstrap.com/components/#media
	 *
	 * @package    lsx
	 * @subpackage comment
	 */
	class LSX_Walker_Comment extends Walker_Comment {

		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1; ?>
			<ul <?php comment_class( 'media media-reply unstyled list-unstyled comment-' . get_comment_ID() ); ?>>
			<?php
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			echo '</ul>';
		}

		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			++$depth;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment']       = $comment;

			if ( ! empty( $args['callback'] ) ) {
				call_user_func( $args['callback'], $comment, $args, $depth );
				return;
			}
			?>

			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media comment-' . get_comment_ID() ); ?>>
			<?php get_template_part( 'comment' ); ?>
			<?php
		}

		function end_el( &$output, $comment, $depth = 0, $args = array() ) {
			if ( ! empty( $args['end-callback'] ) ) {
				call_user_func( $args['end-callback'], $comment, $args, $depth );
				return;
			}

			echo "</div></li>\n";
		}

	}

endif;
