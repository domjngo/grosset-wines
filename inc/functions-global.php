<?php

// Enqueue styles and scripts
function bc_styles() {
    wp_register_style( 'gw-styles', get_template_directory_uri() . '/css/gw-styles.min.css?ver='.GW_VSN, array(), GW_VSN, 'all' );
    wp_register_style( 'google-fonts',
        'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap', array(), 1.0, 'all' );
    wp_enqueue_style( 'gw-styles' );
    wp_enqueue_style( 'google-fonts' );
}

function bc_scripts() {
    wp_register_script( 'jquery-js', 'https://code.jquery.com/jquery-2.2.4.min.js', array(), '2.2.4' );
    wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.3.7', true );
    wp_register_script( 'global-js', get_template_directory_uri() . '/js/compiled/gw.min.js', array(), GW_VSN, true );
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
        $image = null;
    }
    if ( $image[0] ) {
        return 'style="background-image: url('. $image[0] . ');"';
    } else {
        return false;
    }
}

function get_feature_wine_img( $title, $size = 'full' ) {
    global $post;
    $id = $post->ID;
    if ( has_post_thumbnail() ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
    } else {
        $image[0] = '';
    }
    if ( $image[0] ) {
        return '<img src="'.$image[0].'" class="img-responsive" alt="'.$title.'">';
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
        $bg_img = 'style="
        background-image: url(%s);
          background-image: 
            -webkit-image-set(
              url(%s) 1x,
              url(%s) 2x,
            );
          background-image: 
            image-set(
              url(%s) 1x,
              url(%s) 2x,
            );
        "';
        return sprintf( $bg_img, $img, $img, $img, $img, $img );
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

function get_button( $label, $url ) {
    $label = esc_attr( get_option( $label ) );
    $url = esc_attr( get_option( $url ) );
    if ($url) {
        return '<p><a href="'.$url.'" class="btn btn-home">'.$label.'</a></p>';
    } else {
        return '';
    }
}

function wpb_list_child_pages() {

    global $post;

    $string = '';

    if ( is_page() && $post->post_parent ) {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0&exclude=2208,1367,67,434,437,440,443,445,447,451,453,2206,1352,57,400,402,405,407,416,420,423,427,1709,724,53,371,374,378,381,385,387,390,393,934,1753,808,72,1746,802,48,295,298,301,318,326,328,332,334,1750,805,42,268,270,273,276,279,283,287,291,2219,1360,61,337,340,343,346,349,352,355,358,361' );
    }
    else {
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0&exclude=2208,1367,67,434,437,440,443,445,447,451,453,2206,1352,57,400,402,405,407,416,420,423,427,1709,724,53,371,374,378,381,385,387,390,393,934,1753,808,72,1746,802,48,295,298,301,318,326,328,332,334,1750,805,42,268,270,273,276,279,283,287,291,2219,1360,61,337,340,343,346,349,352,355,358,361' );
    }

    if ( $childpages ) {

        $string = '<ul>' . $childpages . '</ul>';
    }

    return $string;

}

add_shortcode('wpb_childpages', 'wpb_list_child_pages');

/**
 * Login logo
 */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/login-logo.png);
            height:65px;
            width:320px;
            background-size: 300px 50px;
            background-repeat: no-repeat;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );

/**
 * Disable comments
 */
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

function disable_comments_status() {
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

function disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

function disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

function disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

function disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'disable_comments_admin_bar');

function add_categories_to_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'add_categories_to_pages' );