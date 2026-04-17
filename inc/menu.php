<?php


function devfolio_menu_handle(){

    register_nav_menus( [
    
        'primary_menu' => __('Primary Menu' , 'devfolio'),
        'dashboard_menu' => __('Dashboard Menu', 'devfolio'), 
        
    
    ]);

}

add_action('after_setup_theme' , 'devfolio_menu_handle');