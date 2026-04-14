<?php

function devfolio_enqueue_assets() {

    // CSS
    wp_enqueue_style(
        'devfolio-main',
        get_template_directory_uri() . '/assets/css/styles.css',
        [],
        '1.0'
    );

    // JS
    wp_enqueue_script(
        'devfolio-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        '1.0',
        true // load in footer
    );
}

add_action('wp_enqueue_scripts', 'devfolio_enqueue_assets');