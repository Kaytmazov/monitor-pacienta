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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function monitor_pacienta_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'monitor-pacienta-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'monitor-pacienta-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'monitor_pacienta_theme_widgets_init' );

/**
 * Register Google Fonts
 */
function monitor_pacienta_theme_fonts_url() {
  $fonts_url = 'https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap&subset=cyrillic';

  return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function monitor_pacienta_theme_scripts() {
  wp_enqueue_style( 'monitor-pacienta-style', get_stylesheet_uri() );

  wp_enqueue_style( 'monitor-pacienta-themeblocks-style', get_template_directory_uri() . '/css/blocks.css' );

  wp_enqueue_style( 'monitor-pacienta-theme-fonts', monitor_pacienta_theme_fonts_url() );

  wp_deregister_script( 'jquery' );
  // wp_register_script( 'jquery', '//code.jquery.com/jquery-3.3.1.slim.min.js', false, null, true );
  wp_register_script( 'jquery', '//code.jquery.com/jquery-3.4.1.min.js', false, null, true );
  wp_enqueue_script( 'jquery' );

  wp_register_script( 'bootstrap-js', '//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'bootstrap-js' );

  wp_enqueue_script( 'monitor-pacienta-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

  wp_enqueue_script( 'monitor-pacienta-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

  if ( is_front_page() ) {
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/libs/slick/slick.css', array(), '1.8.1' );
    wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/libs/slick/slick-theme.css', array('slick'), '1.8.1' );

    wp_register_script( 'slick-js', get_template_directory_uri() . '/libs/slick/slick.min.js', array('jquery'), '1.8.1', true );
    wp_enqueue_script( 'slick-js' );

    wp_add_inline_script( 'slick-js', '
      jQuery(".intro-slider").slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 500,
        cssEase: "linear",
        responsive: [
          {
            breakpoint: 576,
            settings: {
              arrows: true
            }
          },
        ]
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

/**
 * Регистрация таксономий
 */

// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

  // список параметров: wp-kama.ru/function/get_taxonomy_labels
  register_taxonomy( 'instructions_category', [ 'instructions' ], [
    'label'                 => '', // определяется параметром $labels->name
    'labels'                => [
      'name'              => 'Категории',
      'singular_name'     => 'Категория',
      'search_items'      => 'Найти категорию',
      'all_items'         => 'Все категории',
      'view_item '        => 'Посмотреть категорию',
      'parent_item'       => 'Родительская категория',
      'parent_item_colon' => 'Parent Genre:',
      'edit_item'         => 'Редактировать категорию',
      'update_item'       => 'Обновить категорию',
      'add_new_item'      => 'Добавить новую категорию',
      'new_item_name'     => 'Название новой категории',
      'menu_name'         => 'Категории',
    ],
    'public'                => true,
    'hierarchical'        	=> true,
  ] );
}

/**
 * Регистрация Инструкций
 */
add_action( 'init', 'register_post_types' );
function register_post_types(){
  register_post_type('instructions', array(
    'label'  => null,
    'labels' => array(
      'name'               => 'Инструкции', // основное название для типа записи
      'singular_name'      => 'Инструкция', // название для одной записи этого типа
      'add_new'            => 'Добавить инструкцию', // для добавления новой записи
      'add_new_item'       => 'Добавление инструкции', // заголовка у вновь создаваемой записи в админ-панели.
      'edit_item'          => 'Редактирование инструкции', // для редактирования типа записи
      'new_item'           => 'Новая инструкция', // текст новой записи
      'view_item'          => 'Посмотреть инструкцию', // для просмотра записи этого типа.
      'search_items'       => 'Искать инструкцию', // для поиска по этим типам записи
      'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
      'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
      'parent_item_colon'  => '', // для родителей (у древовидных типов)
      'menu_name'          => 'Инструкции', // название меню
    ),
    'description'         => '',
    'public'              => true,
    'menu_position'       => 20,
    'menu_icon'           => 'dashicons-book-alt',
    'taxonomies'          => [ 'instructions_category' ],
    'show_in_rest'        => true,
    'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
  ) );
}

/**
 * Добавить поле фильтра по категориям к кастомным записям "Инструкции"
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy() {
  global $typenow;
  $post_type = 'instructions'; // change to your post type
  $taxonomy  = 'instructions_category'; // change to your taxonomy
  if ($typenow == $post_type) {
    $selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
    $info_taxonomy = get_taxonomy($taxonomy);
    wp_dropdown_categories(array(
      'show_option_all' => sprintf( __( 'Показать все %s', 'textdomain' ), $info_taxonomy->label ),
      'taxonomy'        => $taxonomy,
      'name'            => $taxonomy,
      'selected'        => $selected,
      'show_count'      => true,
      'hide_empty'      => false,
      'hierarchical'    => true,
    ));
  };
}

add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
  global $pagenow;
  $post_type = 'instructions'; // change to your post type
  $taxonomy  = 'instructions_category'; // change to your taxonomy
  $q_vars    = &$query->query_vars;
  if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
    $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
    $q_vars[$taxonomy] = $term->slug;
  }
}

/**
 * Предотвращение поднятия на верх выбранного категория
 */
add_filter('wp_terms_checklist_args', 'wp_terms_checklist_args');
function wp_terms_checklist_args($args) {
  $args['checked_ontop'] = false;
  return $args;
}

/**
 * Определение региона
 */
if (!isset($_COOKIE['region'])) {
  $record = geoip_detect2_get_info_from_ip('::1', NULL);
  $region = $record->mostSpecificSubdivision->name;

  if ($region !== 'Дагестан' && $region !== 'Ингушетия' && $region !== 'Кабардино-Балкария') {
    $region = 'Дагестан';
  } elseif ($region == 'Кабардино-Балкария') {
    $region = 'КБР';
  }
} else {
  $region = $_COOKIE['region'];
}
