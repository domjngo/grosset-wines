<?php

function woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'woocommerce_support');

remove_theme_support( 'wc-product-gallery-zoom' );
remove_theme_support( 'wc-product-gallery-lightbox' );
remove_theme_support( 'wc-product-gallery-slider' );

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

/**
 * Reduce the strength requirement on the woocommerce password.
 *
 * Strength Settings
 * 3 = Strong (default)
 * 2 = Medium
 * 1 = Weak
 * 0 = Very Weak / Anything
 *
 */
function reduce_woocommerce_min_strength_requirement( $strength ) {
    return 1;
}
add_filter( 'woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement' );


/**
 * POS remove discounts
 *
 */
function pos_new_css() {
    echo '<style id="pos-new-css">
			.list-row .img, .cart-totals .cart-discount, .receipt-totals .cart-discount {display:none;}
		  </style>';
}
add_action( 'woocommerce_pos_head', 'pos_new_css' );

/**
 * Reorder item totals
 *
 */
function reordering_order_item_totals( $total_rows, $order, $tax_display ){

    if ( $total_rows['discount'] ) {
        $total_rows['discount']['label'] = '&nbsp;';
    }

    return $total_rows;
}
add_filter( 'woocommerce_get_order_item_totals', 'reordering_order_item_totals', 10, 3 );

/**
 * Display 24 products per page
 *
 */
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

/**
 * Catalog order
 *
 */
function am_woocommerce_catalog_orderby( $args ) {
    $args['orderby'] = 'meta_value';
    $args['order'] = 'asc';
    $args['meta_key'] = '_sku';
}
add_filter('woocommerce_get_catalog_ordering_args', 'am_woocommerce_catalog_orderby');

/**
 * Dynamic pricing
 *
 */
function wc_member_product_field() {
    woocommerce_wp_text_input( array( 'id' => 'member_price', 'class' => 'wc_input_price short', 'label' => __( 'Member price', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );
}
add_action( 'woocommerce_product_options_pricing', 'wc_member_product_field' );

function wc_member_save_product( $product_id ) {

    if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['member_price'] ) ) {
        if ( is_numeric( $_POST['member_price'] ) ) {
            update_post_meta( $product_id, 'member_price', $_POST['member_price'] );
        }
    } else {
        delete_post_meta( $product_id, 'member_price' );
    }
}
add_action( 'save_post', 'wc_member_save_product' );

function wc_member_price_for_login_users( $price, $product ) {

    if (!is_user_logged_in()) {
        return $price;
    }
    $member = get_post_meta( $product->get_id(), 'member_price', true );

    if ( $member ) {
        $price = $member;
    }
    return $price;
}
add_filter('woocommerce_product_get_price', 'wc_member_price_for_login_users', 10, 2);

/**
 * Remove related products
 *
 */
function woo_wine_remove_related_products($args)
{
    return array();
}
add_filter('woocommerce_related_products_args', 'woo_wine_remove_related_products', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

function woo_wine_wrapper_start()
{
    echo '<main id="main" class="main single-product" role="main">';
    echo '<div id="content" class="content"><div class="container"><div class="row">';
    echo '<div class="col-md-8 col-md-offset-2">';
}
function woo_wine_wrapper_end()
{
    echo '</div></div></div></div></main>';
}
add_action('woocommerce_before_main_content', 'woo_wine_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'woo_wine_wrapper_end', 10);

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab
    return $tabs;
}

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */
function my_hide_shipping_when_free_is_available( $rates ) {
    $free = array();
    foreach ( $rates as $rate_id => $rate ) {
        if ( 'free_shipping' === $rate->method_id ) {
            $free[ $rate_id ] = $rate;
            break;
        }
    }
    return ! empty( $free ) ? $free : $rates;
}
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );
