<?php
/**
 * lsd Customizer Class
 *
 * @author   benluoma
 * @package  lsd
 * @since    2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'LSD_Customizer' ) ) :

	/**
	 * The lsd Customizer class
	 */
	class LSD_Customizer {

		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			add_action( 'customize_register',              array( $this, 'customize_register' ) );
			add_action( 'after_setup_theme',               array( $this, 'custom_header_setup' ) );
			add_action( 'wp_head', 												 array( $this, 'lsd_customizer_css' ) );
		}

		/**
		 * Setup the WordPress core custom header feature.
		 *
		 */
		public function custom_header_setup() {
			add_theme_support( 'custom-header', apply_filters( 'lsd_custom_header_args', array(
				'default-image' => '',
				'header-text'   => false,
				'width'         => 1950,
				'height'        => 500,
				'flex-width'    => true,
				'flex-height'   => true,
			) ) );
		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer along with several other settings.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 * @since  1.0.0
		 */
		public function customize_register( $wp_customize ) {

			// Add Design section
			$wp_customize->add_panel( 'lsd_design',
				 array(
						'title' => 'Design',
						'priority' => 80,
						 )
				 );

				 /**
	 			 * Adding typography panel
	 			 */
	 			$wp_customize->add_section( 'lsd_typography', array(
	             'title'          => 'Typography',
							 'panel'				=> 'lsd_design',
	             'priority'       => 80,
	         ) );

					 $wp_customize->add_section( 'lsd_ui', array(
	 	             'title'          => 'UI',
	 							 'panel'				=> 'lsd_design',
	 	             'priority'       => 80,
	 	         ) );

						 //ui style
			  		 $wp_customize->add_setting(
			  			 'lsd_ui_style',
			  			 array(
			  					'default' => 'round'
			  			 )
			  		 );

			  		 $wp_customize->add_control('lsd_ui_style', array(
			  				 'label' => 'UI Style',
			 				 'description' => 'Style for buttons, inputs and other elements.',
			  				 'section' => 'lsd_ui',
			  				 'priority' => 20,
			  				 'type' => 'select',
			  					 'choices'        => array(
			  						'round'  => __( 'Round' ),
			  						'square'  => __( 'Square' ),
			 						'geometric'  => __( 'Geometric' ),
			  					 )
			  			 )
			  		 );

	 				// Add a Google Font control
	 	        require_once dirname(__FILE__) . '/controls/class-google-font.php';
	 	        $wp_customize->add_setting( 'headings_font', array(
	 	            'default'        => '',
	 	        ) );
	 	        $wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize, 'headings_font', array(
	 							'label' => 'Headings Font',
	 					 		'description' => 'Google font for headings and buttons.',
	 	            'section' => 'lsd_typography',
	 	            'priority' => 12
	 	        ) ) );
	 					$wp_customize->add_setting( 'body_font', array(
	 	            'default'        => '',
	 	        ) );
	 					$wp_customize->add_control( new Google_Font_Dropdown_Custom_Control( $wp_customize, 'body_font', array(
	 							'label' => 'Body Font',
	 					 		'description' => 'Google font for paragraphs and navigation.',
	 	            'section' => 'lsd_typography',
	 	            'priority' => 13
	 	        ) ) );

	 					//type scale
	 					 $wp_customize->add_setting(
	 						 'lsd_type_scale',
	 				     array(
	 				        'default' => 'normal'
	 				     )
	 					 );

	 					 $wp_customize->add_control('lsd_type_scale', array(
	 					     'label' => 'Type Scale',
	 							 'description' => 'Choose the size for your text.',
	 					     'section' => 'lsd_typography',
	 							 'priority' => 14,
	 							 'type' => 'select',
	 		            'choices'        => array(
	 									'fine'  => __( 'Fine' ), //14px
	 									'normal'  => __( 'Normal' ), //16px
										'big'  => __( 'Big' ), //18px
	 									'oversize'   => __( 'Oversized' ), //20px
	 		            )
	 					   )
	 					 );


					// Setup Sections/Panels
					$wp_customize->get_section('colors')->panel = 'lsd_design';
$wp_customize->get_section('colors')->priority = 90;

					/**
					 * Custom theme colors
					 */


					 //Adding color

					 /*
					 $wp_customize->add_setting( 'page_color' , array(
								'default'     => '',
								'transport'   => 'refresh',
						) );
*/
					$wp_customize->add_setting( 'primary_color' , array(
							'default'     => '',
							'transport'   => 'refresh',
					) );

					$wp_customize->add_setting( 'link_color' , array(
							'default'     => '',
							'transport'   => 'refresh',
					) );

					$wp_customize->add_setting( 'text_color' , array(
							'default'     => '',
							'transport'   => 'refresh',
					) );

					$wp_customize->add_setting( 'accent_color' , array(
							'default'     => '',
							'transport'   => 'refresh',
					) );

					//Adding control
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_color', array(
						'label'       => __( 'Page Color', 'lsd' ),
						'section'     => 'colors',
					) ) );

					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color', array(
						'label'       => __( 'Primary Color', 'lsd' ),
						'section'     => 'colors',
					) ) );

					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
						'label'       => __( 'Accent Color', 'lsd' ),
						'section'     => 'colors',
					) ) );

					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text_color', array(
						'label'       => __( 'Text Color', 'lsd' ),
						'section'     => 'colors',
					) ) );

					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
						'label'       => __( 'Link Color', 'lsd' ),
						'section'     => 'colors',
					) ) );



					// Add Layout section
					$wp_customize->add_panel( 'lsd_layout',
							array(
								'title' => 'Layout',
								'priority' => 80,
									 )
							);



			// Setup Sections/Panels
			//$wp_customize->get_section('header_image')->title = __( 'Header' );
			//$wp_customize->get_section('header_image')->panel = 'lsd_layout';

			//$wp_customize->get_section('background_image')->title = __( 'Content' );
			//$wp_customize->get_section('background_image')->panel = 'lsd_layout';

			// Add Footer section
			$wp_customize->add_section( 'lsd_header',
				 array(
						'title' => 'Header',
						'panel' => 'lsd_layout',
						'priority' => 80,
						 )
				 );

				 // Add Footer section
	 			$wp_customize->add_section( 'lsd_content',
	 				 array(
	 						'title' => 'Content',
	 						'panel' => 'lsd_layout',
	 						'priority' => 80,
	 						 )
	 				 );

			// Add Footer section
			$wp_customize->add_section( 'lsd_footer',
				 array(
						'title' => 'Footer',
						'panel' => 'lsd_layout',
						'priority' => 80,
						 )
				 );



					 //footer
			 		 $wp_customize->add_setting(
			 			 'lsd_footer_layout',
			 			 array(
			 					'default' => 'left'
			 			 )
			 		 );

			 		 $wp_customize->add_control('lsd_footer_layout', array(
			 				 'label' => 'Footer Layout',
			 				 'section' => 'lsd_footer',
			 				 'type' => 'select',
			 				 'priority' => 1,
			 					'choices'        => array(
			 						'default'  => __( 'Default' ),
			 						'stacked'   => __( 'Stacked' ),
			 					)
			 			 )
			 		 );


			//header layout
			 $wp_customize->add_setting(
				 'lsd_header_layout',
		     array(
		        'default' => 'right'
		     )
			 );

			 $wp_customize->add_control('lsd_header_layout', array(
			     'label' => 'Header Layout',
			     'section' => 'lsd_header',
					 'type' => 'select',
					 'priority' => 1,
            'choices'        => array(
							'right'  => __( 'Right' ),
							'left'  => __( 'Left' ),
							'center'   => __( 'Center' ),
            )
			   )
			 );

			 //fixed Header
			 $wp_customize->add_setting(
 		 			'lsd_fixed_header',
 		 			array(
 		 				'default' => 0,
 		 			)
 		 	);

 		 	$wp_customize->add_control(
 		 		'lsd_fixed_header',
 		 		array(
 		 			'type' => 'checkbox',
 		 			'priority' => 2,
 		 			'section' => 'lsd_header',
 		 			'label' => __( 'Fixed Header', 'lsd' ),
 		 			'description' => '',
 		 		)
 		 	);

			//header layout
			 $wp_customize->add_setting(
				 'lsd_mobile_menu_type',
		     array(
		        'default' => 'bottom'
		     )
			 );

			 $wp_customize->add_control('lsd_mobile_menu_type', array(
			     'label' => 'Mobile Menu Collapse',
			     'section' => 'lsd_header',
					 'priority' => 3,
					 'type' => 'select',
            'choices'        => array(
							'top'  => __( 'Top' ),
							//'right'  => __( 'Right' ),
							'bottom'  => __( 'Bottom' ),
							//'left'  => __( 'Left' ),
							//'full'	=> __( 'Full' ),
            )
			   )
			 );

			 //body layout
			 /*
 			 $wp_customize->add_setting(
 				 'lsd_general_layout',
 		     array(
 		        'default' => 'full'
 		     )
 			 );

 			 $wp_customize->add_control('lsd_general_layout', array(
 			     'label' => 'Content Layout',
 			     'section' => 'lsd_content',
 					 'priority' => 1,
 					 'type' => 'select',
             'choices'        => array(
 							'full'  => __( 'Full Width' ),
 							'framed'  => __( 'Framed' ),
             )
 			   )
 			 );
			 */

			 //sidebar
			 $wp_customize->add_setting(
 		 			'lsd_sidebar',
 		 			array(
 		 				'default' => 0,
						'label' => 'Content Layout'
 		 			)
 		 	);

 		 	$wp_customize->add_control(
 		 		'lsd_sidebar',
 		 		array(
 		 			'type' => 'checkbox',
 		 			'priority' => 2,
 		 			'section' => 'lsd_content',
 		 			'label' => __( 'Add Sidebar', 'lsd' ),
 		 			'description' => '',
 		 		)
 		 	);


			/**
			 * Tagline display settings
			 */


		 	$wp_customize->add_setting(
		 			'lsd_show_tagline',
		 			array(
		 				'default' => 0,
		 				'type' => 'theme_mod',
		 				'capability' => 'edit_theme_options',
		 				'transport' => 'refresh',
		 			)
		 	);

		 	$wp_customize->add_control(
		 		'lsd_show_tagline',
		 		array(
		 			'type' => 'checkbox',
		 			'priority' => 10,
		 			'section' => 'title_tagline',
		 			'label' => __( 'Display Tagline', 'lsd' ),
		 			'description' => '',
		 		)
		 	);


			$wp_customize->add_setting('footer_logo', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			));

			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
				'label' => __( 'Footer Logo', 'base' ),
				'section' => 'title_tagline',
				'priority' => 8,
				'settings' => 'footer_logo',
				))
			);


		 $wp_customize->add_setting(
				 'lsd_show_tagline',
				 array(
					 'default' => 0,
					 'type' => 'theme_mod',
					 'capability' => 'edit_theme_options',
					 'transport' => 'refresh',
				 )
		 );


			/**
			 * Contact info settings (used in Contact Info widget)
			 */

			 $wp_customize->add_panel( 'locations', array(
					 'priority' => 50,
					 'capability' => 'edit_theme_options',
					 'theme_supports' => '',
					 'title' => __( 'Locations', 'lsd' ),
					 'description' => __( 'Location information.', 'lsd' ),
			 ) );

			 $wp_customize->add_section( 'duluth', array(
					 'priority' => 10,
					 'capability' => 'edit_theme_options',
					 'theme_supports' => '',
					 'title' => __( 'Duluth', 'lsd' ),
					 'description' => '',
					 'panel' => 'locations',
			 ) );

			 $wp_customize->add_section( 'two_harbors', array(
					 'priority' => 10,
					 'capability' => 'edit_theme_options',
					 'theme_supports' => '',
					 'title' => __( 'Two Harbors', 'lsd' ),
					 'description' => '',
					 'panel' => 'locations',
			 ) );


			 // D-TOWN

			 $wp_customize->add_setting( 'duluth_address', array(
			 'default' => '',
			 'type' => 'theme_mod',
			 'capability' => 'edit_theme_options',
			 'transport' => 'refresh',
			// 'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'duluth_address', array(
					'type' => 'textarea',
					'priority' => 10,
					'section' => 'duluth',
					'label' => __( 'Address', 'lsd' ),
					'description' => '',
			) );


			$wp_customize->add_setting( 'duluth_phone', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			//'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'duluth_phone', array(
			 'type' => 'text',
			 'priority' => 10,
			 'section' => 'duluth',
			 'label' => __( 'Phone', 'lsd' ),
			 'description' => '',
			) );

			$wp_customize->add_setting( 'duluth_hours', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
		//	'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'duluth_hours', array(
			 'type' => 'textarea',
			 'priority' => 10,
			 'section' => 'duluth',
			 'label' => __( 'Hours', 'lsd' ),
			 'description' => '',
			) );

			// SUP TOWN

			$wp_customize->add_setting( 'two_harbors_address', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => '',
			//'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'two_harbors_address', array(
			 'type' => 'textarea',
			 'priority' => 10,
			 'section' => 'two_harbors',
			 'label' => __( 'Address', 'lsd' ),
			 'description' => '',
			) );


			$wp_customize->add_setting( 'two_harbors_phone', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport' => 'refresh',
			//'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'two_harbors_phone', array(
			'type' => 'text',
			'priority' => 10,
			'section' => 'two_harbors',
			'label' => __( 'Phone', 'lsd' ),
			'description' => '',
			) );

			$wp_customize->add_setting( 'two_harbors_hours', array(
			'default' => '',
			'type' => 'theme_mod',
			'capability' => 'edit_theme_options',
	    'transport' => 'refresh',
		//	'sanitize_callback' => 'sanitize_text',
			) );

			$wp_customize->add_control( 'two_harbors_hours', array(
			'type' => 'textarea',
			'priority' => 10,
			'section' => 'two_harbors',
			'label' => __( 'Hours', 'lsd' ),
			'description' => '',
			) );




			 /*
			$wp_customize->add_setting(
					'lsd_address',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);


			$wp_customize->add_control(
				'lsd_address',
				array(
					'type' => 'textarea',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Address', 'lsd' ),
					'description' => '',
				)
			);

			$wp_customize->add_setting(
					'lsd_phone',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'lsd_phone',
				array(
					'type' => 'text',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Phone', 'lsd' ),
					'description' => '',
				)
			);

			$wp_customize->add_setting(
					'lsd_email',
					array(
						'default' => '',
						'type' => 'theme_mod',
						'capability' => 'edit_theme_options',
						'transport' => 'refresh',
					)
			);

			$wp_customize->add_control(
				'lsd_email',
				array(
					'type' => 'text',
					'priority' => 11,
					'section' => 'title_tagline',
					'label' => __( 'Email', 'lsd' ),
					'description' => '',
				)
			); */



		}

		/**
		 * Add customizer css to doc head
		 *
		 */
		public function lsd_customizer_css() { ?>
			<style type="text/css">

			<?php
			switch (get_theme_mod('lsd_type_scale')) {
			    case 'fine':
			       	echo 'html { font-size: 14px }';
			        break;
			    case 'big':
			        echo 'html { font-size: 18px }';
			        break;
					case 'oversize':
					    echo 'html { font-size: 20px }';
					    break;
			    default:
			        break;
			}

			 ?>

			<?php
			$fontCheck = array(
				'Helvetica',
				'Georgia',
				'Courier'
			);

			if (get_theme_mod('headings_font')) :
				$headings_font = get_theme_mod('headings_font');
        $headings_name = str_replace(' ', '+', $headings_font);
				if ( !in_array($headings_font,$fontCheck) ) {
				    echo '@import url("https://fonts.googleapis.com/css?family=' . $headings_name . ':300,300i,400,400i,600,600i");';
				}
				?>

				h1,
				h2,
				h3,
				.btn,
				.site-title {
					font-family: <?php echo '"'. $headings_font . '"'; ?>;
				}
			<?php endif; ?>

			<?php if (get_theme_mod('body_font')) :
        $body_font = get_theme_mod('body_font');
        $body_name = str_replace(' ', '+', $body_font);
				if (!in_array($body_font,$fontCheck)) {
				    echo '@import url("https://fonts.googleapis.com/css?family=' . $body_name . ':300,300i,400,400i,600,600i");';
				}
				?>

				body,
				h1 small,
				h2 small {
					font-family: <?php echo '"'. $body_font . '"'; ?>;
				}
			<?php endif; ?>
									/* TODO: Get Background Color in here */
		    <?php if (get_theme_mod('primary_color')) : ?>
									/* Button Background Color */
									button,
									input[type='button'],
									input[type='reset'],
									input[type='submit'],
									.btn,
									.button,
									.cat-link,
									.widget_tag_cloud a {
										background-color: <?php echo get_theme_mod('primary_color'); ?>;
									}
								@media (max-width: 1023px) {
									.site-navigation {
										background-color: <?php echo get_theme_mod('primary_color'); ?>;
									}
									.main-menu li:hover {
										background-color: <?php echo adjustBrightness(get_theme_mod('primary_color'), -50); ?>;
									}
								}

									button:hover,
									input[type='button']:hover,
									input[type='reset']:hover,
									input[type='submit']:hover,
									.btn:hover,
									.button:hover,
									.cat-link:hover,
									.widget_tag_cloud a:hover {
										background-color: <?php echo adjustBrightness(get_theme_mod('primary_color'), -50); ?>;
									}

					<?php endif; ?>

		      <?php if (get_theme_mod('link_color')) : ?>
									/* Link Color */
									a,
									a:visited,
									.main-menu li > a,
									.main-menu li > a:visited,
									.search-submit {
										color: <?php echo get_theme_mod('link_color'); ?>;
									}

									a:hover,
									.main-menu li > a:hover,
									.search-submit {
										color: <?php echo adjustBrightness(get_theme_mod('link_color'), -50); ?>;
									}

									.main-menu li.current-menu-item > a,
									.main-menu li.current-menu-ancestor > a,
									.search-submit:hover {
										color: <?php echo adjustBrightness(get_theme_mod('link_color'), -100); ?>;
									}
					<?php endif; ?>

		      <?php if (get_theme_mod('text_color')) : ?>
									/* Main Text Color */
									body {
										color: <?php echo get_theme_mod('text_color'); ?>;
									}
				  <?php endif; ?>

					<?php if (get_theme_mod('accent_color')) : ?>
									/* Secondary Text Color */
									h4,
									h5,
									h6,
									.site-description,
									.widget-title,
									.specimen-title {
										color: <?php echo get_theme_mod('accent_color'); ?> !important;
									}
									.onsale {
										background-color: <?php echo get_theme_mod('accent_color'); ?> !important;
									}
					<?php endif; ?>

					<?php if ( (bool) get_theme_mod('lsd_show_tagline') == FALSE ) : ?>
						.site-description {
							clip: rect(1px, 1px, 1px, 1px);
							position: absolute;
						}
					<?php endif; ?>

			</style>
		<?php }

	}



endif;


return new LSD_Customizer();
