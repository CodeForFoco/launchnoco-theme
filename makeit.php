<?php if ( ! defined( 'ABSPATH' ) )  exit;

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    });

    add_filter('template_include', function($template) {
        return get_stylesheet_directory() . '/static/no-timber.html';
    });

    return;
}

/**
 * Woocommerce Woody Shop functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Woocommerce_Clean_Shop
 */

//require_once(MAKEIT_FRAMEWORK_DIR."/vendors/autoload.php");

/**
 * Hook into Awesome Framework Customizer Menu
 */
include_once('settings.php');

class MakeIt{
    /**
     *
     */
    protected static $instance;

    /**
     * Stores theme options
     */
    protected static $options;

    /**
     * Return exising intance;
     * otherwise instantiate, then return new instance.
     */
    public static function get_instance():self{
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Api for accessing theme options
     *
     * @return Array
     */
    public static function get_options(){
        if(self::$options)
            return self::$options;

        self::$options = get_theme_mod('makeit_setting', []);

        if(isset(self::$options['sort_by_metas'])){
            self::$options['sort_by_metas'] = explode(',', self::$options['sort_by_metas'] );
            self::$options['sort_by_metas'] = bn_array_flatten( array_map(function($m){
                return [$m => ucwords( trim(str_replace('_', ' ', $m) ) ) ];
            },self::$options['sort_by_metas'] ) );
        }

        if(isset(self::$options['contact']))
            $array['notices']['contact'] = self::$options['contact'];

        if(isset(self::$options['hours']))
            $array['notices']['hours'] = self::$options['hours'];

        if(isset(self::$options['products_cats'])){
            self::$options['products_cats'] = explode(',', self::$options['products_cats']);
        }

        return self::$options;
    }

    protected function __construct() {
        self::get_options();

        $this->load_classes();

        $this->init();
    }

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    public function makeit_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Woocommerce Clean Shop, use a find and replace
         * to change 'makeit' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'makeit', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( [
            'makeit_primary' => esc_html__( 'Primary Menu', 'makeit' ),
            'makeit_user' => esc_html__( 'User Menu', 'makeit' ),
            'makeit_footer' => esc_html__( 'Footer Menu', 'makeit' ),
            'makeit_helpful_links' => esc_html__( 'Helpful Links Menu', 'makeit' )
        ] );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ] );

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support( 'post-formats', [
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ] );

        add_theme_support( 'woocommerce' );
    }

    public function makeit_scripts_styles() {
        // wp_enqueue_style( 'makeit-style', MAKEIT_URI . '/style.css' );

        wp_register_script( 'makeit-script', MAKEIT_ASSETS_URI . 'js/app.js', array('jquery', 'bootstrap', 'vue', 'slick','masonry'), MAKEIT_VER, true );
        wp_localize_script('makeit-script','MAKEIT_VARS', array(
                'API_BASE'	=>	site_url('/wp-json/makeit'),
                'BREAKPOINTS'	=>	[
                    'BREAKPOINT_SM'	    =>	720,
                    'BREAKPOINT_MD'	    =>	980,
                    'BREAKPOINT_MMD'	=>	1080,
                    'BREAKPOINT_LG'	    =>	1180,
                    'BREAKPOINT_LLG'    =>	1280,
                    'BREAKPOINT_XL'	    =>	1480,
                    'BREAKPOINT_XXL'    =>	1680,
                    'BREAKPOINT_SL'	    =>	1880,
                    'BREAKPOINT_SSL'    =>	2080
                ]
            )
        );

        wp_enqueue_script( 'makeit-script');

        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }

        //!Kint::dump(wp_script_is('makeit-script','enqueued')); die();
    }

    public function makeit_admin_scripts_styles() {
        //wp_enqueue_script( 'makeit-admin-script', MAKEIT_ASSETS_URI . '/js/admin/app.admin.js', array('jquery'), '2', true );
    }

    public function add_to_context( $context ) {
        $options = self::get_options();

        //$data = TimberHelper::transient(AwesomeWaffle::get_transient_key('makeit_global_context'), function() use ($options, $context){
            $array = array();


            $array['menu']['social'] = new TimberMenu( 'makeit_social' );
            $array['menu']['footer'] = new TimberMenu( 'makeit_footer' );

            if(isset($options['contact']))
                $array['notices']['contact'] = $options['contact'];

            if(isset($options['hours']))
                $array['notices']['hours'] = $options['hours'];

            if(is_array($options) && !empty($options))
                $array['options'] = array_merge($options, $context['options']);

            if(isset($context['options']['logo']))
                $array['options']['logo'] = new CQP_Image($context['options']['logo']);

            //return $array;
        //},Crucible_Quest_Plugin::DATA_CACHE_TIME_LONG);

        $context = array_merge($context, (array) $array);
        $context['menu']['primary'] = new TimberMenu( 'makeit_primary' );
        $context['show_sidebar'] = true;
        $context['page_header'] = true;
        $context['container'] = true;
        $context['MAKEIT_URI'] = MAKEIT_URI;

        $context['widgets']['footer_widget_fluid'] = Timber::get_widgets('makeit_footer_fluid_columns');

        //breadcrumbs
        if ( function_exists('yoast_breadcrumb') )
            $context['yoast_breadcrumb'] = yoast_breadcrumb('<div id="breadcrumbs">', '</div>', false);

        return $context;
    }

    /**
     * Register Widget Area.
     *
     */
    public function wpgyan_widgets_init() {
        register_sidebar( [
            'name'          => 'Blog Sidebar',
            'id'            => 'blog_sidebar',
            'before_widget' => '<div id="%1$s"  class="makeit-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="title widget-title">',
            'after_title'   => '</h2>',
        ] );

        register_sidebar( [
            'name'          => 'Page Sidebar',
            'id'            => 'page_sidebar',
            'before_widget' => '<div  id="%1$s" class="makeit-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="title widget-title">',
            'after_title'   => '</h2>',
        ] );
    }


    private function load_classes(){
        foreach(glob(MAKEIT_FRAMEWORK_DIR."/classes/*.php") as $file):
            include_once($file);
        endforeach;
    }

    protected function init(){
        add_filter( 'timber_context', array( &$this, 'add_to_context' ), 40 );

        add_action( 'after_setup_theme', array(&$this, 'makeit_setup'), 40);
        add_action( 'wp_enqueue_scripts', array(&$this, 'makeit_scripts_styles'), 40);

        add_action( 'widgets_init', [&$this, 'wpgyan_widgets_init'] );

        if(!is_admin())
            return;
    }
}MakeIt::get_instance();