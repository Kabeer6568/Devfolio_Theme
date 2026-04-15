

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