<?php
/**
 * Cart Page
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<div class="gbtr_main_wrapper">
    
    <form class="cart_form" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

        <div class="grid_8 alpha">

            <?php do_action( 'woocommerce_before_cart_table' ); ?>
        
            <div class="shop_table_wrapper">
                
                <table class="shop_table cart footable" cellspacing="0">
                    
                    <thead>
                        <tr>                
                            <th class="product-thumbnail">&nbsp;</th>
                            <th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
                            <th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
                            <th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
                            <th class="product-quantity-mobiles"><?php _e( 'QTY', 'woocommerce' ); ?></th>
                            <th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
                
                        <?php
                        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                ?>
                                    
                                    <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                        <td class="product-thumbnail">
                                            <?php
                                                $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                                if ( ! $_product->is_visible() )
                                                    echo $thumbnail;
                                                else
                                                    printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                                            ?>
                                        </td>

                                        <td class="product-name">
                                            <?php
                                                if ( ! $_product->is_visible() )
                                                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                                else
                                                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

                                                // Meta data
                                                echo WC()->cart->get_item_data( $cart_item );

                                                // Backorder notification
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                                                    echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
                                            ?>
                                        
                                            <div class="product-price">
                                                <?php
                                                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                                ?>
                                            </div>
                                        
                                        </td>

                                        <td class="product-price">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                            ?>
                                        </td>

                                        <td class="product-quantity">
                                            <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                                } else {
                                                    $product_quantity = woocommerce_quantity_input( array(
                                                        'input_name'  => "cart[{$cart_item_key}][qty]",
                                                        'input_value' => $cart_item['quantity'],
                                                        'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                        'min_value'   => '0'
                                                    ), $_product, false );
                                                }

                                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                            ?>
                                        </td>

                                        <td class="product-subtotal">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                            ?>
                                        </td>

                                        <td class="product-remove">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
                                            ?>
                                        </td>

                                    </tr>
                                <?php
                            }
                        }
                
                        do_action( 'woocommerce_cart_contents' );
                        
                        ?>
                        
                    </tbody>
                </table>
            
            </div>
        
        </div>
    
        <div class="grid_4 omega">
        
            <div class="gbtr_left_column_cart">            
                
                
                <?php if ( WC()->cart->coupons_enabled() ) { ?>
                    <div class="coupon">

                        <h3><?php _e('Coupon', 'woocommerce'); ?></h3>
                        <div class="coupon_inputs_wrapper">
                            <input name="coupon_code" class="input-text" id="coupon_code" placeholder="<?php _e('Coupon code', 'woocommerce'); ?>" value="" />
                            <input type="submit" class="button button-coupon" name="apply_coupon" value="<?php _e('Apply Coupon', 'woocommerce'); ?>" />
                        </div>
        
                        <?php do_action('woocommerce_cart_coupon'); ?>
                        
                        <div class="clr"></div>

                    </div>
                <?php } ?>
            
                <?php woocommerce_cart_totals(); ?>
                
                <div class="gbtr_left_column_cart_sep"></div>
                
                <input type="submit" class="update-button button" name="update_cart" value="<?php _e('Update Cart', 'woocommerce'); ?>" />
        
                <?php do_action('woocommerce_proceed_to_checkout'); ?>

                <?php do_action( 'woocommerce_cart_actions' ); ?>
        
                <?php wp_nonce_field( 'woocommerce-cart' ); ?>
            
            </div>

            <?php do_action( 'woocommerce_after_cart_contents' ); ?>

            <?php do_action( 'woocommerce_after_cart_table' ); ?>
        
        </div>

    </form>
    
    <div class="clr"></div>
    
    <?php do_action('woocommerce_cart_collaterals'); ?>
    
    <div class="clr"></div>

<div>

<?php do_action( 'woocommerce_after_cart' ); ?>