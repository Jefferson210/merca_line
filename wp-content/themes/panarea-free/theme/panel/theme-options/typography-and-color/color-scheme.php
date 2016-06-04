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
 * Return an array with the options for Theme Options > Typography and Color > General Settings
 *
 * @package Yithemes
 * @author  Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since   2.0.0
 * @return  mixed array
 *
 */
return array(


    /* Typography and Color > General Settings */
    array(
        'type' => 'title',
        'name' => __( 'Main general color scheme', 'yit' ),
        'desc' => __( "Set the different colors shades for the main theme's color", 'yit' )
    ),

    array(
        'id'             => 'theme-color-1',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 1', 'yit' ),
        'desc'           => __( 'Set the first shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#a4bc48'
        ),
        'style'          => array(
            'selectors'  => '',
            'properties' => 'color'
        ),
        'disabled' => true
    ),

    array(
        'id'             => 'theme-color-2',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 2', 'yit' ),
        'desc'           => __( 'Set the second shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#799707'
        ),
        'style'          => array(
            'selectors'  => '',
            'properties' => 'color'
        ),
        'disabled' => true
    ),

     array(
        'id'             => 'theme-color-3',
        'type'           => 'colorpicker',
        'name'           => __( 'Shade 3', 'yit' ),
        'desc'           => __( 'Set the third shade of main color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#9bb557'
        ),
        'style'          => array(
            'selectors'  => '',
            'properties' => 'color'
        ),
         'disabled' => true
    ),

    array(
        'id'             => 'general-background-color',
        'type'           => 'colorpicker',
        'name'           => __( 'General Background Color 1', 'yit' ),
        'desc'           => __( 'Set the general background color.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#a4bc48'
        ),
        'style'          => array(
            'selectors'  => '',
            'properties' => 'background-color'
        ),
        'disabled' => true
    ),

     array(
        'id'             => 'general-background-color-2',
        'type'           => 'colorpicker',
        'name'           => __( 'General Background Color 2', 'yit' ),
        'desc'           => __( 'Set the general background color 2.', 'yit' ),
        'refresh_button' => true,
        'std'            => array(
            'color' => '#e7eadf'
        ),
        'style'          => array(
            'selectors'  => '',
            'properties' => 'background-color'
        ),
         'disabled' => true
    ),
    array(
        'id'    => 'color-website-border-style-1',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#cdcdcd'
        ),
        'style' => array(
            array(
                'selectors'  => '',
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
            array(
                'selectors'  => '',
                'properties' => 'background-color'
            )
        ),
        'disabled' => true
    ),

    array(
        'id'    => 'color-website-border-style-2',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 2', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#a4bc48'
        ),
        'style' => array(
            array(
                'selectors'  => '',
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
        ),
        'disabled' => true
    ),

    array(
        'id'    => 'color-website-border-style-3',
        'type'  => 'colorpicker',
        'name'  => __( 'General Border Color Style 3', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the border', 'yit' ),
        'std'   => array(
            'color' => '#e7eadf'
        ),
        'style' => array(
            array(
                'selectors'  => '',
                'properties' => 'border-top-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-bottom-color'
            ),

            array(
                'selectors'  => '',
                'properties' => 'border-color'
            ),
        ),
        'disabled' => true
    ),

    array(
        'id'    => 'color-theme-icon',
        'type'  => 'colorpicker',
        'name'  => __( 'General Icons Color 1', 'yit' ),
        'desc'  => __( 'Select the color used in the theme for the theme icons', 'yit' ),
        'std'   => array(
            'color' => '#b4b4b4'
        ),
        'style' => array(
            array(
                'selectors'  => '',
                'properties' => 'color'
            ),
        ),
        'disabled' => true
    )
);

