<?php
/**
 * JE-MA functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package JE-MA
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function je_ma_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on JE-MA, use a find and replace
		* to change 'je-ma' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'je-ma', get_template_directory() . '/languages' );

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

	// Custom Crop Size
	add_image_size( 'student-image', 200, 300, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'je-ma' ),
			'footer' => esc_html__( 'Footer', 'je-ma' ),
		)
	);

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
			'je_ma_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	/** 
	 * Add support for Block Editor features.
	 * 
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/
	*/
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' ); 
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'je_ma_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function je_ma_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'je_ma_content_width', 640 );
}
add_action( 'after_setup_theme', 'je_ma_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function je_ma_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'je-ma' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'je-ma' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'je_ma_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function je_ma_scripts() {
	wp_enqueue_style( 'je-ma-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'je-ma-style', 'rtl', 'replace' );

	wp_enqueue_script( 'je-ma-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( 'post' === get_post_type() ) {
        // Enqueue Animate on Scroll CSS file.
        wp_enqueue_style( 
			'aos-css', 
			get_template_directory_uri() . '/css/aos.css', 
			array(),
			'2.3.1'
		);

        // Enqueue Animate on Scroll JS file.
        wp_enqueue_script( 
			'aos-js', 
			get_template_directory_uri() . '/js/aos.js', 
			array(), 
			'2.3.1',
			array( 'strategy' => 'defer')
		);

		// Enqueue Theme-specific JS file.
		wp_enqueue_script(
			'theme-js', 
			get_template_directory_uri() . '/js/theme.js', 
			array( 'aos-js' ), 
			_S_VERSION,
			array( 'strategy' => 'defer')
		);
    }
}
add_action( 'wp_enqueue_scripts', 'je_ma_scripts' );

function je_ma_change_staff_title_placeholder($title_placeholder, $post) {
    if ($post->post_type === 'je-ma-staff') {
        $title_placeholder = 'Add staff name';
    }
    return $title_placeholder;
}
add_filter('enter_title_here', 'je_ma_change_staff_title_placeholder', 10, 2);

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
 * Register CPT's and Taxonomies.
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';


function je_ma_restrict_block_editor($allowed_block_types, $post) {
    if ($post->post_type === 'je-ma-student') {
        
        $allowed_block_types = array(
            'core/paragraph', 
            'core/buttons',   
        );
    }
    return $allowed_block_types;
}
add_filter('allowed_block_types', 'je_ma_restrict_block_editor', 10, 2);

function je_ma_change_student_title_placeholder($title_placeholder) {
    global $post;
    if ($post->post_type === 'je-ma-student') {
        $title_placeholder = 'Add Student Name';
    }
    return $title_placeholder;
}
add_filter('enter_title_here', 'je_ma_change_student_title_placeholder');

// Modify the End of the Excerpt
function je_ma_excerpt_more( $more ) {
    // Check if we are on the 'je-ma-student' custom post type archive
    if ( is_post_type_archive( 'je-ma-student' ) ) {
        $more = '<br> <a href="'. esc_url( get_permalink() ) .'" class="read-more">Read more about the student...</a>';
    }
    return $more;
}
add_filter( 'excerpt_more', 'je_ma_excerpt_more' );

// Modify Length of the Excerpt
function je_ma_excerpt_length($length) {
    // Check if we are on the 'je-ma-student' custom post type archive
    if ( is_post_type_archive( 'je-ma-student' ) ) {
        return 25;
    }
    // Default excerpt length for other pages
    return $length;
}
add_filter('excerpt_length', 'je_ma_excerpt_length');
