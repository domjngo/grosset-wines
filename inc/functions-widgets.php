<?php

// Register widgets
function mh_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar widgets', 'grosset-wines' ),
        'id' => 'sidebar',
        'description' => __( 'Widgets in this area will be shown in the sidebar.', 'grosset-wines' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 1', 'grosset-wines' ),
        'id' => 'footer-col-1',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'grosset-wines' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 2', 'grosset-wines' ),
        'id' => 'footer-col-2',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'grosset-wines' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Footer widget 3', 'grosset-wines' ),
        'id' => 'footer-col-3',
        'description' => __( 'Widgets in this area will be shown in the footer.', 'grosset-wines' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}