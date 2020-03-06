<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * @package lsx
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'lsx' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php esc_html_e( 'Ready to publish your first post?', 'lsx' ); ?> <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>"><?php esc_html_e( 'Get started here', 'lsx' ); ?></a></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Your search for "', 'lsx' ); ?><?php echo get_search_query(); ?><?php esc_html_e( '" didn’t return any results… ', 'lsx' ); ?><br><?php esc_html_e( 'Please try another keyword', 'lsx' ); ?></p>

			<?php echo wp_kses_post( apply_filters( 'lsx_404_search_form', get_search_form() ) ); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lsx' ); ?></p>
			<?php echo wp_kses_post( apply_filters( 'lsx_404_search_form', get_search_form() ) ); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
