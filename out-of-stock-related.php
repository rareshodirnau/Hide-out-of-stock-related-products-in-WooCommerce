<?php
/*
Plugin Name:  Hide out of stock related products in WooCommerce
Description:  Hide out of stock related products in WooCommerce 
Version:      1.0
Author:       Rares Hodirnau
Author URI:   https://github.com/rareshodirnau/Hide-out-of-stock-related-products-in-WooCommerce.git
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Plugin URL.
define( 'OUT_OF_STOCK_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
// Plugin path.
define( 'OUT_OF_STOCK', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class OutofStock{
    
    public function __construct(){
        add_filter( 'woocommerce_related_products', array($this, 'wcd_filter_related_products'));
    }

    public function wcd_filter_related_products( $related_product_ids ) {

        foreach( $related_product_ids as $key => $value ) {
            $relatedProduct = wc_get_product( $value );
            if( ! $relatedProduct->is_in_stock() ) {
                unset( $related_product_ids["$key"] );
            }
        }
    
        return $related_product_ids;
    }
}

new OutofStock;