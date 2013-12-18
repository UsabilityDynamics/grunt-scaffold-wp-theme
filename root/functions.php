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
    wp_die( '<h1>Critical Error</h1>' . '<p>The website is currently being updated, please wait a few moments.</p><p>Theme is missing the vendor directory, the theme appears to be unbuilt.</p>' );
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
     * Settings.
     *
     * @public
     * @property id
     * @var string
     */
    public $settings = null;

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
      $this->version = $_theme_info[ 'version' ];
      $this->id = Utility::create_slug( __NAMESPACE__ . ' {%= short_name %}', array( 'separator' => ':' ) );
      $this->text_domain = Utility::create_slug( __NAMESPACE__ . ' {%= short_name %}', array( 'separator' => '-' ) );
    
      // Instantiate settings.
      $this->settings = new Settings( $this->id, array( 'color' => 'default' ) );
      
      // Set custom error handler overriding the network error handler
      set_error_handler( array( self, 'error_handler' ), E_ERROR | E_USER_ERROR | E_RECOVERABLE_ERROR );
    
      // Core Actions
      add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
      add_action( 'widgets_init', array( $this, 'widgets_init' ), 100 );
      add_action( 'template_redirect', array( $this, 'template_redirect' ), 100 );
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
      
      add_theme_support( 'html5' );
      add_theme_support( 'comment-list' );
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
      wp_register_script( $this->text_domain . '-require', get_template_directory_uri() . '/scripts/require.js', array(), $this->version, true );
      // Register styles
      wp_register_style( $this->text_domain . '-app', defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? get_template_directory_uri() . '/styles/app.dev.css' : get_template_directory_uri() . '/styles/app.css', array(), $this->version, 'all' );
      // Register Color schema
      wp_register_style( $this->text_domain . '-color', get_template_directory_uri() . '/styles/' . $this->settings->get( 'color' ) . '.css', array( $this->text_domain . '-app' ), $this->version, 'all' );
      // Add custom editor styles
      add_editor_style( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'styles/editor-style.dev.css' : 'styles/editor-style.css' );
      
      // Custom Hooks
      add_filter( 'wp_get_attachment_image_attributes', array( $this, 'wp_get_attachment_image_attributes' ), 10, 2 );
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
     * @author {%= author_name %}
     * @since {%= version %}
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
     * Returns path to page's template
     * 
     * @return string
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function get_query_template() {
      $object = get_queried_object();
      
      if     ( is_404()                           && $template = get_404_template()            ) :
      elseif ( is_search()                        && $template = get_search_template()         ) :
      elseif ( is_tax()                           && $template = get_taxonomy_template()       ) :
      elseif ( is_front_page()                    && $template = get_front_page_template()     ) :
      elseif ( is_home()                          && $template = get_home_template()           ) :
      elseif ( is_attachment()                    && $template = get_attachment_template()     ) :
      elseif ( is_single()                        && $template = get_single_template()         ) :
      elseif ( is_page()                          && $template = get_page_template()           ) :
      elseif ( is_category()                      && $template = get_category_template()       ) :
      elseif ( is_tag()                           && $template = get_tag_template()            ) :
      elseif ( is_author()                        && $template = get_author_template()         ) :
      elseif ( is_date()                          && $template = get_date_template()           ) :
      elseif ( is_archive()                       && $template = get_archive_template()        ) :
      elseif ( is_comments_popup()                && $template = get_comments_popup_template() ) :
      elseif ( is_paged()                         && $template = get_paged_template()          ) :
      else : $template = get_index_template();
      endif;
    
      $template = apply_filters( 'template_include', $template );
      return $template;
    }
    
    /**
     * Adds 'img-responsive' Bootstrap class to all images
     * 
     * @param array $attr
     * @param type $attachment
     * @return array
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function wp_get_attachment_image_attributes( $attr, $attachment ) {
      $attr[ 'class' ] = trim( $attr[ 'class' ] . ' img-responsive' );
      return $attr;
    }
    
    /**
     * Returns post image's url with required size.
     * 
     * Examples:
     * 1) ${%= short_name %}->get_image_link_by_post_id( get_the_ID() ); // Returns Full image
     * 2) ${%= short_name %}->get_image_link_by_post_id( get_the_ID(), array( 'size' => 'medium' ) ); // Returns image with predefined size
     * 3) ${%= short_name %}->get_image_link_by_post_id( get_the_ID(), array( 'width' => '430', 'height' => '125' ) ); // Returns image with custom size
     * 
     * @global array $wpp_query
     * @param int $post_id
     * @param string $args
     * @return string Returns false if image can not be returned
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function get_image_link_by_post_id( $post_id, $args = array() ) {
      global $wpp_query;
      
      extract( wp_parse_args( $args, $default = array(
        'size' => 'full', // Get image by predefined image_size. If width and height are set - it's ignored.
        'width' => '', // Custom size
        'height' => '', // Custom size
        // Optionals:
        'post_type' => false, // Different post types can have different default images
        'default' => true, // Use default image if images doesn't exist or not.
        'default_filetype' => 'png', // Filetype of default image. May be used in theme childs implementations
      ) ) );
      
      if ( has_post_thumbnail( $post_id ) ) {
        $attachment_id = get_post_thumbnail_id( $post_id );
      } else {
        // Use default image if image for post doesn't exist
        if ( $default ) {
          
          $wp_upload_dir = wp_upload_dir();
          $dir = $wp_upload_dir[ 'basedir' ] . '/no_image/' . md5( $this->text_domain ) . '';
          $url = $wp_upload_dir[ 'baseurl' ] . '/no_image/' . md5( $this->text_domain ) . '';
          $path = $dir . '/' . $this->settings->get( 'color' ) . ( !empty( $post_type ) ? "-{$post_type}" : "" ) . '.' . $default_filetype;
          $default_path = get_template_directory_uri() . '/images/no_image/' . basename( $path );
          $guid = $url . '/' . basename( $path );
          
          if( !is_dir( $dir ) ) {
            wp_mkdir_p( $dir );
          }
          
          // If attachment for default image doesn't exist
          if( !$attachment_id = Utility::get_image_id_by_guid( $guid ) ) {
            // Determine if image exists. Check image by post_type at first if post_type is passed.
            if( !file_exists( $default_path ) ) {
              return false;
            }
            if( !file_exists( $path ) ) {
              copy( $default_path, $path );
            }
            
            $wp_filetype = wp_check_filetype( basename( $path ), null );
            $attachment = array(
              'guid' => $guid, 
              'post_mime_type' => $wp_filetype['type'],
              'post_title' => __( 'No Image', $this->text_domain ),
              'post_content' => '',
              'post_status' => 'inherit'
            );
            
            if( !$attachment_id = wp_insert_attachment( $attachment, $path ) ) {
              return false;
            }
            
            // image.php file must be included at first
            // for the function wp_generate_attachment_metadata() to work
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $path );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            
          }
          
        } else {
          return false;
        }
      }
      
      if( !empty( $width ) && !empty( $height ) ) {
        $_attachment = Utility::get_image_link_with_custom_size( $attachment_id, $width, $height );
      } else {
        if( $size == 'full' ) {
          $_attachment = wp_get_attachment_image_src( $attachment_id, $size );
          $_attachment[ 'url' ] = $_attachment[0];
        } else {
          $_attachment = Utility::get_image_link( $attachment_id, $size );
        }
      }
      
      return is_wp_error( $_attachment ) ? false : $_attachment[ 'url' ];
    }
    
    /**
     * Set/reset excerpt filters: excerpt_length, excerpt_more
     * 
     * Example:
     * $wp_escalade->set_excerpt_filter( '30', 'length' ); // Set excerpt length = 30
     * the_excerpt(); // Excerpt's length will be 30.
     * $wp_escalade->set_excerpt_filter( false, 'length' ); // Reset applied above filter.
     * 
     * @staticvar array $_function
     * @param mixed $val
     * @param string $filter Available values: length, more
     * @return boolean
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function set_excerpt_filter( $val = false, $filter = 'length' ) {
      static $_function = array( 'excerpt_length' => '', 'excerpt_more' => '' );
      
      if( !in_array( $filter, array( 'length', 'more' ) ) ) {
        return false;
      }
      
      $_filter = 'excerpt_' . $filter;
      
      if( has_action( $_filter, $_function[ $_filter ] ) ) {
        remove_filter( $_filter, $_function[ $_filter ] );
      }
      
      if( !$val ) {
        $_function[ $_filter ] = '';
        return true;
      }
      
      $_function[ $_filter ] = create_function( '$val', 'return "'. $val . '";' );
      
      add_filter( $_filter, $_function[ $_filter ] );
      
      return true;
    }
    
    /**
     * Return name of Navigation Menu
     * 
     * @param string $slug
     * @return string If menus not found, boolean false will be returned
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function get_menus_name( $slug ) {
      $cippo_menu_locations = (array) get_nav_menu_locations();
      $menu = get_term_by( 'id', (int) $cippo_menu_locations[ $slug ], 'nav_menu', ARRAY_A );
      return !empty( $menu[ 'name' ] ) ? $menu[ 'name' ] : false;
    }
    
    /**
     * Prints styled bloginfo name
     * 
     * @return type
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public function the_bloginfo_name() {
      $name = get_bloginfo( 'name', 'display' );
      echo $name;
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
     * @author {%= author_name %}
     * @since {%= version %}
     */
    public static function error_handler( $code, $message, $file, $line ) {
      // Log error
      error_log( $message );
      // Output message
      wp_die( "<h1>Error</h1><p>We apologize for the inconvenience and will return shortly.</p><p>$message</p>" );
    }

  }

  // Instantiate
  // Instantiate
  global ${%= short_name %};
  ${%= short_name %} = new {%= short_name %};

}