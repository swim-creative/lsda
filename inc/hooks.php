<?php

/* Hooks */

// hero / banner
function hero() {
  if(!is_archive() && !is_404() && !is_search()) :
    get_template_part('template_parts/page/banner');
  endif;
}
add_action('before_content','hero');

// homepage templates
function home() {
  if(is_front_page()) {
    get_template_part('template_parts/page/staff');
    get_template_part('template_parts/page/lower_banner');
  } else {
    get_template_part('template_parts/page/lower_banner');
  }
}
add_action('after_content','home');

// top of page alert / banner
function alert() {
  get_template_part('template_parts/page/alert');
}
add_action('before_header','alert');

// chat template
function chat() {
  get_template_part('template_parts/page/chat');
}
add_action('add_to_banner','chat');

// cta above footer
function cta() {
  get_template_part('template_parts/page/cta');
}
add_action('after_content','cta');

// landing page top section
function landing() {
  if(is_page_template('page-landing.php')) {
    get_template_part('template_parts/page/landing-page-header');
  }
}
add_action('before_content','landing');

// pseudo crumb (for comprehensive care page)
function crumb() {
  global $post;
  $page = get_page_by_path('comprehensive-care', OBJECT, 'page');
  //echo $page->ID;
  if(is_page(intval($page->ID)) || is_page() && $page->ID == $post->post_parent) {
    get_template_part('template_parts/page/pseudo-crumb');
  }
}
add_action('before_content','crumb');

// tooth
function tooth() {
  if(is_front_page()) :
    get_template_part('template_parts/page/tooth');
  endif;
}
add_action('add_to_banner','tooth');

// append testimonials to testimonial page
function testimonials() {

  if(is_page(48)) : ?>

  <script type="text/javascript">
  (function(w, d){w._rab_review_q = w._rab_review_q || []; w._rab_review_q.push({id: 'b4fe50bf17aa0fe54de53a367886ab01', reviewDivId: 'review-widget-container', template: 'light', seoFriendlyName: 'lake-superior-dental-associates-duluth-mn'}); var el = d.createElement("script"); el.async=true; el.src="//s3.amazonaws.com/cdn.rateabiz.com/reviews/loader.js"; el.type="text/javascript"; var s0 = d.getElementsByTagName("script")[0]; s0.parentNode.insertBefore(el, s0);})(window, document);
  var $ = jQuery;
  // append
  $('.entry-content').append('<div id="review-widget-container" style="width: 100%;"></div>');
  </script>

  <?php endif;

}

add_action('wp_footer','testimonials');
