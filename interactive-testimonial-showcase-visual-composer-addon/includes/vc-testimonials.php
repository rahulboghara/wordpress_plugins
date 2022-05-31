<?php

/* Visual composer fields */
add_action('vc_before_init', 'hs_showcase_vc_addon_function');

function hs_showcase_vc_addon_function() {

    vc_map(array(
        'name' => __('HS Testimonial', 'hs-testimonial-visual-composer-addon'),
        'base' => 'hs_testimonial_shortcode',
        'description' => __('HS Testimonial Shortcode', 'hs-testimonial-visual-composer-addon'),
        'params' => array(
            array(
                'type' => 'checkbox',
                'param_name' => 'hs_testimonail_show_name',
                'value' => array(
                    __('Show Person Name', 'hs-testimonial-visual-composer-addon') => '1'
                ), //value
                'std' => true,
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon'),
                'description' => __('Uncheck checkbox to hide name from frontend', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'checkbox',
                'param_name' => 'hs_testimonail_show_img',
                'value' => array(
                    __('Show Image', 'hs-testimonial-visual-composer-addon') => '1'
                ), //value
                'std' => true,
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon'),
                'description' => __('Uncheck checkbox to hide image from frontend', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'checkbox',
                'param_name' => 'hs_testimonail_show_rating',
                'value' => array(
                    __('Show Rating', 'hs-testimonial-visual-composer-addon') => '1'
                ), //value
                'std' => true,
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon'),
                'description' => __('Uncheck checkbox to hide rating from frontend', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'checkbox',
                'param_name' => 'hs_testimonial_slider_enabled',
                'value' => array(
                    __('Slider', 'hs-testimonial-visual-composer-addon') => '1'
                ), //value
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Order Testimonial', 'hs-testimonial-visual-composer-addon'),
                'param_name' => 'hs_testimonail_order',
                'value' => array(
                    __('DESC', 'hs-testimonial-visual-composer-addon') => 'DESC',
                    __('ASC', 'hs-testimonial-visual-composer-addon') => 'ASC',
                    __('RAND', 'hs-testimonial-visual-composer-addon') => 'rand'
                ),
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Grid selection', 'hs-testimonial-visual-composer-addon'),
                'param_name' => 'hs_testimonail_grid_option',
                'value' => array(
                    __('1 Column', 'hs-testimonial-visual-composer-addon') => '12',
                    __('2 Column', 'hs-testimonial-visual-composer-addon') => '6',
                    __('3 Column', 'hs-testimonial-visual-composer-addon') => '4',
                    __('4 Column', 'hs-testimonial-visual-composer-addon') => '3',
                ),
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Image Size', 'hs-testimonial-visual-composer-addon'),
                'param_name' => 'hs_testimonail_image_size',
                'admin_label' => true,
                'value' => array(
                    __('Thumbnail', 'hs-testimonial-visual-composer-addon') => 'thumbnail',
                    __('HS Testimonial Custom', 'hs-testimonial-visual-composer-addon') => 'hs-testimonial-custom',
                ),
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon'),
                'description' => __('Select the image size.', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'dropdown',
                'id' => 'theme_selection',
                'heading' => __('Theme Style', 'hs-testimonial-visual-composer-addon'),
                'param_name' => 'hs_testimonail_theme_style',
                'value' => array(
                    __('Theme 1', 'hs-testimonial-visual-composer-addon') => 'hs_t1',
                    __('Theme 2', 'hs-testimonial-visual-composer-addon') => 'hs_t2',
                    __('Theme 3', 'hs-testimonial-visual-composer-addon') => 'hs_t3',
                    __('Theme 4', 'hs-testimonial-visual-composer-addon') => 'hs_t4',
                ),
                'description' => '<img class=theme_demo_image>',
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Add Custom Class', 'hs-testimonial-visual-composer-addon'),
                'param_name' => 'hs_testimonail_extra_class',
                'value' => '',
                'group' => __('General Settings', 'hs-testimonial-visual-composer-addon'),
                'description' => __('Add your custom <strong>Class</strong> if you want.', 'hs-testimonial-visual-composer-addon')
            ),
        ),
        'category' => __('HS Testimonial', 'hs-testimonial-visual-composer-addon'),
    ));
}
