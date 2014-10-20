<?php
/**
 * The current file is just Bootstrap Loader.
 * Do not touch it!
 * Please see {%= namespace %}\{%= bootstrap_class %} which initialize theme. ( lib/classes/class-{%= bootstrap_class %}.php )
 *
 */

if( !function_exists( 'ud_get_theme_{%= slug %}' ) ) {

  /**
   * Returns {%= title %} Instance
   *
   * @author Usability Dynamics, Inc.
   * @since {%= version %}
   */
  function ud_get_theme_{%= slug %}( $key = false, $default = null ) {
    $instance = \{%= namespace %}\{%= bootstrap_class %}::get_instance();
    return $key ? $instance->get( $key, $default ) : $instance;
  }

}

if( !function_exists( 'ud_check_theme_{%= slug %}' ) ) {
  /**
   * Determines if theme can be initialized.
   *
   * @author Usability Dynamics, Inc.
   * @since {%= version %}
   */
  function ud_check_theme_{%= slug %}() {
    global $_ud_{%= slug %}_error;
    try {
      //** Be sure composer.json exists */
      $file = dirname( __FILE__ ) . '/composer.json';
      if( !file_exists( $file ) ) {
        throw new Exception( __( 'Distributive is broken. composer.json is missed. Try to remove and upload theme again.', '{%= text_domain %}' ) );
      }
      $data = json_decode( file_get_contents( $file ), true );
      //** Be sure PHP version is correct. */
      if( !empty( $data[ 'require' ][ 'php' ] ) ) {
        preg_match( '/^([><=]*)([0-9\.]*)$/', $data[ 'require' ][ 'php' ], $matches );
        if( !empty( $matches[1] ) && !empty( $matches[2] ) ) {
          if( !version_compare( PHP_VERSION, $matches[2], $matches[1] ) ) {
            throw new Exception( sprintf( __( 'Theme requires PHP %s or higher. Your current PHP version is %s', '{%= text_domain %}' ), $matches[2], PHP_VERSION ) );
          }
        }
      }
      //** Be sure vendor autoloader exists */
      if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
        require_once ( dirname( __FILE__ ) . '/vendor/autoload.php' );
      } else {
        throw new Exception( sprintf( __( 'Distributive is broken. %s file is missed. Try to remove and upload theme again.', '{%= text_domain %}' ), dirname( __FILE__ ) . '/vendor/autoload.php' ) );
      }
      //** Be sure our Bootstrap class exists */
      if( !class_exists( '\{%= namespace %}\{%= bootstrap_class %}' ) ) {
        throw new Exception( __( 'Distributive is broken. Theme loader is not available. Try to remove and upload theme again.', '{%= text_domain %}' ) );
      }
    } catch( Exception $e ) {
      $_ud_{%= slug %}_error = $e->getMessage();
      return false;
    }
    return true;
  }

}

if( !function_exists( 'ud_theme_{%= slug %}_message' ) ) {
  /**
   * Renders admin notes in case there are errors on theme init
   *
   * @author Usability Dynamics, Inc.
   * @since 1.0.0
   */
  function ud_theme_{%= slug %}_message() {
    global $_ud_{%= slug %}_error;
    if( !empty( $_ud_{%= slug %}_error ) ) {
      $message = sprintf( __( '<p><b>%s</b> can not be initialized. %s</p>', '{%= text_domain %}' ), '{%= title %}', $_ud_{%= slug %}_error );
      echo '<div class="error fade" style="padding:11px;">' . $message . '</div>';
    }
  }
  add_action( 'admin_notices', 'ud_theme_{%= slug %}_message' );
}

if( ud_check_theme_{%= slug %}() ) {
  //** Initialize. */
  ud_get_theme_{%= slug %}();
}