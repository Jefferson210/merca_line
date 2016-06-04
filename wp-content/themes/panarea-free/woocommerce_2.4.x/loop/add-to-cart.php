<?php
/**
 * Loop Add to Cart
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.1.0
 */

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

global $product;

?>

<?php if (!$product->is_in_stock()) {
    ?>
    <a href="<?php echo apply_filters('out_of_stock_add_to_cart_url', get_permalink($product->id)); ?>"
       class="out-of-stock btn btn-alternative"><?php echo apply_filters('out_of_stock_add_to_cart_text', __('Out Of Stock', 'yit')); ?></a>
<?php
} else {

    $link = array(
        'url'      => $product->add_to_cart_url(),
        'label'    => $product->add_to_cart_text(),
        'class'    => isset( $class ) ? $class : '',
        'quantity' => isset( $quantity ) ? $quantity : 1
    );

    $handler = apply_filters('woocommerce_add_to_cart_handler', $product->product_type, $product);

    switch ( $handler ) {
        case "variable" :
            $link['url']    = apply_filters( 'variable_add_to_cart_url', $link['url'] );
            $link['label']  = apply_filters( 'variable_add_to_cart_text', $link['label'] );
            $link['class']  = apply_filters( 'add_to_cart_class', $link['class'] );
            break;
        case "grouped" :
            $link['url']   = apply_filters( 'grouped_add_to_cart_url', $link['url'] );
            $link['label'] = apply_filters( 'grouped_add_to_cart_text', $link['label'] );
            break;
        case "external" :
            $link['url']   = apply_filters( 'external_add_to_cart_url', $link['url'] );
            $link['label'] = apply_filters( 'external_add_to_cart_text', $link['label'] );
            break;
        default :
            if ( $product->is_purchasable() ) {
                $link['url']      = apply_filters( 'add_to_cart_url', $link['url'] );
                $link['label']    = apply_filters( 'add_to_cart_text', $link['label'] );
                $link['class']    = apply_filters( 'add_to_cart_class', $link['class'] );
                $link['quantity'] = apply_filters( 'add_to_cart_quantity', $link['quantity'] );
            }
            else {
                $link['url']   = apply_filters( 'not_purchasable_url', $link['url'] );
                $link['label'] = apply_filters( 'not_purchasable_text', $link['label'] );
            }
            break;
    }

    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="btn %s">%s</a>',
            esc_url( $link['url'] ),
            esc_attr( $link['quantity'] ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( $link['class'] ),
            esc_html( $link['label'] )
        ),
    $product );

}
