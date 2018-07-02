<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lsd
 */

 ///PHP HEX COLOR ADJUSTER
 function adjustBrightness($hex, $steps) {
     // Steps should be between -255 and 255. Negative = darker, positive = lighter
     $steps = max(-255, min(255, $steps));

     // Normalize into a six character long hex string
     $hex = str_replace('#', '', $hex);
     if (strlen($hex) == 3) {
         $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
     }

     // Split into three parts: R, G and B
     $color_parts = str_split($hex, 2);
     $return = '#';

     foreach ($color_parts as $color) {
         $color   = hexdec($color); // Convert to decimal
         $color   = max(0,min(255,$color + $steps)); // Adjust color
         $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
     }

     return $return;
 }

 function user_icon() {
   echo '<?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 22.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 78.7 78.7" style="enable-background:new 0 0 78.7 78.7;" xml:space="preserve">
<style type="text/css">
	.st0{fill:#FFFFFF;}
</style>
<g>
	<g>
		<path d="M40.6,76.4c-0.7,0-1.3,0-2,0c-0.1,0-0.2-0.1-0.3-0.1c-2.7-0.1-5.3-0.4-7.9-1.1c-11.2-3-19.4-9.7-24.5-20.1
			c-3.7-7.5-4.7-15.5-3-23.8c2.1-10.3,7.7-18.3,16.4-24.1C24.4,3.9,30.1,2,36.2,1.5c0.5,0,1-0.1,1.4-0.2c1.3,0,2.6,0,3.9,0
			c0.1,0,0.2,0.1,0.3,0.1C43.4,1.6,45,1.7,46.5,2C54.4,3.5,61.3,7.1,66.8,13c8.8,9.5,12,20.7,9.6,33.3c-1.9,9.8-7.2,17.6-15.4,23.4
			c-5.5,3.9-11.7,6.1-18.5,6.6C41.9,76.3,41.2,76.4,40.6,76.4z M16.6,60.8c0.1-0.1,0.1-0.2,0.1-0.3c0.9-1.2,2.2-1.9,3.6-2.3
			c2.4-0.7,4.9-1.4,7.3-2c1.2-0.3,2.4-0.7,3.5-1.5c1.4-1,1.9-2.3,1.5-4c-0.2-0.9-0.6-1.8-1-2.6c-1.3-2.7-2.5-5.4-3.3-8.3
			c-0.8-2.9-1.2-5.8-0.7-8.7c0.5-2.7,1.6-5.1,3.7-6.9c3.1-2.7,6.7-3.7,10.7-3c4.4,0.8,7.4,3.3,9,7.5c1,2.7,1.1,5.5,0.5,8.3
			c-0.7,3.6-2,7-3.4,10.3c-0.5,1-1,2.1-1.3,3.2c-0.6,1.7,0,3.1,1.4,4.1c0.5,0.4,1.1,0.7,1.7,1c2.1,1,4.5,1.5,6.7,2.1
			c2.2,0.5,4.4,1,5.9,2.8c0.1,0.2,0.3,0.2,0.5,0c0.5-0.6,1-1.1,1.4-1.6c6-7.7,8.2-16.4,6.4-26c-1.2-6.6-4.4-12.3-9.3-16.9
			c-7.7-7.2-16.9-9.9-27.3-8.2c-6.8,1.1-12.6,4.3-17.4,9.3C10,23.9,7.1,32.3,8,42c0.5,5.7,2.5,10.9,5.9,15.5
			C14.7,58.6,15.6,59.7,16.6,60.8z"/>
		<path class="st0" d="M37.6,1.3c-0.5,0.1-1,0.1-1.4,0.2C30.1,2,24.4,3.9,19.3,7.3C10.5,13.1,4.9,21.1,2.8,31.4
			c-1.7,8.2-0.7,16.2,3,23.8c5.1,10.4,13.4,17.1,24.5,20.1c2.6,0.7,5.2,1,7.9,1.1c0.1,0,0.2,0,0.3,0.1c-12.2,0-24.4,0-36.6,0
			c0-25,0-50.1,0-75.1C13.9,1.3,25.8,1.3,37.6,1.3z"/>
		<path class="st0" d="M40.6,76.4c0.6-0.1,1.3-0.1,1.9-0.2c6.8-0.5,12.9-2.7,18.5-6.6c8.2-5.8,13.5-13.5,15.4-23.4
			c2.4-12.6-0.8-23.8-9.6-33.3C61.3,7.1,54.4,3.5,46.5,2c-1.5-0.3-3.1-0.4-4.7-0.6c-0.1,0-0.2,0-0.3-0.1c11.9,0,23.8,0,35.6,0
			c0,25,0,50.1,0,75.1C65,76.4,52.8,76.4,40.6,76.4z"/>
		<path class="st0" d="M16.6,60.8c-0.9-1.2-1.9-2.2-2.7-3.3C10.5,52.9,8.5,47.7,8,42c-0.8-9.6,2-18.1,8.7-25.1
			c4.7-5,10.6-8.2,17.4-9.3c10.4-1.7,19.6,1,27.3,8.2c5,4.6,8.1,10.3,9.3,16.9c1.8,9.6-0.4,18.3-6.4,26c-0.4,0.6-0.9,1.1-1.4,1.6
			c-0.2,0.2-0.4,0.2-0.5,0c-1.5-1.9-3.7-2.3-5.9-2.8c-2.3-0.6-4.6-1-6.7-2.1c-0.6-0.3-1.2-0.6-1.7-1c-1.5-1-2-2.4-1.4-4.1
			c0.4-1.1,0.9-2.1,1.3-3.2c1.5-3.3,2.8-6.7,3.4-10.3c0.5-2.8,0.5-5.6-0.5-8.3c-1.6-4.2-4.7-6.7-9-7.5c-4-0.7-7.6,0.2-10.7,3
			c-2.1,1.8-3.2,4.2-3.7,6.9c-0.5,3,0,5.9,0.7,8.7c0.8,2.9,2,5.6,3.3,8.3c0.4,0.8,0.8,1.7,1,2.6c0.4,1.6-0.2,3-1.5,4
			c-1,0.8-2.2,1.2-3.5,1.5c-2.4,0.7-4.9,1.4-7.3,2c-1.4,0.4-2.7,1.1-3.6,2.3C16.6,60.6,16.6,60.7,16.6,60.8z"/>
	</g>
</g>
</svg>';
 }

 function wpdocs_theme_add_editor_styles() {
     add_editor_style(  'editor-style.css' );
 }
 add_action( 'init', 'wpdocs_theme_add_editor_styles' );

 // Callback function to insert 'styleselect' into the $buttons array
function sfhs_tinymce_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'sfhs_tinymce_buttons');

// Callback function to filter the MCE settings
function sfhs_tinymce_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => 'Lead',
			'selector' => 'p',
			'classes' => 'lead'
		),
	);
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'sfhs_tinymce_formats' );


//* Move Yoast metabox to bottom
	add_filter( 'wpseo_metabox_prio', 'metaboxbottom');
	function metaboxbottom() {
		return 'low';
	}

add_image_size( 'gallery-size', 700, 475, true );

add_filter( 'image_size_names_choose', 'my_custom_sizes' );

function my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'gallery-size' => __( 'Gallery Size' ),
    ) );
}

/**
 * Set up the new field in the media module.
 *
 * @return void
 */
function additional_gallery_settings() {
  ?>

    <script type="text/html" id="tmpl-custom-gallery-setting">
        <span>Style</span>
        <select data-setting="style">
            <option value="default">Default</option>
            <option value="carousel">Carousel</option>
        </select>
    </script>

    <script type="text/javascript">
        jQuery( document ).ready( function() {
            _.extend( wp.media.gallery.defaults, {
                style: 'default'
            } );

            wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend( {
                template: function( view ) {
                    return wp.media.template( 'gallery-settings' )( view )
                         + wp.media.template( 'custom-gallery-setting' )( view );
                }
            } );
        } );
    </script>

  <?php
}
add_action( 'print_media_templates', 'additional_gallery_settings' );

/**
 * HTML Wrapper - Support for a custom class attribute in the native gallery shortcode
 *
 * @param string $html
 * @param array $attr
 * @param int $instance
 *
 * @return $html
 */
function customize_gallery_abit( $html, $attr, $instance ) {

    if( isset( $attr['style'] ) && $style = $attr['style'] ) {
        // Unset attribute to avoid infinite recursive loops
        unset( $attr['style'] );

        // Our custom HTML wrapper
        $html = sprintf(
            '<div class="gallery-wrapper-%s">%s</div>',
            esc_attr( $style ),
            gallery_shortcode( $attr )
        );
    }

    return $html;
}
add_filter( 'post_gallery', 'customize_gallery_abit', 10, 3 );


// custom body classes
function swim_custom_body_classes($classes_formatted)
{
    // the list of WordPress global browser checks
    // https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    // check the globals to see if the browser is in there and return a string with the match
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));
    foreach ($classes as $class) {
      $classes_formatted[] = str_replace('is_','',$class);
    }
    return $classes_formatted;
}
// call the filter for the body class
add_filter('body_class', 'swim_custom_body_classes');



/**
 * Get custom headers
 *
 * @link    http://wordpress.stackexchange.com/q/151850/1685
 *
 * @return  string
 */
function lsd_get_random_header_image() {

  $headers = get_uploaded_header_images();
  shuffle($headers);

  $header = array_pop($headers);
  $header = $header['url'];
  return $header;

}
