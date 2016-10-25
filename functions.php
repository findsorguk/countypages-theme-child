<?php
/**
 * Enqueue styles and parent theme CSS.
 */
function countypages_child_enqueue_styles() {
    $parent_style = 'countypages-style'; // This refers to style.css of the parent theme

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'countypages-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        null
    );

}
add_action( 'wp_enqueue_scripts', 'countypages_child_enqueue_styles' );