<?php

if ( ! defined( 'ABSPATH' ) ) exit;

//Add Modudule's cusotm db settings
add_filter('af_customizer_settings', function($settings){
    //Footer
    $settings[] = [
        'id'        =>  'cqt_setting[footer][background]',
        'default'   => __( MAKEIT_ASSETS_DIR.'images/cork-background.png', 'wcws' ),
        'type'      =>  'theme_mod',
    ];

    //Home Page
    $settings[] = [
        'id'        =>  'cqt_setting[home][slider][type]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[home][slider][count]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[home][slider][orderby]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];

    //Blog Page
    $settings[] = [
        'id'        =>  'cqt_setting[blog][title]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[blog][subtitle]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];

    //Contact Info
    $settings[] = [
        'id'        =>  'cqt_setting[contact][phone]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[contact][phone_intro]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[contact][email]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];
    $settings[] = [
        'id'        =>  'cqt_setting[contact][email_intro]',
        'type'      =>  'theme_mod',
        'default'   =>  ''
    ];

    return $settings;
}, 60);

//Hook in Module's custom controls
add_filter('af_customizer_controls', function($controls){
    $slider_types = get_terms([
        'taxonomy'       =>  'type',
        'hide_empty'     =>  false
    ]);
    $types = [];
    foreach($slider_types as $type){
        $types[$type->term_id] = $type->name;
    }unset($slider_types);
    //Home Page
    $controls[] = [
        'id'            =>  'cqt_setting[home][slider][type]',
        'type'          =>  'select',
        'choices'       =>  $types,
        'section'       =>  'wcms_mods_pages_home',
        'label'         =>  __( 'Home Slider Type' ),
        'description'   =>  __( 'Select Homepage Slider Type'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[home][slider][count]',
        'type'          =>  'number',
        'section'       =>  'wcms_mods_pages_home',
        'label'         =>  __( 'Home Slider Count' ),
        'description'   =>  __( 'How Many Sliders Would you like to show at a time'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[home][slider][orderby]',
        'type'          =>  'select',
        'choices'       =>  [
            'none'      =>  'None',
            'title'     =>  'Slide Title',
            'date'      =>  'Published Date',
            'rand'      =>  'Random Order'
        ],
        'section'       =>  'wcms_mods_pages_home',
        'label'         =>  __( 'Randomize Slider' ),
        'description'   =>  __( 'Check to Show slides in random order'),
    ];

    //Blog Page
    $controls[] = [
        'id'            =>  'cqt_setting[blog][title]',
        'type'          =>  'text',
        'choices'       =>  $types,
        'section'       =>  'wcms_mods_pages_blog',
        'label'         =>  __( 'Blog Page Title' ),
        'description'   =>  __( 'Enter blog page title'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[blog][subtitle]',
        'type'          =>  'text',
        'choices'       =>  $types,
        'section'       =>  'wcms_mods_pages_blog',
        'label'         =>  __( 'Blog Page Subtitle' ),
        'description'   =>  __( 'Enter blog page subtitle'),
    ];

    //Contact Info
    $controls[] = [
        'id'            =>  'cqt_setting[contact][phone]',
        'type'          =>  'tel',
        'section'       =>  'wcms_mods_contact',
        'label'         =>  __( 'Phone Number' ),
        'description'   =>  __( 'Formmated phone number'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[contact][phone_intro]',
        'type'          =>  'text',
        'section'       =>  'wcms_mods_contact',
        'label'         =>  __( 'Phone Intro' ),
        'description'   =>  __( 'Any call to action or text you would like before the phone number'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[contact][email]',
        'type'          =>  'tel',
        'section'       =>  'wcms_mods_contact',
        'label'         =>  __( 'Email address' ),
        'description'   =>  __( 'Formmated email address'),
    ];
    $controls[] = [
        'id'            =>  'cqt_setting[contact][email_intro]',
        'type'          =>  'text',
        'section'       =>  'wcms_mods_contact',
        'label'         =>  __( 'Email Intro' ),
        'description'   =>  __( 'Any call to action or text you would like before the email address'),
    ];

    //Footer
    $controls[] = [
        'id'            =>  'cqt_setting[footer][background]',
        'type'          =>  'image',
        'class'         =>  'WP_Customize_Image_Control',
        'section'       =>  'wcms_mods_footer',
        'label'         =>  __( 'Footer Background' ),
        'description'   =>  __( ''),
    ];

    return $controls;
}, 60);

//Add Module's custom settings section
add_filter('af_customizer_sections', function($sections){
    $my_sections = [
        [
            'id'            =>  'wcms_mods_pages_home',
            'title'         =>  'Pages:Home',
            'description'   =>  'Home Page customizations'
        ],
        [
            'id'            =>  'wcms_mods_pages_blog',
            'title'         =>  'Pages:Blog',
            'description'   =>  'Blog Page customizations'
        ],
        [
            'id'            =>  'wcms_mods_contact',
            'title'         =>  'Contact & Social Medial',
            'description'   =>  'Contact and Social accounts settings'
        ]
    ];

    return array_merge($my_sections, $sections);
}, 60);