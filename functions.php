<?php

if ( ! function_exists( 'monitor_pacienta_theme_setup' ) ) :

  function monitor_pacienta_theme_setup() {

    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    register_nav_menus( array(
      'menu-1' => esc_html__( 'Primary', 'monitor-pacienta-theme' ),
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
  }
endif;
add_action( 'after_setup_theme', 'monitor_pacienta_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function monitor_pacienta_theme_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'monitor_pacienta_theme_content_width', 1110 );
}
add_action( 'after_setup_theme', 'monitor_pacienta_theme_content_width', 0 );

/**
 * Register Google Fonts
 */
function monitor_pacienta_theme_fonts_url() {
  $fonts_url = 'https://fonts.googleapis.com/css?family=Montserrat:700&display=swap&subset=cyrillic';

  return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function monitor_pacienta_theme_scripts() {
  wp_enqueue_style( 'slick', get_template_directory_uri() . '/libs/slick/slick.css', array(), '1.8.1' );
  wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/libs/slick/slick-theme.css', array('slick'), '1.8.1' );

  wp_enqueue_style( 'monitor-pacienta-style', get_stylesheet_uri() );

  wp_enqueue_style( 'monitor-pacienta-themeblocks-style', get_template_directory_uri() . '/css/blocks.css' );

  wp_enqueue_style( 'monitor-pacienta-theme-fonts', monitor_pacienta_theme_fonts_url() );

  wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', false, null, true );
  wp_enqueue_script( 'jquery' );

  wp_register_script( 'bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'bootstrap-js' );

  wp_enqueue_script( 'monitor-pacienta-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  wp_enqueue_script( 'monitor-pacienta-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  wp_register_script( 'slick-js', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), '1.8.1', true );
  wp_enqueue_script( 'slick-js' );

	if ( is_front_page() ) {
    wp_add_inline_script( 'slick-js', '
      jQuery(".intro-slider").slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: "linear"
      });'
    );
	}

  wp_enqueue_script( 'scripts-js', get_template_directory_uri() . '/js/scripts.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'monitor_pacienta_theme_scripts' );

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
 * Theme Settings
 */
require get_template_directory() . '/inc/theme-options.php';

/**
 * Отключаем Toolbar на сайте
 */
add_filter('show_admin_bar', '__return_false');
