<?php
/**
 * Template used to display widget review.
 *
 * @package lsx
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $comment, $stored_comment, $_product, $rating;
$the_comment = $comment;
if ( null !== $stored_comment ) {
	$the_comment = $stored_comment;
}
?>
<div class="lsx-woocommerce-review-slot">
	<div class="lsx-woocommerce-review-flex">
		<a href="<?php echo esc_url( get_comment_link( $the_comment->comment_ID ) ); ?>">
			<figure class="lsx-woocommerce-avatar">
				<?php echo wp_kses_post( $_product->get_image( 'lsx-thumbnail-square' ) ); ?>
			</figure>
		</a>

		<div class="lsx-woocommerce-review-box">
			<div class="lsx-woocommerce-rating">
				<?php echo wp_kses_post( wc_get_rating_html( $rating ) ); ?>
			</div>

			<h5 class="lsx-woocommerce-title">
				<a href="<?php echo esc_url( get_comment_link( $the_comment->comment_ID ) ); ?>"><?php echo wp_kses_post( $_product->get_name() ); ?></a>
			</h5>

			<p class="lsx-woocommerce-reviewer">
				<?php
					/* translators: %s: review author */
					echo wp_kses_post( esc_html__( 'by ', 'lsx' ) . get_comment_author( $the_comment->comment_ID ) );
				?>
			</p>

			<div class="lsx-woocommerce-content">
				<p><?php echo wp_kses_post( $the_comment->comment_content ); ?></p>
				<p><a href="<?php echo esc_url( get_comment_link( $the_comment->comment_ID ) ); ?>" class="moretag"><?php esc_html_e( 'View more', 'lsx' ); ?></a></p>
			</div>
		</div>
	</div>
</div>
