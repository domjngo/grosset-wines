<?php

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