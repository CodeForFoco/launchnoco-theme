<?php
if ( ! defined( 'ABSPATH' ) )  exit;

/**
 * This file initiates and setup Reflex Custom theme.
 *
 * Reflex is a custom theme developed by {@author}. Reflex comes with the following pre-packaged plugins: Custom Review Items Plugin (CRIP), Timber
 *
 * @author RADD Web Studio <developer@raddwebstudio.com>
 * @package Reflex
 *
 * @version 1.0.0
 */

/** Global Variables */
if(!defined('MAKEIT_DIR')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_DIR', trailingslashit( get_template_directory() ) );
}

if(!defined('MAKEIT_URI')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_URI', trailingslashit( get_template_directory_uri() ) );
}


if(!defined('MAKEIT_FRAMEWORK_URI')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_FRAMEWORK_URI', MAKEIT_URI."framework");
}

if(!defined('MAKEIT_FRAMEWORK_DIR')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_FRAMEWORK_DIR', MAKEIT_DIR."framework" );
}


if(!defined('MAKEIT_ASSETS_URI')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_ASSETS_URI', trailingslashit( MAKEIT_URI.'assets' ));
}

if(!defined('MAKEIT_ASSETS_DIR')){
    /**
     * Theme's full top system path
     */
    define('MAKEIT_ASSETS_DIR', trailingslashit( MAKEIT_DIR."assets") );
}

if(!defined('HOME_URL')){
    /**
     * Wrapper constact for the Wordpress' ({@link http://codex.wordpress.org/Function_Reference/get_home_url})
     */
    define('HOME_URL', trailingslashit( get_home_url() ) );
}

if(!defined('MAKEIT_VER')){
    $my_theme = wp_get_theme();
    /**
     * Theme's full top system path
     */
    define('MAKEIT_VER', $my_theme->get( 'Version' ) );
}

if(!class_exists('MAKEIT')) require_once('makeit.php');