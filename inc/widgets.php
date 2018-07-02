<?php

//CONTACT INFO
class lsd_contact_info extends WP_Widget {

	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Contact Info' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Contact Info' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		echo $before_title . $title . $after_title;
	}
	echo '<div class="location">';
  echo '<span class="contact-info-title"><strong>Duluth Clinic</strong></span><br>';
	echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2731.21689647023!2d-92.08580564833048!3d46.80003325123396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52ae52d103a5ca7b%3A0x705563335381f34c!2sLake+Superior+Dental+Associates!5e0!3m2!1sen!2sus!4v1525715140603"/></iframe>';

	echo '<span class="contact-info-address">' . nl2br(get_theme_mod('duluth_address')) . '<a target="_blank" href="http://maps.google.com/maps?q='.str_replace('<br />',' ', nl2br(get_theme_mod('duluth_address'))).'">Map <span class="genericon genericon-location"></span></a></span><br><br>';
	echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:'.get_theme_mod('duluth_phone').'">' . get_theme_mod('duluth_phone') . '</a></span><br><br>';
	echo '<span class="contact-info-email">'. nl2br(get_theme_mod('duluth_hours')) . '</span>';
	echo '</div>';

	echo '<div class="location">';
	echo '<span class="contact-info-title"><strong>Two Harbors Clinic</strong></span><br>';
	//echo 'TESTING';
	echo '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d680.0048909351179!2d-91.6704389!3d47.020221!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x52af165967107f13%3A0x4cf79d25ba2009f4!2s508+2nd+Ave%2C+Two+Harbors%2C+MN+55616!5e0!3m2!1sen!2sus!4v1528920129495" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
	//echo '<iframe src="http://maps.google.com/maps?q='.str_replace('<br />',' ', nl2br(get_theme_mod('two_harbors_address'))).'&output=embed"/></iframe>';
	//echo '<iframe src="http://maps.google.com/maps?q='.str_replace('<br />',' ', nl2br(get_theme_mod('duluth_address'))).'&output=embed"/></iframe>';
	echo '<span class="contact-info-address">' . nl2br(get_theme_mod('two_harbors_address')) . '<a target="_blank" href="http://maps.google.com/maps?q=508 2nd Ave Two Harbors, MN">Map <span class="genericon genericon-location"></span></a></span><br><br>';

	echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:'.get_theme_mod('two_harbors_phone').'">' . get_theme_mod('two_harbors_phone') . '</a></span><br><br>';
	echo '<span class="contact-info-email">'. nl2br(get_theme_mod('two_harbors_hours')) . '</span>';
	echo '</div>';

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}


// SECONDARY NAV
function lsd_side_nav() {

	global $post;
	$string = '';
	$current = get_the_title();
  $link = get_the_permalink($post->ID);

	if ( is_page() && $post->post_parent )

	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );
	else
	    $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&depth=1' );

	if ( $childpages ) {

	    $string = '<h2 class="widget-title"><strong class="widget-title">'.$current.'</strong></h2><ul>' . $childpages . '</ul>';

	} else {

	$children = get_pages( array( 'child_of' => $post->ID ) );

   if ( is_page() && ($post->post_parent || count( $children ) > 0  )) {

			$parent = wp_get_post_parent_id( $post->ID );
			$link = get_the_permalink($parent);
			$parent = get_the_title($parent);
			$childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&depth=1' );

			$string = '<strong><h2 class="widget-title"><a href="'.$link.'">'.$parent.'</a></strong></h2><ul>' . $childpages . '</ul>';

		} else {

				// nada, hide empty widget with CSS

		}
	}

	echo $string;

}

//SIDE NAV WIDGET
class lsd_sidenav extends WP_Widget {

	function  lsd_sidenav() {
		// Instantiate the parent object
		parent::__construct( false, 'Side Navigation' );
	}

	function widget( $args, $instance ) {

    extract($args, EXTR_SKIP);

    echo $before_widget;
    $title = empty($instance['title']) ? 'Side Navigation' : apply_filters('widget_title', $instance['title']);

    if ($title === ' ') {
      //do nothing
	} else {
		//echo $before_title . $title . $after_title;
	}

  lsd_side_nav();

	echo $after_widget;

    }

	function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }

	 function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
	  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<?php
	  }
}



function lsd_register_widgets() {
	register_widget( 'lsd_sidenav' );
	register_widget( 'lsd_contact_info' );
}

add_action( 'widgets_init', 'lsd_register_widgets' );
