<?php
/**
 * Bootstrap
 *
 * @since {%= version %}
 */
namespace {%= namespace %} {

  if( !class_exists( '{%= namespace %}\{%= bootstrap_class %}' ) ) {

    final class {%= bootstrap_class %} extends \UsabilityDynamics\WP\Bootstrap_Theme {
      
      /**
       * Singleton Instance Reference.
       *
       * @protected
       * @static
       * @property $instance
       * @type {%= namespace %}\{%= bootstrap_class %} object
       */
      protected static $instance = null;
      
      /**
       * Instantaite class.
       */
      public function init() {
        
        //** Here is we go. */
        
      }

    }

  }

}
