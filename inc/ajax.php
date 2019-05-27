<?php
    if (!defined('ABSPATH')) {
        die('Direct access forbidden.');
    }

    /**
     * Theme’s ajax
     */

    function sendEmail ($postArr) {
        if (isset($_POST)) {
            if (count(fw_get_db_settings_option('ul_general_email_list')) > 0) {
                $recipients = fw_get_db_settings_option('ul_general_email_list');
            } else {
                $recipients = array(get_option('admin_email'));
            }

            $headers .= 'From: '.get_bloginfo('name').' <' . $recipients[0] . '>' . "\r\n";
            $headers .= 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-Type: text/html;\r\n";

            $subject = __('Сообщение с сайта -', 'ul' ) . ' ' . get_bloginfo('name');
            $message_body = '<h2>'.$subject.'</h2>';

            if(!empty($_POST['name'])) { $message_body .= "<p><b>Имя : </b>".$_POST['name']."</p>"; }
            if(!empty($_POST['phone'])) { $message_body .= "<p><b>Телефон : </b>".$_POST['phone']."</p>"; }
            if(!empty($_POST['form_name'])) { $message_body .= "<p><b>Форма : </b>".$_POST['form_name']."</p>"; }

            $mail = wp_mail($recipients, $subject, $message_body, $headers);

            if ($mail) {
                echo 'email_sending_success';
            } else {
                echo 'email_sending_error';
            }
        } 
    }

    function ul_send_message_callback () {
        // Send on email
        sendEmail($_POST);

        wp_die();
    }

    // Send message to email
    add_action( 'wp_ajax_send_message', 'ul_send_message_callback' ); // For logged in users
    add_action( 'wp_ajax_nopriv_send_message', 'ul_send_message_callback' ); // For anonymous users




    
