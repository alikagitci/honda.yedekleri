<?php

// Porto Testimonial
add_shortcode('porto_testimonial', 'porto_shortcode_testimonial');
add_action('vc_build_admin_page', 'porto_load_testimonial_shortcode');
add_action('vc_after_init', 'porto_load_testimonial_shortcode');

function porto_shortcode_testimonial($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_testimonial'))
        include $template;
    return ob_get_clean();
}

function porto_load_testimonial_shortcode() {
    $animation_type = porto_vc_animation_type();
    $animation_duration = porto_vc_animation_duration();
    $animation_delay = porto_vc_animation_delay();
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        'name' => "Porto " . __('Testimonial', 'porto'),
        'base' => 'porto_testimonial',
        'category' => __('Porto', 'porto'),
        'icon' => 'porto_vc_testimonial',
        'weight' => - 50,
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Name', 'porto'),
                'param_name' => 'name',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Role', 'porto'),
                'param_name' => 'role',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Company', 'porto'),
                'param_name' => 'company',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Author Link', 'porto'),
                'param_name' => 'author_url',
                'admin_label' => true
            ),
            array(
                'type' => 'label',
                'heading' => __('Input Photo URL or Select Photo.', 'porto'),
                'param_name' => 'label'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Photo URL', 'porto'),
                'param_name' => 'photo_url'
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Photo', 'porto'),
                'param_name' => 'photo_id'
            ),
            array(
                'type' => 'textarea_html',
                'holder' => 'blockquote',
                'heading' => __('Quote', 'porto'),
                'param_name' => 'quote',
                'value' => __('<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.  Donec hendrerit vehicula est, in consequat.</p>', 'porto')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'View Type', 'porto' ),
                'param_name' => 'view',
                'value' => array(
                    __( 'Default', 'porto' )=> 'default',
                    __( 'Simple', 'porto' )=> 'simple',
                    __( 'Transparent', 'porto' ) => 'transparent'
                ),
                'admin_label' => true
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Color Skin', 'porto' ),
                'param_name' => 'color',
                'value' => array(
                    __( 'Normal', 'porto' )=> '',
                    __( 'White', 'porto' ) => 'white'
                ),
                'dependency' => array(
                    'element' => 'view',
                    'value' => array( 'transparent' )
                ),
                'admin_label' => true
            ),
            $animation_type,
            $animation_duration,
            $animation_delay,
            $custom_class
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Testimonial')) {
        class WPBakeryShortCode_Porto_Testimonial extends WPBakeryShortCode {
        }
    }
}