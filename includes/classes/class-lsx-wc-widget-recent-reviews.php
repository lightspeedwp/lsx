<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Recent Reviews Widget.
 *
 * @author   WooThemes
 * @category Widgets
 * @package  WooCommerce/Widgets
 * @version  2.3.0
 * @extends  WC_Widget
 */
class LSX_WC_Widget_Recent_Reviews extends WC_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_recent_reviews';
		$this->widget_description = __( 'Display a list of your most recent reviews on your site.', 'lsx' );
		$this->widget_id          = 'woocommerce_recent_reviews';
		$this->widget_name        = __( 'WooCommerce recent reviews', 'lsx' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Recent reviews', 'lsx' ),
				'label' => __( 'Title', 'lsx' ),
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 10,
				'label' => __( 'Number of reviews to show', 'lsx' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) ) {
			return;
		}
		ob_start();
		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$comments = get_comments(
			array(
				'number'      => $number,
				'status'      => 'approve',
				'post_status' => 'publish',
				'post_type'   => 'product',
				'parent'      => 0,
			)
		);

		if ( $comments ) {
			$this->widget_start( $args, $instance );

			echo wp_kses_post( apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_list_widget">' ) );

			global $stored_comment, $_product, $rating;

			the_comment();
			foreach ( (array) $comments as $comment ) {
				$_product = wc_get_product( $comment->comment_post_ID );
				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
				$stored_comment = $comment;

				wc_get_template( 'content-widget-review.php' );
			}

			echo wp_kses_post( apply_filters( 'woocommerce_after_widget_product_list', '</ul>' ) );

			$this->widget_end( $args );
		}
		$content = ob_get_clean();
		echo wp_kses_post( $content );
		$this->cache_widget( $args, $content );
	}
}
