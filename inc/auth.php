

<?php


function devfolio_handle_login(){

    if(!isset($_POST['login_submit'])) return;

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

    $user_id = wp_create_user(
        sanitize_text_field($_POST['fullname']),
        sanitize_email($_POST['email']),
        sanitize_text_field($_POST['username']),
        $_POST['password']
    );

    if(!is_wp_error($user_id)){
        wp_redirect(home_url('/dashboard'));
        exit;
    }

}

add_action('init' , 'devfolio_register_handle');