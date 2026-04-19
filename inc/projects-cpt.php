<?php



// Register Custom Post Type
function register_Projects_post_type() {
    $labels = array(
        'name'                  => _x('Projects', 'Post Type General Name', 'Devfolio'),
        'singular_name'         => _x('Project', 'Post Type Singular Name', 'Devfolio'),
        'menu_name'            => __('Projects', 'Devfolio'),
        'all_items'            => __('All Projects', 'Devfolio'),
        'add_new_item'         => __('Add New Project', 'Devfolio'),
        'add_new'              => __('Add New', 'Devfolio'),
        'edit_item'            => __('Edit Project', 'Devfolio'),
        'update_item'          => __('Update Project', 'Devfolio'),
        'search_items'         => __('Search Project', 'Devfolio'),
    );

    $args = array(
        'label'                 => __('Project', 'Devfolio'),
        'labels'                => $labels,
        'supports'              => ["title","custom-fields"],
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_icon'             => 'dashicons-media-default',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
    );

    register_post_type('Projects', $args);
}
add_action('init', 'register_Projects_post_type', 0);





// Register Custom Taxonomy
function register_project_tags_taxonomy() {
    $labels = array(
        'name'                       => _x('Project Tag', 'Taxonomy General Name', 'Devfolio'),
        'singular_name'              => _x('Project Tags', 'Taxonomy Singular Name', 'Devfolio'),
        'menu_name'                  => __('Project Tag', 'Devfolio'),
        'all_items'                  => __('All Project Tag', 'Devfolio'),
        'parent_item'                => __('Parent Project Tags', 'Devfolio'),
        'parent_item_colon'          => __('Parent Project Tags:', 'Devfolio'),
        'new_item_name'              => __('New Project Tags Name', 'Devfolio'),
        'add_new_item'               => __('Add New Project Tags', 'Devfolio'),
        'edit_item'                  => __('Edit Project Tags', 'Devfolio'),
        'update_item'                => __('Update Project Tags', 'Devfolio'),
        'view_item'                  => __('View Project Tags', 'Devfolio'),
        'search_items'               => __('Search Project Tag', 'Devfolio'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'publicly_queryable'         => true,
        'show_ui'                    => true,
        'show_in_menu'               => true,
        'show_in_nav_menus'          => true,
        'show_in_rest'               => true,
        'rest_base'                  => 'project_tags',
        'show_tagcloud'              => true,
        'show_in_quick_edit'         => true,
        'show_admin_column'          => true,
    );

    register_taxonomy('project_tags', ["projects"], $args);
}
add_action('init', 'register_project_tags_taxonomy', 0);



// Register Meta Box
function add_project_meta_box_meta_box() {
    add_meta_box(
        'project_meta_box',
        'Project Meta Box',
        'project_meta_box_meta_box_callback',
        ["projects"],
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_project_meta_box_meta_box');

// Meta Box Callback
function project_meta_box_meta_box_callback($post) {
    wp_nonce_field('project_meta_box_meta_box', 'project_meta_box_meta_box_nonce');
    $values = get_post_meta($post->ID);
    ?>
    <div class="meta-box-container">
        
        <div class="meta-box-field">
            <label for="short_description">Short Description</label>
            <input
                type="text"
                id="short_description"
                name="short_description"
                value="<?php echo esc_attr(isset($values['short_description'][0]) ? $values['short_description'][0] : ''); ?>"
            />
        </div>
    </div>
    <?php
}

// Save Meta Box Data
function save_project_meta_box_meta_box_data($post_id) {
    if (!isset($_POST['project_meta_box_meta_box_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['project_meta_box_meta_box_nonce'], 'project_meta_box_meta_box')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    
    if (isset($_POST['short_description'])) {
        update_post_meta($post_id, 'short_description', sanitize_text_field($_POST['short_description']));
    }
}
add_action('save_post', 'save_project_meta_box_meta_box_data');