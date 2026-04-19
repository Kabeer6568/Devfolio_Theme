<?php


// Register Custom Post Type Skills
function register_skills_post_type() {
    $labels = array(
        'name'                  => _x('Skills', 'Post Type General Name', 'Devfolio'),
        'singular_name'         => _x('skill', 'Post Type Singular Name', 'Devfolio'),
        'menu_name'            => __('Skills', 'Devfolio'),
        'all_items'            => __('All Skills', 'Devfolio'),
        'add_new_item'         => __('Add New skill', 'Devfolio'),
        'add_new'              => __('Add New', 'Devfolio'),
        'edit_item'            => __('Edit skill', 'Devfolio'),
        'update_item'          => __('Update skill', 'Devfolio'),
        'search_items'         => __('Search skill', 'Devfolio'),
    );

    $args = array(
        'label'                 => __('skill', 'Devfolio'),
        'labels'                => $labels,
        'supports'              => ["title","custom-fields"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-chart-bar',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('skills', $args);
}
add_action('init', 'register_skills_post_type', 0);





// Register Meta Box
function add_skills_meta_box_meta_box() {
    add_meta_box(
        'skills_meta_box',
        'Skills Meta Box',
        'skills_meta_box_meta_box_callback',
        ["skills"],
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_skills_meta_box_meta_box');

// Meta Box Callback
function skills_meta_box_meta_box_callback($post) {
    wp_nonce_field('skills_meta_box_meta_box', 'skills_meta_box_meta_box_nonce');
    $values = get_post_meta($post->ID);
    
    ?>
    <div class="meta-box-container">
        
        <div class="meta-box-field">
            <label for="skill_percentage">Skill Percentage</label>
            <input
                type="number"
                id="skill_percentage"
                name="skill_percentage"
                value="<?php echo esc_attr(isset($values['skill_percentage'][0]) ? $values['skill_percentage'][0] : ''); ?>"
            />
            <label for="skill_field">Skill Field</label>
            <input
                type="text"
                id="skill_field"
                name="skill_field"
                list="fields"
                value="<?php echo esc_attr(isset($values['skill_field'][0]) ? $values['skill_field'][0] : ''); ?>"
            />
            <datalist id="fields">
                <option value="Frontend">
                <option value="Backend">
                <option value="Devops">
                <option value="SQA">
                <option value="Full Stack">
            </datalist>
        </div>
    </div>
    <?php
}

// Save Meta Box Data
function save_skills_meta_box_meta_box_data($post_id) {
    if (!isset($_POST['skills_meta_box_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['skills_meta_box_meta_box_nonce'], 'skills_meta_box_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    
    if (isset($_POST['skill_percentage']) && isset($_POST['skill_field'])) {
        update_post_meta($post_id, 'skill_percentage', sanitize_text_field($_POST['skill_percentage']));
        update_post_meta($post_id, 'skill_field' , sanitize_text_field( $_POST['skill_field'] ));
    }
}
add_action('save_post', 'save_skills_meta_box_meta_box_data');