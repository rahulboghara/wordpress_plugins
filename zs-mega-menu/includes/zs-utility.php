<?php
if ( ! defined( 'ABSPATH' ) ) die( 'Direct access is not allowed' );

if( ! class_exists( 'ZS_Utility' ) ) {
    #-----------------------------------------------------------------
    # Mega Menu Class
    #-----------------------------------------------------------------
    class ZS_Utility {

        static function onload() {
            add_action('init', array(__CLASS__,'init_mega_menu'));
            add_action("after_switch_theme", "flush_rewrite_rules", 10 ,  2); // update permalinks for new user rewrite rules
            add_shortcode('mega_menu_section', array(__CLASS__,'mega_menu_shortcode'));
            add_shortcode('zs_mega_menu', array(__CLASS__,'mega_menu_shortcode'));
        }
        
        static function init_mega_menu() {
            if (function_exists('register_post_type')) {
                register_post_type('zs_mega_menu',
                    array(
                        'labels' => array(
                            'name'                  =>  esc_html_x('ZS Mega Menu', 'post type general name', ZS_TEXTDOMAIN),
                            'singular_name'         =>  esc_html_x('ZS Mega Menu', 'post type singular name', ZS_TEXTDOMAIN),
                            'add_new'               =>  esc_html_x('Add New Menu', 'block', ZS_TEXTDOMAIN),
                            'add_new_item'          =>  esc_html__('Add New Mega Menu', ZS_TEXTDOMAIN),
                            'edit_item'             =>  esc_html__('Edit Mega Menu', ZS_TEXTDOMAIN),
                            'new_item'              =>  esc_html__('New Mega Menu', ZS_TEXTDOMAIN),
                            'all_items'             =>  esc_html__('All Mega Menu', ZS_TEXTDOMAIN),
                            'view_item'             =>  esc_html__('View Mega Menu', ZS_TEXTDOMAIN),
                            'search_items'          =>  esc_html__('Search', ZS_TEXTDOMAIN),
                            'not_found'             =>  esc_html__('No Mega Menu found', ZS_TEXTDOMAIN),
                            'not_found_in_trash'    =>  esc_html__('No Mega Menu found in Trash', ZS_TEXTDOMAIN), 
                            'parent_item_colon'     => '',
                            'menu_name'             => 'ZS Mega Menu'
                        ),
                        'exclude_from_search' => true,
                        'publicly_queryable'  => true,
                        'public'              => true,
                        'show_ui'             => true,
                        'query_var'           => 'zs_mega_menu',
                        'rewrite'             => array('slug' => 'zs_mega_menu'),
                        'supports'            => array(
                            'title',
                            'editor',
                            'revisions',
                        ),
                        'menu_icon'          => 'dashicons-menu',
                    )
                );
            }
        }

        // Retrieves content for Mega Menus
        static function get_mega_menu_section($args=array()) {

            $default = array(
                'id'        => false,
                'post_type' => 'zs_mega_menu',
                'class'     => '',
                'title'     => '',
                'showtitle' => false,
                'titletag'  => 'h3',
            );
            $args = (object)array_merge($default,$args);

            // Find the page data
            if (!empty($args->id)) {
                // Get content by ID or slug
                $id = $args->id;
                $id = (!is_numeric($id)) ? get_ID_by_slug($id, $args->post_type) : $id;
                // Get the page contenet
                $page_data = get_post($id);
            } else {
                $page_data = null;
            }

            // Format and return data
            if (is_null($page_data))
                return '<!-- [No arguments where provided or the values did not match an existing Mega Menu] -->';
            else {

                // The content
                $content = $page_data->post_content;
                $content = apply_filters('mega_menu_section', $content);

                if (get_post_meta($id, 'content_filters', true) == 'all') {
                    $GLOBALS['wpautop_post'] = $page_data; 
                    $content = apply_filters('the_content', $content);
                } else {
                    $content = wptexturize($content);
                    $content = convert_smilies($content);
                    $content = convert_chars($content);
                    if (get_post_meta($id, 'wpautop', true) == 'on') { 
                        $content = wpautop($content); // Add paragraph.
                    }
                    $content = shortcode_unautop($content);
                    $content = prepend_attachment($content);
                    $content = apply_filters('the_content', $content);

                }
                $class = (!empty($args->class)) ? trim($args->class) : '';
                $content = '<div id="mega_menu-content-' . $id . '" class="mega_menu-content '. $class .'">'. $content .'</div>';

                // The title
                if (!empty($args->title)){
                    $title = $args->title;
                    $showtitle = true;
                } else {
                    $title = $page_data->post_title;
                    $showtitle = $args->showtitle;
                }
                if ($showtitle) $content =  '<'. $args->titletag .' class="mega_menu-content-title page-title">'. $page_data->post_title .'</'. $args->titletag .'>' . $content; 

                // Return content
                return  $content;
            }
        }

        // Generate ZS Mega Menu from shortcode
        static function mega_menu_shortcode($args=array()) {
            if (!isset($args['class'])) {
                $args['class'] = '';
            } 
            $args['class'] .= ' from-shortcode';
            return self::get_mega_menu_section($args);
        }   
    }
}

// Register Script And Style ZS Mega Menu

class register_script {
    function register(){
    //for frontend
        add_action( 'wp_enqueue_scripts', array($this,'frontendEnqueue'), 11);
    //for backend
        add_action( 'admin_enqueue_scripts', array($this,'backendEnqueue'), 11);

    }
    function backendEnqueue(){
        wp_enqueue_style( 'zs_mega_menu_admin', ZS_PLUGIN_URI . '/assets/css/zs_menu_admin.css');
    }
    function frontendEnqueue(){
        wp_enqueue_style( 'zs_mega_menu_style', ZS_PLUGIN_URI . '/assets/css/zs_menu_style.css');
        wp_enqueue_script( 'zs_mega_menu_jquery', ZS_PLUGIN_URI . '/assets/js/zs_mega_menu.js');
    }
}

if(class_exists('register_script')){
    $register_script=new register_script();
    $register_script->register();
}


// Initialize
if( method_exists( 'ZS_Utility', 'onload') ) {
    ZS_Utility::onload();
}

if ( ! function_exists( 'the_zs_mega_menu' ) ) {
    // Easy access to Mega Menu output
    function the_zs_mega_menu( $id = false, $args = array() ) {
        if ($id) {
            $args["id"] = $id;
            echo ZS_Utility::get_mega_menu_section($args);
        }
    }
}

// Get content ID by slug 
//................................................................
if ( ! function_exists( 'get_ID_by_slug' ) ) :

    function get_ID_by_slug($slug, $post_type = 'page') {

        // Find the page object (works for any post type)
        $page = get_page_by_path( $slug, 'OBJECT', $post_type );
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
endif;

#-----------------------------------------------------------------
# Custom Meta Fields for Mega Menu
#-----------------------------------------------------------------

global $meta_box_mega_menu;

// Define Meta Fields
$meta_box_mega_menu = array(
    'id'        => 'theme-meta-box-mega-menu-filters',
    'title'     =>  esc_html__('Content Options', ZS_TEXTDOMAIN),
    'page'      => 'zs_mega_menu',
    'context'   => 'side',
    'priority'  => 'default',
    'fields'    => array(
        array(
         'name'       => esc_html__('Content Filters', ZS_TEXTDOMAIN),
         'desc'       => esc_html__('Apply all WP content filters? This will include plugin added filters.', ZS_TEXTDOMAIN),
         'id'         => 'content_filters',
         'type'       => 'radio',
         'std'        => '',
         'options'    => array(
            'default'   => esc_html__('Defaults (recommended)', ZS_TEXTDOMAIN),
            'all'       => esc_html__('All Content Filters', ZS_TEXTDOMAIN)
        )
     ),
        array(
         'name'       => esc_html__('Auto Paragraphs', ZS_TEXTDOMAIN),
         'desc'       => esc_html__('Add &lt;p&gt; and &lt;br&gt; tags automatically. (disabling may fix layout issues)', ZS_TEXTDOMAIN),
         'id'         => 'wpautop',
         'type'       => 'radio',
         'std'        => '',
         'options'    => array(
            'on'    => esc_html__('On', ZS_TEXTDOMAIN),
            'off'   => esc_html__('Off', ZS_TEXTDOMAIN)
        )
     )
    )
);


/*-----------------------------------------------------------------------------------*/
/*  Add metabox to Mega Menu edit screen
/*-----------------------------------------------------------------------------------*/

function zs_add_box_mega_menu() {
    global $meta_box_mega_menu;
    
    add_meta_box(
        $meta_box_mega_menu['id'], 
        $meta_box_mega_menu['title'], 
        'zs_show_box_mega_menu', 
        $meta_box_mega_menu['page'], 
        $meta_box_mega_menu['context'], 
        $meta_box_mega_menu['priority']
    );

}
add_action('admin_menu', 'zs_add_box_mega_menu');


/*-----------------------------------------------------------------------------------*/
/*  Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function zs_show_box_mega_menu() {
    global $meta_box_mega_menu, $post;
    
    // Use nonce for verification
    echo '<input type="hidden" name="zs_meta_box_nonce" value="', wp_create_nonce( plugin_basename(__FILE__) ), '" />';

    $increment = 0;
    foreach ($meta_box_mega_menu['fields'] as $field) {
        // styling
        $style = ($increment) ? 'border-top: 1px solid #dfdfdf;' : '';
        // get current mega_menu meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        switch ($field['type']) {

            //If radio array        
            case 'radio':

            echo '<div class="metaField_field_wrapper metaField_field_'.$field['id'].'" style="'.$style.'">',
            '<p><label for="'.$field['id'].'"><strong>'.$field['name'].'</strong></label></p>';

            $count = 0;
            foreach ($field['options'] as $key => $label) {
                $checked = ($meta == $key || (!$meta && !$count)) ? 'checked="checked"' : '';
                echo '<label class="zs_metaField_radio" style="display: block; padding: 2px 0;"><input class="zs_metaField_radio" type="radio" name="'.$field['id'].'" value="'.$key.'" '.$checked.'> '.$label.'</label>';
                $count++;
            }

            echo '<p class="zs_metaField_caption" style="color:#999">'.$field['desc'].'</p>',
            '</div>';
            
            break;           
            
        }

        $increment++;
    }

}
add_action('save_post', 'zs_save_data_mega_menu');



/*-----------------------------------------------------------------------------------*/
/*  Save data when post is edited
/*-----------------------------------------------------------------------------------*/
function zs_save_data_mega_menu($post_id) {
    global $meta_box_mega_menu;

    // verify nonce
    if ( !isset($_POST['zs_meta_box_nonce']) || !wp_verify_nonce($_POST['zs_meta_box_nonce'], plugin_basename(__FILE__))) {
        return $post_id;
    }

    // check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box_mega_menu['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }

}