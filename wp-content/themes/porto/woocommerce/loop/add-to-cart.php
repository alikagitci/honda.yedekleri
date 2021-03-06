<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $porto_settings, $product;

$wishlist = class_exists('YITH_WCWL') && $porto_settings['product-wishlist'];
$quickview = $porto_settings['product-quickview'];

?>
<div class="add-links-wrap">
    <div class="add-links <?php if (!$wishlist && !$quickview) echo 'no-effect' ?> clearfix">
        <?php
        echo apply_filters( 'woocommerce_loop_add_to_cart_link',
            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="button %s product_type_%s">%s</a>',
                esc_url( $product->add_to_cart_url() ),
                esc_attr( $product->id ),
                esc_attr( $product->get_sku() ),
                esc_attr( isset( $quantity ) ? $quantity : 1 ),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : 'add_to_cart_read_more',
                esc_attr( $product->product_type ),
                esc_html( $product->add_to_cart_text() )
            ),
        $product );

        if ($wishlist)
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
        if ($quickview) {
            echo '<div class="quickview" data-id="'.$product->id.'" title="' . __('Quick View', 'porto') . '">'.__('Quick View', 'porto').'</div>';
        }
        ?>
    </div>
</div>