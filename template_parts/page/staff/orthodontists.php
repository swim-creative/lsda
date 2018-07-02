<?php

$args = array(
  'post_type' => 'staff',
  'tax_query' => array(
    array(
    'taxonomy' => 'staff-type',
    'terms' => 'orthodontist',
    'field' => 'slug',
    //'operator' => '='
    )
  ),
  'orderby' => 'menu_order',
  'order' => 'DESC',
  'posts_per_page' => -1
);

$q = new WP_Query($args);

if($q->have_posts()) : while($q->have_posts()) : $q->the_post();
global $post; ?>

<div class="item" id="<?php echo $post->post_name; ?>">
<?php if(is_front_page()) : ?>
<a href="<?php echo '/our-providers/#'.$post->post_name; ?>">
<?php endif; ?>
<?php if(is_front_page()) : ?>
<img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>"/>
</a>
<?php else : ?>
  <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'thumbnail'); ?>"/>
<?php endif; ?>
<?php if(is_front_page()) : ?>
<a href="<?php echo '/our-providers/#'.$post->post_name; ?>">
<?php endif; ?>
<h6><?php echo get_the_title(); ?></h6>
<?php if(!is_front_page()) : ?>
<hr>
<?php endif; ?>
<?php if(is_front_page()) : ?>
</a>
<?php endif; ?>
<?php if(!is_front_page()) :
 the_content();
endif; ?>
</div>


<?php endwhile; endif; wp_reset_postdata(); ?>
