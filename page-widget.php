<?php
/**
 * Plugin Name: Font Awesome Background
 * Description: Easily add links into your WordPress posts, pages, and custom post types with Font Awesome Icon as background
 * Version: 1.0.0
 */

/**
 * Do not load this file directly.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Adds widget.
 */
class faw_page_widget extends WP_Widget {

		/**
	 * Register widget with WordPress.
	 */

	public function __construct(){	
		
		parent::__construct( 'fa_page_widget', ' Font Awesome Background', array(
			'classname' => 'faw_page_widget',
			'description' => __('Easily add links into your WordPress posts, pages, and custom post types with Font Awesome Icon as background'))
		);

		
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */

	public function faw_assets(){


	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance){
		
		return $new_instance;

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */

	public function form($instance){

		$title = '';
		$icon = '';
		$link_text = '';
		$page_id = '';
		$description = '';
		$page_link = '';

		if( !empty( $instance['title'] ) ) { $title = $instance['title']; }
		if( !empty( $instance['icon'] ) ) { $icon = $instance['icon']; }
		if( !empty( $instance['link_text'] ) ) { $link_text = $instance['link_text']; }
		if( !empty( $instance['page_id'] ) ) { $page_id = $instance['page_id']; }
		if( !empty( $instance['page_link'] ) ) { $page_link = $instance['page_link']; }
		if( !empty( $instance['description'] ) ) { $description = $instance['description']; }

	?>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_name('title')); ?>">
				<?php _e('Title:'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr_e( $title ); ?>"/>
	</p>
	
	<p>
	<label for="<?php echo esc_attr( $this->get_field_name('pageSelect')); ?>">
				<?php _e('Page:'); ?>
	</label>
	</br>
	<?php 

		if( isset( $instance['page_id'] ) ){
			$page_id = $instance['page_id'];
		} else {
			$page_id = 0;
		}

		$args = array(
			'id' => $this->get_field_id('page_id'),
			'name' => $this->get_field_name('page_id'),
			'selected' => $page_id,
			'show_option_none' => 'Please select a page'
		);

		wp_dropdown_pages($args);

	?>

	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_name('page_link')); ?>">
				<?php _e('Page Link:'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_link' ) ); ?>" type="text" value="<?php echo esc_attr_e( $page_link ); ?>"/>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_name('icon')); ?>">
				<?php _e('Font Awesome Icon:'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon' ) ); ?>" type="text" value="<?php echo esc_attr_e( $icon ); ?>"/></br>
		<a href="http://fontawesome.io/icons/" target="_blank">Font Awesome Icons</a>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_name('description')); ?>">
				<?php _e('Page Description:'); ?>
		</label>
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr_e( $description ); ?></textarea>
	</p>

	<p>
		<label for="<?php echo esc_attr( $this->get_field_name('link_text')); ?>">
				<?php _e('Page Link text:'); ?>
		</label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_text' ) ); ?>" type="text" value="<?php echo esc_attr_e( $link_text ); ?>"/>
	</p>


	<?php

		}

	public function widget($args, $instance){

			echo $args['before_widget'];

			$page = get_post($instance['page_id']);

	?>

					<div class="box-services-d box-services-e">
							<div class="bg-overlay"></div>
							<div class="row col-p0">
								<div class="col-sm-12">

									<h3 class="title-uppercased title-shadow-a"><?php if( !empty( $instance['title'] ) ) { echo esc_attr_e($instance['title']); } else if( !empty( $instance['page_id'] ) ) { echo $page->post_title;} ?>
										
									<a href="<?php if( !empty( $instance['page_id'] ) ) { echo get_permalink($page->ID); } else { if( !empty( $instance['page_link'] ) ) { echo esc_url( $instance['page_link']); } } ?>" class="link-read-more"><?php if( !empty( $instance['link_text'] ) ) { echo esc_attr_e( $instance['link_text'] ); }?></a>
									</h3>
									<p class="mb10"><?php if( !empty( $instance['description'] ) ){ echo esc_attr_e( $instance['description'] ); }  ?></p>									
									<?php if( !empty( $instance['icon'] ) ){ echo sprintf( $instance['icon'] ); } ?>								

							</div>
						</div>
					</div>
	
	

	<?php

			echo $args['after_widget'];

	}
}

add_action( 'widgets_init', function(){ 
	return register_widget("faw_page_widget"); 
});

?>