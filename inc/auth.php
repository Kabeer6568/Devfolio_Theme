

<?php


function devfolio_handle_login(){

    if(!isset($_POST['login_submit'])) return;
    if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'devfolio_login' ) ) return;

    $creds = [
    
        'user_login' => sanitize_text_field($_POST['username']),
        'user_password' => $_POST['password'],
        'remember' => true
    
    ];

    $user = wp_signon($creds , false);

    if(!is_wp_error($user)){
        wp_redirect(home_url('/dashboard'));
        exit;
    }

}

add_action('init' , 'devfolio_handle_login');


function devfolio_register_handle(){

    if(!isset($_POST['register_submit'])) return;
    if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'devfolio_register' ) ) return;

    $user_id = wp_create_user(
        
        sanitize_text_field($_POST['username']),
        $_POST['password'],
        sanitize_email($_POST['email']),
        
    );

    if(is_wp_error($user_id)) return;

    update_user_meta($user_id , 'devfolio_fullname' , sanitize_text_field( $_POST['fullname']));

    wp_update_user([
        'ID'           => $user_id,
        'display_name' => sanitize_text_field( $_POST['fullname'] ),
    ]);

    wp_set_current_user( $user_id );
    wp_set_auth_cookie( $user_id );

    wp_redirect( home_url( '/dashboard' ) );
    exit;

}

add_action('init' , 'devfolio_register_handle');




function devfolio_profile_save_handle(){

    if(!isset($_POST['submit_profile'])) return;
    if(!is_user_logged_in()) return;

    if(!wp_verify_nonce( $_POST['profile_nonce'], 'devfolio_save_profile' )) return;

    $user_id = get_current_user_id();

    wp_update_user( [
        
        'ID' => $user_id,
        'display_name' => sanitize_text_field( $_POST['fullname'] ),
        'user_email' => sanitize_email( $_POST['email'] ),
        'description' => sanitize_textarea_field ( $_POST['bio'] ),

    ] );

    $meta_fields = [

        'devfolio_fullname' => 'sanitize_text_field',
        'devfolio_location' => 'sanitize_text_field',
        'devfolio_jobtitle' => 'sanitize_text_field',
        'devfolio_years_exp' => 'absint',
        

    ];

    foreach ($meta_fields as $key => $sanitize_fn) {
        $post_key = str_replace('devfolio_' , '' , $key);
        if(isset($_POST[$post_key])){
            update_user_meta( $user_id, $key, $sanitize_fn($_POST[$post_key]) );
        }
    }

    //image upload

    if (!empty($_FILES['profile_img']['name'])) {
        
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $allowed_type = ['image/png' , 'image/jpeg' , 'image/webp'];
        
        if (in_array($_FILES['profile_img']['type'] , $allowed_type)) {
    
        $old_img = get_user_meta( $user_id, 'devfolio_profile_img', true );

        if ($old_img) {
            wp_delete_attachment( $old_img, true );
        }

        $attatcment_id = media_handle_upload( 'profile_img' , 0 );

        if (! is_wp_error( $attatcment_id )) {
            update_user_meta( $user_id, 'devfolio_profile_img', $attatcment_id );
        }
      }
    }



    // resume upload

    if (!empty($_FILES['resume']['name'])) {
        
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';

        $allowed_type = ['application/pdf'];
        
        if (in_array($_FILES['resume']['type'] , $allowed_type)) {
    
        $old_resume = get_user_meta( $user_id, 'devfolio_resume', true );

        if ($old_resume) {
            wp_delete_attachment( $old_resume, true );
        }

        $attatcment_id = media_handle_upload( 'resume' , 0 );

        if (! is_wp_error( $attatcment_id )) {
            update_user_meta( $user_id, 'devfolio_resume', $attatcment_id );
        }
      }
    }

    $social_links = [];

    if (isset($_POST['social_platform']) && isset($_POST['social_link'])) {
    
        $platforms = $_POST['social_platform'];
        $urls = $_POST['social_link'];

        foreach ($platforms as $index => $platform) {
            $platform = sanitize_text_field( $platform );
            $url = esc_url_raw( $urls[$index] );

            if ($platform && $url) {
                $social_links[] = [
                    'platform' => $platform,
                    'url' => $url,
                ];
            }
        }

    }

    update_user_meta( $user_id, 'devfolio_social_links', $social_links );

    wp_redirect(home_url('/edit-profile') . '?saved=1');
    exit;

}

add_action ('init' , 'devfolio_profile_save_handle');