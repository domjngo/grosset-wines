<?php

// Enqueue styles and scripts
function bc_styles() {
    wp_register_style( 'gw-styles', get_template_directory_uri() . '/css/gw-styles.min.css', array(), 1.0, 'all' );
    wp_register_style( 'google-fonts',
        'https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic|Bitter', array(), 1.0, 'all' );
    wp_enqueue_style( 'gw-styles' );
    wp_enqueue_style( 'google-fonts' );
}

function bc_scripts() {
    wp_register_script( 'jquery-js', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '2.2.4' );
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.3.7', true );
    wp_register_script( 'global-js', get_template_directory_uri() . '/js/compiled/gw.min.js', array(), '1.0', true );
    wp_enqueue_script( 'jquery-js' );
    wp_enqueue_script( 'bootstrap-js' );
    wp_enqueue_script( 'global-js' );
}

function register_bc_menu() {
    register_nav_menu( 'primary', __( 'Navigation Menu', 'blankcanvas' ) );
}

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
    global $post;
    return '<br><a class="btn btn-default btn-xs" role="button" href="'. get_permalink($post->ID) . '">Read more &raquo;</a>';
}

function bc_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name', 'display' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'blankcanvas' ), max( $paged, $page ) );

    return $title;
}

function add_image_responsive_class($content) {
    $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
    $replacement = '<img$1class="$2 img-responsive"$3>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}

function excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}

function posts_link_attributes() {
    return 'class="btn btn-default"';
}

function get_feature_image_as_bg( $size = 'full' ) {
    global $post;
    $id = $post->ID;
    if ( has_post_thumbnail() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
    } else {
        $image[0] = get_template_directory_uri() . '/img/bg0.jpg';
    }
    if ( $image[0] ) {
        return 'style="background-image: url('. $image[0] . ');"';
    } else {
        return false;
    }
}

function get_option_img($i, $n='0') {
    $img = get_option($i);
    if ($img) {
        return esc_attr($img);
    } else {
        return get_template_directory_uri() . '/img/bg'.$n.'.jpg';
    }
}

function get_home_img( $field ) {
    $img = get_option( $field );
    if ( $img ) {
        $bg_img = 'style="background-image: url(%s);"';
        return sprintf( $bg_img, $img );
    }
    return '';
}

function get_home_text( $field ) {
    $text = esc_attr( get_option( $field ) );
    if ($text) {
        return $text;
    } else {
        return 'Lorem ipsum dolor sit amet, eam ex exerci hendrerit';
    }
}
