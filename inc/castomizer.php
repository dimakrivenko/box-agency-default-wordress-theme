<?php
    if (!defined('ABSPATH')) {
        die('Direct access forbidden.');
    }

    /**
     * Theme default customizer
     */

    function ul_customize_register($wp_customize)
    {

    }
    add_action('customize_register', 'ul_customize_register');
