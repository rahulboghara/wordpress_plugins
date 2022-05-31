/*
 * jQuery for the admin
 */
jQuery(document).ready(function () {

    var template_path = js_custom_object.template_path;

    //Change the theme demo image below dropdown on change of theme style dropdown.
    jQuery(document.body).on('change', '.wpb-select.hs_testimonail_theme_style', function () {
        jQuery('.theme_demo_image').attr('src', template_path + jQuery(this).val() + '.jpg');
    });
});


