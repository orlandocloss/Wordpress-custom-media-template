<?php
function my_custom_theme_scripts() {
    wp_enqueue_style( 'my-custom-theme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'my_custom_theme_scripts' );

function my_custom_theme_register_nav_menu(){
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'my-custom-theme' ),
    ));
}
add_action( 'after_setup_theme', 'my_custom_theme_register_nav_menu', 0 );
