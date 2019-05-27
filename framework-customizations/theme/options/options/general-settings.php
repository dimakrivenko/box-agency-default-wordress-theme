<?php

if (!defined('FW')) {
    die('Forbidden');
}

$options = array(
    'general' => array(
        'title' => __('Основные настройки', 'ul'),
        'type' => 'tab',
        'options' => array(
            'general-box' => array(
                'type' => 'box',
                'options' => array(
                    'ul_general_favicon' => array(
                        'label' => __('Favicon', 'ul'),
                        'type' => 'upload'
                    ),
                    'ul_general_opengraph_group' => array(
                        'type'    => 'group',
                        'options' => array(
                            'ul_general_opengraph_title' => array(
                                'type' => 'text',
                                'label'   => __('Open Graph - Заголовок', 'ul'),
                                'value'   => ''
                            ),
                            'ul_general_opengraph_description' => array(
                                'type' => 'text',
                                'label'   => __('Open Graph - Описание', 'ul'),
                                'value'   => ''
                            ),
                            'ul_general_opengraph_image' => array(
                                'type' => 'upload',
                                'label' => __('Open Graph - Изображение', 'ul')
                            ),
                            'ul_general_opengraph_image_width' => array(
                                'type' => 'text',
                                'label'   => __('Open Graph - Ширина изображения', 'ul'),
                                'value'   => ''
                            ),
                            'ul_general_opengraph_image_height' => array(
                                'type' => 'text',
                                'label'   => __('Open Graph - Высота изображения', 'ul'),
                                'value'   => ''
                            )
                        )
                    ),
                    'ul_general_email_list' => array(
                        'type'  => 'addable-option',
                        'value' => array(),
                        'label'   => __('Адреса для отправки на E-mail', 'ul'),
                        'add-button-text' => __('Add', 'ul'),
                        'sortable' => true
                    ),
                    'ul_general_yandex_metrika_id' => array(
                        'type' => 'text',
                        'label'   => __('Yandex metrika ID', 'ul'),
                        'value'   => ''
                    ),
                    'ul_general_custom_js_code' => array(
                        'type' => 'textarea',
                        'label'   => __('Пользовательский JS код', 'ul'),
                        'value'   => ''
                    ),
                ),
            ),
        )
    )
);
