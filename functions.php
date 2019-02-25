<?php
// Theme version
define( 'GW_VSN', '0.2' );

include 'inc/functions-global.php';
include 'inc/functions-admin.php';
include 'inc/functions-widgets.php';
include 'inc/functions-wines.php';
include 'inc/functions-temp.php';
include 'inc/functions-forms.php';
include 'inc/functions-woo.php';

add_theme_support( 'post-thumbnails' );

add_action( 'wp_enqueue_scripts', 'bc_styles' );
add_action( 'wp_enqueue_scripts', 'bc_scripts' );
add_action( 'after_setup_theme', 'register_bc_menu' );
add_action( 'admin_menu', 'grosset_settings_menu' );
add_action( 'widgets_init', 'mh_widgets_init' );

add_filter( 'excerpt_more', 'new_excerpt_more' );
add_filter( 'wp_title', 'bc_wp_title', 10, 2 );
add_filter( 'the_content', 'add_image_responsive_class' );
add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );

add_shortcode( 'wine', 'wine_shortcode' );
add_shortcode( 'vineyard', 'vineyard_shortcode' );
