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
 * Return an array with the options for Theme Options > Typography and Color > Shop
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'        => 'shop-add-to-cart-hover-color',
        'type'      => 'colorpicker',
        'name'      => __( 'Remove hover color in widget cart', 'yit' ),
        'desc'      => __( 'Select the hover color to use for the remove link', 'yit' ),
        'std'       => array(
            'color' => '#a4bc48'
        ),
        'linked_to' => 'theme-color-1',
        
        'style'     => array(
            'selectors'  => '',
            'properties' => 'color'
        ),
        'disabled' => true
    ),

    array(
        'id'        => 'shop-add-to-cart-number-color',
        'type'      => 'colorpicker',
        'name'      => __( 'Items counter', 'yit' ),
        'desc'      => __( 'Select the color to use for the items counter border and items counter background', 'yit' ),
         'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'color'      => __( 'Text', 'yit' ),
        ),
        'std'       => array(
            'color' => array(
                'border'        => '#adadad',
                'background'    => '#ffffff',
                'color'         => '#4a5c08'
            )
        ),
        'style'     => apply_filters( 'yit_shop-add-to-cart-number-color', array(
                'border'        => array(
                    'selectors'  => '',
                    'properties' => 'border-color'
                ),

                'background'    => array(
                    'selectors'  => '',
                    'properties' => 'background-color'
                ),

                'color'    => array(
                    'selectors'  => '',
                    'properties' => 'color'
                )
            )
        ),
        'disabled' => true
    ),

    /* Typography and Color > Shop > Shop Page */
    array(
        'type' => 'title',
        'name' => __( 'Shop Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-page-product-name-font',
        'type'            => 'typography',
        'name'            => __( 'Product title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 15,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'disabled' => true
        
    ),

    array(
        'id'              => 'shop-page-product-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 19,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'color'     => '#000000',
            'align'     => 'center',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'disabled' => true
        
    ),

    array(
        'id'    => 'shop-page-quick-view-background',
        'type'  => 'colorpicker',
        'name'  => __( 'Quick view background color', 'yit' ),
        'desc'  => __( 'Select a background-color for quick-view section link in slide-up layout', 'yit' ),
        'std'   => apply_filters( 'yit_shop-page-quick-view-background_std', array(
            'color' => '#808e49'
        ) ),
        'style' => apply_filters( 'yit_shop-page-quick-view-background_style', array(
            'selectors'  => '',
            'properties' => 'background-color'
        ) ),
        'disabled' => true
        
    ),

    array(
        'id'              => 'shop-page-quick-view-font',
        'type'            => 'typography',
        'name'            => __( 'Quick view link font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for quick view link in slide-up layout.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => apply_filters( 'yit_shop-page-quick-view-font_std', array(
            'size'      => 12,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#ffffff',
            'align'     => 'center',
            'transform' => 'uppercase',
        ) ),
        'style'           => apply_filters( 'yit_shop-page-quick-view-font_style', array(
            'selectors'  => '',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ),
        'disabled' => true
        
    ),

    array(
        'type' => 'title',
        'name' => __( 'Shop Icon', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'         => 'shop-icon-onsale-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Icon On Sale Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the icon on-sale border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-icon-onsale-colors_std', array(
            'color' => array(
                'border'     => '#ffa509',
                'background' => '#f7c104',
                'text'       => '#000000'
            )
        ) ),
        
        'style'      => apply_filters( 'yit_shop-icon-onsale-colors_style', array(
            'border'     => array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors' => '',
                'properties' => 'color',
            )
        ) ),
        'disabled' => true
    ),

    array(
        'id'         => 'shop-preset-onsale-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Preset Icon On Sale Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the preset icon "on sale" border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-preset-onsale-colors_std', array(
            'color' => array(
                'border'     => '#000000',
                'background' => '#636363',
                'text'       => '#ffffff'
            )
        ) ),
        
        'style'      => apply_filters( 'yit_shop-preset-onsale-colors_style', array(
            'border'     => array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors' => '',
                'properties' => 'color',
            )
        ) ),
        'disabled' => true
    ),

    array(
        'id'         => 'shop-icon-added-cart-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
            'text'       => __( 'Text Color', 'yit' )
        ),
        'name'       => __( 'Icon "Added to Cart" Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the icon "added to cart" border, background and text color', 'yit' ),
        'std'        => apply_filters( 'yit_shop-added-cart-colors_std', array(
            'color' => array(
                'border'     => '#908209',
                'background' => '#adab01',
                'text'       => '#ffffff'
            )
        ) ),
        
        'style'      => apply_filters( 'yit_shop-icon-added-cart-colors_style', array(
            'border'     => array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '',
                'properties' => 'background'
            ),
            'text'       => array(
                'selectors'  => '',
                'properties' => 'color',
            )
        ) ),
        'disabled' => true
    ),

    array(
        'type' => 'title',
        'name' => __( 'Shop Pagination Style', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-pagination-font',
        'type' => 'typography',
        'name' => __( 'Shop Pagination ', 'yit' ),
        'desc' => __( 'Select the font to use for the shop pagination', 'yit' ),
        'min' => 1,
        'max' => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'   => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#b4b4b4',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style' => apply_filters( 'yit_shop-pagination-font_style', array(
            'selectors'   => '',
            'properties'  => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ) ),
        'disabled' => true
        
    ),


    /* Typography and Color > Shop > Product Detail Page */

    array(
        'type' => 'title',
        'name' => __( 'Single Product Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'shop-product-title-price-font',
        'type'            => 'typography',
        'name'            => __( 'Product title and price font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 30,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '400',
            'color'     => '#000000',
            'align'     => 'left',
            'transform' => 'none',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                              font-family,
                              font-weight,
                              color,
                              text-transform,
                              text-align'
        ),
        'disabled' => true
        
    ),

    array(
        'id'    => 'shop-out-of-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Out of Stock" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Out of Stock" label.', 'yit' ),
        'std'   => array(
            'color' => '#dd3333'
        ),
        'style' => array(
            'selectors'  => '',
            'properties' => 'color'
        ),
        'disabled' => true
        
    ),

    array(
        'id'    => 'shop-in-stock-color',
        'type'  => 'colorpicker',
        'name'  => __( 'Shop "Stock Quantity" text color', 'yit' ),
        'desc'  => __( 'Select a text color for the "Stock Quantity" label.', 'yit' ),
        'std'   => apply_filters( 'yit_shop-in-stock-color_std', array(
            'color' => '#85ad74'
        ) ),
        'style' => apply_filters( 'yit_shop-in-stock-color_style', array(
            'selectors'  => '',
            'properties' => 'color'
        ) ),
        'disabled' => true
        
    ),

    /* Typography and Color > Shop > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Cart Header Widget', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'shop-cart-header-widget-colors',
        'type'       => 'colorpicker',
        'variations' => array(
            'border'     => __( 'Border', 'yit' ),
            'background' => __( 'Background', 'yit' ),
        ),
        'name'       => __( 'Cart Header Widget Colors', 'yit' ),
        'desc'       => __( 'Select the colors to use for the header cart widget border and background', 'yit' ),
        'std'        => array(
            'color' => array(
                'border'     => '#dcdad2',
                'background' => '#ffffff',
            )
        ),
        'linked_to'  => array(
            'border' => 'theme-color-1',
        ),
        
        'style'      => array(
            'border'     => array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
            'background' => array(
                'selectors'  => '',
                'properties' => 'background'
            )
        ),
        'disabled' => true
    ),


);

