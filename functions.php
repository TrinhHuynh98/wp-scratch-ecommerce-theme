<?php
/**
 * furniture-store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package furniture-store
 */

if (!defined("_S_VERSION")) {
  // Replace the version number of the theme on each release.
  define("_S_VERSION", "1.0.0");
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function furniture_store_setup()
{
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on furniture-store, use a find and replace
   * to change 'furniture-store' to the name of your theme in all the template files.
   */
  load_theme_textdomain(
    "furniture-store",
    get_template_directory() . "/languages"
  );

  // Add default posts and comments RSS feed links to head.
  add_theme_support("automatic-feed-links");

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support("title-tag");

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support("post-thumbnails");

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus([
    "menu-1" => esc_html__("Primary", "furniture-store"),
  ]);

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support("html5", [
    "search-form",
    "comment-form",
    "comment-list",
    "gallery",
    "caption",
    "style",
    "script",
  ]);

  // Set up the WordPress core custom background feature.
  add_theme_support(
    "custom-background",
    apply_filters("furniture_store_custom_background_args", [
      "default-color" => "ffffff",
      "default-image" => "",
    ])
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support("customize-selective-refresh-widgets");

  /**
   * Add support for core custom logo.
   *
   * @link https://codex.wordpress.org/Theme_Logo
   */
  add_theme_support("custom-logo", [
    "height" => 250,
    "width" => 250,
    "flex-width" => true,
    "flex-height" => true,
  ]);
}
add_action("after_setup_theme", "furniture_store_setup");

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function furniture_store_content_width()
{
  $GLOBALS["content_width"] = apply_filters(
    "furniture_store_content_width",
    640
  );
}
add_action("after_setup_theme", "furniture_store_content_width", 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function furniture_store_widgets_init()
{
  register_sidebar([
    "name" => esc_html__("Sidebar", "furniture-store"),
    "id" => "sidebar-1",
    "description" => esc_html__("Add widgets here.", "furniture-store"),
    "before_widget" => '<section id="%1$s" class="widget %2$s">',
    "after_widget" => "</section>",
    "before_title" => '<h2 class="widget-title">',
    "after_title" => "</h2>",
  ]);
}
add_action("widgets_init", "furniture_store_widgets_init");

/**
 * Enqueue scripts and styles.
 */
function furniture_store_scripts()
{
  wp_enqueue_style(
    "furniture-store-style",
    get_stylesheet_uri(),
    [],
    _S_VERSION
  );
  wp_style_add_data("furniture-store-style", "rtl", "replace");
  wp_enqueue_style(
    "furniture-store-main",
    get_template_directory_uri() . "/css/main.css"
  );
  wp_enqueue_style(
    "bootstrap-icons",
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
  );

  wp_enqueue_script(
    "furniture-store-navigation",
    get_template_directory_uri() . "/js/navigation.js",
    [],

    _S_VERSION,
    true
  );

  wp_enqueue_script(
    "bootstrap_popper",
    "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js",
    ["jquery"],
    true
  );
  wp_enqueue_script(
    "bootstrap_script",
    "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js",
    ["jquery"],
    true
  );

  wp_enqueue_script(
    "main-script",
    get_template_directory_uri() . "/js/main.js",
    ["jquery"],
    true
  );

  if (is_singular() && comments_open() && get_option("thread_comments")) {
    wp_enqueue_script("comment-reply");
  }
}
add_action("wp_enqueue_scripts", "furniture_store_scripts");

/**
 * Custom Fonts
 */
function enqueue_custom_fonts()
{
  // if(!is_admin()){
  wp_register_style(
    "source_poppins",
    "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
  );
  wp_enqueue_style("source_poppins");
  // }
}
add_action("wp_enqueue_scripts", "enqueue_custom_fonts");

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . "/inc/custom-header.php";

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . "/inc/template-tags.php";

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . "/inc/template-functions.php";

/**
 * Customizer additions.
 */
require get_template_directory() . "/inc/customizer.php";

/**
 * Load Jetpack compatibility file.
 */
if (defined("JETPACK__VERSION")) {
  require get_template_directory() . "/inc/jetpack.php";
}

/**
 * Footer wifget One
 */

function custom_footer_widget_one()
{
  $args = [
    "id" => "footer-widget-col-one",
    "name" => __("Footer Column One", "tet_domain"),
    "description" => __("Column One", "text_domain"),
    "before_title" => '<h3 class="title">',
    "after_title" => "</h3>",
    "before_widget" => '<div id="%1$s" class="widget %2$s">',
    "after_widget" => "</div>",
  ];
  register_sidebar($args);
}
add_action("widgets_init", "custom_footer_widget_one");

/**
 * Footer wifget Two
 */

function custom_footer_widget_two()
{
  $args = [
    "id" => "footer-widget-col-two",
    "name" => __("Footer Column Two", "tet_domain"),
    "description" => __("Column Two", "text_domain"),
    "before_title" => '<h3 class="title">',
    "after_title" => "</h3>",
    "before_widget" => '<div id="%1$s" class="widget %2$s">',
    "after_widget" => "</div>",
  ];
  register_sidebar($args);
}
add_action("widgets_init", "custom_footer_widget_two");

/**
 * Footer wifget Three
 */

function custom_footer_widget_three()
{
  $args = [
    "id" => "footer-widget-col-three",
    "name" => __("Footer Column Three", "tet_domain"),
    "description" => __("Column Three", "text_domain"),
    "before_title" => '<h3 class="title">',
    "after_title" => "</h3>",
    "before_widget" => '<div id="%1$s" class="widget %2$s">',
    "after_widget" => "</div>",
  ];
  register_sidebar($args);
}
add_action("widgets_init", "custom_footer_widget_three");

/**
 * WooCommerce
 */
add_theme_support("woocommerce");

// Remove WooCommerce Styles
function remove_woocommerce_styles($enqueue_styles)
{
  unset($enqueue_styles["woocommerce-general"]); // Remove the gloss
  // unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
  // unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
  return $enqueue_styles;
}

add_filter("woocommerce_enqueue_styles", "remove_woocommerce_styles");

/**
 * Enqueue your own stylesheet
 */
function wp_enqueue_woocommerce_style()
{
  wp_register_style(
    "mytheme-woocommerce",
    get_template_directory_uri() . "/css/woocommerce/woocommerce.css"
  );

  if (class_exists("woocommerce")) {
    wp_enqueue_style("mytheme-woocommerce");
  }
}
add_action("wp_enqueue_scripts", "wp_enqueue_woocommerce_style");
