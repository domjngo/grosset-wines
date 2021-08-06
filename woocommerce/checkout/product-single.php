<?php
/**
 * Template to display a single product as per standard WooCommerce Templates
 *
 * @package WooCommerce-One-Page-Checkout/Templates
 * @version 1.7.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="gw-product-list">
<?php
global $post, $product;

$the_post_id = $post->ID;

foreach ( $products as $single_product_id => $single_product ) :

	$product = $single_product;
	$post    = get_post( $single_product_id );

	?>
	<div class="opc-single-product single-product">

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

                <div class="product-row row">
                    <div class="col-md-2 hidden-sm hidden-xs">
                        <?php
                        /**
                         * woocommerce_before_single_product_summary hook
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                        ?>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <?php
                        woocommerce_template_single_title();
                        woocommerce_template_single_price();
                        ?>
                    </div>
                    <div class="col-md-7 col-sm-9 col-xs-12 product-add-to-cart">
                        <div class="summary entry-summary product-item <?php if ( wcopc_get_products_prop( $product, 'in_cart' ) ) { echo 'selected'; } ?>">

                            <div class="opc-product-quantity product-quantity">

                                <?php
                                /**
                                 * wcopc_single_add_to_cart hook
                                 *
                                 * @hooked opc_single_add_to_cart - 10
                                 */
                                do_action( 'wcopc_single_add_to_cart', $the_post_id );
                                ?>

                            </div><!-- .opc-product-quantity -->

                        </div><!-- .summary -->
                    </div>
                </div>

		</div><!-- #product-<?php the_ID(); ?> -->

	</div><!-- .opc-single-product -->
<?php endforeach; ?>
</div>

<?php wp_reset_postdata(); ?>
