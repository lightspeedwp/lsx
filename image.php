<?php
/**
 * The template for displaying image attachments.
 *
 * @package LSX Theme
 */
global $content_width;
get_header();
?>
 
	<div id="primary" class="content-area <?php echo lsx_main_class(); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>
 
            <?php while ( have_posts() ) : the_post(); ?>
 
 				<?php lsx_entry_before(); ?>
 				
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                	<?php lsx_entry_top(); ?>
                
                    <header class="entry-header">
                        <h1 class="entry-title"><?php the_title(); ?></h1>
 
                        <div class="entry-meta">
                            <?php
                                $metadata = wp_get_attachment_metadata();
                                printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%7$s</a>', 'lsx' ),
                                    esc_attr( get_the_date( 'c' ) ),
                                    esc_html( get_the_date() ),
                                    wp_get_attachment_url(),
                                    $metadata['width'],
                                    $metadata['height'],
                                    get_permalink( $post->post_parent ),
                                    get_the_title( $post->post_parent )
                                );
                            ?>
                            <?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="sep"> | </span> <span class="edit-link">', '</span>' ); ?>
                        </div><!-- .entry-meta -->
 
                        <nav id="image-navigation" class="site-navigation">
                            <span class="previous-image"><?php previous_image_link( false, '&larr; '.__( 'Previous', 'lsx' ) ); ?></span>
                            <span class="next-image"><?php next_image_link( false, __( 'Next', 'lsx' ).' &rarr;' ); ?></span>
                        </nav><!-- #image-navigation -->
                    </header><!-- .entry-header -->
 
                    <div class="entry-content">
 
                        <div class="entry-attachment">
                            <div class="attachment">
                                <?php
                                    /**
                                     * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
                                     * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
                                     */
                                    $attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
                                    foreach ( $attachments as $k => $attachment ) {
                                        if ( $attachment->ID == $post->ID )
                                            break;
                                    }
                                    $k++;
                                    // If there is more than 1 attachment in a gallery
                                    if ( count( $attachments ) > 1 ) {
                                        if ( isset( $attachments[ $k ] ) )
                                            // get the URL of the next image attachment
                                            $next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
                                        else
                                            // or get the URL of the first image attachment
                                            $next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
                                    } else {
                                        // or, if there's only 1 image, get the URL of the image
                                        $next_attachment_url = wp_get_attachment_url();
                                    }
                                ?>
 
                                <a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                                    $attachment_size = apply_filters( 'shape_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
                                    echo wp_get_attachment_image( $post->ID, $attachment_size );
                                ?></a>
                            </div><!-- .attachment -->
 
                            <?php if ( ! empty( $post->post_excerpt ) ) : ?>
                            <div class="entry-caption">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-caption -->
                            <?php endif; ?>
                        </div><!-- .entry-attachment -->
 
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'lsx' ), 'after' => '</div>' ) ); ?>
 
                    </div><!-- .entry-content -->
                    
					<footer class="entry-meta">
						
						<?php if ( ! is_single() ) : ?>
							<a class="read-more" href="<?php the_permalink(); ?>">Read More</a>
						<?php endif ?>
				
						<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
						<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'lsx' ), __( '1 Comment', 'lsx' ), __( '% Comments', 'lsx' ) ); ?></span>
						<?php endif; ?>			
				
						<?php edit_post_link( __( 'Edit', 'lsx' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->                    
 
 				<?php lsx_entry_bottom(); ?>
 				
                </article><!-- #post-<?php the_ID(); ?> -->
 
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>	
				
				<?php lsx_entry_after(); ?>
 
            <?php endwhile; // end of the loop. ?>
 
		</main><!-- #main -->

		<?php lsx_content_after(); ?>
		
	</div><!-- #primary -->

<?php get_sidebar(); ?>

<?php get_footer();