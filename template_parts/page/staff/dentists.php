<?php

if(isset($type)) :

extract(shortcode_atts(array(
      'type' => $type,
   ), $type));

else :

$type = 'dentist';

endif;

if($type == 'dentist' || $type == 'orthodontist') {
  $order = 'menu_order';
} else {
  $order = 'title';
}

$var = 'ASC';

if(!is_front_page() && $type != 'dentist' && $type != 'orthodontist') :
  $order = 'title';
//  $var = 'ASC';
endif;

$args = array(
  'post_type' => 'staff',
  'orderby' => $order,
  'order' => $var,
  'posts_per_page' => -1,
  'tax_query' => array(
    array(
    'taxonomy' => 'staff-type',
    'terms' => $type,
    'field' => 'slug',
    //'operator' => '='
    )
  ),
);

$q = new WP_Query($args);

if($q->have_posts()) : while($q->have_posts()) : $q->the_post();
global $post; ?>
<div class="item" id="<?php echo $post->post_name; ?>">

<?php if(!empty($post->post_content)) : ?>
<a href="<?php echo '/our-providers/#'.$post->post_name; ?>">

<?php endif; ?>

<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>"/>
<?php if(is_front_page()) : ?>
</a>
<?php endif; ?>
<?php if(is_front_page()) : ?>
<a href="<?php echo '/our-providers/#'.$post->post_name; ?>">
<?php endif; ?>
<h6><?php echo get_the_title(); ?></h6>
<?php if(!empty($post->post_content)) : ?>
</a>
<?php endif; ?>
<?php if(!is_front_page()) :
  get_template_part('template_parts/page/staff/staff-header-grid');
  echo '<div class="staff-content">';
  get_template_part('template_parts/page/staff/staff-header-lightbox');
 the_content();
 echo '</div>';
endif; ?>
</div>

<?php endwhile; endif; wp_reset_postdata(); ?>
