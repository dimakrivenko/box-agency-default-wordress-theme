<?php
    if (!defined('ABSPATH')) {
        die('Direct access forbidden.');
    }

    /**
     * Theme’s helpers
     */

    // Support SVG mime types
    function cc_mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
    add_filter('upload_mimes', 'cc_mime_types');


    // Get meta option from builder
    function get_meta_builder( $id, $shortcodeName ) {
        $meta = get_post_meta( absint( $id ), 'fw:opt:ext:pb:page-builder:json', true );
        $result = json_decode( $meta );

        foreach ( $result as $stdClass ) {
            if( $stdClass instanceof stdClass ) {
                if( $stdClass->shortcode === $shortcodeName ) {
                    return $stdClass->atts;
                }
            }
        }

        return null;
    }

    // Cut content on word count
    function content($post_id, $limit) {
        $content_post = get_post($post_id);

        $content = explode(' ', $content_post->post_content, $limit);

     
        if (count($content) >= $limit) {
            array_pop($content);
            $content = preg_replace('/[.+]/','', $content);
            $content = implode(" ",$content).'...';
        } else {
            $content = preg_replace('/[.+]/','', $content);
            $content = implode(" ",$content);
        } 

        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }


    
    if ( ! function_exists( 'ul_is_woocommerce_activated' ) ) {
        /**
         * Query WooCommerce activation
         */
        function ul_is_woocommerce_activated() {
            return class_exists( 'WooCommerce' ) ? true : false;
        }
    }
