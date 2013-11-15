<?php
/**
 * Property Default Template for Single Property View
 *
 * Overwrite by creating your own in the theme directory called either:
 * property.php
 * or add the property type to the end to customize further, example:
 * property-building.php or property-floorplan.php, etc.
 *
 * By default the system will look for file with property type suffix first,
 * if none found, will default to: property.php
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
*/
get_template_part( 'templates/page/header', get_post_type() ); 
?>
templates/wp-property/property.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>