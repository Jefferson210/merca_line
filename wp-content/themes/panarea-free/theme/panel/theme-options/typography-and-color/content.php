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
 * Return an array with the options for Theme Options > Typography and Color > Content
 *
 * @package Yithemes
 * @author  Andrea Grillo <andrea.grillo@yithemes.com>
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */
return array(

    /* Typography and Color > Content > 404 Page */
    array(
        'type' => 'title',
        'name' => __( '404 Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-not-found-general-font',
        'type'            => 'typography',
        'name'            => __( 'Custom 404 page general font', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-paragraph',
        'std'             => array(
            'size'      => 16,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#555555',
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

    /* Typography and Color > Content > Blog */
    array(
        'type' => 'title',
        'name' => __( 'Blog', 'yit' ),
        'desc' => '',
    ),

    array(
        'id'              => 'content-blog-small-title-font',
        'type'            => 'typography',
        'name'            => __( 'Blog page title font', 'yit' ),
        'desc'            => __( 'Choose the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 18,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => '700',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             text-align'
        ),
        'disabled' => true
        
    ),

    array(
        'id'         => 'content-blog-title-link-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Title Color', 'yit' ),
            'hover'  => __( 'Title Color Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        
        'name'       => __( 'Title Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links title in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#000000',
                'hover'  => '#799707'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '',
                'properties' => 'color'
            )
        ),
        'disabled' => true
    ),


    array(
        'id'              => 'content-blog-small-meta-font',
        'type'            => 'typography',
        'name'            => __( 'Meta info box for small layout', 'yit' ),
        'desc'            => __( 'Choose the font type, size and color for meta info box on small layout.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 11,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'color'     => '#555555',
            'align'     => 'left',
            'transform' => 'uppercase',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                              font-family,
                              font-family,
                              font-weight,
                              color,
                              text-align,
                              text-transform'
        ),
        'disabled' => true
        
    ),

    array(
        'id'         => 'content-blog-meta-link-hover-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal' => __( 'Meta Link', 'yit' ),
            'hover'  => __( 'Meta Link Hover', 'yit' )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-2'
        ),
        
        'name'       => __( 'Meta Links', 'yit' ),
        'desc'       => __( 'Select the colors to use for the links in normal state and on hover.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal' => '#555555',
                'hover'  => '#799707'
            )
        ),
        'style'      => array(
            'normal' => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
            'hover'  => array(
                'selectors'  => '',
                'properties' => 'color'
            )
        ),
        'disabled' => true
    ),

    /* Typography and Color > Content > Comments */
    array(
        'type' => 'title',
        'name' => __( 'Comments', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-comments-font',
        'type'            => 'typography',
        'name'            => __( 'Comments Link font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'      => 14,
            'unit'      => 'px',
            'family'    => 'default',
            'style'     => 'regular',
            'transform' => 'uppercase',
            'color'     => '#555555'
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-transform,
                             color'
        ),
        'disabled' => true
        
    ),

    /* Typography and Color > Content > Pagination */
    array(
        'type' => 'title',
        'name' => __( 'Pagination', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'              => 'content-pagination-font',
        'type'            => 'typography',
        'name'            => __( 'Pagination font', 'yit' ),
        'desc'            => __( 'the font type, size, text transform and align.', 'yit' ),
        'min'             => 1,
        'max'             => 80,
        'default_font_id' => 'typography-website-title',
        'std'             => array(
            'size'   => 18,
            'unit'   => 'px',
            'family' => 'default',
            'style'  => 'regular',
            'align'  => 'center',
        ),
        'style'           => array(
            'selectors'  => '',
            'properties' => 'font-size,
                             font-family,
                             font-weight,
                             text-align'
        ),
        'disabled' => true
        
    ),

    array(
        'id'         => 'content-pagination-text-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Number Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#555555',
                'hover'    => '#a4bc48',
                'selected' => '#555555',
            )
        ),
        'linked_to'  => array(
            'hover' => 'theme-color-1',
        ),
        
        'style'      => array(
            'normal'   => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
            'hover'    => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
            'selected' => array(
                'selectors'  => '',
                'properties' => 'color'
            )
        ),
        'disabled' => true
    ),

    array(
        'id'         => 'content-pagination-background-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'normal'   => __( 'Normal Color', 'yit' ),
            'hover'    => __( 'Hover Color', 'yit' ),
            'selected' => __( 'Selected Color', 'yit' )
        ),
        'name'       => __( 'Pagination Background Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for the pagination links.', 'yit' ),
        'std'        => array(
            'color' => array(
                'normal'   => '#ffffff',
                'hover'    => '#ffffff',
                'selected' => '#ffffff',
            )
        ),
        'style'      => array(
            'normal'   => array(
                'selectors'  => '',
                'properties' => 'background-color'
            ),
            'hover'    => array(
                'selectors'  => '',
                'properties' => 'background-color'
            ),
            'selected' => array(
                'selectors'  => '',
                'properties' => 'background-color'
            )
        ),
        'disabled' => true
    ),

    array(
        'type' => 'title',
        'name' => __( 'Team - About', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'         => 'content-team-text-color',
        'type'       => 'colorpicker',
        'variations' => array(
            'info'    => __( 'Info', 'yit' ),
            'role'    => __( 'Role', 'yit' ),
        ),
        'name'       => __( 'Team Section Text Color', 'yit' ),
        'desc'       => __( 'Select the colors to use for team section (name and role).', 'yit' ),
        'std'        => array(
            'color' => array(
                'info'    => '#928b8b',
                'role'    => '#928b8b',
            )
        ),
        'style'      => array(
            'info'   => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
            'role'    => array(
                'selectors'  => '',
                'properties' => 'color'
            ),
        ),
        'disabled' => true
    ),


);

