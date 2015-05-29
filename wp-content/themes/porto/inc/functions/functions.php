<?php

require_once(porto_functions . '/general.php');
require_once(porto_functions . '/shortcodes.php');
require_once(porto_functions . '/widgets.php');
require_once(porto_functions . '/content_type.php');
require_once(porto_functions . '/post.php');
if ( class_exists( 'WooCommerce' ) ) {
    require_once(porto_functions . '/woocommerce.php');
}
require_once(porto_functions . '/layout.php');

function porto_demo_types() {
    return array(
        '_1' => __("Demo 1", 'porto'),
        '_2' => __("Demo 2", 'porto'),
        '_3' => __("Demo 3", 'porto'),
        '_4' => __("Demo 4", 'porto'),
        '_5' => __("Demo 5", 'porto'),
        '_6' => __("Demo 6", 'porto'),
        '_7' => __("Demo 7", 'porto'),
        '_8' => __("Demo 8", 'porto'),
        '_9' => __("Demo 9", 'porto'),
        '_10' => __("Demo 10", 'porto'),
        '_rtl' => __("RTL Demo", 'porto')
    );
}