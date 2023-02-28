<?php
namespace LSX\Classes;

/**
 * All the functions that run on the frontend and the rendering of the blocks.
 *
 * @package   LSX
 * @author    LightSpeed
 * @license   GPL3
 * @link
 * @copyright 2023 LightSpeed
 */
class Block_Functions {

	/**
	 * Contructor
	 */
	public function __construct() {
	}

	/**
	 * Initiate our class.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'pre_render_block', array( $this, 'pre_render_block' ), 10, 2 );
	}

	/**
	 * A function to detect variation, and alter the query args.
	 * 
	 * Following the https://developer.wordpress.org/news/2022/12/building-a-book-review-grid-with-a-query-loop-block-variation/
	 *
	 * @param string|null   $pre_render   The pre-rendered content. Default null.
	 * @param array         $parsed_block The block being rendered.
	 * @param WP_Block|null $parent_block If this is a nested block, a reference to the parent block.
	 */
	public function pre_render_block( $pre_render, $parsed_block ) {
		// Determine if this is the custom block variation.
		if ( isset( $parsed_block['attrs']['namespace'] ) && 'lsx/lsx-related-posts' === $parsed_block['attrs']['namespace'] ) {
	
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
}
