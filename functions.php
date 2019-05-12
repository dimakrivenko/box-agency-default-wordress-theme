<?php
    /**
     * functions.php
     *
     * The theme's functions and definitions.
     */
    /**
     * Define constants. Current Version number & Theme Name.
     */

    define('UL_THEME', 'Default WordPress Theme');
    define('UL_VERSION', '1.0.0');
    define('UL_THEMEROOT', get_template_directory_uri());
    define('UL_ASSETS', UL_THEMEROOT . '/assets');
    define('UL_IMAGES', UL_THEMEROOT . '/assets/images');
    define('UL_CSS', UL_THEMEROOT . '/assets/css');
    define('UL_SCRIPTS', UL_THEMEROOT . '/assets/js');

    /**
     * ----------------------------------------------------------------------------------------
     * Set up the content width value based on the theme's design.
     * ----------------------------------------------------------------------------------------
     */
    if (!isset($content_width)) {
        $content_width = 800;
    }

    /**
     * ----------------------------------------------------------------------------------------
     * Set up theme default and register various supported features.
     * ----------------------------------------------------------------------------------------
     */
    if (!function_exists('ul_setup')) {
        function ul_setup()
        {
            /**
             * Make the theme available for translation.
             */
            load_theme_textdomain('ul', get_template_directory() . '/languages');


            /**
             * Add support for post formats.
             */
            // add_theme_support('post-formats', array()
            // );

            /**
             * Add support for automatic feed links.
             */
            add_theme_support('automatic-feed-links');

            /*
             * Let WordPress manage the document title.
             * By adding theme support, we declare that this theme does not use a
             * hard-coded <title> tag in the document head, and expect WordPress to
             * provide it for us.
             */
            add_theme_support('title-tag');


            /**
             * Add support for post thumbnails.
             */
            add_theme_support('post-thumbnails');
            set_post_thumbnail_size(300, 300, array('center', 'center')); // Hard crop center center


            /**
             * Register nav menus.
             */
            register_nav_menus(
                array(
                    'header-menu' => __('Header menu', 'ul'),
                    // 'footer-menu' => __('Footer menu', 'ul')
                )
            );
            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support('html5', array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
            ));

            add_filter('upload_mimes', 'cc_mime_types');

            add_theme_support('widgets');

            // Woocommerce support
            // add_theme_support( 'woocommerce' );
        }

        add_action('after_setup_theme', 'ul_setup');
    }

    /*
     * Theme Inc
     */
    include_once get_template_directory() .'/inc/init.php';

    /*
     * Castomizer
     */
    include_once get_template_directory() .'/inc/castomizer.php';

    /*
     * AJAX
     */
    include_once get_template_directory() .'/inc/ajax.php';

    // if ( ul_is_woocommerce_activated() ) {
    //     include_once get_template_directory() . '/inc/woocommerce/ul-woocommerce-template-functions.php';
    //     include_once get_template_directory() . '/inc/woocommerce/ul-woocommerce-template-hooks.php';
    //     include_once get_template_directory() . '/inc/woocommerce/ul-woocommerce-widget-functions.php';
    // }
