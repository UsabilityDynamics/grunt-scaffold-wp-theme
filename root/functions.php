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
     */
    public function __construct() {}

  }

  // Instantiate
  new {%= name %};

}