<?php
/**
 * {%= name %} Core
 *
 * @version {%= version %}
 * @author {%= author_name %}
 * @namespace UsabilityDynamics
 */
namespace UsabilityDynamics\Theme {

  // Be sure that vendors installed ( composer install ). See: http://getcomposer.org/
  if( !file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    wp_die( '<h1>Critical Error</h1>' . '<p>The website is currently being updated, please wait a few moments.</p><p>The NightCulture theme is missing the vendor directory, the theme appears to be unbuilt.</p>' );
  }

  // Load vendor classes
  require_once( __DIR__ . '/vendor/autoload.php' );
  
  // Localize UsabilityDynamics classes
  use UsabilityDynamics\Utility;
  use UsabilityDynamics\Settings;
  use UsabilityDynamics\UI;

  /**
   * {%= name %} Theme
   *
   * @author {%= author_name %}
   */
  final class {%= short_name %} {

    /**
     * Version of theme
     *
     * @public
     * @property version
     * @var string
     */
    public static $version = null;

    /**
     * Textdomain String
     *
     * Parses namespace, should be something like "wpp-theme-{%= short_name %}"
     *
     * @public
     * @property text_domain
     * @var string
     */
    public static $text_domain = null;

    /**
     * ID of instance, used for settings.
     *
     * Parses namespace, should be something like wpp:theme:{%= short_name %}
     *
     * @public
     * @property id
     * @var string
     */
    public static $id = null;

    /**
     * Class Initializer
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function __construct() {
    
      // Get information about current theme
      $_theme_info = get_file_data( __DIR__ . '/style.css', array( 'version' => 'Version' ) );
      
      // Configure properties.
      self::$version = $_theme_info[ 'version' ];
      self::$id = Utility::create_slug( __NAMESPACE__ . ' {%= short_name %}', array( 'separator' => ':' ) );
      self::$text_domain = Utility::create_slug( __NAMESPACE__ . ' {%= short_name %}', array( 'separator' => '-' ) );
    
      // Instantiate settings.
      $this->settings = new Settings( $this->id, array() );
      
      // Set custom error handler overriding the network error handler
      set_error_handler( array( self, 'error_handler' ), E_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR );
    
      // Core Actions
      add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
      add_action( 'widgets_init', array( $this, 'widgets_init' ) );
      add_action( 'template_redirect', array( $this, 'template_redirect' ) );
      add_action( 'admin_init', array( $this, 'admin_init' ) );
      add_action( 'admin_menu', array( $this, 'admin_menu' ) );
      add_action( 'init', array( $this, 'init' ), 100 );
      add_action( 'wp_footer', array( $this, 'wp_footer' ) );
      add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
      add_action( 'wp_head', array( $this, 'wp_head' ) );
      
      // Disable WP Gallery styles
      add_filter( 'use_default_gallery_style', function () {
        return false;
      } );
    
    }
    
    /**
     * Initial Theme Setup
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function after_setup_theme() {
      
      // Make theme available for translation
      if( is_dir( get_template_directory() . '/static/languages' ) ) {
        load_theme_textdomain( $this->text_domain, get_template_directory() . '/static/languages' );
      }
      
      // Enable relative URLs
      add_theme_support( 'root-relative-urls' );
      // Enable URL rewrites
      add_theme_support( 'rewrites' );
      // Standard Bootstrap grid
      add_theme_support( 'bootstrap-grid' );
      // Enable Bootstrap's top navbar
      add_theme_support( 'bootstrap-top-navbar' );
      // Enable Bootstrap's thumbnails component on [gallery]
      add_theme_support( 'bootstrap-gallery' );
      // Enable /?s= to /search/ redirect
      add_theme_support( 'nice-search' );
      // Enable to load jQuery from the Google CDN
      add_theme_support( 'jquery-cdn' );
      // Add default posts and comments RSS feed links to <head>.
      add_theme_support( 'automatic-feed-links' );
      // This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
      add_theme_support( 'post-thumbnails' );
      
    }
    
    /**
     * Register Sidebars
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function widgets_init() {
      
    }
    
    /**
     * Primary Frontend Hook
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function template_redirect() {

    }
    
    /**
     * Primary Admin Hook
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function admin_init() {
      
    }
    
    /**
     * Primary Admin Hook
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function admin_menu() {
      
    }
    
    /**
     * Primary Hook
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function init() {
      // Register scripts
      wp_register_script( $this->text_domain . '-require', get_stylesheet_directory_uri() . '/scripts/require.js', array(), $this->version, true );
      
      // Register styles
      wp_register_style( $this->text_domain . '-app', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? get_stylesheet_directory_uri() . '/styles/app.dev.css' : get_stylesheet_directory_uri() . '/styles/app.css', array(), $this->version, 'all' );
      
      // Add custom editor styles
      add_editor_style( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'styles/editor-style.dev.css' : 'styles/editor-style.css' );
    }
    
    /**
     * Frontend Footer
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function wp_footer() {
      
    }
    
    /**
     * Enqueue Frontend Scripts
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function wp_enqueue_scripts() {
    
      // Add filter to fix the require.js script tag
      add_filter( 'clean_url', array( __CLASS__, 'fix_requirejs_script' ), 11, 1 );
      // Require will load app.js and other Require.js modules
      wp_enqueue_script( $this->text_domain . '-require' );
      // Compiled styles which include Bootstrap and custom styles.
      wp_enqueue_style( $this->text_domain . '-app' );
    
    }
    
    /**
     * Adds Require.js data attribute to script tag
     *
     * @param $url
     *
     * @return string
     * @return string
     */
    public function fix_requirejs_script( $url ) {
      if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
        return strpos( $url, 'require.js' ) !== false ? "$url' data-main='" . get_template_directory_uri() . "/scripts/app.dev.js" : $url;
      }
      return strpos( $url, 'require.js' ) !== false ? "$url' data-main='" . get_template_directory_uri() . "/scripts/app.js" : $url;
    }
    
    /**
     * Frontend Header
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function wp_head() {
    
    }
    
    /**
     * Theme Error Handler
     *
     * Overrides network error handler.
     *
     * @param $code
     * @param $message
     * @param $file
     * @param $line
     *
     * @return bool|void
     */
    public static function error_handler( $code, $message, $file, $line ) {
      // Log error
      error_log( $message );
      // Output message
      wp_die( "<h1>Error</h1><p>We apologize for the inconvenience and will return shortly.</p><p>$message</p>" );
    }

  }

  // Instantiate
  new {%= short_name %};

}