<?php
/**
 * LSX Blog Widget
 */
class LSX_Blog_Widget extends WP_Widget {

	/** constructor -- name this the same as the class above */
	function lsx_blog_widget() {
		parent::WP_Widget(false, $name = 'LSX Blog');

		add_filter('lsx_blog_widget_post_meta', array($this, 'post_meta'), 10, 3);
	}

	/** @see WP_Widget::widget -- do not rename this */
	function widget($args, $instance) {
		global $post;

		extract($args);
		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = false;
		}

		if (isset($instance['title_link'])) {
			$title_link = $instance['title_link'];
		} else {
			$title_link = false;
		}
		if (isset($instance['tagline'])) {
			$tagline = $instance['tagline'];
		} else {
			$tagline = false;
		}
		if (isset($instance['category'])) {
			$category = $instance['category'];
		} else {
			$category = false;
		}
		if (isset($instance['limit'])) {
			$limit = $instance['limit'];
		} else {
			$limit = false;
		}
		if (isset($instance['layout'])) {
			$layout = $instance['layout'];
		} else {
			$layout = false;
		}

		if (isset($instance['class'])) {
			$class = $instance['class'];
		} else {
			$class = false;
		}

		if (isset($instance['featured'])) {
			$featured = $instance['featured'];
		} else {
			$featured = false;
		}

		if (isset($instance['size'])) {
			$size = $instance['size'];
		} else {
			$size = false;
		}
		
		if (isset($instance['columns'])) {
			$columns = $instance['columns'];
		} else {
			$columns = 3;
		}	
		$md_col_width = 12 / $columns;

		// If limit not set, display all posts
		if ($limit == '') {$limit = "1";
		}

		if ($title_link) {
			$link_open  = "<a href='$title_link'>";
			$link_close = "</a>";
		} else {
			$link_open  = "";
			$link_close = "";
		}

		if (!$size) {
			$size = '100';
		}

		$class = 'class="'.$class.' ';
		echo str_replace('class="', $class, $before_widget);

		if ($title) {
			echo $before_title.$link_open.$title.$link_close.$after_title;
		}

		if ($tagline) {
			echo "<p class='tagline text-center'>$tagline</p>";
		}

		$args = array(
			'posts_per_page'      => $limit,
			'ignore_sticky_posts' => true
		);

		if ($featured) {
			$args['post__in'] = get_option('sticky_posts');
		}

		$posts = new WP_Query($args);

		if ($posts->have_posts()):

			switch ($layout) {

				case 'list':
					$element             = 'ul';
					$inner_element       = 'li';
					$inner_element_class = 'list-item';
					break;

				default:
					$element             = 'div';
					$inner_element       = 'div';
					$inner_element_class = 'item col-md-'.$md_col_width;
					break;
			}

			echo '<'.$element.'>';

			while ($posts->have_posts()):$posts->the_post();

				echo '<'.$inner_element.' class="'.$inner_element_class.'">';

				switch ($layout) {
					case 'list':
						?>
						<div class="col-md-2">
							<?php if (has_post_thumbnail()) {?>
								<a href="<?php the_permalink();?>">
								<?php the_post_thumbnail('thumbnail', array($size, $size));?>
								</a>
							<?php } else {?>
							    <a href="<?php the_permalink();?>">
									<img class="img-responsive" src="http://placehold.it/350x230/" alt="placeholder" />
								</a>
							<?php } ?>
	
						<?php echo apply_filters('lsx_blog_widget_post_meta', '', get_the_ID(), $layout);?>
						</div>
					
						<div class="col-md-10">
	
							<?php do_action('lsx_blog_widget_before_title');?>
							<h4><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4>
							<?php do_action('lsx_blog_widget_after_title');?>
		
		
							<?php do_action('lsx_blog_widget_before_excerpt');?>
							
							<?php
							// Description
							if ($excerpt_length > 0) {
								$content = strip_tags($post->post_excerpt).'...';
								echo $content;
							} else {
								the_excerpt();
							}
							?>
							
							<a class="read-more" href="<?php the_permalink();?>">Read More</a>
							<?php do_action('lsx_blog_widget_after_excerpt');?>
						</div>

					    <div class="clearfix"></div>
					<?php
					break;

				default:
					?>
						<?php if (has_post_thumbnail()) {?>
							<a href="<?php the_permalink();?>">
								<?php the_post_thumbnail('thumbnail', array($size, $size));?>
							</a>
						<?php } else {?>
							<a href="<?php the_permalink();?>">
								<img class="img-responsive" src="http://placehold.it/350x230/" alt="placeholder" />
							</a>
						<?php } ?>
						
						<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
						
						<?php echo apply_filters('lsx_blog_widget_post_meta', '', get_the_ID(), $layout);?>
						
						<?php the_excerpt(); ?>
						
						<a class="read-more" href="<?php the_permalink();?>">Read More</a>
					<?php
					break;
			}

			echo '</'.$inner_element.'>';

		endwhile;

		echo '</'.$element.'>';

		?>
		<div class="clearfix"></div>
		<?php

		endif;

		wp_reset_query();

		echo $after_widget;
	}

	/** @see WP_Widget::update -- do not rename this */
	function update($new_instance, $old_instance) {
		$instance                   = $old_instance;
		$instance['title']          = strip_tags($new_instance['title']);
		$instance['title_link']     = strip_tags($new_instance['title_link']);
		$instance['tagline']        = strip_tags($new_instance['tagline']);
		$instance['layout']         = strip_tags($new_instance['layout']);
		$instance['limit']          = strip_tags($new_instance['limit']);
		$instance['class']          = strip_tags($new_instance['class']);
		$instance['featured']       = strip_tags($new_instance['featured']);
		$instance['size']           = strip_tags($new_instance['size']);
		$instance['columns'] = strip_tags( $new_instance['columns'] );

		return $instance;
	}

	/** @see WP_Widget::form -- do not rename this */
	function form($instance) {

		$defaults = array(
			'title'          => 'Blog',
			'excerpt_length' => '300',
			'size'           => '100',
		);
		$instance = wp_parse_args((array) $instance, $defaults);

		if (isset($instance['title'])) {
			$title = esc_attr($instance['title']);
		} else {
			$title = false;
		}
		if (isset($instance['size'])) {
			$size = esc_attr($instance['size']);
		} else {
			$size = false;
		}
		if (isset($instance['title_link'])) {
			$title_link = esc_attr($instance['title_link']);
		} else {
			$title_link = false;
		}
		if (isset($instance['tagline'])) {
			$tagline = esc_attr($instance['tagline']);
		} else {
			$tagline = false;
		}
		if (isset($instance['layout'])) {
			$layout = esc_attr($instance['layout']);
		} else {
			$layout = false;
		}
		if (isset($instance['limit'])) {
			$limit = esc_attr($instance['limit']);
		} else {
			$limit = false;
		}
		if (isset($instance['class'])) {
			$class = esc_attr($instance['class']);
		} else {
			$class = '';
		}
		if (isset($instance['featured'])) {
			$featured = esc_attr($instance['featured']);
		} else {
			$featured = false;
		}
		
		if (isset($instance['columns'])) {
			$columns = esc_attr($instance['columns']);
		} else {
			$columns = false;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:','lsx');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title;?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('title_link');?>"><?php _e('Title Link:','lsx');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title_link');?>" name="<?php echo $this->get_field_name('title_link');?>" type="text" value="<?php echo $title_link;?>" />
			<small>Link the widget title to a URL</small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('size');?>"><?php _e('Image size:','lsx');	?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('size');?>" name="<?php echo $this->get_field_name('size');?>" type="text" value="<?php echo $size;?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('tagline');?>"><?php _e('Tagline:','lsx');	?></label>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('tagline');?>" name="<?php echo $this->get_field_name('tagline');?>"><?php echo $tagline;?></textarea>
			<small>Tagline to display below the widget title</small>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('limit');?>"><?php _e('Maximum amount:', 'lsx'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit');?>" name="<?php echo $this->get_field_name('limit');?>" type="text" value="<?php echo $limit;?>" />
			<small><?php _e('Default 1 post','lsx');?></small>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('featured');?>"
						name="<?php echo $this->get_field_name('featured');?>"
						type="checkbox" value="1" <?php checked('1', $featured);?> /> 
			<label for="<?php echo $this->get_field_id('featured');?>"><?php _e('Featured','lsx'); ?></label>
		</p>
				
		<p>
			<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Columns:','lsx'); ?></label>
			<select name="<?php echo $this->get_field_name('columns'); ?>"
				id="<?php echo $this->get_field_id('columns'); ?>"
				class="widefat layout">
		            <?php
		            $options = array('1', '2', '3', '4' , '5' , '6');
		            foreach ($options as $option) {
		                echo '<option value="' . lcfirst($option) . '" id="' . $option . '"', $columns == lcfirst($option) ? ' selected="selected"' : '', '>', $option, '</option>';
		            }
		            ?>
		            </select>
		</p>				

		<p>
			<label for="<?php echo $this->get_field_id('layout');?>"><?php _e('Layout:', 'lsx'); ?></label>
			<select name="<?php echo $this->get_field_name('layout');?>" id="<?php echo $this->get_field_id('layout');?>" class="widefat layout">
			<?php
			$options = array('Standard', 'List', 'Custom');
			foreach ($options as $option) {
				echo '<option value="'.lcfirst($option).'" id="'.$option.'"', $layout == lcfirst($option)?' selected="selected"':'', '>', $option, '</option>';
			}
			?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('class');?>"><?php _e('Class:','lsx');	?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('class');?>" name="<?php echo $this->get_field_name('class');?>" type="text" value="<?php echo $class;?>" />
			<small><?php _e('Add your own class to the opening element of the widget','lsx');	?></small>
		</p>
		<?php

	}

	function post_meta($post_meta, $post_id, $layout) {

		if (lsx_get_option('post_meta')) {
			$post_meta = lsx_get_option('post_meta');
		} else {
			$post_meta = '<span class="small">'.__('By', 'lsx-theme').'</span> [post_author_posts_link] <span class="small">'._x('on', 'post datetime', 'lsx-theme').'</span> [post_date] <span class="small">'.__('in', 'lsx-theme').'</span> [post_categories before=""] ';
		}

		$post_meta = do_shortcode($post_meta);

		return $post_meta;
	}

}// end class bs_blog_widget
add_action('widgets_init', create_function('', 'return register_widget("LSX_Blog_Widget");'));
?>