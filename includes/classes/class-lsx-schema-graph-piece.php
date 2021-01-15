<?php
/**
 * Schema for LSX
 *
 * @package lsx
 */
/**
 * Returns schema Review data.
 *
 * @since 10.2
 */
use \Yoast\WP\SEO\Generators\Schema\Abstract_Schema_Piece;

if ( class_exists( 'Abstract_Schema_Piece' ) ) {
	class LSX_Schema_Graph_Piece extends Abstract_Schema_Piece {
		/**
		 * A value object with context variables.
		 *
		 * @var \WPSEO_Schema_Context
		 */
		public $context;
		/**
		 * This is the post type that you want the piece to output for.
		 *
		 * @var string;
		 */
		public $post_type;
		/**
		 * If this is a top level parent
		 *
		 * @var boolean
		 */
		public $is_top_level;
		/**
		 * This holds the meta_key => scehma_type of the fields you want to add to your subtrip.
		 *
		 * @var array()
		 */
		public $place_ids;
		/**
		 * This holds an object or the current trip post.
		 *
		 * @var WP_Post();
		 */
		public $post;
		/**
		 * This holds URL for the trip
		 *
		 * @var string
		 */
		public $post_url;
		/**
		 * Constructor.
		 *
		 * @param \WPSEO_Schema_Context $context A value object with context variables.
		 */
		public function __construct( WPSEO_Schema_Context $context ) {
			$this->context      = $context;
			$this->place_ids    = array();
			$this->post         = get_post( $this->context->id );
			$this->post_url     = get_permalink( $this->context->id );
			$this->is_top_level = false;
			if ( is_object( $this->post ) && isset( $this->post->post_parent ) && ( false === $this->post->post_parent || 0 === $this->post->post_parent || '' === $this->post->post_parent ) ) {
				$this->is_top_level = true;
			}
		}
		/**
		 * Determines whether or not a piece should be added to the graph.
		 *
		 * @return bool
		 */
		public function is_needed() {
			if ( ! is_singular() ) {
				return false;
			}
			if ( false === $this->context->site_represents ) {
				return false;
			}
			return LSX_Schema_Utils::is_type( get_post_type(), $this->post_type );
		}
		/**
		 * Returns Review data.
		 *
		 * @return array $data Review data.
		 */
		public function generate() {
			$data = array();
			return $data;
		}
		/**
		 * Gets the connected reviews post type and set it as the "Review" schema
		 *
		 * @param  array    $data An array of offers already added.
		 * @param  string   $data_key
		 * @param  boolean  $include_aggregate
		 * @return array    $data
		 */
		public function add_reviews( $data, $data_key = 'reviews', $include_aggregate = true ) {
			$reviews       = get_post_meta( $this->context->id, 'review_to_' . $this->post_type, false );
			$reviews_array = array();
			if ( ! empty( $reviews ) ) {
				$aggregate_value = 1;
				$review_count    = 0;
				foreach ( $reviews as $review_id ) {
					$rating      = get_post_meta( $review_id, 'rating', true );
					$author      = get_post_meta( $review_id, 'reviewer_name', true );
					$description = wp_strip_all_tags( get_the_excerpt( $review_id ) );
					$review_args = array(
						'author'     => $author,
						'reviewBody' => $description,
					);
					// Add in the review rating.
					if ( false !== $rating && '' !== $rating && '0' !== $rating && 0 !== $rating ) {
						$review_args['reviewRating'] = array(
							'@type'       => 'Rating',
							'ratingValue' => $rating,
						);
					}
					$reviews_array = LSX_Schema_Utils::add_review( $reviews_array, $review_id, $this->context, $review_args );
					$review_count++;
				}
				if ( ! empty( $reviews_array ) ) {
					if ( true === $include_aggregate ) {
						$data['aggregateRating'] = array(
							'@type'       => 'AggregateRating',
							'ratingValue' => (string) $aggregate_value,
							'reviewCount' => (string) $review_count,
							'bestRating'  => '5',
							'worstRating' => '1',
						);
					}
					$data[ $data_key ] = $reviews_array;
				}
			}
			return $data;
		}
		/**
		 * Gets the connected posts and set it as the "Article" schema
		 *
		 * @param  array  $data An array of offers already added.
		 * @param  string $data_key
		 * @return array  $data
		 */
		public function add_articles( $data, $data_key = 'subjectOf' ) {
			$posts       = get_post_meta( $this->context->id, 'post_to_' . $this->post_type, false );
			$posts_array = array();
			if ( ! empty( $posts ) ) {
				foreach ( $posts as $post_id ) {
					$post_args = array(
						'articleBody' => wp_strip_all_tags( get_the_excerpt( $post_id ) ),
						'headline'    => get_the_title( $post_id ),
					);
					$section   = get_the_term_list( $post_id, 'category' );
					if ( ! is_wp_error( $section ) && '' !== $section && false !== $section ) {
						$post_args['articleSection'] = wp_strip_all_tags( $section );
					}
					if ( $this->context->site_represents_reference ) {
						$post_args['publisher'] = $this->context->site_represents_reference;
					}
					$image_url = get_the_post_thumbnail_url( $post_id, 'lsx-thumbnail-wide' );
					if ( false !== $image_url ) {
						$post_args['image'] = $image_url;
					}
					$posts_array = LSX_Schema_Utils::add_article( $posts_array, $post_id, $this->context, $post_args );
				}
				if ( ! empty( $posts_array ) ) {
					$data[ $data_key ] = $posts_array;
				}
			}
			return $data;
		}
		/**
		 * Adds the Project and Testimonials attached to the Team Member
		 *
		 * @param array $data
		 *
		 * @return array $data
		 */
		public function add_connections( $data ) {
			$connections_array = array();
			if ( $this->is_top_level ) {
				$connections_array = $this->add_regions( $connections_array );
				$connections_array = $this->add_accommodation( $connections_array );
				if ( ! empty( $connections_array ) ) {
					$data['containsPlace'] = $connections_array;
				}
			} else {
				$connections_array             = $this->add_countries( $connections_array );
				$data['containedInPlace'] = $connections_array;
				$connections_array          = array();
				$connections_array          = $this->add_accommodation( $connections_array );
				$data['containsPlace'] = $connections_array;
			}
			return $data;
		}
		/**
		 * Adds the terms for the taxonomy
		 *
		 * @param array $data     Review data.
		 * @param array $data_key the parameter name you wish to assign it to.
		 * @param array $taxonomy the taxonomy to grab terms for.
		 *
		 * @return array $data Review data.
		 */
		public function add_taxonomy_terms( $data, $data_key, $taxonomy ) {
			/**
			 * Filter: 'lsx_schema_' . $this->post_type . '_' . $data_key . '_taxonomy' - Allow changing the taxonomy used to assign keywords to a post type Review data.
			 *
			 * @api string $taxonomy The chosen taxonomy.
			 */
			$taxonomy = apply_filters( 'lsx_schema_' . $this->post_type . '_' . $data_key . '_taxonomy', $taxonomy );
			return LSX_Schema_Utils::add_terms( $data, $this->context->id, $data_key, $taxonomy );
		}
		/**
		 * Adds the custom field value for the supplied key
		 *
		 * @param array   $data     Schema data.
		 * @param string  $data_key the parameter name you wish to assign it to.
		 * @param string  $meta_key the taxonomy to grab terms for.
		 * @param boolean $single   A single custom field or an array
		 *
		 * @return array $data Review data.
		 */
		public function add_custom_field( $data, $data_key, $meta_key, $single = true ) {
			$value = get_post_meta( $this->context->id, $meta_key, $single );
			if ( '' !== $value && false !== $value ) {
				$data[ $data_key ] = $value;
			}
			return $data;
		}
	}
}
