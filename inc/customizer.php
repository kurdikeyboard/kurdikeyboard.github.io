<?php
/**
 * Glow Theme Customizer.
 *
 * @package Glow
 */

function glow_not_slider_full_screen(){
    return ( get_theme_mod( 'home_featured_full_screen' ) == 1 ) ? false : true;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function glow_customize_register( $wp_customize ) {
//	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Load custom controls
	require get_template_directory() . '/inc/customizer-controls.php';

	// Primary Color
	$wp_customize->add_setting( 'glow_primary_color', array(
		'default' 			     => '#fa7921',
		'capability' 			 => 'edit_theme_options',
		'sanitize_callback'		 => 'glow_color_sanitize',
		'sanitize_js_callback'   => 'glow_color_escaping_sanitize'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'glow_primary_color', array(
		'priority' 				 => 10,
		'label' 				 => esc_html__( 'Primary Color', 'glow' ),
		'section' 				 => 'colors',
		'settings' 				 => 'glow_primary_color'
	) ) );

	// Home Page Featured posts
	$wp_customize->add_section( 'home_featured_posts', array(
			'title' 			=> esc_html__( 'Home Page Slider', 'glow' )
	));

	$wp_customize->add_setting( 'home_featured_posts', array(
			'default' 			=> '',
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'glow_checkbox_sanitize'
	));

	$wp_customize->add_control( 'home_featured_posts', array(
			'type' 				=> 'checkbox',
			'label' 			=> esc_html__( 'Check to enable featured posts', 'glow' ),
			'settings' 			=> 'home_featured_posts',
			'section' 			=> 'home_featured_posts'
	));

	$cats = array();
	foreach ( get_categories() as $categories => $category ){
		$cats[$category->term_id] = $category->name;
	}

	$wp_customize->add_setting( 'home_featured_posts_select', array(
		'default' => 1,
		'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( 'home_featured_posts_select', array(
		'type'      => 'select',
		'label' 	=> esc_html__( 'Select Category', 'glow' ),
		'choices'   => $cats,
		'settings'  => 'home_featured_posts_select',
		'section'   => 'home_featured_posts'
	) );

    $wp_customize->add_setting( 'dt_slide_number', array(
        'default' 			=> '3',
        'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'glow_sanitize_integer'
    ));

    $wp_customize->add_control( 'dt_slide_number', array(
        'type'			 	=> 'number',
        'label' 			=> esc_html__( 'No. of Slide', 'glow' ),
        'section'			=> 'home_featured_posts',
        'settings' 			=> 'dt_slide_number'
    ));

   

    $wp_customize->add_setting( 'home_slider_pt', array(
        'default' 			=> '10',
        'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',

    ));
    $wp_customize->add_control( 'home_slider_pt', array(
        'type'			 	=> 'text',
        'label' 			=> esc_html__( 'Padding top (%)', 'glow' ),
        'section'			=> 'home_featured_posts',
        'active_callback' => 'glow_not_slider_full_screen'
    ));


    $wp_customize->add_setting( 'home_slider_bt', array(
        'default' 			=> '10',
        'capability' 		=> 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',

    ));
    $wp_customize->add_control( 'home_slider_bt', array(
        'type'			 	=> 'number',
        'label' 			=> esc_html__( 'Padding bottom (%)', 'glow' ),
        'section'			=> 'home_featured_posts',
        'active_callback' => 'glow_not_slider_full_screen'
    ));

    //Panel theme options
    $wp_customize->add_panel('theme_options', array(
        'title' => esc_html__('Theme Options', 'glow')
    ));

    // Nav Button
    $wp_customize->add_section('navigation_button', array(
        'title' => esc_html__('Navigation Button', 'glow'),
        'panel' => 'theme_options',
        'priority' => 25
    ));

    $wp_customize->add_setting('nav_button_show', array(
        'default' => '1',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('nav_button_show', array(
        'label' => esc_html__('Display Navigation Button', 'glow'),
        'section' => 'navigation_button',
        'type' => 'checkbox',
    ));


    $wp_customize->add_setting('nav_button_label', array(
        'default' => esc_html__('Book an appointment', 'glow'),
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('nav_button_label', array(
        'label' => esc_html__('Navigation Button Label', 'glow'),
        'section' => 'navigation_button',
    ));

    $wp_customize->add_setting('nav_button_url', array(
        'default' => '#',
        'sanitize_callback' => 'wp_kses_post',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('nav_button_url', array(
        'label' => esc_html__('Navigation Button URL', 'glow'),
        'section' => 'navigation_button',
    ));


	/* Footer settings */
	$wp_customize->add_section('footer', array(
		'title' => esc_html__('Footer', 'glow'),
		'panel' => 'theme_options',
		'priority' => 120
	));
   
	    $wp_customize->add_setting( 'footer_credit', array(
		    'sanitize_callback' => 'sanitize_text_field',
	    ) );
	    $wp_customize->add_control(
		    new Glow_Group_Settings_Heading_Control(
			    $wp_customize,
			    'footer_credit',
			    array(
				    'label'      => esc_html__( 'Footer Settings', 'glow' ),
				    'description' => sprintf( esc_html__( 'Upgrade to %1$s to change footer copyright and credit.', 'glow' ), '<a href="https://www.famethemes.com/themes/glow-pro/#download_pricing">'.esc_html__( 'Glow Pro version', 'glow' ).'</a>' ),
				    'section'    => 'footer',
				    'type'    => 'group_heading_message',
			    )
		    )
	    );
    



		$wp_customize->add_section( 'glow_premium' ,
			array(
				'title'       => esc_html__( 'Upgrade to Glow Pro', 'glow' ),
				'description' => '',
				'priority'  => 215,
			)
		);
		$wp_customize->add_setting( 'glow_premium_features', array(
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new Glow_Group_Settings_Heading_Control(
				$wp_customize,
				'glow_premium_features',
				array(
					'label'      => esc_html__( 'Glow Pro Features', 'glow' ),
					'description'   => '<span>Advanced Typography</span><span>600+ Google Fonts</span><span>Header Topbar</span><span>Pricing Table</span><span>Gallery Widget</span><span>Footer Copyright Editor</span><span>... and much more </span>',
					'section'    => 'glow_premium',
					'type'    => 'group_heading_message',
				)
			)
		);
		$wp_customize->add_setting( 'glow_premium_links', array(
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control(
			new Glow_Group_Settings_Heading_Control(
				$wp_customize,
				'glow_premium_links',
				array(
					'description'   => '<a target="_blank" class="glow-premium-buy-button" href="https://www.famethemes.com/themes/glow-pro/#download_pricing">Buy Glow Pro Now</a>',
					'section'    => 'glow_premium',
					'type'    => 'group_heading_message',
				)
			)
		);
	

	// Checkbox Sanitize
	function glow_checkbox_sanitize( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	// Color Sanitize
	function glow_color_sanitize( $color ) {
		if ( $unhashed = sanitize_hex_color_no_hash( $color ))
			return '#' . $unhashed;
		return $color;
	}

	// Color Escape Sanitize
	function glow_color_escaping_sanitize( $input ) {
		$input = esc_attr( $input );
		return $input;
	}

	// Number Integer
	function glow_sanitize_integer( $input ) {
		return absint( $input );
	}
}
add_action( 'customize_register', 'glow_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function glow_customize_preview_js() {
	wp_enqueue_script( 'glow_customizer_preview', get_template_directory_uri() . '/js/customizer-live-view.js', array( 'customize-preview', 'customize-selective-refresh' ), false, true );
}
add_action( 'customize_preview_init', 'glow_customize_preview_js' );

function glow_customize_css_settings(){
	wp_register_style( 'glow-customizer-controls',  get_template_directory_uri() . '/css/customizer.css' );
	wp_enqueue_style('glow-customizer-controls');
}
add_action( 'customize_controls_enqueue_scripts', 'glow_customize_css_settings' );

/**
 * Enqueue Inline styles generated by customizer
 */
function glow_customizer_styles() {
    $custom_css = '';
	$get_header_textcolor = get_header_textcolor();

	if ( $get_header_textcolor != '000000' && $get_header_textcolor != '' ) {
        $custom_css .= "
	.site-title a,
	.site-title .site-description,
	.dt-main-menu-scroll .site-title span{
		color: #{$get_header_textcolor};
	}
	";
	}

	$primary_color = sanitize_hex_color_no_hash( get_theme_mod( 'glow_primary_color', '#fa7921' ) );

	if ( $primary_color != '' ) {
        $primary_color = '#'.$primary_color;
        $custom_css .= "
	a:hover,
	.site-title a,
	.dt-main-menu li:hover > a,
	.dt-entry-header h2 span,
	.dt-services-header:hover h3 a,
	.dt-call-to-action-btn a,
	.dt-footer-bar a:hover,
	.dt-pagination-nav a:hover,
	.dt-pagination-nav .current:hover,
	.dt-pagination-nav .current {
		color: {$primary_color};
	}

	.dt-main-menu .menu > li > a:hover,
	.dt-main-menu .menu .current-menu-item > a, 
	.dt-main-menu .menu .current_page_item > a {
		color: {$primary_color} ;
	
	}

	.dt-call-to-action-btn a,
	.dt-opening-hours,
	.dt-pagination-nav a:hover,
	.dt-pagination-nav .current:hover,
	.dt-pagination-nav .current {
		border-color: {$primary_color};
	}

	.sticky article {
		border-color: {$primary_color} !important;
	}

	.dt-featured-post-slider .swiper-button-next:hover,
	.dt-featured-post-slider .swiper-button-prev:hover,
	.dt-services-holder span,
	.dt-call-to-action-btn a:hover,
	.tagcloud a:hover,
	.dt-footer h2 span,
	.dt-about-header h2 span,
	.dt-right-sidebar h2 span,
	.dt-right-sidebar h2 span,
	.dt-right-sidebar .dt-recent-posts h2 span,
	.dt-archive-post .entry-footer a:hover,
	#back-to-top:hover,
	
	.dt-main-menu li li a:hover,
	.dt-main-menu .menu > li > a.btn-book,
	.pricing-area .p_button,
	.btn-theme-primary,
	.btn-theme-primary:hover,
	.btn.button-theme {
		background: {$primary_color};
	}
	@media all and (max-width: 1270px) {
		.dt-main-menu .menu .current-menu-item > a, 
		.dt-main-menu .menu .current_page_item > a,
		.dt-main-menu li li a:hover {
	        color: {$primary_color} !important;
	        background: transparent;
	    }
	    
	    .dt-main-menu-scroll .dt-main-menu .menu > li > a:hover {
	         color: {$primary_color} ;
	    }
	}
	";
	}

    if ( get_theme_mod( 'home_featured_full_screen' ) != 1 ) {
        $slider_padding_top = floatval( get_theme_mod( 'home_slider_pt', 10 ) );
        $slider_padding_bottom = floatval( get_theme_mod( 'home_slider_bt', 10 ) );
        $custom_css .= "
        .dt-front-slider.s-padding .swiper-slide .dt-featured-post-meta  {
            padding-top: {$slider_padding_top}%;
            padding-bottom: {$slider_padding_bottom}%;
        }
        ";
    }

   

	wp_add_inline_style( 'glow-style', $custom_css );
}
