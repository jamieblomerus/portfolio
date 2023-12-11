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

// REST API - Get project by slug (slug is the project name)
add_action( 'rest_api_init', function () {
	register_rest_route( 'portfolio/v1', '/projects', array(
		'methods' => 'GET',
		'callback' => 'get_projects',
	) );
} );

function get_projects( $request ) {
	global $projects;
	$slug = $request->get_param( 'slug' );
	foreach ($projects as $project) {
		if ($project['slug'] == $slug) {
			return $project;
		}
	}
	return null;
}

// CUSTOMIZATION

/* Projects */
$projects = array();
$projects[] = array(
	'slug' => 'wp-scrive',
	'title' => 'WP Scrive by Webbstart',
    'description' => 'A WordPress-plugin to simplify onboarding of new customers, by building a bridge between CMS and document signing software. The plugin was published on WordPress.org and was available for free. The plugin was later discontinued due to lack of interest.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wpscrive.jpg',
    'link' => 'https://wordpress.org/plugins/wp-scrive/'
);
$projects[] = array(
	'slug' => 'wcagnetworks-customers',
    'title' => 'WCAG Networks – Customer References Block',
    'description' => 'I implemented a new customer reference block for WCAG Networks website.<br>With these changes it became easy for the web editors to add new references to the website without manually editing the site. The new block was built with Advanced Custom Fields and was fully customizable.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wcagnetworks-customers.jpg',
    'link' => 'https://www.wcagnetworks.com/'
);
$projects[] = array(
	'slug' => 'webbstart',
    'title' => 'Webbstart – Digital Agency',
    'description' => "I led the development of a new fresh website built on WordPress and a modified version of OceanWP.<br>The new website helpt attract new optimization gigs with an fully integrated PageSpeed Insights widget and glossary.",
    'image' => get_template_directory_uri() . '/assets/images/projects/webbstart.jpg',
    'link' => 'https://www.webbstart.nu/'
);
$projects[] = array(
	'slug' => 'will-you-snail',
    'title' => 'Will You Snail? – Swedish translation',
    'description' => 'I helped translate the game "Will You Snail?" from English to Swedish.<br>"Will You Snail?" is an unique platformer where an evil AI has trapped you in one of it\'s simulation to watch you suffer for an eternity. You must escape the simulation and find a way to defeat the AI.',
    'image' => get_template_directory_uri() . '/assets/images/projects/wys.jpg',
    'link' => 'https://store.steampowered.com/app/1115050/Will_You_Snail/'
);
$projects[] = array(
	'slug' => 'jamieblomerus',
	'title' => 'Jamie Blomerus – Portfolio',
	'description' => 'This website is my portfolio. It is built on WordPress and uses Fullpage.js to create a smooth scrolling experience. All the code is open source and can be found on GitHub.',
	'image' => get_template_directory_uri() . '/assets/images/projects/jamieblomerus.png'
);
$projects[] = array(
	'slug' => 'wcagnetworks',
	'title' => 'WCAG Networks – WordPress Engineer',
	'description' => 'I am a part of the WCAG Networks team. We help companies and organizations to make their websites accessible for everyone by providing audits and training.',
	'image' => get_template_directory_uri() . '/assets/images/projects/wcagnetworks.jpg',
	'link' => 'https://www.wcagnetworks.com/'
);
$projects[] = array(
	'slug' => 'gagnef',
	'title' => 'Gagnef Municipality – Event Calendar',
	'description' => 'I helped create an event calendar for Gagnef Municipality. The calendar is built on WordPress and is integrated with Visit Dalarna\'s event calendar.',
	'image' => get_template_directory_uri() . '/assets/images/projects/gagnef.jpg',
	'link' => 'https://www.gagnef.se/'
);
$projects[] = array(
	'slug' => 'swekaz',
	'title' => 'Swekaz – Website reconstruction',
	'description' => 'I helped Swekaz with a website reconstruction and migration to webhost Loopia. I reviewed the old code and fixed errors related to: <ul><li>Accessibility</li><li>Performance</li><li>SEO</li><li>Security</li></ul> I did also integrate a new webshop utilizing WooCommerce.',
	'image' => get_template_directory_uri() . '/assets/images/projects/swekaz.jpg',
	'link' => 'https://www.swekaz.se/'
);
$projects[] = array(
	'slug' => 'mobile-bankid-integration',
	'title' => 'Unofficial Mobile BankID Integration for WordPress',
	'description' => 'I created a plugin for WordPress that allows users to login with Mobile BankID, the most common authentication method in Sweden, and prove their age on WooCommerce checkout. The plugin is available for free on <a href="https://github.com/jamieblomerus/WP-Mobile-BankID-Integration" target="_blank">GitHub</a>.',
	'image' => get_template_directory_uri() . '/assets/images/projects/wpbankid.jpg'
);