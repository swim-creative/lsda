<?php // shortcodes
function name_code() {
  $name = get_bloginfo('name');
  return $name;
}
add_shortcode('name', 'name_code');

function phone_code() {
  if (get_theme_mod('lsd_phone')=='')
    return;
  $phone = '<a href="tel:' . get_theme_mod('lsd_phone') . '">' . get_theme_mod('lsd_phone') . '</a>';
  return $phone;
}
add_shortcode('phone', 'phone_code');

//Address
function address_code($atts) {
  if (get_theme_mod('lsd_address')=='')
    return;
  extract( shortcode_atts( array(
    'format' => true
  ), $atts ) );
  if($format === true) {
    $addy = nl2br(get_theme_mod('lsd_address'));
  } else {
    $lines = preg_split( "/\\r\\n|\\r|\\n/", get_theme_mod('lsd_address') );
    $count = count($lines);
    $addy = '';

    for( $i = 0; $i <= $count; $i++ ) {
      $addy .= $lines[$i];
      if($i < $count - 1) {
        $addy .= ', ';
      }
    }//for
  }//else

  return $addy;
}
add_shortcode('address', 'address_code');

// Email
function email_code() {
  if (get_theme_mod('lsd_email')=='')
    return;
  $e = '<a href="mailto:' . get_theme_mod('lsd_email') . '">' . get_theme_mod('lsd_email') . '</a>';
  return $e;
}
add_shortcode('email', 'email_code');


// Dentists
function staff_code($type = 'dentist') {

  if(isset($type)) :

  extract(shortcode_atts(array(
        'type' => $type,
     ), $type));

  else :

  $type = 'other';

  endif;


  ob_start();
  echo '<div class="staff-list type-'.$type.'">';
  include get_stylesheet_directory().'/template_parts/page/staff/dentists.php';
  echo '</div>';
  return ob_get_clean();

}
add_shortcode('staff', 'staff_code');

// Dentists

function ortho_code() {

  ob_start();
  echo '<div class="staff-list">';
  get_template_part('template_parts/page/staff/orthodontists');
  echo '</div>';
  return ob_get_clean();

}

//add_shortcode('orthodontists', 'ortho_code');
