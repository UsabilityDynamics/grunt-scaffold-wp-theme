<?php
/**
 * Property overview page.
 *
 * Used when no WordPress page is setup to display overview via shortcode.
 * Will be rendered as a 404 not-found, but still can display properties.
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
 */
 get_template_part( 'templates/page/header', get_post_type() ); 
?>
templates/wp-property/property-overview-page.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>