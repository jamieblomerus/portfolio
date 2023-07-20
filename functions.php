<?php
/**
 * Jamie Blomerus Portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jamie_Blomerus_Portfolio
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.2' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function portfolio_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Jamie Blomerus Portfolio, use a find and replace
		* to change 'portfolio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'portfolio', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'portfolio_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'portfolio_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function portfolio_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'portfolio_content_width', 640 );
}
add_action( 'after_setup_theme', 'portfolio_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function portfolio_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer contact form', 'portfolio' ),
			'id'            => 'footer-cf',
			'description'   => esc_html__( 'Add widgets here.', 'portfolio' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'portfolio_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function portfolio_scripts() {
	wp_enqueue_style( 'portfolio-style', get_template_directory_uri(). '/style.min.css', array(), _S_VERSION );
	wp_enqueue_script( 'portfolio-script', get_template_directory_uri(). '/js/frontend.min.js', array(), _S_VERSION, true );
	wp_style_add_data( 'portfolio-style', 'rtl', 'replace' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Fullpage.js
	wp_enqueue_style( 'fullpagejs', get_template_directory_uri(). '/assets/css/fullpage.min.css', array(), '4.0.11' );
	wp_enqueue_script( 'fullpagejs', get_template_directory_uri(). '/assets/js/fullpage.min.js', array(), '4.0.11', false );

	//Font Awesome
	wp_enqueue_script( 'fontawesome', 'https://use.fontawesome.com/c3610b5102.js', array(), '', false );
}
add_action( 'wp_enqueue_scripts', 'portfolio_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register certification post type
 */
function register_certification_post_type() {
	register_post_type(
		'certifications',
		array(
		   'labels'      => array(
			  'name'          => "Certifications",
			  'singular_name' => "Certificate",
		   ),
		   'show_ui'     => true,
		   'supports'    => ['title', 'excerpt'],
		   'publicly_queryable' => true
		)
	);
}
add_action( 'init', 'register_certification_post_type' );

/**
 * Customizer options
 */
function register_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'portfolio_options',
        array(
            'title' => 'Portfolio customization',
            'description' => 'Small changes doesn\'t require code changes.',
            'priority' => 35,
        )
    );

	// Register Profile Picture Setting
	$wp_customize->add_setting(
		'profile_image',
		array(
			'default' => null,
		)
	);
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'profile_image', array(
		'label' => 'Profile Picture',
		'section' => 'portfolio_options',
		'type' => 'image',
	)));

	// Biography
	$wp_customize->add_setting(
		'biography',
		array(
			'default' => "This is your biography. You can change it through the Customizer.",
		)
	);
	$wp_customize->add_control( new WP_Customize_Control( 
		$wp_customize, 'biography', 
			array(
				'type' => 'textarea',
				'section' => 'portfolio_options', 
				'label' => 'Biography'
			) 
	));
}
add_action( 'customize_register', 'register_customizer' );

// CUSTOMIZATION

/* Projects */
$projects = array();
$projects[] = array(
	'title' => 'WP Scrive by Webbstart',
    'description' => 'A WordPress-plugin to simplify onboarding of new customers, by building a bridge between CMS and document signing software.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wpscrive.jpg',
    'link' => 'https://wordpress.org/plugins/wp-scrive/'
);
$projects[] = array(
    'title' => 'WCAG Networks',
    'description' => 'I implemented a new customer reference block for WCAG Networks website.<br>With these changes it became easy for the web editors to add new references to the website without manually editing the site.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wcagnetworks.jpg',
    'link' => 'https://www.wcagnetworks.com/'
);
$projects[] = array(
    'title' => 'Webbstart – Digital Agency',
    'description' => "I lead the development of a new fresh website built on WordPress and a modified version of OceanWP.<br>The new website helpt attract new optimization gigs with an fully integrated PageSpeed Insights widget and an integrated glossary.",
    'image' => get_template_directory_uri() . '/assets/images/projects/webbstart.jpg',
    'link' => 'https://www.webbstart.nu/'
);
$projects[] = array(
    'title' => 'Will You Snail? – Swedish translation',
    'description' => 'I helped translate the game "Will You Snail?" from English to Swedish.<br>"Will You Snail?" is an unique platformer where an evil AI has trapped you in one of it\'s simulation to watch you suffer for an eternity. You must escape the simulation and find a way to defeat the AI.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wys.jpg',
    'link' => 'https://store.steampowered.com/app/1115050/Will_You_Snail/'
);