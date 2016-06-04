<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return the list of shortcodes and their settings
 *
 * @package Yithemes
 * @author Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$config = YIT_Plugin_Common::load();
$awesome_icons = YIT_Plugin_Common::get_awesome_icons();
$animate = $config['animate'];

$theme_shortcodes = array(


    /* ====== TEXT WITH IMAGE ======== */
    'text-image' => array(
        'title' => __( 'Text with Image', 'yit' ),
        'description' => __( 'Insert text with an image and button', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => false,
        'hide' => 'true',
        'has_content' => true,
        'attributes' => array(
            'title' => array(
                'title' => __('Title', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'subtitle' => array(
                'title' => __( 'Subtitle', 'yit' ),
                'type' => 'text',
                'std' => ''
            ),
            'image' => array(
                'title' => __('Image URL', 'yit'),
                'type' => 'text',
                'std'  => ''
            ),
            'button' => array(
                'title' => __('Button', 'yit'),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'button_text' => array(
                'title' => __( 'Button text', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'button',
                    'values' => '1'
                )
            ),
            'link' => array(
                'title' => __('Link', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'button',
                    'values' => '1'
                )
            ),
            'last' => array(
                'title' => __('Last element', 'yit'),
                'type' => 'checkbox',
                'std'  => 'no'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )

    ),

    /*================= TESTIMONIAL ================*/
    'testimonial'        => array(
        'title'       => __( 'Testimonials', 'yit' ),
        'description' => __( 'Show all post on testimonials post types', 'yit' ),
        'tab'         => 'cpt',
        'in_visual_composer' => true,
        'has_content' => false,
        'create'      => false,
        'attributes'  => array(
            'items' => array(
                'title'       => __( 'N. of items', 'yit' ),
                'description' => __( 'Show all with -1', 'yit' ),
                'type'        => 'number',
                'std'         => '-1'
            ),
            'cat'   => array(
                'title'       => __( 'Categories', 'yit' ),
                'description' => __( 'Select the categories of posts to show', 'yit' ),
                'type'        => 'select',
                'options'     => apply_filters( 'yit_get_testimonial_categories', '' ),
                'std'         => ''
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),


    /*================= BLOG SECTION =================*/
    'blog_section' =>  array(
        'title' => __( 'Blog', 'yit' ),
        'description' => __( 'Print a blog slider', 'yit' ),
        'tab' => 'section',
        'has_content' => false,
        'in_visual_composer' => true,
        'create' => true,
        'attributes' => array(
            'nitems' => array(
                'title' => __( 'Number of items', 'yit' ),
                'description' => __( '-1 to show all elements', 'yit' ),
                'type' => 'number',
                'min' => -1,
                'max' => 99,
                'std' => -1
            ),
            'enable_slider' => array(
                'title' => __( 'Enable Slider', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_thumbnails' => array(
                'title' => __( 'Show Thumbnails', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_date' => array(
                'title' => __( 'Show Date', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_title' => array(
                'title' => __( 'Show Title', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_author' => array(
                'title' => __( 'Show Author', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'enable_comments' => array(
                'title' => __( 'Show Comments', 'yit' ),
                'type' => 'checkbox',
                'std' => 'yes'
            ),
            'animate' => array(
                'title' => __('Animation', 'yit'),
                'type' => 'select',
                'options' => $animate,
                'std'  => ''
            ),
            'animation_delay' => array(
                'title' => __('Animation Delay', 'yit'),
                'type' => 'text',
                'desc' => __('This value determines the delay to which the animation starts once it\'s visible on the screen.', 'yit'),
                'std'  => '0'
            )
        )
    ),


    /*================= SEPARATOR ================*/
    'separator' => array(
        'title' => __( 'Separator', 'yit' ),
        'description' => __( 'Print a separator line', 'yit' ),
        'tab' => 'shortcodes',
        'has_content' => false,
        'create' => true,
        'in_visual_composer' => true,
        'attributes' => array(
            'style' => array(
                'title' => __( 'Separator style', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'single' => __( 'Single line', 'yit' ),
                    'double' => __( 'Double line', 'yit' ),
                    'dotted' => __( 'Dotted line', 'yit' ),
                    'dashed' => __( 'Dashed line', 'yit' )
                ),
                'std' => 'single'
            ),
            'color' => array(
                'title' => __( 'Separator color', 'yit' ),
                'type' => 'colorpicker',
                'std' => '#cdcdcd'
            ),
            'margin_top' => array(
                'title' => __( 'Margin top', 'yit' ),
                'type' => 'number',
                'min' => 0,
                'max' => 999,
                'std' => 40
            ),
            'margin_bottom' => array(
                'title' => __( 'Margin bottom', 'yit' ),
                'type' => 'number',
                'min' => 0,
                'max' => 999,
                'std' => 40
            )
        )
    ),


    /* === MODAL === */
    'modal' => array(
        'title' => __('Modal Window', 'yit' ),
        'description' =>  __('Create a modal window', 'yit' ),
        'tab' => 'shortcodes',
        'in_visual_composer' => true,
        'has_content' => true,
        'attributes' => array(
            'title' => array(
                'title' => __( 'Modal Title', 'yit' ),
                'type' => 'text',
                'std' => __( 'Your title here', 'yit' )
            ),
            'opener' => array(
                'title' => __( 'Type of modal opener', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'button' => __( 'Button', 'yit' ),
                    'text' => __( 'Textual Link', 'yit' ),
                    'image' => __( 'Image', 'yit' )
                ),
                'std' => 'button'
            ),
            'button_text_opener' => array(
                'title' => __( 'Text of the button', 'yit' ),
                'type' => 'text',
                'std' => __( 'Open Modal', 'yit' ),
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'button'
                )
            ),
            'button_style' => array(
                'title' => __( 'Style of the button', 'yit' ),
                'type' => 'select',
                'options' => array(
                    'normal' => __( 'Normal', 'yit' ),
                    'alternative' => __( 'Alternative', 'yit' )
                ),
                'std' => 'normal',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'button'
                )
            ),
            'link_text_opener' => array(
                'title' => __( 'Text of the link', 'yit' ),
                'type' => 'text',
                'std' => __( 'Open Modal', 'yit' ),
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_type' => array(
                'title' => __('Icon type', 'yit'),
                'type'  => 'select',
                'options' => array(
                    'none' => __( 'None', 'yit' ),
                    'theme-icon' => __('Theme Icon', 'yit'),
                    'custom' => __('Custom Icon', 'yit')
                ),
                'std' => 'none',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'link_icon_theme' => array(
                'title' => __('Icon', 'yit'),
                'type' => 'select-icon',  // home|file|time|ecc
                'options' => $awesome_icons,
                'std'  => '',
                'deps' => array(
                    'ids' => 'link_icon_type',
                    'values' => 'theme-icon'
                )
            ),
            'link_icon_url' =>  array(
                'title' => __('Icon URL', 'yit'),
                'type' => 'text',
                'std'  => '',
                'deps' => array(
                    'ids' => 'link_icon_type',
                    'values' => 'custom'
                )
            ),
            'link_text_size' => array(
                'title' => __( 'Font size of the link', 'yit' ),
                'type' => 'number',
                'std' => 17,
                'min' => 1,
                'max' => 99,
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'text'
                )
            ),
            'image_opener' => array(
                'title' => __( 'Url of the image', 'yit' ),
                'type' => 'text',
                'std' => '',
                'deps' => array(
                    'ids' => 'opener',
                    'values' => 'image'
                )
            ),
        )
    ),


);

return $theme_shortcodes;