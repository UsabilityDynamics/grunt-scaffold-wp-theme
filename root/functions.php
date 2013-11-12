<?php
/**
 * {%= name %} Core
 *
 * @version {%= version %}
 * @author {%= author_name %}
 * @namespace UsabilityDynamics
 */
namespace UsabilityDynamics {


  /**
   * {%= name %} Theme
   *
   * @author {%= author_name %}
   */
  final class {%= name %} {

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
    
    }
    
    /**
     * Initial Theme Setup
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function after_setup_theme() {
      
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
      
    }
    
    /**
     * Frontend Header
     *
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function wp_head() {
    
    }

  }

  // Instantiate
  new {%= name %};

}