<?php
/**
 * The Template for displaying all single posts.
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
 */
get_template_part( 'templates/page/header', get_post_type() ); 
?>
single.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>
