<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Woo_Show_Product_Discount_Frontend_Manager' ) ) :

/**
 * @class Woo_Show_Product_Discount_Frontend_Manager
 * @version	1.0.0
 */
class Woo_Show_Product_Discount_Frontend_Manager {
	
	/**
	 * The single instance of the class.
	 *
	 * @var Woo_Show_Product_Discount_Frontend_Manager
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	
	/**
	 * Main Woo_Show_Product_Discount_Frontend_Manager Instance.
	 *
	 * Ensures only one instance of Woo_Show_Product_Discount_Frontend_Manager is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Woo_Show_Product_Discount_Frontend_Manager()
	 * @return Woo_Show_Product_Discount_Frontend_Manager - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	
	/**
	 * Woo_Show_Product_Discount_Frontend_Manager Constructor.
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0.0
	 */
	private function init_hooks() {
		
		/*
		* Shop Page Discount Display
		*/
		$wspd_settings_discount_percentage_position_on_shop = get_option( 'wspd_settings_discount_percentage_position_on_shop' );
		if( $wspd_settings_discount_percentage_position_on_shop == 'discount_percentage_position_before_price' ) {
			add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'render_discount_percentage_on_shop' ), 9 );
		}
		else {
			add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'render_discount_percentage_on_shop' ), 11 );
		}
		add_action( 'woocommerce_before_main_content', array( $this, 'render_shop_page_custom_css' ), 10 );

		/*
		* Sale Flash Section Discount Display
		*/
		add_filter( 'woocommerce_sale_flash', array( $this, 'render_discount_percentage_on_sale_flash' ), 10, 3 );

		/*
		* Product Single Page Discount Display
		*/
		$wspd_settings_discount_percentage_position_on_product = get_option( 'wspd_settings_discount_percentage_position_on_product' );
		if( $wspd_settings_discount_percentage_position_on_product == 'discount_percentage_position_before_price' ) {
			add_action( 'woocommerce_single_product_summary', array( $this, 'render_discount_percentage_on_product' ), 9 );
		}
		else {
			add_action( 'woocommerce_single_product_summary', array( $this, 'render_discount_percentage_on_product' ), 11 );
		}
		add_action( 'woocommerce_before_single_product', array( $this, 'render_product_page_custom_css' ), 10 );

		/*
		* Variation Specific Discount Display
		*/
		add_filter( 'woocommerce_available_variation', array( $this, 'discount_percentage_for_single_variation' ), 20, 3 );
		
	}

	function render_discount_percentage_on_shop() {
		$wspd_settings_enable_discount_percentage_on_shop = get_option( 'wspd_settings_enable_discount_percentage_on_shop' );
		if( $wspd_settings_enable_discount_percentage_on_shop == 'yes' ) {
			global $product, $sts_woo_show_product_discount_manager;
			$discount = $sts_woo_show_product_discount_manager->calculate_product_discount( $product->id );
			if( $discount ) {
				$inline_style = '';
				$wspd_settings_enable_discount_percentage_color_on_shop = get_option( 'wspd_settings_enable_discount_percentage_color_on_shop' );
				if( $wspd_settings_enable_discount_percentage_color_on_shop == 'yes' ) {
					$wspd_settings_discount_percentage_color_on_shop = get_option( 'wspd_settings_discount_percentage_color_on_shop' );
					$inline_style = 'style="color:'.$wspd_settings_discount_percentage_color_on_shop.';"';
				}
				$wspd_settings_discount_percentage_text_on_shop = get_option( 'wspd_settings_discount_percentage_text_on_shop' );
				$wspd_settings_discount_percentage_text_on_shop = str_replace( '{{*wspd_%_discount}}', $discount, $wspd_settings_discount_percentage_text_on_shop );
				echo '<span class="price wspd_shop_page" '.$inline_style.'>' . $wspd_settings_discount_percentage_text_on_shop . '</span>';
			}
		}
	}

	function render_shop_page_custom_css() {
		$wspd_settings_enable_discount_percentage_on_shop = get_option( 'wspd_settings_enable_discount_percentage_on_shop' );
		if( $wspd_settings_enable_discount_percentage_on_shop == 'yes' ) {
			$wspd_settings_discount_percentage_css_on_shop = get_option( 'wspd_settings_discount_percentage_css_on_shop' );
			$wspd_settings_discount_percentage_css_on_sale_flash = get_option( 'wspd_settings_discount_percentage_css_on_sale_flash' );
			if( !empty( $wspd_settings_discount_percentage_css_on_shop ) ) {
				echo '<style>';
				echo $wspd_settings_discount_percentage_css_on_shop;
				echo $wspd_settings_discount_percentage_css_on_sale_flash;
				echo '</style>';
			}
		}
	}

	function render_discount_percentage_on_sale_flash( $sale_html, $post, $product ) {
		$wspd_settings_enable_discount_percentage_on_sale_flash = get_option( 'wspd_settings_enable_discount_percentage_on_sale_flash' );
		if( $wspd_settings_enable_discount_percentage_on_sale_flash == 'yes' ) {
			global $sts_woo_show_product_discount_manager;
			$discount = $sts_woo_show_product_discount_manager->calculate_product_discount( $product->id );
			if( $discount ) {
				$wspd_settings_discount_percentage_text_on_sale_flash = get_option( 'wspd_settings_discount_percentage_text_on_sale_flash' );
				$wspd_settings_discount_percentage_text_on_sale_flash = str_replace( '{{*wspd_%_discount}}', $discount, $wspd_settings_discount_percentage_text_on_sale_flash );
				echo '<span class="onsale wspd_sale_flash">' . $wspd_settings_discount_percentage_text_on_sale_flash . '</span>';
			}
		}
		else {
			return $sale_html;
		}
	}

	function render_discount_percentage_on_product() {
		$wspd_settings_enable_discount_percentage_on_product = get_option( 'wspd_settings_enable_discount_percentage_on_product' );
		if( $wspd_settings_enable_discount_percentage_on_product == 'yes' ) {
			global $product, $sts_woo_show_product_discount_manager;
			$discount = $sts_woo_show_product_discount_manager->calculate_product_discount( $product->id );
			if( $discount ) {
				$wspd_settings_discount_percentage_text_on_product = get_option( 'wspd_settings_discount_percentage_text_on_product' );
				$wspd_settings_discount_percentage_text_on_product = str_replace( '{{*wspd_%_discount}}', $discount, $wspd_settings_discount_percentage_text_on_product );
				echo '<span class="price wspd_product_page">' . $wspd_settings_discount_percentage_text_on_product . '</span>';
			}
		}
	}

	function render_product_page_custom_css() {
		$wspd_settings_enable_discount_percentage_on_product = get_option( 'wspd_settings_enable_discount_percentage_on_product' );
		if( $wspd_settings_enable_discount_percentage_on_product == 'yes' ) {
			$wspd_settings_discount_percentage_css_on_product = get_option( 'wspd_settings_discount_percentage_css_on_product' );
			$wspd_settings_discount_percentage_css_on_sale_flash = get_option( 'wspd_settings_discount_percentage_css_on_sale_flash' );
			if( !empty( $wspd_settings_discount_percentage_css_on_product ) ) {
				echo '<style>';
				echo $wspd_settings_discount_percentage_css_on_product;
				echo $wspd_settings_discount_percentage_css_on_sale_flash;
				echo '</style>';
			}
		}
	}

	function discount_percentage_for_single_variation( $variation_config_array , $product, $variation ) {
		$wspd_settings_enable_discount_percentage_on_product = get_option( 'wspd_settings_enable_discount_percentage_on_product' );
		if( $wspd_settings_enable_discount_percentage_on_product == 'yes' ) {
			global $product, $sts_woo_show_product_discount_manager;
			$discount = $sts_woo_show_product_discount_manager->calculate_product_discount( $product->id, $variation->variation_id );
			if( $discount ) {
				$wspd_settings_discount_percentage_text_on_product = get_option( 'wspd_settings_discount_percentage_text_on_product' );
				$wspd_settings_discount_percentage_text_on_product = str_replace( '{{*wspd_%_discount}}', $discount, $wspd_settings_discount_percentage_text_on_product );
				$product_discount_html = '<span class="price">' . $wspd_settings_discount_percentage_text_on_product . '</span>';
				$variation_config_array['price_html'] = $variation_config_array['price_html'].'<div class="clear"></div>'.$product_discount_html;
			}
		}
		return $variation_config_array;
	}

}

endif;

/**
 * Main instance of Woo_Show_Product_Discount_Frontend_Manager.
 * @since  1.0.0
 * @return Woo_Show_Product_Discount_Frontend_Manager
 */
Woo_Show_Product_Discount_Frontend_Manager::instance();
?>