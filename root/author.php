<?php
/**
 * The template for displaying Author Archive pages.
 *
 * Used to display archive-type pages for posts by an author.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
 */
get_template_part( 'templates/page/header', get_post_type() ); 
?>
author.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>