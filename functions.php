<?php
/**
 * oiko_s functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package oiko_s
 */

if ( ! function_exists( 'oiko_s_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function oiko_s_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on oiko_s, use a find and replace
		 * to change 'oiko_s' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'oiko_s', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'oiko_s' ),
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

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'oiko_s_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'oiko_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function oiko_s_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'oiko_s_content_width', 640 );
}
add_action( 'after_setup_theme', 'oiko_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function oiko_s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'oiko_s' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'oiko_s' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'oiko_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function oiko_s_scripts() {
	// jQuery no good!
    if (!is_admin() && !is_user_logged_in()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', false);
    }

	wp_enqueue_style( 'underscores-style', get_stylesheet_uri() );

	wp_enqueue_script( 'underscores-navigation', get_template_directory_uri() . '/js/navigation.js', array(), NULL, true );

	wp_enqueue_script( 'underscores-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), NULL, true );

	wp_enqueue_script( 'rw_cookies', get_template_directory_uri() . '/js/cookies/cookies.min.js', [], false, true );

	wp_enqueue_script( 'rw_settings', get_template_directory_uri() . '/js/settings.js', ['rw_cookies'], false, true );

	if (is_front_page()) {
		wp_enqueue_script( 'rw_terminal', get_template_directory_uri() . '/js/terminal.js', [], false, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'oiko_s_scripts' );

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
 * User Settings/Theming
 */
require get_template_directory() . '/inc/user-settings.php';

/**
 * Post types
 */
foreach(glob(get_template_directory() . "/inc/post-types/*.php") as $file){
    require $file;
}

/**
 * Widgets
 */
foreach(glob(get_template_directory() . "/inc/widgets/*.php") as $file){
    require $file;
}
