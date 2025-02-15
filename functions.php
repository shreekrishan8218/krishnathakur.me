<?php
/**
 * Functions
 * 
 * @package Valkivid
 * 
 * @since 1.0.0
 * 
 * @author Odin Design Themes (https://odindesignthemes.com/)
 * 
 */

/**
 * Versioning
 * 
 * @since 1.0.0
 */
if (!defined('VALKIVID_VERSION')) {
  $valkivid_wp_theme = wp_get_theme('valkivid');
  $valkivid_theme_version = isset($valkivid_wp_theme['Version']) ?  $valkivid_wp_theme['Version'] : esc_html__('Unknown', 'valkivid');
  define('VALKIVID_VERSION', $valkivid_theme_version);
}

/**
 * Paths and urls
 * 
 * @since 1.0.0
 */
if (!defined('VALKIVID_PATH')) {
  define('VALKIVID_PATH', get_template_directory());
}

if (!defined('VALKIVID_URL')) {
  define('VALKIVID_URL', get_template_directory_uri());
}

/**
 * Globals
 * 
 * @since 1.0.0
 */
if (!isset($content_width)) {
  $content_width = 1170;
}

if (!function_exists('valkivid_scripts_load')) {
  /**
   * Load theme styles and scripts
   * 
   * @since 1.0.0
   */
  function valkivid_scripts_load() {
    /**
     * Styles
     */
    // Load current user selected font data
    $font = valkivid_customizer_font_data_get();

    // load fonts
    wp_enqueue_style('valkivid-fonts', 'https://fonts.googleapis.com/css?family=' . $font['family'] . ':400,500,600,700&display=swap');

    // Main
    wp_enqueue_style('valkivid-styles', VALKIVID_URL . '/style.css', [], '1.0.0');

    // Simplebar
    wp_enqueue_style('simplebar-styles', VALKIVID_URL . '/css/simplebar/simplebar.css', ['valkivid-styles'], '1.0.0');

    // Load current user selected font family styles
    $font_styles = valkivid_customizer_font_styles_get();

    // add user custom theme colors
    wp_add_inline_style('valkivid-styles', $font_styles);

    // Load current color preset CSS variables
    $current_color_preset_styles = valkivid_customizer_color_preset_styles_get();

    // add user custom theme colors
    wp_add_inline_style('valkivid-styles', $current_color_preset_styles);

    // Load user custom body background styles
    $body_background_styles = valkivid_customizer_body_background_styles_get();
  
    // add user custom body background
    wp_add_inline_style('valkivid-styles', $body_background_styles);

    /**
     * Scripts
     */
    // Simplebar
    wp_enqueue_script('simplebar-script', VALKIVID_URL . '/js/vendor/simplebar/simplebar.min.js', [], '1.0.0', true);

    // SVG
    wp_enqueue_script('valkivid-svg-loader-script', VALKIVID_URL . '/js/svg-loader.js', [], '1.0.0', true);
    
    // App
    wp_enqueue_script('valkivid-app-script', VALKIVID_URL . '/js/app.js', [], '1.0.0', true);

    // Header
    wp_enqueue_script('valkivid-header-script', VALKIVID_URL . '/js/header.js', [], '1.0.0', true);

    // Dropdowns
    wp_enqueue_script('valkivid-dropdown-script', VALKIVID_URL . '/js/dropdown.js', [], '1.0.0', true);

    // Navigation
    wp_enqueue_script('valkivid-navigation-mobile-script', VALKIVID_URL . '/js/navigation-mobile.js', ['valkivid-app-script'], '1.0.0', true);
    wp_enqueue_script('valkivid-navigation-mobile-menu-script', VALKIVID_URL . '/js/navigation-mobile-menu.js', [], '1.0.0', true);

    // Search
    wp_enqueue_script('valkivid-search-overlay-script', VALKIVID_URL . '/js/search-overlay.js', [], '1.0.0', true);

    // PMPro
    if (valkivid_plugin_pmpro_is_active()) {
      wp_enqueue_script('valkivid-pmpro-required-fields', VALKIVID_URL . '/js/pmpro/pmpro-required-fields.js', [], '1.0.0', true);
    }
  }
}

add_action('wp_enqueue_scripts', 'valkivid_scripts_load');

if (!function_exists('valkivid_body_classes')) {
  /**
   * Add body class filters
   * 
   * @since 1.0.0
   */
  function valkivid_body_classes($classes){
    $body_type = valkivid_customizer_setting_template_type_value_get('valkivid_body_setting_type');
    $body_version = valkivid_template_type_version_get($body_type);

    $classes[] = 'valkivid-template_' . $body_version;

    if ($body_type === 'streamer-v1') {
      $body_has_background = valkivid_template_streamer_v1_has_body_background();

      // add body background on certain pages only
      if ($body_has_background) {
        $classes[] = 'valkivid-body_has-background';
      }
    }

    return $classes;
  }
}

add_filter('body_class', 'valkivid_body_classes');

if (!function_exists('valkivid_features_support')) {
  /**
   * Add support for features
   * 
   * @since 1.0.0
   */
  function valkivid_features_support() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');

    // add post thumbnails support
    add_theme_support('post-thumbnails');

    // default post thumbnail size, cropped
    set_post_thumbnail_size(370, 240, true);

    add_image_size('valkivid-body-background', 1920, 827);

    // WooCommerce support
    add_theme_support('woocommerce');
    
    // WooCommerce gallery support
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
  }
}

add_action('after_setup_theme', 'valkivid_features_support');

if (!function_exists('valkivid_menus_register')) {
  /**
   * Navigation Menus
   * 
   * @since 1.0.0
   */
  function valkivid_menus_register() {
    register_nav_menu('header', esc_html_x('Header', '(Backend) Menu Location Name', 'valkivid'));
    register_nav_menu('footer', esc_html_x('Footer', '(Backend) Menu Location Name', 'valkivid'));
    register_nav_menu('footer-bottom', esc_html_x('Footer - Bottom', '(Backend) Menu Location Name', 'valkivid'));
  }
}

add_action('init', 'valkivid_menus_register');

if (!function_exists('valkivid_sidebars_register')) {
  /**
   * Sidebars
   * 
   * @since 1.0.0
   */
  function valkivid_sidebars_register() {
    $body_type = valkivid_customizer_setting_template_type_value_get('valkivid_body_setting_type');
    $body_version = valkivid_template_type_version_get($body_type);

    register_sidebar([
      'id'            => 'blog',
      'name'          => esc_html_x('(Valkivid) Blog Post Sidebar', '(Backend) Blog Post Sidebar - Title', 'valkivid'),
      'description'   => esc_html_x('A sidebar for blog posts.', '(Backend) Blog Post Sidebar - Description', 'valkivid'),
      'before_widget' => '<div id="%1$s" class="valkivid-sidebar-widget valkivid-template_' . $body_version . ' %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<h6 class="valkivid-sidebar-widget-title">',
      'after_title'   => '</h6>'
    ]);

    if (valkivid_plugin_woocommerce_is_active()) {
      register_sidebar([
          'id'            => 'shop',
          'name'          => esc_html_x('(Valkivid) WooCommerce Shop Sidebar', '(Backend) WooCommerce Shop Sidebar - Title', 'valkivid'),
          'description'   => esc_html_x('A sidebar for the WooCommerce shop page.', '(Backend) WooCommerce Shop Sidebar - Description', 'valkivid'),
          'before_widget' => '<div id="%1$s" class="valkivid-sidebar-widget valkivid-template_' . $body_version . ' %2$s">',
          'after_widget'  => '</div>',
          'before_title'  => '<h6 class="valkivid-sidebar-widget-title">',
          'after_title'   => '</h6>'
      ]);
    }
  }
}

add_action('widgets_init', 'valkivid_sidebars_register');

if (!function_exists('valkivid_translations_load')) {
  /**
   * Load translations
   * 
   * @since 1.0.0
   */
  function valkivid_translations_load() {
    load_theme_textdomain('valkivid', VALKIVID_PATH . '/languages');
  }
}

add_action('after_setup_theme', 'valkivid_translations_load');

/**
 * Load customizer options
 * 
 * @since 1.0.0
 */
require_once VALKIVID_PATH . '/includes/customizer/valkivid-customizer.php';

/**
 * Load functions
 * 
 * @since 1.0.0
 */
require_once VALKIVID_PATH . '/includes/functions/valkivid-functions.php';

/**
 * Load backend functions
 * 
 * @since 1.0.0
 */
require_once VALKIVID_PATH . '/backend/functions.php';