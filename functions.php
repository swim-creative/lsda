<?php
/**
 * components functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lsd
 */

/**
 * Assign the lsd version to a var
 */
$theme            = wp_get_theme();
$lsd_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
 $content_width = 1280; /* pixels */
}

$lsd = (object) array(
	'version' => $lsd_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-theme.php',
	'customizer' => require 'inc/customizer/class-customizer.php',
  'cpt'        => require 'inc/class-cpt.php',
);

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load custom widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load custom shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load custom hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Load Jetpack compatibility file.
 */
if ( class_exists( 'Jetpack' ) ) {
	$lsd->jetpack = require 'inc/jetpack/class-jetpack.php';
}

/**
 * Load acf compatibility file.
 */
if ( class_exists( 'acf' ) ) {
	$lsd->acf = require 'inc/acf/acf.php';
}

/**
 * Custom post types & taxonomies
 */
if ( class_exists( 'CPT' ) ) {
  //cpt
  $work = new CPT(
    array(
      'post_type_name' => 'Staff',
      'singular' => 'Staff',
      'plural' => 'Staff',
      'slug' => 'staff'
    ),
    array(
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_icon' => 'dashicons-groups',
      'publicly_queryable' => false,
      'hierarchical' => true,
    )
  );

}

function create_private_type_tax()
{
    register_taxonomy(
        'staff-type',
        'staff',
        array(
            'label' => __('Staff Type'),
            'public' => true,
            'rewrite' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
        )
    );
}

add_action('init', 'create_private_type_tax');

// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	//unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	//unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

//add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_filter( 'manage_staff_posts_columns', 'wpse_135433_posts_columns' );
add_action( 'manage_staff_posts_custom_column', 'wpse_135433_posts_custom_columns', 10, 2 );

function wpse_135433_posts_columns( $defaults ){

    $defaults = array_merge(
        array( 'riv_post_thumbs' => __( 'Photo' ) ),
        $defaults
    );

    return $defaults;
}

function wpse_135433_posts_custom_columns( $column_name, $id ) {

   if ( $column_name === 'riv_post_thumbs' ) {
        echo the_post_thumbnail( 'thumbnail');
    }
}

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .column-riv_post_thumbs {
      width:120px;
    }
      .column-riv_post_thumbs img {
        max-width:100px;
        height:auto;
      }
  </style>';
}

// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
	global $typenow;
	$post_type = 'staff'; // change to your post type
	$taxonomy  = 'staff-type'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}s"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}
/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'staff'; // change to your post type
	$taxonomy  = 'staff-type'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}
