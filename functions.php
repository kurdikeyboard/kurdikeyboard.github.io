<?php
/**
 * Glow functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Glow
 */



if ( ! function_exists( 'glow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function glow_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.z
	 * If you're building a theme based on Glow, use a find and replace
	 * to change 'glow' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'glow' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Custom Image Crop
	add_image_size( 'glow-featured-slider-img', 1920, 1080, true );
	add_image_size( 'glow-service-img', 480, 300, true );
	add_image_size( 'glow-archive-img', 720, '', true );
	add_image_size( 'glow-about-img', 340, 260, true );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Add Custom Logo Support
	 */
	add_theme_support( 'custom-logo' );
    add_theme_support( 'custom-header', apply_filters( 'glow_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => '',
        'width'                  => 1000,
        'height'                 => 250,
        'flex-height'            => true,
    ) ) );
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'glow' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'glow_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Add custom editor style
	 */
	add_editor_style( 'css/custom-editor-style.css' );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Support EasyMega menu
     */
    add_theme_support( 'megamenu-wp', array(
        'mobile_mod' => 1270,
        'margin_top' => 0,
        'parent_level' => 5,
    ) );

   

}
endif;
add_action( 'after_setup_theme', 'glow_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function glow_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'glow_content_width', 640 );
}
add_action( 'after_setup_theme', 'glow_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function glow_scripts() {

	// Enqueue Bootstrap Grid
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5', '' );

	// Enqueue FontAwesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.4.0', '' );

	// Enqueue Animate.css
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.min.css', array(), '4.4.0', '' );

	// Enqueue Swiper.css
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css', array(), '3.2.5', '' );

   
        // Enqueue Google fonts
        wp_enqueue_style('glow_fonts', '//fonts.googleapis.com/css?family=Bad+Script|Roboto:400,900,700,500,300');
    

	// Stylesheet
	wp_enqueue_style( 'glow-style', get_stylesheet_uri() );

	// Enqueue Swiper
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.jquery.min.js', array( 'jquery' ), '3.2.5', '' );

	// Custom JS
	wp_enqueue_script( 'glow-custom-js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    glow_customizer_styles( );
}
add_action( 'wp_enqueue_scripts', 'glow_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';



/**
 * Load Widgets file
 */
require get_template_directory() . '/inc/widgets/widgets.php';


/**
 * Theme Dashboard
 */
require get_template_directory() . '/inc/dashboard.php';


/**
 * Convert hexdec color string to rgb(a) string
 */
function glow_hex2rgba( $color, $opacity = false ) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if( empty( $color ) )
		return $default;

	//Sanitize $color if "#" is provided
	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

	//Check if color has 6 or 3 characters and get values
	if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

	//Convert hexadec to rgb
	$rgb =  array_map( 'hexdec', $hex );

	//Check if opacity is set(rgba or rgb)
	if( $opacity ){
		if( abs( $opacity ) > 1 )
			$opacity = 1.0;
		$output = 'rgba( '.implode( ",",$rgb ).','.$opacity.' )';
	} else {
		$output = 'rgb( '.implode( ",",$rgb ).' )';
	}

	//Return rgb(a) color string
	return $output;
}

/**
 * Filter the except length to 40 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function glow_archive_excerpt_length( $length ) {
	return ( is_front_page() ) ? 15 : 40;
}
add_filter( 'excerpt_length', 'glow_archive_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function glow_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'glow_excerpt_more' );


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/tgm.php';

add_action( 'tgmpa_register', 'glow_register_required_plugins' );

function glow_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Mega Menu plugin for WordPress',
            'slug'      => 'easymega',
            'required'  => false,
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'glow',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}
