<?php
/*
 * * Register MetaBox For Testimonial CPT
 */

function hs_testimonials_meta_box() {
    add_meta_box(
        'hs_testimonials_meta_box', __('Details', 'hs-testimonial-visual-composer-addon'), 'generate_hs_testimonial_meta_box', 'hs_testimonials', 'advanced', 'high'
    );
}

function generate_hs_testimonial_meta_box() {
    global $post;
    $meta_rating = get_post_meta($post->ID, 'hs_testimonial_rating', true);
    $meta_testimonial_person_name = get_post_meta($post->ID, 'hs_testimonial_person_name', true);
    ?>
    <div class="hs-testimonial-vc-addon-admin">
        <div class="input-hs-testimonial-vc-addon">
            <div class="form-input">
                <label for="hs_person_name"><?php _e('Person Name', 'hs-testimonial-visual-composer-addon'); ?></label>
                <input id="hs_person_name" name="hs_testimonial_person_name" value="<?php echo $meta_testimonial_person_name; ?>">
            </div>
            <br>
            <div class="form-input">
                <label for="hs_rating"><?php _e('Rating (out of 5)', 'hs-testimonial-visual-composer-addon'); ?></label>
                <select id="hs_rating" name="hs_testimonial_rating">
                    <option value="5" <?php selected($meta_rating, '5'); ?>>5</option>
                    <option value="4" <?php selected($meta_rating, '4'); ?>>4</option>
                    <option value="3" <?php selected($meta_rating, '3'); ?>>3</option>
                    <option value="2" <?php selected($meta_rating, '2'); ?>>2</option>
                    <option value="1" <?php selected($meta_rating, '1'); ?>>1</option>
                </select>
            </div>
            
        </div>
    </div>
    <?php
}

add_action('save_post', 'testimonial_save_post', 1, 2);

function testimonial_save_post($post_id, $post) {
    if (empty($post_id) || empty($post) || empty($_POST)):
        return;
    endif;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE):
        return;
    endif;
    if (is_int(wp_is_post_revision($post))):
        return;
    endif;
    if (is_int(wp_is_post_autosave($post))):
        return;
    endif;
    if (!current_user_can('edit_post', $post_id)):
        return;
    endif;
    if ($post->post_type != 'hs_testimonials'):
        return;
    endif;
    if (isset($_POST["hs_testimonial_rating"])) {
        $meta_rating = $_POST['hs_testimonial_rating'];
        update_post_meta($post->ID, 'hs_testimonial_rating', $meta_rating);
    }
    if (isset($_POST["hs_testimonial_person_name"])) {
        $meta_rating = $_POST['hs_testimonial_person_name'];
        update_post_meta($post->ID, 'hs_testimonial_person_name', $meta_rating);
    }
}
