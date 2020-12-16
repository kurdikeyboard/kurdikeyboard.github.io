<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Glow
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function glow_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'glow_body_classes' );


// $opt = apply_filters('bcn_settings_init', $opt);

if( function_exists( 'bcn_display' ) ) {

    /**
     *
     * Filter breadcrumb navxt options
     *
     * @param $opt
     * @return mixed
     */
    function glow_breadcrumb_navxt_option( $opt ){

        $opt['Hhome_template'] = '<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to %title%." href="%link%" class="%type%"><span property="name">'.esc_html__( 'Home', 'glow' ).'</span></a><meta property="position" content="%position%"></span>';
        $opt['hseparator'] = '<span class="separator">/</span>';
        return $opt;
    }

    add_filter('bcn_settings_init', 'glow_breadcrumb_navxt_option' );

}

function glow_add_nav_button( $items, $args ){
    $show = get_theme_mod( 'nav_button_show', 1 );
    if ( $show || is_customize_preview() ) {
        if ( property_exists($args, 'theme_location') && $args->theme_location == 'primary') {
            $label = get_theme_mod( 'nav_button_label', esc_html__('Book an appointment', 'glow') );
            $link = get_theme_mod( 'nav_button_url', '#' );
            $style = '';
            if ( ! $show && is_customize_preview() ) {
                $style = ' style="display: none;" ';
            }
            $items .= '<li '.$style.' class="nav-btn-li"><a class="btn btn-book" href="'.esc_url( $link ).'">'.wp_kses_post( $label ).'</a> </li>';
        }
    }

    return $items;
}
add_filter( 'wp_nav_menu_items', 'glow_add_nav_button', 36, 2 );

