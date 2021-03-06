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

/**
 * Custom template tags for this child theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Add Font Awesome icons to the primary menu in the style of finds.org.uk
 *
 * Modifies $args->link_before to inject into start_el method of parent
 *
 */

class CountyPages_Child_Icons_Menu_Walker extends Walker_Nav_Menu {

    function generate_icon_tag ( $iconName ) {
        $iconWrap = '<i class="fa fa-%s"></i>';
        return sprintf( $iconWrap, $iconName );
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        if ( $args->theme_location == 'primary' ) {

            if ( $depth == 0 ) { // only add icons to top-level menu items

                switch ($item->title) {
                    case 'Home':
                        $args->link_before = $this->generate_icon_tag( 'home' );
                        break;
                    case 'How To and General Guides':
                        $args->link_before = $this->generate_icon_tag( 'info-circle' );
                        break;
                    case 'Guides A-Z by Image':
                        $args->link_before = $this->generate_icon_tag( 'image' );
                        break;
                    case 'Guides by Use and Function':
                        $args->link_before = $this->generate_icon_tag( 'gavel' );
                        break;
                    case 'Guides by Time Period':
                        $args->link_before = $this->generate_icon_tag( 'clock-o' );
                        break;
                    default:
                        $args->link_before = $this->generate_icon_tag( 'file' );
                }
            }

            parent::start_el($output, $item, $depth, $args);

        }
    }
}

/**
 * Register a shortcode [count-guides] to display a count of the published guides.
 */
add_shortcode( 'count-guides', 'countypages_child_count_guides' );

/**
 * Shortcode function for [count-guides] shortcode.
 *
 * @return string count of guides
 */

function countypages_child_count_guides( $attr ) {
    $count_posts = wp_count_posts( );
    $published_posts = $count_posts->publish;
    return $published_posts;
}