<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['title'] = 'Blog';

$options = MAKEIT::get_options();
if(isset($options['blog'])){
    if(isset($options['blog']['title']))
        $context['title'] = $options['blog']['title'];

    if(isset($options['blog']['subtitle']))
        $context['subtitle'] = $options['blog']['subtitle'];
}

$context['sidebar'] = Timber::get_widgets('blog_sidebar');
Timber::render( 'index.twig', $context );
