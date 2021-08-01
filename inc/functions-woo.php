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
// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

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

    if (isset($_POST['_inline_edit']) && wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
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
    echo '<div id="content" class="content"><div class="container"><div class="row">';
    echo '<div class="col-md-8 col-md-offset-2">';
}
function woo_wine_wrapper_end()
{
    echo '</div></div></div></div>';
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
 * https://gist.github.com/woogists/bd6938ccfdea0d03df5d060902561378
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
add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100, 2 );

/**
 * https://gist.github.com/JeroenSormani/87afe8432e05905587bd#file-woocommerce-custom-no-shipping-available-message-php
 */
function my_custom_no_shipping_message( $message ) {
    return __( 'A minimum of 6 bottles are required for free shipping.' );
}
add_filter( 'woocommerce_no_shipping_available_html', 'my_custom_no_shipping_message' );
add_filter( 'woocommerce_cart_no_shipping_available_html', 'my_custom_no_shipping_message' );

function shop_is_member_shortcode()
{

    if ( is_user_logged_in() ) {
        $html = '<h2>Welcome Grosset Wine Club member!</h2>';
    } else {
        $html = '<p>If you\'re a <strong>Grosset Wine Club member</strong> please ';
        $html .= '<strong><a href="'.site_url().'/my-club-account/">sign in here</a></strong> for your member\'s pricing.<br>';
        $html .= 'Not yet a member? <a href="'.site_url().'/contact/grosset-wine-club-member/">Click here to join</a>.</p>';
    }

    return $html;
}
add_shortcode( 'is-member', 'shop_is_member_shortcode' );

function my_account_content_after() {
    echo '<a href="'.site_url().'/members-online/" class="btn">Members wine shop</a>';
}
add_action( 'woocommerce_account_dashboard', 'my_account_content_after' );

function user_profile_customer_status( $user ) {
    // https://www.cssigniter.com/how-to-add-a-custom-user-field-in-wordpress/
    $status = esc_html( get_the_author_meta( 'customer_status', $user->ID ) );
    $isActivated = get_the_author_meta( 'is_activated', $user->ID );
    if ( $isActivated ) {
        if ( $isActivated == 1 ) {
            $account = '<p><strong>Account activated</strong></p>';
        } else {
            $account = '<p><strong>Account pending</strong></p>';
        }
    } else {
        $account = '';
    }
    ?>
    <h2>Customer status</h2>
    <?php echo $account; ?>
    <table class="form-table">
        <tr>
            <th><label for="customer_status">Status</label></th>
            <td>
                <select id="customer_status" name="customer_status">
                    <option value="">No status</option>
                    <option value="do-not-call" <?php if ( $status == 'do-not-call' ) { echo ' selected="selected"'; }; ?>>Do not call</option>
                    <option value="platinum" <?php if ( $status == 'Platinum' || $status == 'platinum' ) { echo ' selected="selected"'; }; ?>>Platinum</option>
                    <option value="silver-clare-valley" <?php if ( $status == 'silver-clare-valley' ) { echo ' selected="selected"'; }; ?>>Silver</option>
                    <option value="gold" <?php if ( $status == 'gold' ) { echo ' selected="selected"'; }; ?>>Gold</option>
   					<option value="grosset-club-members" <?php if ( $status == 'grosset-club-members' ) { echo ' selected="selected"'; }; ?>>Grosset club member</option>
                    <option value="grosset-information" <?php if ( $status == 'grosset-information' ) { echo ' selected="selected"'; }; ?>>Grosset information</option>
                </select>
            </td>
        </tr>
    </table>
    <?php
}

function update_user_profile_customer_status( $user_id ) {

    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }
    if ( ! empty( $_POST['customer_status'] ) ) {
        update_user_meta( $user_id, 'customer_status', $_POST['customer_status'] );
    }
}

function add_customer_status_column( $column ) {
    $column['col_customer_status'] = 'Customer status';
    return $column;
}

function add_customer_status_column_value( $val, $column_name, $user_id ) {
    switch($column_name) {

        case 'col_customer_status' :
            return get_user_meta($user_id, 'customer_status', true); ;
            break;

        default:
    }
}

function add_variation_members_pricing( $loop, $variation_data, $variation ){

    woocommerce_wp_text_input( array(
        'id' => '_members_price_'.$loop,
        'wrapper_class' => 'form-row form-row-first',
        'class' => 'short wc_input_price',
        'label' => __( 'Members price', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')',
        'value' => wc_format_localized_price( get_post_meta( $variation->ID, '_members_price', true ) ),
        'data_type' => 'price',
    ) );
}

function save_variation_members_pricing( $variation_id, $loop ){
    if( isset($_POST['_members_price_'.$loop]) ) {
        update_post_meta(
                $variation_id,
                '_members_price',
                wc_clean( wp_unslash( str_replace( ',', '.', $_POST['_members_price_'.$loop] ) ) )
        );
    }
}

function member_get_price( $price, $variation  ) {
    if( is_user_logged_in() ) {
        if( $members_price = $variation->get_meta('_members_price') ) {
            $price = $members_price;
        }
    }
    return $price;
}

function buy_now_button( $join = false ) {
    if ( is_user_logged_in() ) {
        $shop_page = get_site_url().'/members-online/';
        $shop_btn_text = 'Buy now';
    } else {
        $shop_page = get_site_url().'/wine-shop/';
        $shop_btn_text = 'Buy now';
    }
    if (has_category('members-only')) {
        $shop_btn_text = 'Buy now <small>(Members only)</small>';
    } elseif (has_category('sold-out')) {
        $shop_page = '#';
        $shop_btn_text = 'Sold out';
    } elseif (has_category('coming-soon')) {
        $shop_page = '#';
        $shop_btn_text = 'Coming Soon';
    }
    $join_btn = '';
    if ($join && !is_user_logged_in()) {
        $join_btn = '<a class="btn btn-default" href="'.get_site_url().'/contact/grosset-wine-club-member/">Join</a>';
    }

    echo '<div class="buy-now-btn text-center">'.$join_btn.'<a class="btn btn-default" href="'.$shop_page.'">'.$shop_btn_text.'</a></div>';
}

function remove_product_image_link( $html, $post_id ) {
    return preg_replace( "!<(a|/a).*?>!", '', $html );
}