/*-----------------------------------------------------------------------------------*/
/*  zs mega menu add class jQuery 
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function() {
    jQuery("li.menu-item").find("li.menu-item-object-zs_mega_menu").each(function(i){
        jQuery(this).parent().parent().addClass('zsmm-full');
    });

    jQuery(".menu").find("li.zs_horizontal").each(function(i){
        jQuery(this).parent().addClass('zs_horizontal_menu');
        jQuery(this).parent().addClass('zsmm');
    });

    jQuery(".menu").find("li.zs_vertical").each(function(i){
        jQuery(this).parent().addClass('zs_vertical_menu');
        jQuery(this).parent().addClass('zsmm');
    });
});

