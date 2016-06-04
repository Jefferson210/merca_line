<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce;

define( 'WC_LATEST_VERSION', '2.5' );

/* === HOOKS === */
function yit_woocommerce_hooks() {

    global $woocommerce;

    if ( ! defined( 'YIT_DEBUG' ) || ! YIT_DEBUG ) {
        $message = get_option( 'woocommerce_admin_notices', array() );
        $message = array_diff( $message, array( 'template_files' ) );
        update_option( 'woocommerce_admin_notices', $message );
    }

    add_filter( 'woocommerce_template_path', 'yit_set_wc_template_path' );

    add_action( 'yit_after_primary_starts', 'yit_single_product_title_bar' );
    add_action( 'woocommerce_before_main_content', 'yit_shop_page_meta' );
    add_action( 'yit_activated', 'yit_woocommerce_default_image_dimensions' );
    add_filter( 'woocommerce_enqueue_styles', 'yit_enqueue_wc_styles' );

    add_action( 'wp_head', 'yit_size_images_style' );

    // Use WC 2.0 variable price format, now include sale price strikeout
    add_filter( 'woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2 );
    add_filter( 'woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2 );

    /* shop */

    add_filter( 'loop_shop_per_page', 'yit_products_per_page' );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    add_action( 'shop-page-meta', 'yit_wc_catalog_ordering' );

    add_action( 'shop-page-meta', 'yit_wc_list_or_grid' );

    add_action( 'woocommerce_after_shop_loop_item_title', 'yit_shop_product_description', 15 );
    add_action( 'yith_add_to_cart_button', 'woocommerce_template_loop_add_to_cart', 10 );

    /** 2.4 action */
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

    add_action( 'woocommerce_shop_loop_item_title', 'yit_shop_page_product_title', 10 );

    /* single product */

    function remove_woocommerce_breadcrumb () {
        if ( is_singular( array( 'product' ) ) ) {
            remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
        }
    }
    add_action( 'woocommerce_before_main_content', 'remove_woocommerce_breadcrumb' );
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


    add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash' );

    /* cart */
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

    /* checkout */
    remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form' );


    /*ajax search loading*/
    add_filter( 'yith_wcas_ajax_search_icon', 'yit_loading_search_icon' );

    /*======== Support to YITH Plugins =========*/

    add_action( 'init', 'yit_plugins_support' );

}

add_action( 'after_setup_theme', 'yit_woocommerce_hooks' );


if ( !function_exists( 'yit_shop_page_product_title' ) ) {
    /**
     * Add product title to main shop page
     *
     * @return void
     * @since  1.0.0
     * @author Francesco Licandro <francesco.licandro@yithemes.com>
     */
    function yit_shop_page_product_title() {

        $html = '<h3>';
        $html .= '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
        $html .= '</h3>';

        echo $html;

    }

}


if ( ! function_exists( 'yit_set_wc_template_path' ) ) {
    /**
     * Return the folder of custom woocommerce templates
     *
     * @param $path
     *
     * @return string template folder
     *
     * @since    2.0.0
     */
    function yit_set_wc_template_path( $path ) {

        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', WC()->version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x/';
        }

        return $path;
    }
}

if ( ! function_exists( 'yit_enqueue_wc_styles' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_enqueue_wc_styles( $styles ) {

        $path = 'woocommerce';
        $version = WC()->version;

        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), WC_LATEST_VERSION, '<' ) ) {
            $path = 'woocommerce_' . substr( $version, 0, 3 ) . '.x';
        }

        /* 2.3 add select2 on cart page*/
        if ( version_compare( preg_replace( '/-beta-([0-9]+)/', '', $version ), '2.2', '>' ) ){
            if(is_cart()){
                wp_enqueue_script( 'select2' );
                wp_enqueue_style( 'select2', WC()->plugin_url() . '/assets/css/select2.css' );
            }
        }

        unset( $styles['woocommerce-general'], $styles['woocommerce-layout'], $styles['woocommerce-smallscreen'] );

        $styles ['yit-layout'] = array(
            'src'     => get_stylesheet_directory_uri() . '/' . $path . '/style.css',
            'deps'    => '',
            'version' => '1.0',
            'media'   => ''
        );
        return $styles;
    }
}

if ( ! function_exists( 'yit_get_current_cart_info' ) ) {
    /**
     * Remove Woocommerce Styles add custom Yit Woocommerce style
     *
     * @internal param $styles
     *
     * @return array list of style files
     * @since    2.0.0
     */
    function yit_get_current_cart_info() {

        $subtotal  = WC()->cart->get_cart_subtotal();
        $items     = yit_get_option( 'shop-mini-cart-total-items' ) ? WC()->cart->get_cart_contents_count() : count( WC()->cart->get_cart() );
        $cart_icon = yit_get_option( 'shop-mini-cart-icon' );

        return array(
            $items,
            $subtotal,
            $cart_icon,
            get_woocommerce_currency_symbol(),
        );
    }
}

function woocommerce_template_loop_product_thumbnail() {

    global $product, $woocommerce_loop;

    $attachments = $product->get_gallery_attachment_ids();

    echo '<div class="thumb-wrapper classic ">';

    if( isset( $attachments[0] ) ) {
        echo '<a href="' . get_permalink() . '" class="thumb backface"><span class="face">' . woocommerce_get_product_thumbnail() . '</span>';
        echo '<span class="face back">';
        yit_image( "id=$attachments[0]&size=shop_catalog&class=image-hover" );
        echo '</span></a>';
    }
    else {
        echo '<a href="' . get_permalink() . '" class="thumb"><span class="face">' . woocommerce_get_product_thumbnail() . '</span></a>';
    }


    echo '</div>';

}


function yit_get_product_category() {
    global $product;
    echo '<span class="product_cat">' . $product->get_categories() . '</span>';
}

/**
 * SIZES
 */
// shop small
if ( ! function_exists( 'yit_shop_catalog_w' ) ) : function yit_shop_catalog_w() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_h' ) ) : function yit_shop_catalog_h() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_catalog_c' ) ) : function yit_shop_catalog_c() {
    $size = wc_get_image_size( 'shop_catalog' );
    return $size['crop'];
} endif;
// shop thumbnail
if ( ! function_exists( 'yit_shop_thumbnail_w' ) ) : function yit_shop_thumbnail_w() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_h' ) ) : function yit_shop_thumbnail_h() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_thumbnail_c' ) ) : function yit_shop_thumbnail_c() {
    $size = wc_get_image_size( 'shop_thumbnail' );
    return $size['crop'];
} endif;
//shop large
if ( ! function_exists( 'yit_shop_single_w' ) ) : function yit_shop_single_w() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_single_h' ) ) : function yit_shop_single_h() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_single_c' ) ) : function yit_shop_single_c() {
    $size = wc_get_image_size( 'shop_single' );
    return $size['crop'];
} endif;
// shop featured
if ( ! function_exists( 'yit_shop_featured_w' ) ) : function yit_shop_featured_w() {
    $size = wc_get_image_size( 'shop_featured' );
    return $size['width'];
} endif;
if ( ! function_exists( 'yit_shop_featured_h' ) ) : function yit_shop_featured_h() {
    $size = wc_get_image_size( 'shop_featured' );
    return $size['height'];
} endif;
if ( ! function_exists( 'yit_shop_featured_c' ) ) : function yit_shop_featured_c() {
    $size = wc_get_image_size( 'shop_featured' );
    return $size['crop'];
} endif;





function yit_single_product_title_bar() {
    if ( function_exists( 'WC' ) ) {
        if ( ! is_product() ) {
            return;
        }

        global $product;
        $args = array( 'delimiter' => ' > ' );

        echo '<div id="title_bar" class="clearfix title_bar_single_product">';
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-sm-12">';
        woocommerce_breadcrumb( $args );
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}

function yit_related_posts_per_page() {
    return array(
        'posts_per_page'      => - 1,
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1
    );
}

function yit_add_my_account_endpoint() {
    if ( function_exists( 'WC' ) ) {
        WC()->query->query_vars['recent-downloads'] = 'recent-downloads';
    }
}


if ( ! function_exists( 'yit_loading_search_icon' ) ) {

    function yit_loading_search_icon() {
        return '"' . YIT_THEME_ASSETS_URL . '/images/search.gif"';
    }
}

if ( ! function_exists( 'yit_shop_page_meta' ) ) {

    function yit_shop_page_meta() {
        if ( is_single() ) {
            return;
        }
        wc_get_template( '/global/page-meta.php' );
    }
}

if ( ! function_exists( 'yit_wc_catalog_ordering' ) ) {

    function yit_wc_catalog_ordering() {
        if ( ! is_single() && have_posts() ) {
            woocommerce_catalog_ordering();
        }
    }
}

if ( ! function_exists( 'yit_wc_list_or_grid' ) ) {

    function yit_wc_list_or_grid() {
        wc_get_template( '/global/list-or-grid.php' );
    }
}

if ( ! function_exists( 'yit_add_query_vars_filter' ) ) {

    function yit_add_query_vars_filter( $vars ) {

        $vars[] = "products-per-page";
        return $vars;
    }
}
add_filter( 'query_vars', 'yit_add_query_vars_filter' );


if ( ! function_exists( 'yit_products_per_page' ) ) {

    function yit_products_per_page() {

        $num_prod = get_query_var( 'products-per-page' );

        if ( empty( $num_prod ) ) {
            $num_prod = yit_get_option( 'shop-products-per-page' );
        }
        elseif ( $num_prod == 'all' ) {
            $num_prod = wp_count_posts( 'product' )->publish;
        }

        return $num_prod;
    }
}

// print style for list view
if ( ! function_exists( 'yit_size_images_style' ) ) {

    function yit_size_images_style() {

        $content_width      = $GLOBALS['content_width'];
        $shop_catalog_w     = ( 100 * yit_shop_catalog_w() ) / $content_width;
        $info_product_width = 100 - $shop_catalog_w;

        ?>

        <style type="text/css">

            .woocommerce ul.products li.product.list .product-wrapper .thumb-wrapper {
                width: <?php echo $shop_catalog_w?>%;
                height: auto;
            }

            .woocommerce ul.products li.product.list .product-wrapper .info-product {
                width: <?php echo $info_product_width - 2 ?>%;
            }

            .woocommerce ul.products li.product.list .product-wrapper .product-meta {
                width: <?php echo $info_product_width -2 ?>%;
            }

        </style>
    <?php
    }
}

if ( ! function_exists( 'yit_shop_product_description' ) ) {

    function yit_shop_product_description() {

        if ( yit_get_option( 'shop-product-description-on-list' ) == 'yes' ) {
            echo '<div class="product-description">';
            woocommerce_template_single_excerpt();
            echo '</div>';
        }
    }
}

function wc_wc20_variation_price_format( $price, $product ) {
    // Main Price
    $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
    $price  = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );
    // Sale Price
    $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
    sort( $prices );
    $saleprice = $prices[0] !== $prices[1] ? sprintf( __( '<span class="from">From: </span>%1$s', 'yit' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

    if ( $price !== $saleprice ) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    return $price;
}

if ( ! function_exists( 'yit_add_to_cart_success_ajax' ) ) {
    function yit_add_to_cart_success_ajax( $datas ) {

        list( $cart_items, $cart_subtotal, $cart_icon, $cart_currency ) = yit_get_current_cart_info();
        $datas['.yit_cart_widget .cart_label .cart-items .yit-mini-cart-icon'] = '<span class="yit-mini-cart-icon"><span class="cart-items-number">' . $cart_items . '</span></span>';
        return $datas;
    }

    add_filter( 'woocommerce_add_to_cart_fragments', 'yit_add_to_cart_success_ajax' );
}



// SET LAYOUT FOR SHOP PAGE

function yit_sidebar_shop_page( $value, $key, $id ) {

    $new_layout = ( isset( $_GET['layout-shop'] ) ) ? $_GET['layout-shop'] : '';

    if( isset( $value['layout'] ) && $new_layout != '' && $key == 'sidebars' ) {

        $value['layout'] = $new_layout;

        if( $value['sidebar-left'] == -1 ){
            $value['sidebar-left'] = $value['sidebar-right'];
        }
        elseif( $value['sidebar-right'] == -1 ){
            $value['sidebar-right'] = $value['sidebar-left'];
        }
    }

    return $value;
}
add_filter( 'yit_get_option_layout', 'yit_sidebar_shop_page', 10, 3 );



// add image for product category page

function woocommerce_taxonomy_archive_description() {

    if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
        global $wp_query;

        $cat          = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image        = wp_get_attachment_image_src( $thumbnail_id, 'full' );

        $description = apply_filters( 'the_content', term_description() );


        if ( $description ) {
            echo '<div class="term-description">' . $description . '</div>';
        }
    }
}

if ( ! function_exists( 'yit_plugins_support' ) ) {
    /**
     * YITH Plugins support
     *
     * @return string
     * @since 1.0
     */
    function yit_plugins_support(){

        /* === YITH WooCommerce Multi Vendor */
        if( class_exists( 'YITH_Vendors_Frontend_Premium' ) && function_exists( 'YITH_Vendors' ) ){
            $obj = YITH_Vendors()->frontend;
            remove_action( 'woocommerce_archive_description', array( $obj, 'add_store_page_header' ) );
            add_action( 'yith_before_shop_page_meta', array( $obj, 'add_store_page_header' ) );
            add_filter( 'yith_wpv_quick_info_button_class', 'yith_multi_vendor_button_class' );
            add_filter( 'yith_wpv_report_abuse_button_class', 'yith_multi_vendor_button_class' );
        }

        if ( ! function_exists( 'yith_multi_vendor_quick_info_button_class' ) ) {

            /**
             * YITH Plugins support -> Multi Vendor widgets submit button
             *
             * @param string $class
             * @return string
             * @since 1.0
             */
            function yith_multi_vendor_button_class( $class ) {
                return 'button btn-flat pull-right';
            }
        }


        /* advanced reviews */

        if ( defined( 'YITH_YWAR_VERSION' ) ) {

            global $YWAR_AdvancedReview;

            remove_action( 'yith_advanced_reviews_before_reviews', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

            add_action( 'yith_advanced_reviews_before_review_list', array( $YWAR_AdvancedReview, 'load_reviews_summary' ) );

            if ( defined( 'YITH_YWAR_PREMIUM' ) ) {

                add_filter( 'yith_advanced_reviews_loader_gif', 'yit_loading_search_icon' );

            }
        }

        /* request a quote */

        if ( defined( 'YITH_YWRAQ_VERSION' ) ) {

            $yith_request_quote = YITH_Request_Quote();

            if ( method_exists( $yith_request_quote, 'add_button_shop' ) ) {
                remove_action( 'woocommerce_after_shop_loop_item', array( $yith_request_quote, 'add_button_shop' ), 15 );
                add_action( 'woocommerce_before_shop_loop_item', array( $yith_request_quote, 'add_button_shop' ), 30);
            }

            add_filter( 'ywraq_product_in_list', 'yit_ywraq_change_product_in_list_message' );

            function yit_ywraq_change_product_in_list_message() {
                return __( 'In your quote list', 'yit' );
            }

            add_filter( 'ywraq_product_added_view_browse_list', 'yit_ywraq_product_added_view_browse_list_message' );

            function yit_ywraq_product_added_view_browse_list_message() {
                return __( 'View list &gt;', 'yit' );
            }

            add_filter( 'yith_admin_tab_params' , 'yith_wraq_remove_layout_options' );

            if ( ! function_exists( 'yith_wraq_remove_layout_options' ) ) {

                /**
                 * Remove Layout option from Request a Quote
                 *
                 * @param array $array
                 * @return array
                 * @since 1.0
                 */
                function yith_wraq_remove_layout_options( $array ) {

                    if ( $array['page'] == 'yith_woocommerce_request_a_quote' ) {
                        unset( $array['available_tabs']['layout'] );
                    }

                    return $array;
                }
            }
        }

        /*================ Colors and Label Variations Premium ==================*/

        if( defined( 'YITH_WCCL_PREMIUM' ) && function_exists( 'YITH_WCCL_Frontend' ) ) {

            remove_filter( 'woocommerce_loop_add_to_cart_link', array( YITH_WCCL_Frontend(), 'add_select_options' ), 99, 2 );
            add_action( 'woocommerce_after_shop_loop_item_title', array( YITH_WCCL_Frontend(), 'print_select_options' ) , 99 );


            if( yit_get_option( 'shop-layout-type' )=='slideup' ) {

                add_filter( 'yith_wccl_add_to_cart_button_content' , 'yit_get_add_to_cart_slideup' );

            }

            function yit_get_add_to_cart_slideup( $arg ) {

                $img = ( yit_get_option( 'shop-slide-add-cart-icon' ) != '' ) ? yit_get_option( 'shop-slide-add-cart-icon' ) : get_template_directory_uri() . '/images/ico-cart.png';

                $image_size = yit_getimagesize( $img );

                $button = '<img src="' . $img . '" alt="ico-cart" class="ico-cart" height="'. $image_size[1] . '" width="'. $image_size[0] . '"/>';

                return $button;
            }


        }


        /* === WPML === */

        function yit_wpml_endpoint_hack_for_after() {
            global $yit_wpml_hack_endpoint;
            $yit_wpml_hack_endpoint = WC()->query->query_vars;
            // add the options
            foreach ( $yit_wpml_hack_endpoint as $endpoint => $value ) {
                add_option( 'woocommerce_myaccount_'.$endpoint.'_endpoint', $value );
            }
        }
        add_action( 'after_setup_theme', 'yit_wpml_endpoint_hack_for_after', 11 );

        function yit_wpml_my_account_endpoint() {
            global $woocommerce_wpml, $yit_wpml_hack_endpoint;

            if ( ! isset( $woocommerce_wpml->endpoints ) ) {
                return;
            }

            $endpoints = array(
                'recent-downloads',
                'myaccount-wishlist',
            );

            foreach ( $endpoints as $endpoint ) {
                if ( ! isset( $yit_wpml_hack_endpoint[ $endpoint ] ) ) {
                    return;
                }

                WC()->query->query_vars[ $endpoint ] = $woocommerce_wpml->endpoints->get_endpoint_translation( $yit_wpml_hack_endpoint[ $endpoint ] );
            }

            unset( $yit_wpml_hack_endpoint );
        }

        add_action( 'init', 'yit_wpml_my_account_endpoint', 3 );


    }

}