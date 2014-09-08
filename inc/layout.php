<?php
/**
 * Layout hooks
 *
 * @package lsx
 */

add_action( 'lsx_footer_before', 'lsx_add_footer_sidebar_area' );
if ( ! function_exists( 'lsx_add_footer_sidebar_area' ) ) { 
function lsx_add_footer_sidebar_area() {
	?>
	<section id="footer-widgets" class="container">
		<div class="row">
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		</div>
	</section>
	<?php
}
}


add_filter( 'lsx_filter_post_meta', 'lsx_set_post_meta_options' );
function lsx_set_post_meta_options( $post_info ) {
	$post_info = lsx_get_option('post_meta');
}


if ( ! function_exists( 'lsx_page_banner' ) ) { 
	add_action( 'lsx_header_after', 'lsx_page_banner' );
	function lsx_page_banner() {

		if ( ! lsx_get_option( 'enable_banner' ) ) { return false; }

		$heading = get_post_meta( get_the_ID(), 'lsx_heading', true );
		$tagline = get_post_meta( get_the_ID(), 'lsx_tagline', true );
		$image_id = get_post_meta( get_the_ID(), 'lsx_banner_image', true );
		if ( $image_id ) {
			$image_url = wp_get_attachment_url( $image_id );
		}
			
		?>
		<?php if ( is_author() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title"><?php the_author(); ?></h1>
						<h2 class="bs-image-header-desc"><?php the_author_meta( 'user_description' ); ?></h2>
					</div>
				</div>
			</header>	
		<?php } elseif ( is_404() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title">Oops</h1>
					</div>
				</div>
			</header>
		<?php } elseif ( is_search() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title">Search Results</h1>
						<?php if(isset($_GET['s'])) { ?>
							<h2 class="bs-image-header-desc">for <?php echo $_GET['s']; ?></h2>
						<?php } ?>
					</div>
				</div>
			</header>
		<?php } elseif ( is_home() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title"><?php echo lsx_get_option( 'home_banner_heading' ); ?></h1>
						<?php if(lsx_get_option( 'home_banner_tagline' )){ ?>
							<h2 class="bs-image-header-desc"><?php echo lsx_get_option( 'home_banner_tagline' ); ?></h2>
						<?php } ?>
					</div>
				</div>
			</header>
		<?php } elseif ( is_page( 'events ') ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title">Events</h1>	
					</div>
				</div>
			</header>
		<?php } elseif ( is_date() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title">
							<?php if ( is_day() ) { ?> 
								Archive for <?php the_time('F jS, Y'); ?>
							<?php  } elseif ( is_month() ) { ?> 
								Archive for <?php the_time('F, Y'); ?>
							<?php } elseif ( is_year() ) { ?> 
								Archive for <?php the_time('Y'); ?>
							<?php } ?>
						</h1>
					</div>
				</div>
			</header>
		<?php } elseif ( is_archive() ) { ?>
			<header class="bs-image-header">
				<div class="container">
					<div class="banner-text">
						<h1 class="bs-image-header-title"><?php single_cat_title(); ?></h1>
						<h2 class="bs-image-header-desc"><?php echo category_description(); ?></h2>
					</div>
				</div>
			</header>
		<?php } else { ?>
			<?php if ( $image_id ) { ?>
				<header class="bs-image-header" style="background-image: url(<?php echo $image_url; ?>)">
			<?php } else { ?>
				<header class="bs-image-header">
			<?php } ?>
				<div class="container">
					<div class="banner-text">
						<?php if ( $heading ) { ?>
							<h1 class="bs-image-header-title"><?php echo $heading; ?></h1>
						<?php } else { ?>
							<h1 class="bs-image-header-title"><?php the_title(); ?></h1>
						<?php } ?>
						
						<?php if(false != get_post_meta( get_the_ID(), 'lsx_tagline', true )) {?>
							<h2 class="bs-image-header-desc"><?php echo get_post_meta( get_the_ID(), 'lsx_tagline', true ); ?></h2>
						<?php } ?>
					</div>
				</div>
			</header>
		<?php }
	}
};

add_action( 'lsx_entry_after', 'lsx_author_box' );
function lsx_author_box() {

	if ( ! lsx_get_option( 'author_box' ) || ! is_single() ) { return false; }

	global $post;
	$author_id=$post->post_author;
	if ( get_post_type() == 'post' ) {
		$author_meta = get_the_author_meta( $field, $user_id );
		?>
			<div class="author-box well col-xs-12">
				<div class="image col-sm-2">
					<img class="pull-left img-circle" src="<?php echo get_avatar_url( $author_id, '80' ); ?>" alt="Author Image"/>
				</div>
				<div class="content col-sm-10">
					<h4>About <?php echo get_the_author_meta( 'display_name', $author_id ); ?></h4>
					<p><?php echo get_the_author_meta( 'description', $author_id ); ?></p>
				</div>							
				<div class="col-sm-12">
					<hr>
					<?php
					$args = array(
						'post_type' => 'team',
						'meta_key' => 'bs_user_id',
						'meta_value' => $author_id
						);

					$team_members = get_posts( $args );

					foreach ( $team_members as $member ) {							
						$facebook = get_post_meta( $member->ID, 'bs_facebook', true );
						$twitter = get_post_meta( $member->ID, 'bs_twitter', true );
						$googleplus = get_post_meta( $member->ID, 'bs_googleplus', true );
						$linkedin = get_post_meta( $member->ID, 'bs_linkedin', true );

						if ( $facebook || $twitter || $googleplus || $linked )
							echo "<div class='social pull-left'>";

						if ( $facebook )
							echo "<a href='$facebook' target='_blank'><i class='fa fa-facebook'></i></a>";

						if ( $twitter )
							echo "<a href='$twitter' target='_blank'><i class='fa fa-twitter'></i></a>";

						if ( $googleplus )
							echo "<a href='$googleplus' target='_blank'><i class='fa fa-google-plus'></i></a>";

						if ( $linkedin )
							echo "<a href='$linkedin' target='_blank'><i class='fa fa-linkedin'></i></a>";

						if ( $facebook || $twitter || $googleplus || $linked )
							echo "</div>";
					}
					?>
					<div class="profile-link pull-right">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>">
							View all posts by <?php echo get_the_author_meta( 'display_name', $author_id ); ?>  <i class="fa fa-arrow-right"></i>
						</a>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php
	};
}

add_action( 'lsx_entry_after', 'lsx_related_posts' );
function lsx_related_posts() {

	if ( ! lsx_get_option( 'related_posts' ) || ! is_single() ) { return false; }

	$category_array = array();
	$category_terms = ( get_the_terms( get_the_ID(), 'category' ) );
	foreach ( $category_terms as $category_term ) {
		$category_array[] = $category_term->term_id;
	}
	$tag_array = array();
	$tag_terms = ( get_the_terms( get_the_ID(), 'tag' ) );
	foreach ( $tag_terms as $tag_term ) {
		$tag_array[] = $tag_term->term_id;
	}

	if ( lsx_get_option( 'related_by' ) == "category" ) {
		$args = array(
			'posts_per_page' => '3',
			'orderby' => 'rand',
			'post__not_in' => array(get_the_ID()),
			'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'id',
						'terms' => $category_array
					)
				)
			);
	} elseif ( lsx_get_option( 'related_by' ) == "tag" ) {
		$args = array(
			'posts_per_page' => '3',
			'orderby' => 'rand',
			'post__not_in' => array(get_the_ID()),
			'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field' => 'id',
						'terms' => $tag_array
					)
				)
			);
	}

	$related_posts = get_posts( $args );

	if ( $related_posts ) {
		?>
		<h3>Related Posts</h3>
		<div class="related-posts row">		
		<?php
		foreach ( $related_posts as $related_post ) {
			?>
			<div class="col-md-4">
				<div class="well">					
						<?php if ( has_post_thumbnail( $related_post->ID ) ) { ?>
							<a href="<?php echo get_permalink( $related_post->ID );?>">
								<?php echo get_the_post_thumbnail( $related_post->ID, 'thumbnail-wide', 'class=img-responsive' ); ?>
							</a>
						<?php } else { ?>
							<a href="<?php echo get_permalink( $related_post->ID );?>">
								<img class="img-responsive" src="http://placehold.it/350x230/" alt="placeholder" />
							</a>
						<?php } ?>
					<h4><a href="<?php echo get_permalink( $related_post->ID );?>"><?php echo $related_post->post_title ?></a></h4>					
				</div>
			</div>
			<?php
		} ?>
		</div>
		<?php
	}

	?>
	<?php
}