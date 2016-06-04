<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'YIT' ) ) {
    exit( 'Direct access forbidden.' );
}

function yit_add_theme_metaboxes() {
    if ( ! function_exists( 'YIT_Metabox' ) ) {
        return;
    }

//Add Metabox to pages
    $args1 = array( 'id'       => 'yit-page-setting',
                    'label'    => __( 'Page settings', 'yit' ),
                    'pages'    => 'page',
                    'context'  => 'normal', //('normal', 'advanced', or 'side')
                    'priority' => 'high',
                    'tabs'     => array(
                        'settings' => array( //tab
                            'label'  => __( 'Settings', 'yit' ),
                            'fields' => array(
                                'active_page_options' => array(
                                    'label' => __( 'Active Page Options', 'yit' ),
                                    'desc'  => '',
                                    'type'  => 'checkbox',
                                    'std'   => '0'
                                ),
                                'show_title'          => array(
                                    'label' => __( 'Show Title', 'yit' ),
                                    'desc'  => __( 'Show or not the title of the page', 'yit' ),
                                    'type'  => 'checkbox',
                                    'std'   => ''
                                ),
                                'sep'                 => array(
                                    'type' => 'sep'
                                ),
                                'show_breadcrumb'     => array(
                                    'label' => __( 'Show Breadcrumb', 'yit' ),
                                    'desc'  => __( 'Show or not the breadcumb', 'yit' ),
                                    'type'  => 'checkbox',
                                    'std'   => ''
                                ),
                                'sep1'                => array(
                                    'type' => 'sep'
                                ),

                                'sidebars'            => array(
                                    'label' => __( 'Sidebar', 'yit' ),
                                    'type'  => 'sidebars',
                                    'std'   => array( 'layout' => 'sidebar-no' )
                                ),
                            ),
                        ),
                        'header'   => array(
                            'label'  => __( 'Header', 'yit' ),
                            'fields' => array(
                                'custom_background'     => array(
                                    'label' => __( 'Enable custom header background', 'yit' ),
                                    'desc'  => __( 'Set YES if you want to customize the header background.', 'yit' ),
                                    'type'  => 'onoff',
                                    'std'   => 'no'
                                ),
                                'header_bg_color'       => array(
                                    'label' => __( 'Header background color', 'yit' ),
                                    'desc'  => __( 'Select a background color for the header', 'yit' ),
                                    'type'  => 'colorpicker',
                                    'std'   => '#ffffff',
                                    'deps'  => array(
                                        'ids'    => '_custom_background',
                                        'values' => 'yes'
                                    )
                                ),
                                'header_bg_image'       => array(
                                    'label' => __( 'Header background image', 'yit' ),
                                    'desc'  => __( 'Select a background image for the header.', 'yit' ),
                                    'type'  => 'upload',
                                    'std'   => '',
                                    'deps'  => array(
                                        'ids'    => '_custom_background',
                                        'values' => 'yes'
                                    )
                                ),
                                'header_bg_repeat'      => array(
                                    'label'   => __( 'Background repeat', 'yit' ),
                                    'desc'    => __( 'Select the repeat mode for the background image.', 'yit' ),
                                    'type'    => 'select',
                                    'options' => array(
                                        'default'   => __( 'Default', 'yit' ),
                                        'repeat'    => __( 'Repeat', 'yit' ),
                                        'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
                                        'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
                                        'no-repeat' => __( 'No Repeat', 'yit' ),
                                    ),
                                    'std'     => 'default',
                                    'deps'    => array(
                                        'ids'    => '_custom_background',
                                        'values' => 'yes'
                                    )
                                ),
                                'header_bg_position'    => array(
                                    'label'   => __( 'Background position', 'yit' ),
                                    'desc'    => __( 'Select the position for the background image.', 'yit' ),
                                    'type'    => 'select',
                                    'options' => array(
                                        'default'       => __( 'Default', 'yit' ),
                                        'center'        => __( 'Center', 'yit' ),
                                        'top left'      => __( 'Top left', 'yit' ),
                                        'top center'    => __( 'Top center', 'yit' ),
                                        'top right'     => __( 'Top right', 'yit' ),
                                        'bottom left'   => __( 'Bottom left', 'yit' ),
                                        'bottom center' => __( 'Bottom center', 'yit' ),
                                        'bottom right'  => __( 'Bottom right', 'yit' ),
                                    ),
                                    'std'     => 'default',
                                    'deps'    => array(
                                        'ids'    => '_custom_background',
                                        'values' => 'yes'
                                    )
                                ),
                                'header_bg_attachament' => array(
                                    'label'   => __( 'Background attachment', 'yit' ),
                                    'desc'    => __( 'Select the attachment for the background image.', 'yit' ),
                                    'type'    => 'select',
                                    'options' => array(
                                        'default' => __( 'Default', 'yit' ),
                                        'scroll'  => __( 'Scroll', 'yit' ),
                                        'fixed'   => __( 'Fixed', 'yit' ),
                                    ),
                                    'std'     => 'default',
                                    'deps'    => array(
                                        'ids'    => '_custom_background',
                                        'values' => 'yes'
                                    )
                                )
                            ),
                        ),
                    )
    );

    $metabox1 = YIT_Metabox( 'yit-page-setting' );
    $metabox1->init( $args1 );

//Add Metabox to post
    $args2 = array( 'id'       => 'yit-post-setting',
                    'label'    => __( 'Post settings', 'yit' ),
                    'pages'    => 'post',
                    'context'  => 'normal', //('normal', 'advanced', or 'side')
                    'priority' => 'high',
                    'tabs'     => array(
                        'settings' => array( //tab
                            'label'  => __( 'Settings', 'yit' ),
                            'fields' => array(
                                'active_page_options' => array(
                                    'label' => __( 'Active Page Options', 'yit' ),
                                    'desc'  => '',
                                    'type'  => 'checkbox',
                                    'std'   => '0'
                                ),
                                'sidebars'            => array(
                                    'label' => __( 'Sidebar', 'yit' ),
                                    'type'  => 'sidebars',
                                    'std'   => ''
                                )
                            )
                        )

                    )
    );

    $metabox2 = YIT_Metabox( 'yit-post-setting' );
    $metabox2->init( $args2 );

}

add_action( 'after_setup_theme', 'yit_add_theme_metaboxes' );