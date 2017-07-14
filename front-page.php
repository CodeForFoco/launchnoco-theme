<?php

$options = MAKEIT::get_options();

$context = Timber::get_context();

if(isset($options['home']) && isset($options['home']['slider'])):
$context['home_slides'] = Timber::get_posts([
    'post_type'         =>  'slide',
    'posts_per_page'    =>  intval($options['home']['slider']['count']) > 0 ? intval($options['home']['slider']['count']) : -1,
    'orderby'           =>  isset($options['home']['slider']['orderby']) ? $options['home']['slider']['orderby'] : 'date',
    'tax_query'         =>  [
        [
            'taxonomy' => 'type',
            'field'    => 'term_id',
            'terms'    => intval($options['home']['slider']['type']),
        ]
    ]
], 'Awesome_Slide');
endif;
$context['posts'] = Timber::get_posts([
    'post_type'         =>   'post',
    'post_status'       =>  'publish',
    'posts_per_page'    =>  8
]);

// Portfolio
$context['portfolio'] = Timber::get_posts([
    'post_type'     =>  'portfolio',
    'post_status'   =>  'publish',
    'orderby'       =>  'menu_order',
], 'Awesome_Portfolio');

 // !Kint::dump( $context['portfolio'] ); die();

Timber::render( 'pages/home.twig', $context );
