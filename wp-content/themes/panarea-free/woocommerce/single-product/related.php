<?php
/**
 * Related Products
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) {
    return;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
    'post_type'           => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows'       => 1,
    'posts_per_page'      => $posts_per_page,
    'orderby'             => $orderby,
    'post__in'            => $related,
    'post__not_in'        => array( $product->id )
) );

$products = new WP_Query( $args );

//force grid view
$woocommerce_loop['view'] = 'grid';
$title_param              = yit_get_option( 'typography-h2-font' );
$related_title            = __( 'Related Products', 'yit' );
$border_color             = yit_get_option( 'color-website-border-style-1' );
$related_shortcodes_start = '[box_title subtitle="" font_size="' . $title_param['size'] . '" font_alignment="center" border="middle" border_color="' . $border_color['color'] . '"]';
$related_shortcodes_end   = '[/box_title]';

if ( $products->have_posts() ) : ?>

    <div class="clearfix related products">

            <?php if( shortcode_exists( 'box_title' ) ) : ?>
                <?php echo do_shortcode( $related_shortcodes_start . $related_title . $related_shortcodes_end ) ?>
            <?php else: ?>
                <h3><?php echo $related_title ?></h3>
            <?php endif; ?>


            <?php woocommerce_product_loop_start(); ?>

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

    </div>

<?php endif;

wp_reset_postdata();
