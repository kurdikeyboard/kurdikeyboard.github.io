<?php

$widget_ultimate_url = trailingslashit( get_template_directory_uri().'/inc/widgets/widgets-ultimate/' );
$widget_ultimate_path = trailingslashit( get_template_directory().'/inc/widgets/widgets-ultimate/');
if ( ! class_exists( 'Widget_Ultimate' ) ) {
    include_once $widget_ultimate_path.'inc/init.php';
}
if ( class_exists( 'Widget_Ultimate' ) ) {
    $GLOBALS['Widget_Ultimate'] = new Widget_Ultimate( $widget_ultimate_path, $widget_ultimate_url );

    include_once get_template_directory().'/inc/widgets/widget-social-icons.php';
    include_once get_template_directory().'/inc/widgets/widget-about.php';
    include_once get_template_directory().'/inc/widgets/widget-services.php';
    include_once get_template_directory().'/inc/widgets/widget-testimonial.php';
    include_once get_template_directory().'/inc/widgets/widget-call-to-action.php';
    include_once get_template_directory().'/inc/widgets/widget-recent-posts.php';
    include_once get_template_directory().'/inc/widgets/widget-opening-hour.php';
   

}


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function glow_widgets_init() {

    // Register Right Sidebar
    register_sidebar( array(
        'name'          => __( 'Right Sidebar', 'glow' ),
        'id'            => 'dt-right-sidebar',
        'description'   => __( 'Add widgets to Show widgets at right panel of page', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '<span></span></h2>',
    ) );

   

    // Home Sidebars
    register_sidebar( array(
        'name'          => __( 'Home Page', 'glow' ),
        'id'            => 'dt_home_page',
        'description'   => __( 'Add widgets to Show at Home Page', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );


    // Register Footer Position 1
    register_sidebar( array(
        'name'          => __( 'Footer Position 1', 'glow' ),
        'id'            => 'dt-footer1',
        'description'   => __( 'Add widgets to Show widgets at Footer Position 1', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title"><span></span>',
        'after_title'   => '</h2>',
    ) );

    // Register Footer Position 2
    register_sidebar( array(
        'name'          => __( 'Footer Position 2', 'glow' ),
        'id'            => 'dt-footer2',
        'description'   => __( 'Add widgets to Show widgets at Footer Position 2', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title"><span></span>',
        'after_title'   => '</h2>',
    ) );

    // Register Footer Position 3
    register_sidebar( array(
        'name'          => __( 'Footer Position 3', 'glow' ),
        'id'            => 'dt-footer3',
        'description'   => __( 'Add widgets to Show widgets at Footer Position 3', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title"><span></span>',
        'after_title'   => '</h2>',
    ) );

    // Register Footer Position 4
    register_sidebar( array(
        'name'          => __( 'Footer Position 4', 'glow' ),
        'id'            => 'dt-footer4',
        'description'   => __( 'Add widgets to Show widgets at Footer Position 4', 'glow' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h2 class="widget-title"><span></span>',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'glow_widgets_init' );

/**
 * Register widgets
 */
function glow_register_widgets() {

    register_widget( 'glow_social_icons' );
    register_widget( 'glow_about' );
    register_widget( 'Glow_Services_Widget' );
    register_widget( 'glow_call_to_action' );
    register_widget( 'Glow_Testimonial_Widget' );
    register_widget( 'Glow_Recent_Posts' );
    register_widget( 'glow_opening_hour' );
   

}
add_action( 'widgets_init', 'glow_register_widgets' );
