<?php
/* Function to get HTML structure based on the paramater.
 * @param: array
 */

add_action('hs_get_theme_style', 'hs_func_get_theme_style', '', 1);

function hs_func_get_theme_style($testimonial_details = array()) {
    $theme_num = $testimonial_details['general_options']['hs_testimonail_theme_style'];
    switch ($theme_num):
        case 'hs_t1':
            do_action('hs_vc_testimonial_theme_1', $testimonial_details);
            break;
        case 'hs_t2':
            do_action('hs_vc_testimonial_theme_2', $testimonial_details);
            break;
        case 'hs_t3':
            do_action('hs_vc_testimonial_theme_3', $testimonial_details);
            break;
        case 'hs_t4':
            do_action('hs_vc_testimonial_theme_4', $testimonial_details);
            break;
        default:
            do_action('hs_vc_testimonial_theme_1', $testimonial_details);
            break;
    endswitch;
}

/*
 * Function to generate html string for the rating star
 * @params: rating (int)
 * return: html rating string
 */

function hs_testimonial_rating($rating) {
    $rating_string = "";
    for ($i = 1; $i <= $rating; $i++):
        $rating_string .= '<i data-alt="1" class="fa fa-star"></i>';
    endfor;
    if ($rating < 5) {
        $blank_rating = 5 - $rating;
        for ($i = 1; $i <= $blank_rating; $i++):
            $rating_string .= '<i data-alt="1" class="fa fa-star-o"></i>';
        endfor;
    }
    return $rating_string;
}

/*
 * Function to check slider is enabled or not
 * @params: slider option (int)
 */
add_action('hs_testimonial_slider_option', 'hs_testimonial_is_slider', '', 2);

function hs_testimonial_is_slider($slider_option, $grid_option) {
    $grid_class = $slider_class = '';
    if ($slider_option == 0):
        $grid_class = 'vc_col-md-' . $grid_option;
    else:
        $slider_random_class = generateRandomString();
        $slider_class = 'owl-carousel owl-theme' . $slider_random_class;
        do_action('hs_testomonial_slider_init', 12 / $grid_option, $slider_random_class);
    endif;
}

/*
 * Theme 1
 * @params: testimonail details (array)
 */
add_action('hs_vc_testimonial_theme_1', 'hs_testimonial_theme_1', '', 1);

function hs_testimonial_theme_1($testimonial_details = array()) {
    $grid_option = $testimonial_details['general_options']['hs_testimonail_grid_option'];
    $slider_option = $testimonial_details['general_options']['hs_testimonial_slider_enabled'];
    $grid_class = $slider_class = '';
    if ($slider_option == 0):
        $grid_class = 'vc_col-md-' . $grid_option;
    else:
        $slider_random_class = generateRandomString();
        $slider_class = 'owl-carousel owl-theme hs-testimonial' . $slider_random_class;
        do_action('hs_testomonial_slider_init', 12 / $grid_option, 'hs-testimonial' . $slider_random_class);
    endif;
    ?>
    <div id="hs_testimonial_theme_1" class="<?php echo $slider_class; ?> col-custom-<?php echo $grid_option; ?>">
        <?php
        foreach (array_slice($testimonial_details, 1) as $value):
            ?>
            <div class="<?php echo $grid_class; ?> hs_column">
                <?php
                //Image
                if ($value['image']):
                    ?>
                    <div class="hs_client_image"><img src="<?php echo $value['image']; ?>" alt=""></div>
                    <?php
                endif;
                ?>
                <?php
                //Rating
                if ($value['rating']):
                    ?>
                    <div class="hs_client_rating"><?php
                        $rating_string = hs_testimonial_rating($value['rating']);
                        echo $rating_string;
                        ?>
                    </div>
                    <?php
                endif;

                //Message
                ?>
                <div class="hs_client_message"><?php echo $value['description']; ?></div>
                <?php
                //Person name
                if ($value['name']):
                    ?>
                    <div class="hs_client_name"><?php echo $value['name']; ?></div>
                    <?php
                endif;
                ?>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <?php
}

/*
 * Theme 2
 * @params: testimonail details (array)
 */
add_action('hs_vc_testimonial_theme_2', 'hs_testimonial_theme_2', '', 1);

function hs_testimonial_theme_2($testimonial_details = array()) {
    $grid_option = $testimonial_details['general_options']['hs_testimonail_grid_option'];
    $slider_option = $testimonial_details['general_options']['hs_testimonial_slider_enabled'];
    $grid_class = $slider_class = '';
    if ($slider_option == 0):
        $grid_class = 'vc_col-md-' . $grid_option;
    else:
        $slider_random_class = generateRandomString();
        $slider_class = 'owl-carousel owl-theme hs-testimonial' . $slider_random_class;
        do_action('hs_testomonial_slider_init', 12 / $grid_option, 'hs-testimonial' . $slider_random_class);
    endif;
    ?>
    <div id="hs_testimonial_theme_2" class="<?php echo $slider_class; ?> col-custom-<?php echo $grid_option; ?> vc_row">
        <?php
        foreach (array_slice($testimonial_details, 1) as $value):
            ?>
            <div class="<?php echo $grid_class; ?> hs_column">
                <?php
                //Image
                if ($value['image']):
                    ?>
                    <div class="hs_client_image vc_col-sm-2"><img src="<?php echo $value['image']; ?>" alt=""></div>
                    <?php
                endif;
                ?>
                <div class="vc_col-sm-10 hs_equal-height">
                    <div class="hs_title"><?php echo $value['title']; ?></div>
                    <?php
                    //Message
                    ?>
                    <div class="hs_client_message"><?php echo $value['description']; ?></div>
                    <?php
                    //Rating
                    if ($value['rating']):
                        ?>
                        <div class="hs_client_rating"><?php
                            $rating_string = hs_testimonial_rating($value['rating']);
                            echo $rating_string;
                            ?>
                        </div>
                        <?php
                    endif;

                    //Person name
                    if ($value['name']):
                        ?>
                        <div class="hs_client_name"><?php echo $value['name']; ?></div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <?php
}

/*
 * Theme 3
 * @params: testimonail details (array)
 */
add_action('hs_vc_testimonial_theme_3', 'hs_testimonial_theme_3', '', 1);

function hs_testimonial_theme_3($testimonial_details = array()) {
    $grid_option = $testimonial_details['general_options']['hs_testimonail_grid_option'];
    $slider_option = $testimonial_details['general_options']['hs_testimonial_slider_enabled'];
    $grid_class = $slider_class = '';
    if ($slider_option == 0):
        $grid_class = 'vc_col-md-' . $grid_option;
    else:
        $slider_random_class = generateRandomString();
        $slider_class = 'owl-carousel owl-theme hs-testimonial' . $slider_random_class;
        do_action('hs_testomonial_slider_init', 12 / $grid_option, 'hs-testimonial' . $slider_random_class);
    endif;
    ?>
    <div id="hs_testimonial_theme_3" class="<?php echo $slider_class; ?> col-custom-<?php echo $grid_option; ?>">
        <?php
        foreach (array_slice($testimonial_details, 1) as $value):
            ?>
            <div class="<?php echo $grid_class; ?> hs_column hs-equalheight">
                <div class="inner-wrap">
                    <?php
                    //Image
                    if ($value['image']):
                        ?>
                        <div class="hs_client_image"><img src="<?php echo $value['image']; ?>" alt=""></div>
                        <?php
                    endif;
                    ?>
                    <div class="hs_title"><?php echo $value['title']; ?></div>
                    <?php
                    //Rating
                    if ($value['rating']):
                        ?>
                        <div class="hs_client_rating"><?php
                            $rating_string = hs_testimonial_rating($value['rating']);
                            echo $rating_string;
                            ?>
                        </div>
                        <?php
                    endif;

                    //Message
                    ?>
                    <div class="hs_client_message"><?php echo $value['description']; ?></div>
                    <?php
                    //Person name
                    if ($value['name']):
                        ?>
                        <div class="hs_client_name"><?php echo $value['name']; ?></div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <?php
}

/*
 * Theme 3
 * @params: testimonail details (array)
 */
add_action('hs_vc_testimonial_theme_4', 'hs_testimonial_theme_4', '', 1);

function hs_testimonial_theme_4($testimonial_details = array()) {
    $grid_option = $testimonial_details['general_options']['hs_testimonail_grid_option'];
    $slider_option = $testimonial_details['general_options']['hs_testimonial_slider_enabled'];
    $grid_class = $slider_class = '';
    if ($slider_option == 0):
        $grid_class = 'vc_col-md-' . $grid_option;
    else:
        $slider_random_class = generateRandomString();
        $slider_class = 'owl-carousel owl-theme hs-testimonial' . $slider_random_class;
        do_action('hs_testomonial_slider_init', 12 / $grid_option, 'hs-testimonial' . $slider_random_class);
    endif;
    ?>
    <div id="hs_testimonial_theme_4" class="<?php echo $slider_class; ?> col-custom-<?php echo $grid_option; ?>">
        <?php
        foreach (array_slice($testimonial_details, 1) as $value):
            ?>
            <div class="<?php echo $grid_class; ?> hs_column hs-equalheight">
                <div class="inner-wrap">
                    <?php
                    //Image
                    if ($value['image']):
                        ?>
                        <div class="hs_client_image"><img src="<?php echo $value['image']; ?>" alt=""></div>
                        <?php
                    endif;
                    ?>
                    <div class="hs_title"><?php echo $value['title']; ?></div>
                    <?php
                    //Rating
                    if ($value['rating']):
                        ?>
                        <div class="hs_client_rating"><?php
                            $rating_string = hs_testimonial_rating($value['rating']);
                            echo $rating_string;
                            ?>
                        </div>
                        <?php
                    endif;

                    //Message
                    ?>
                    <div class="hs_client_message"><?php echo $value['description']; ?></div>
                    <?php
                    //Person name
                    if ($value['name']):
                        ?>
                        <div class="hs_client_name"><?php echo $value['name']; ?></div>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
            <?php
        endforeach;
        ?>
    </div>
    <?php
}

add_action('hs_testomonial_slider_init', 'hs_testomonial_slider_init', 100, 2);

function hs_testomonial_slider_init($grid_option, $theme_id) {
    ?>
    <script>
        jQuery(window).load(function () {
            var hs_testimonial_slider = jQuery('.<?php echo $theme_id; ?>');
            hs_testimonial_slider.owlCarousel({
                nav: true,
                dots: false,
                smartSpeed: 450,
                onInitialized: sliderequalheight,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: <?php echo $grid_option; ?>
                    }
                }
            });
            function sliderequalheight() {
                setTimeout(function () {
                    jQuery('.hs-equalheight').matchHeight({
                        byRow: true
                    });
                }, 200);
            }
        });
    </script>
    <?php
}

//Function to generate string - unique class if slider is enabled
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>