<div class="site-contact">
	<?php
	if (get_theme_mod('footer_logo') !='') {
		echo '<a href="/" class="custom-logo-link"><img src="'.get_theme_mod('footer_logo').'"/></a>';
	} else {
  if(has_custom_logo()) {
  	echo get_custom_logo() . '<br>';
  } else {
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="contact-info-title">' . get_bloginfo('name') . '</span></a><br>';
  	}
	}

	$address = nl2br(get_theme_mod('lsd_address'));
	if ($address != '') {
		echo '<span class="contact-info-address">' . $address . '</span><br>';
	}
	if (get_theme_mod('lsd_phone') != '') {
		echo '<span class="contact-info-phone"><abbr title="Phone Number">PH</abbr>: <a href="tel:' . get_theme_mod('lsd_phone'). '">' . get_theme_mod('lsd_phone') . '</a></span><br>';
	}
	if (get_theme_mod('lsd_email') !='' ) {
		echo '<span class="contact-info-email"><abbr title="Email Address">E</abbr>: <a href="mailto:' . get_theme_mod('lsd_email'). '">' . get_theme_mod('lsd_email') . '</a></span>';
	}
	?>
</div><!-- .site-contact -->

<?php

//GET ADDRESS LINE BY LINE
/*
$address = '';
$lines = explode("\n", get_theme_mod('lsd_address'));
$i = 1;
foreach ($lines as $line) {
  if($i == 1) {
    $address .= '<span>'.$line.'</span>';
  } else {
    $address .= '<br><span>'.$line.'</span>';
  }
  $i++;
}
*/

?>
