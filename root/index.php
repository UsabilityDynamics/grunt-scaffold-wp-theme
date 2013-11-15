<?php
/**
 * The Core Template File
 *
 * Fallback for all other templates.
 * Can be overwritten by: taxonomy.php, category.php, tag.php, author.php, archive-$post_type.php and other more specific templates.
 *
 * @author {%= author_name %}
 * @module {%= short_name %}  
 * @since {%= short_name %} {%= version %}
 */
get_template_part( 'templates/page/header', get_post_type() ); 
?>
index.php
<?php get_template_part( 'templates/page/footer', get_post_type() ); ?>