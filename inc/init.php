<?php if (! defined('ABSPATH')) {
    die('Direct access forbidden.');
}

class UniversalLanding_Theme_Includes
{
    private static $rel_path = null;

    private static $include_isolated_callable;

    private static $initialized = false;

    public static function init()
    {
        if (self::$initialized) {
            return;
        } else {
            self::$initialized = true;
        }

        /**
         * Include a file isolated, to not have access to current context variables
         */
        self::$include_isolated_callable = create_function('$path', 'include $path;');

        /**
         * Both frontend and backend
         */
        {
        	self::include_child_first('/helpers.php');
            self::include_child_first('/hooks.php');
        	self::include_child_first('/widgets.php');

        	add_action('init', array(__CLASS__, '_action_init'));
        }

        /**
         * Only frontend
         */
        if (!is_admin()) {
            add_action( 'wp_enqueue_scripts', 'boxagency_additionally_scripts', 99 );
            function boxagency_additionally_scripts() {
            	wp_localize_script('jquery', 'globalParams',
            		array(
                        'site_url' => site_url(),
                        'ajax_url' => admin_url('admin-ajax.php'),
                        'ya_metrika_id' => fw_get_db_settings_option('ul_general_yandex_metrika_id')
                    )
            	);
            }

            add_action('wp_enqueue_scripts', array(__CLASS__, '_action_enqueue_scripts'), 20);
        }

        // Add widget support
        if (!function_exists('ul_register_sidebars')) {
            function ul_register_sidebars() {
                register_sidebar(
                    array(
                        'id' => 'sidebar-blog',
                        'name' => __('Сайдбар в блоге', 'ul'),
                        'description' => __('Перетащите сюда виджеты, чтобы добавить их в сайдбар.', 'ul')
                    )
                );
                if (ul_is_woocommerce_activated()) {
                    register_sidebar(
                        array(
                            'id' => 'products-filter',
                            'name' => __('Фильтр товаров', 'ul'),
                            'description' => __('Перетащите сюда виджеты, чтобы добавить их в сайдбар.', 'ul')
                        )
                    );
                }
            }
             
            add_action( 'widgets_init', 'ul_register_sidebars' );
        }

        // Exclude page from search result
        // if (!function_exists('ul_search_filter')) {
        //     function ul_search_filter($query) {
        //         if ($query->is_search) {
        //             $query->set('post_type', 'post');
        //         }
        //         return $query;
        //     }

        //     add_filter('pre_get_posts','ul_search_filter');
        // }
    }

    private static function get_rel_path($append = '')
    {
        if (self::$rel_path === null) {
            self::$rel_path = '/inc';
        }

        return self::$rel_path . $append;
    }

    public static function get_parent_path($rel_path)
    {
        return get_template_directory() . self::get_rel_path($rel_path);
    }

    public static function get_child_path($rel_path)
    {
        if (!is_child_theme()) {
            return null;
        }

        return get_stylesheet_directory() . self::get_rel_path($rel_path);
    }

    public static function include_isolated($path)
    {
        call_user_func(self::$include_isolated_callable, $path);
    }

    public static function include_child_first($rel_path)
    {
        if (is_child_theme()) {
            $path = self::get_child_path($rel_path);

            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }

        {
            $path = self::get_parent_path($rel_path);

            if (file_exists($path)) {
                self::include_isolated($path);
            }
        }
    }

    /**
     * @internal
     */
    public static function _action_enqueue_scripts()
    {
        self::include_child_first('/static.php');
    }

    /**
     * @internal
     */
    public static function _action_init()
    {
    	self::include_child_first('/post-types.php');
    }

}

UniversalLanding_Theme_Includes::init();
