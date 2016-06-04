<?php
/**
 * WooCommerce Custom Price Label Bulk Editor Tool
 *
 * The WooCommerce Custom Price Label Bulk Editor Tool class.
 *
 * @version 2.1.0
 * @since   2.1.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WC_Custom_Price_Label_Bulk_Editor' ) ) :

class WC_Custom_Price_Label_Bulk_Editor {

	/**
	 * Constructor.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function __construct() {
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'add_tool' ), PHP_INT_MAX );
		}
	}

	/**
	 * add_tool.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function add_tool() {
		add_submenu_page(
			'woocommerce',
			__( 'WooCommerce Custom Price Label Bulk Editor Tool', 'woocommerce-custom-price-label' ),
			__( 'Custom Price Label Bulk Editor Tool', 'woocommerce-custom-price-label' ),
			'manage_options',
			'wc-custom-price-label-bulk-editor-tool',
			array( $this, 'create_tool' )
		);
	}

	/**
	 * get_products.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function get_products( $products = array() ) {
		$offset = 0;
		$block_size = 96;
		while( true ) {
			$args = array(
				'post_type'      => 'product',
				'post_status'    => 'any',
				'posts_per_page' => $block_size,
				'offset'         => $offset,
				'orderby'        => 'title',
				'order'          => 'ASC',
			);
			$loop = new WP_Query( $args );
			if ( ! $loop->have_posts() ) break;
			while ( $loop->have_posts() ) : $loop->the_post();
				$products[ strval( $loop->post->ID ) ] = get_the_title( $loop->post->ID );
			endwhile;
			$offset += $block_size;
		}
		wp_reset_postdata();
		return $products;
	}

	/**
	 * get_products.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function get_table_html( $data, $args = array() ) {
		$defaults = array(
			'table_class'        => '',
			'table_style'        => '',
			'table_heading_type' => 'horizontal',
			'columns_classes'    => array(),
			'columns_styles'     => array(),
		);
		$args = array_merge( $defaults, $args );
		extract( $args );
		$table_class = ( '' == $table_class ) ? '' : ' class="' . $table_class . '"';
		$table_style = ( '' == $table_style ) ? '' : ' style="' . $table_style . '"';
		$html = '';
		$html .= '<table' . $table_class . $table_style . '>';
		$html .= '<tbody>';
		foreach( $data as $row_number => $row ) {
			$html .= '<tr>';
			foreach( $row as $column_number => $value ) {
				$th_or_td = ( ( 0 === $row_number && 'horizontal' === $table_heading_type ) || ( 0 === $column_number && 'vertical' === $table_heading_type ) ) ? 'th' : 'td';
				$column_class = ( ! empty( $columns_classes ) && isset( $columns_classes[ $column_number ] ) ) ? ' class="' . $columns_classes[ $column_number ] . '"' : '';
				$column_style = ( ! empty( $columns_styles ) && isset( $columns_styles[ $column_number ] ) ) ? ' style="' . $columns_styles[ $column_number ] . '"' : '';
				$html .= '<' . $th_or_td . $column_class . $column_style . '>';
				$html .= $value;
				$html .= '</' . $th_or_td . '>';
			}
			$html .= '</tr>';
		}
		$html .= '</tbody>';
		$html .= '</table>';
		return $html;
	}

	/**
	 * create_tool.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function create_tool() {
		$products = $this->get_products();

		// Action
		if ( isset( $_POST['alg_custom_price_label_bulk_editor_submit'] ) ) {
			foreach ( $products as $product_id => $product_title ) {
				foreach ( WCCPL()->custom_tab_sections as $custom_tab_section => $custom_tab_section_title ) {
					foreach ( WCCPL()->custom_tab_section_variations as $custom_tab_section_variation => $custom_tab_section_variation_title ) {
						if ( '_text' === $custom_tab_section_variation || '' === $custom_tab_section_variation ) {
							$option_name = WCCPL()->custom_tab_group_name . $custom_tab_section . $custom_tab_section_variation;
							if ( '_text' === $custom_tab_section_variation ) {
								update_post_meta( $product_id, '_' . $option_name,  $_POST[ $option_name . '_' . $product_id ] );
							} else {
								if ( isset( $_POST[ $option_name . '_' . $product_id ] ) ) {
									update_post_meta( $product_id, '_' . $option_name,  $_POST[ $option_name . '_' . $product_id ] );
								} else {
									update_post_meta( $product_id, '_' . $option_name,  'off' );
								}
							}
						}
					}
				}
			}
		}

		// Tool
		$html = '';
		$html .= '<h1>' . __( 'Custom Price Label Bulk Editor Tool', 'woocommerce-custom-price-label' ) . '</h1>';
		$html .= '<form method="post" action="' . $_SERVER['REQUEST_URI'] . '">';
		$table_data = array();
		$table_header = array( __( 'ID', 'woocommerce-custom-price-label' ), __( 'Title', 'woocommerce-custom-price-label' ) );
		foreach ( WCCPL()->custom_tab_sections as $custom_tab_section => $custom_tab_section_title ) {
			$table_header[] = '';
			if ( '' === apply_filters( 'alg_wccpl_get_option', '' ) ) {
				$custom_tab_section_title .= ( '' != $custom_tab_section && '_before' != $custom_tab_section ) ? '<br><span style="font-size:x-small;">' . wccpl_get_pro_message() . '</span>' : '';
			}
			$table_header[] = $custom_tab_section_title;
		}
		$table_data[] = $table_header;
		foreach ( $products as $product_id => $product_title ) {
			$table_row = array( $product_id, $product_title );
			foreach ( WCCPL()->custom_tab_sections as $custom_tab_section => $custom_tab_section_title ) {
				$input_text = '';
				$input_checkbox = '';
				if ( '' === apply_filters( 'alg_wccpl_get_option', '' ) ) {
					$readonly_if_no_plus = ( '' != $custom_tab_section && '_before' != $custom_tab_section ) ? 'readonly' : '';
				} else {
					$readonly_if_no_plus = '';
				}
				if ( '' === apply_filters( 'alg_wccpl_get_option', '' ) ) {
					$disabled_if_no_plus = ( '' != $custom_tab_section && '_before' != $custom_tab_section ) ? 'disabled' : '';
				} else {
					$disabled_if_no_plus = '';
				}
				foreach ( WCCPL()->custom_tab_section_variations as $custom_tab_section_variation => $custom_tab_section_variation_title ) {
					if ( '_text' === $custom_tab_section_variation || '' === $custom_tab_section_variation ) {
						$option_name = WCCPL()->custom_tab_group_name . $custom_tab_section . $custom_tab_section_variation;
						if ( '_text' === $custom_tab_section_variation ) {
//							$input_text = '<input type="text" name="' . $option_name . '_' . $product_id . '" value="' . get_post_meta( $product_id, '_' . $option_name, true ) . '">';
							$input_text = '<textarea name="' . $option_name . '_' . $product_id . '" ' . $readonly_if_no_plus . '>' . get_post_meta( $product_id, '_' . $option_name, true ) . '</textarea>';
						} else {
							$value = get_post_meta( $product_id, '_' . $option_name, true );
							$value = ( 'on' === $value || 'yes' === $value ) ? 1 : 0;
							$input_checkbox = '<input type="checkbox" name="' . $option_name . '_' . $product_id . '" ' . checked( $value, 1, false ) . ' ' . $disabled_if_no_plus . '>';
//							$input_checkbox .= get_post_meta( $product_id, '_' . $option_name, true );
						}
					}
				}
				$table_row[] = $input_checkbox;
				$table_row[] = $input_text;
			}
			$table_data[] = $table_row;
		}
		$html .= $products_table = $this->get_table_html( $table_data, array( 'table_class' => 'widefat striped', 'columns_styles' => array( 'width:5%;', 'width:15%;', 'width:5%;text-align:right;', 'width:15%;', 'width:5%;text-align:right;', 'width:15%;', 'width:5%;text-align:right;', 'width:15%;', 'width:5%;text-align:right;', 'width:15%;', ) ) );
		$html .= '<p><input type="submit" class="button button-primary button-large" name="alg_custom_price_label_bulk_editor_submit" value="' . __( 'Save Price Labels', 'woocommerce-custom-price-label' ) . '"></p>';
		$html .= '</form>';
		$global_settings_url = admin_url( 'admin.php?page=wc-settings&tab=custom_price_label' );
		$html .= '<p>' . __( 'Global price labels can be set in', 'woocommerce-custom-price-label' ) . ' ' . '<a href="' . $global_settings_url . '">' . __( 'WooCommerce > Settings > Custom Price Label', 'woocommerce-custom-price-label' ) . '</a>' . '</p>';
		echo $html;
	}
}

endif;

return new WC_Custom_Price_Label_Bulk_Editor();
