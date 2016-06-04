<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > Shop > Single Product Page
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Shop > Single Product Page Settings */
    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-single-product-nav',
        'type' => 'onoff',
        'name' => __( 'Show nav prev/next link', 'yit' ),
        'desc' => __( 'Say if you want to show product navigation', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-product-title',
        'type' => 'onoff',
        'name' => __( 'Show title', 'yit' ),
        'desc' => __( 'Say if you want to show product title', 'yit' ),
        'std' => 'yes',
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-product-title-uppercase',
        'type' => 'onoff',
        'name' => __( 'Force title to uppercase', 'yit' ),
        'desc' => __( 'Say if you want to force product title to uppercase', 'yit' ),
        'std' => 'yes',
        'deps' => array(
            'ids' => 'shop-single-product-title',
            'values' => 'yes'
        ),
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-product-price',
        'type' => 'onoff',
        'name' => __( 'Show price', 'yit' ),
        'desc' => __( 'Select if you want to show price.', 'yit' ),
        'std' => 'yes',
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-add-to-cart',
        'type' => 'onoff',
        'name' => __( 'Show button add to cart', 'yit' ),
        'desc' => __( 'Select if you want to show purchase button.', 'yit' ),
        'std' => 'yes',
        'disabled' => true
    ),

    array(
        'id' =>'shop-single-show-wishlist',
        'type' => 'onoff',
        'name' => __( 'Show wishlist button', 'yit' ),
        'desc' => __( 'Say if you want to show wishlist button.', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-share',
        'type' => 'onoff',
        'name' => __( 'Show share link', 'yit' ),
        'desc' => __( 'Say if you want to show link for sharing product.', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-metas',
        'type' => 'onoff',
        'name' => __( 'Show product metas (categories and tags)', 'yit' ),
        'desc' => __( 'Say if you want to show product metas in your single product page. It also remove Brands if you are using WooCommerce Brands Addon.', 'yit' ),
        'std' => 'yes',
        'disabled' => true
    ),

    array(
        'id' => 'shop-remove-reviews',
        'type' => 'onoff',
        'name' => __( 'Remove reviews tab', 'yit' ),
        'desc' => __( 'Say if you want to remove reviews tab from all products', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id'   => 'shop-products-tab-layout',
        'type' => 'select',
        'name' => __( 'Product tab orientation', 'yit' ),
        'desc' => __( 'Set the orientation for the product tab.', 'yit' ),
        'options' => array(
            'vertical' => __( 'Vertical', 'yit' ),
            'horizontal' => __( 'Horizontal', 'yit' )
        ),
        'std'  => 'horizontal',
        'disabled' => true
    ),

    array(
        'id'   => 'shop-products-tab-first-opened',
        'type' => 'onoff',
        'name' => __( 'Product Tab First Opened', 'yit' ),
        'desc' => __( 'Set if you want to keep opened the first tab.', 'yit' ),
        'std'  => 'no',
        'deps' => array(
            'ids' => 'shop-products-tab-layout',
            'values' => 'vertical'
        )
    ),

    /* Shop > Related Products Settings */
    array(
        'type' => 'title',
        'name' => __( 'Related products', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-show-related',
        'type' => 'onoff',
        'name' => __( 'Hide related products', 'yit' ),
        'desc' => __( 'Select if you want to display Related Products.', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-show-custom-related',
        'type' => 'onoff',
        'name' => __( 'Custom Related Products number', 'yit' ),
        'desc' => __( 'Select if you want to customize the number of Related Products. Note: if you are already using a custom filter to do that, please don\'t enable this option', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-number-related',
        'type' => 'number',
        'name' => __( 'Number of Related Products', 'yit' ),
        'desc' => __( 'Set the total numbers of the related products displayed, on the product detail page. Note: related products are displayed randomly from Woocommerce. Sometimes the number of related products could be less than the number of items selected. This number depends from the query plugin, not from the theme.', 'yit' ),
        'std' => 3,
        'disabled' => true
    ),

    array(
        'type' => 'title',
        'name' => __( 'Inquiry Form Options', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-enable-inquiry-form',
        'type' => 'onoff',
        'name' => __( 'Enable Inquiry Form', 'yit' ),
        'desc' => __( 'Select if you want to display a inquiry form for the products.', 'yit' ),
        'std' => 'no',
        'disabled' => true
    ),

    array(
        'id' => 'shop-inquiry-title',
        'type' => 'text',
        'name' => __( 'Inquiry box title', 'yit' ),
        'desc' => __( 'Set inquiry box title', 'yit' ),
        'std' => __( 'send an inquiry for this item', 'yit' ),
        'disabled' => true
    ),

    array(
        'id'      => 'shop-inquiry-title-icon',
        'type'    => 'select-icon',
        'options' => array(
            'select' => array(
                'icon'   => __( 'Theme Icon', 'yit' ),
                'custom' => __( 'Custom Icon', 'yit' ),
                'none'   => __( 'None', 'yit' )
            ),
            'icon'   => class_exists('YIT_Plugin_Common') ? YIT_Plugin_Common::get_awesome_icons() : '',
        ),
        'name'    => __( 'Show inquiry icon', 'yit' ),
        'desc'    => __( 'Select the icon for inquiry box title. Note: Custom icon size will be scaled to 25x25', 'yit' ),
        'std'     => array(
            'select' => 'icon',
            'icon'   => 'envelope-o',
            'custom' => ''
        ),
        'disabled' => true
    ),

    array(
        'id' => 'shop-single-product-contact-form',
        'type' => 'select',
        'name' => __( 'Inquiry form', 'yit' ),
        'desc' => __( 'Select contact form type. Note: First you must create one contact form on plugin YIT Contact Form', 'yit' ),
        'options' => apply_filters( 'yit_get_contact_forms', array() ),
        'std' => false,
        'disabled' => true
    )

);

