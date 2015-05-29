<?php

function porto_check_theme_options() {
    // check default options
    global $porto_settings;

    ob_start();
    include(porto_admin . '/porto/default_options.php');
    $options = ob_get_clean();
    $porto_default_settings = json_decode($options, true);

    foreach ($porto_default_settings as $key => $value) {
        if (is_array($value)) {
            foreach ($value as $key1 => $value1) {
                if (!isset($porto_settings[$key][$key1]) || !$porto_settings[$key][$key1]) {
                    $porto_settings[$key][$key1] = $porto_default_settings[$key][$key1];
                }
            }
        } else {
            if (!isset($porto_settings[$key])) {
                $porto_settings[$key] = $porto_default_settings[$key];
            }
        }
    }

    return $porto_settings;
}

function porto_options_sidebars() {
    return array(
        'wide-left-sidebar',
        'wide-right-sidebar',
        'left-sidebar',
        'right-sidebar'
    );
}

function porto_options_body_wrapper() {
    return array(
        'wide' => __('Wide', 'porto'),
        'full' => __('Full', 'porto'),
        'boxed' => __('Boxed', 'porto')
    );
}

function porto_options_wrapper() {
    return array(
        'full' => __('Full', 'porto'),
        'boxed' => __('Boxed', 'porto')
    );
}

function porto_options_header_types() {
    return array(
        '1' => array('alt' => __('Header Type 1', 'porto'), 'img' => porto_options_uri.'/headers/header_01.png'),
        '2' => array('alt' => __('Header Type 2', 'porto'), 'img' => porto_options_uri.'/headers/header_02.png'),
        '3' => array('alt' => __('Header Type 3', 'porto'), 'img' => porto_options_uri.'/headers/header_03.png'),
        '4' => array('alt' => __('Header Type 4', 'porto'), 'img' => porto_options_uri.'/headers/header_04.png'),
        '5' => array('alt' => __('Header Type 5', 'porto'), 'img' => porto_options_uri.'/headers/header_05.png'),
        '6' => array('alt' => __('Header Type 6', 'porto'), 'img' => porto_options_uri.'/headers/header_06.png'),
        '7' => array('alt' => __('Header Type 7', 'porto'), 'img' => porto_options_uri.'/headers/header_07.png'),
        '8' => array('alt' => __('Header Type 8', 'porto'), 'img' => porto_options_uri.'/headers/header_08.png'),
        '9' => array('alt' => __('Header Type 9', 'porto'), 'img' => porto_options_uri.'/headers/header_09.png'),
        'side' => array('alt' => __('Header Type(Side Navigation)', 'porto'), 'img' => porto_options_uri.'/headers/header_side.png')





    );
}

function porto_options_footer_types() {
    return array(
        '1' => array('alt' => __('Footer Type 1', 'porto'), 'img' => porto_options_uri.'/footers/footer_01.png'),
        '2' => array('alt' => __('Footer Type 2', 'porto'), 'img' => porto_options_uri.'/footers/footer_02.png'),
        '3' => array('alt' => __('Footer Type 3', 'porto'), 'img' => porto_options_uri.'/footers/footer_03.png')





    );
}

