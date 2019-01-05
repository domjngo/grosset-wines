<?php

// Register widgets
function mh_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar widgets', 'blank-canvas' ),
        'id' => 'sidebar',
        'description' => __( 'Widgets in this area will be shown in the sidebar.', 'blank-canvas' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Shop sidebar widgets', 'blank-canvas' ),
        'id' => 'shop-sidebar',
        'description' => __( 'Widgets in this area will be shown in the shop sidebar.', 'blank-canvas' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 1', 'theme-slug' ),
        'id' => 'footer-col-1',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'blank-canvas' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 2', 'theme-slug' ),
        'id' => 'footer-col-2',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'blank-canvas' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 3', 'theme-slug' ),
        'id' => 'footer-col-3',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'blank-canvas' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}