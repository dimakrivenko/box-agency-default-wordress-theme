<?php

    if (!defined('ABSPATH')) {
        die('Direct access forbidden.');
    }

    /**
     * Theme’s filters and actions
     */

    /*
     * TGM REQUIRE PLUGIN
     * require or recommend plugins for your WordPress themes
     */

    require_once get_template_directory() . '/inc/includes/plugin-activator.php';

    /** @internal */
    function _action_ul_register_required_plugins() {

        $plugin_dir = UL_THEMEROOT . '/inc/includes/plugins';

        $plugins = array(
            array(
                'name' => 'Unyson',
                'slug' => 'unyson',
                'required' => true,
                'source' => $plugin_dir . '/unyson.2.7.21.zip',
                'force_activation' => true,
            ),
            array(
                'name' => 'Classic Editor',
                'slug' => 'classic-editor',
                'required' => true,
                'source' => $plugin_dir . '/classic-editor.1.3.zip',
                'force_activation' => true,
            ),
            array(
                'name' => 'WP translitera',
                'slug' => 'wp-translitera',
                'required' => true,
                'source' => $plugin_dir . '/wp-translitera.p1.2.5.zip',
                'force_activation' => true,
            ),
            array(
                'name' => 'Robin Image Optimizer',
                'slug' => 'robin-image-optimizer',
                'required' => true,
                'source' => $plugin_dir . '/robin-image-optimizer.zip',
                'force_activation' => true,
            ),
            array(
                'name' => 'Google Sitemap Generator',
                'slug' => 'google-sitemap-generator',
                'required' => true,
                'source' => $plugin_dir . '/google-sitemap-generator.4.1.0.zip',
                'force_activation' => true,
            ),
            array(
                'name' => 'WP Super Cache',
                'slug' => 'wp-super-cache',
                'required' => true,
                'source' => $plugin_dir . '/wp-super-cache.1.6.4.zip',
                'force_activation' => true,
            ),
        );

        $config = array(
            'id'           => 'ul',                    // Unique ID for hashing notices for multiple instances of TGMPA.
    		'default_path' => '',                      // Default absolute path to bundled plugins.
    		'menu'         => 'tgmpa-install-plugins', // Menu slug.
    		'has_notices'  => true,                    // Show admin notices or not.
    		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    		'message'      => '',
        );

        tgmpa($plugins, $config);
    }
    add_action('tgmpa_register', '_action_ul_register_required_plugins');

