<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
 */
get_template_part( 'templates/page/header', get_post_type() ); 
?>
404.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>