<?php
/**
 * LSX: Block Patterns
 *
 * @since LSX 1.0
 */

/**
 * Registers our block variations.
 *
 * @return void
 */
function lsx_editor_assets() {
	wp_enqueue_script(
		'lsx-block-variations',
		get_template_directory_uri() . '/blocks/build/related-posts/index.js',
		array( 'wp-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'lsx_editor_assets' );



add_filter( 'pre_render_block', 'lsx_pre_render_block', 10, 2 );

function lsx_pre_render_block( $pre_render, $parsed_block ) {
    // Determine if this is the custom block variation.
    if ( 'lsx/lsx-related-posts' === $parsed_block['attrs']['namespace'] ) {

        add_filter(
            'query_loop_block_query_vars',
            function( $query, $block ) use ( $parsed_block ) {

                // Add rating meta key/value pair if queried.
                if ( 'lsx/lsx-related-posts' === $parsed_block['attrs']['namespace'] ) {

					$group     = array();
					$terms     = get_the_terms( get_the_ID(), 'category' );
			
					if ( is_array( $terms ) && ! empty( $terms ) ) {
						foreach( $terms as $term ) {
							$group[] = $term->term_id;
						}
					}
					$query['tax_query'] = array(
						array(
							'taxonomy' => 'category',
							'field'    => 'term_id',
							'terms'     => $group,
						)
					);
					$query['orderby']        = 'rand';
					$query['post__not_in']   = array( get_the_ID() );
                }
                return $query;
            },
            10,
            2
        );
    }

    return $pre_render;
}


/**
 * Register the meta fields with REST.
 *
 * @return void
 */
function meta_fields_register_meta() {

    $metafields = [ 'price' ];

    foreach( $metafields as $metafield ){
        // Pass an empty string to register the meta key across all existing post types.
        register_post_meta( '', $metafield, array(
            'show_in_rest' => true,
            'type' => 'string',
            'single' => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback' => function() { 
                return current_user_can( 'edit_posts' );
            }
        ));
    } 
}
add_action( 'init', 'meta_fields_register_meta', 100 );
