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
 * Notifications Area Constants definition
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 *
 */


/**
 * The name of the YIT theme
 */
define( 'YIT_THEME_NAME', 'panarea.free' );

/**
 * URL to check a theme update
 */
define( 'YIT_THEME_NOTIFIER_URL', 'http://update.yithemes.com/' . YIT_THEME_NAME . '.xml');

/**
 * Define the marketplace: ThemeForest (tf) Yithemes (yit) or free
 *
 */
define( 'YIT_MARKETPLACE', 'yit' );

/**
 * Link to the theme documentation
 */
define( 'YIT_DOCUMENTATION_URL', 'http://docs-free.yithemes.com/panarea/');

/**
 * Define if the theme is a shop, to add supporto to woocommerce plugin
 */
define( 'YIT_IS_SHOP', true);

/**
 * Link to the support platform
 */
define( 'YIT_SUPPORT_URL', 'http://support.yithemes.com/');

define( 'YIT_SAMPLE_IMAGES_URL', '' );

if( !defined( 'YIT_DEBUG' ) ) {
    /**
     * Define if Debug Mode is enabled (Default: disabled)
     */
    define( 'YIT_DEBUG', false );
}


/**
 * The options below allows you to remove all Yithemes brand details in Theme Options.
 * It's highly recommended to define those constants within your wp-config.php
 * in order to preserve the settings even after theme update.
 */
if( !defined( 'YIT_SHOW_PANEL_HEADER' ) ) {
    define( 'YIT_SHOW_PANEL_HEADER', 1 );
}

if( !defined( 'YIT_SHOW_PANEL_HEADER_LINKS' ) ) {
    define( 'YIT_SHOW_PANEL_HEADER_LINKS', 1 );
}

/**
 * If true show notification icon in admin area when an update are available
 */
if( !defined( 'YIT_SHOW_UPDATES' ) ) {
    define( 'YIT_SHOW_UPDATES', true );
}

/**
 * Define if the theme support the skins system
 */
define( 'YIT_HAS_SKINS', false );

/**
 * Remove unused framework modules
 */
function yit_unset_theme_modules( $modules ){
    unset( $modules['services'] );
    unset( $modules['backup-reset'] );
    unset( $modules['contact-form'] );
    unset( $modules['feature-tabs'] );
    unset( $modules['newsletter'] );
    unset( $modules['portfolio'] );
    unset( $modules['shortcodes'] );
    unset( $modules['sidebar'] );
    unset( $modules['team'] );
    return $modules;
}
add_filter( 'yit_framework_modules', 'yit_unset_theme_modules' );

/**
 * Add recommended jetpack modules
 */
function yit_recommended_jetpack_modules( $modules ){

    $modules= array();

    $modules[]= 'yith-woocommerce-ajax-navigation';
    $modules[]= 'yith-woocommerce-colors-labels-variations';
    $modules[]= 'yith-woocommerce-compare';
    $modules[]= 'yith-woocommerce-wishlist';
    $modules[]= 'yith-woocommerce-zoom-magnifier';

    return $modules;
}
add_filter( 'yith_jetpack_recommended_list', 'yit_recommended_jetpack_modules' );