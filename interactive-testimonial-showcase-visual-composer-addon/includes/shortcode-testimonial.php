<?php

function hs_testimonial_sc($atts, $content = null) {

    extract(shortcode_atts(array(
        'hs_testimonail_show_name' => '0',
        'hs_testimonail_show_rating' => '0',
        'hs_testimonail_show_img' => '0',
        'hs_testimonail_theme_style' => 'hs_t1',
        'hs_testimonail_order' => 'DESC',
        'hs_testimonail_grid_option' => '12',
        'hs_testimonail_image_size' => 'thumbnail',
        'hs_testimonail_extra_class' => '',
        'hs_testimonial_slider_enabled' => '0'
            ), $atts));

    ob_start();
    wp_enqueue_style('hs-testimonial-common-style', plugins_url('../templates/css/hs-testimonial-common.css', __FILE__));
    wp_enqueue_style('hs-testimonial-theme-style' . $hs_testimonail_theme_style, plugins_url('../templates/css/theme-' . $hs_testimonail_theme_style . '.css', __FILE__));
    wp_enqueue_style('font-awesome', vc_asset_url('lib/bower/font-awesome/css/font-awesome.min.css'), array(), WPB_VC_VERSION);

//If slider is enabled then add the slider css & script
    if ($hs_testimonial_slider_enabled) {
        wp_enqueue_style('hs-testimonial-owl-carousel', plugins_url('../templates/css/owl.carousel.min.css', __FILE__));
        wp_enqueue_style('hs-testimonial-owl-carousel-theme', plugins_url('../templates/css/owl.theme.default.min.css', __FILE__));
        wp_enqueue_script('hs-testimonial-owl-carousel-jquery', plugins_url('../templates/js/owl.carousel.min.js', __FILE__));
    }

    $query = array(
        'post_type' => 'hs_testimonials',
        'order' => $hs_testimonail_order,
        'post_status' => 'publish',
		'posts_per_page' => -1
    );
    $name = $image = $rating = "";
    $wpbp = new WP_Query($query);
    $hs_testimonail_array['general_options'] = array(
        'hs_testimonail_theme_style' => $hs_testimonail_theme_style,
        'hs_testimonail_grid_option' => $hs_testimonail_grid_option,
        'hs_testimonial_slider_enabled' => $hs_testimonial_slider_enabled
    );
    if ($wpbp->have_posts()) :
        while ($wpbp->have_posts()) : $wpbp->the_post();
            //title
            $title = get_the_title();
            //person name
            if ($hs_testimonail_show_name):
                $name = get_post_meta(get_the_ID(), 'hs_testimonial_person_name', true);
            endif;
            //image
            if ($hs_testimonail_show_img):
                $image = get_the_post_thumbnail_url('', $hs_testimonail_image_size);
            endif;
            //rating
            if ($hs_testimonail_show_rating):
                $rating = get_post_meta(get_the_ID(), 'hs_testimonial_rating', true);
            endif;
            //message
            $description = get_the_content();

            $hs_testimonail_array[] = array(
                'title' => $title,
                'name' => $name,
                'image' => $image,
                'rating' => $rating,
                'description' => $description
            );
        endwhile;
        wp_reset_query();
    endif;
    ?>
    <div class="hs_testimonial_wrapper <?php echo $hs_testimonail_extra_class; echo " imagesize-".$hs_testimonail_image_size; ?>">
        <?php
        do_action('hs_get_theme_style', $hs_testimonail_array);
        ?>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('hs_testimonial_shortcode', 'hs_testimonial_sc');
