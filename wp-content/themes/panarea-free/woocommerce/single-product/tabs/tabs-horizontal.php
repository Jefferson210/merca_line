<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="woocommerce-tabs clearfix horizontal wc-tabs-wrapper">
    <ul class="tabs wc-tabs">
        <?php foreach ( $tabs as $key => $tab ) : ?>

            <li class="<?php echo esc_attr( $key ) ?>_tab">
                <a href="#tab-<?php echo esc_attr( $key ) ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ) ?></a>
            </li>

        <?php endforeach; ?>
    </ul>
    <?php foreach ( $tabs as $key => $tab ) : ?>

        <div class="panel entry-content wc-tab" id="tab-<?php echo $key ?>">
            <?php call_user_func( $tab['callback'], esc_attr( $key ), $tab ) ?>
        </div>

    <?php endforeach; ?>
</div>