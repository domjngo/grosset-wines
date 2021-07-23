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
<table class="gw-product-list">
<?php
global $post, $product;

$the_post_id = $post->ID;

foreach ( $products as $single_product_id => $single_product ) :

	$product = $single_product;
	$post    = get_post( $single_product_id );

	?>
	<div class="opc-single-product single-product">

		<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

                <tr class="product-row">
                    <td>
                        <?php
                        /**
                         * woocommerce_before_single_product_summary hook
                         *
                         * @hooked woocommerce_show_product_sale_flash - 10
                         * @hooked woocommerce_show_product_images - 20
                         */
                        do_action( 'woocommerce_before_single_product_summary' );
                        ?>
                    </td>
                    <td>
                        <?php
                        woocommerce_template_single_title();
                        ?>
                    </td>
                    <td>
                        <?php
                        woocommerce_template_single_price();
                        ?>
                    </td>
                    <td class="product-add-to-cart">
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
                    </td>
                </tr>

		</div><!-- #product-<?php the_ID(); ?> -->

	</div><!-- .opc-single-product -->
<?php endforeach; ?>
</table>

<?php wp_reset_postdata(); ?>
