<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$woocommerce_loop['shown_product'] = true;


//Store loop count we're currently on
if (empty($woocommerce_loop['loop']))
    $woocommerce_loop['loop'] = 0;

// Ensure visibility
if (!$product || !$product->is_visible())
    return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$woocommerce_loop['li_class'] = array();

// view
$woocommerce_loop['view'] = yit_get_option('shop-view-type', 'grid');


$woocommerce_loop['li_class'][] = $woocommerce_loop['view'];

// Set column
$woocommerce_loop['li_class'][] = 'col-sm-' . intval(12 / intval(yit_get_option('shop-num-column')));
$woocommerce_loop['columns'] = intval(yit_get_option('shop-num-column'));


// Set column
if (is_shop()) {
    $woocommerce_loop['li_class'][] = 'col-sm-' . intval(12 / intval(yit_get_option('shop-num-column')));
    $woocommerce_loop['columns'] = intval(yit_get_option('shop-num-column'));
} else {

    $sidebar = YIT_Layout()->sidebars;

    if ($sidebar['layout'] == 'sidebar-double') {
        $woocommerce_loop['li_class'][] = 'col-sm-6';
        $woocommerce_loop['columns'] = '2';
    } elseif ($sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left') {
        $woocommerce_loop['li_class'][] = 'col-sm-4';
        $woocommerce_loop['columns'] = '3';
    } else {
        $woocommerce_loop['li_class'][] = 'col-sm-3';
        $woocommerce_loop['columns'] = '4';
    }
}


// Add class first or last
if (0 == ($woocommerce_loop['loop'] - 1) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'])
    $woocommerce_loop['li_class'][] = 'first';
if (0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'])
    $woocommerce_loop['li_class'][] = 'last';

?>
<li <?php post_class($woocommerce_loop['li_class']); ?> >

    <div class="product-wrapper">

        <?php
        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action( 'woocommerce_before_shop_loop_item' );
        ?>

        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action('woocommerce_before_shop_loop_item_title');
        ?>
        
        <div class="clearfix info-product classic">
            <?php

            /**
             * woocommerce_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_price - 10
             * @hooked woocommerce_template_loop_rating - 5
             */
            do_action('woocommerce_after_shop_loop_item_title'); ?>
        </div>

        <div class="product-meta">
            <div class="product-meta-wrapper">

                <?php
                /**
                 * woocommerce_after_shop_loop_item hook.
                 *
                 * @hooked woocommerce_template_loop_product_link_close - 5
                 * @hooked woocommerce_template_loop_add_to_cart - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item' );
                ?>

            </div>
        </div>


    </div>

</li>
