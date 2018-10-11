<?php
/**
 * @package STS_Woo_Show_Product_Discount_Manager
 * @category Core
 * @author SimplerThanSimplest
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'STS_Woo_Show_Product_Discount_Manager' ) ) :

/**
 * Main STS_Woo_Show_Product_Discount_Manager Class.
 *
 * @class STS_Woo_Show_Product_Discount_Manager
 * @version	1.0.0
 */
class STS_Woo_Show_Product_Discount_Manager {

	/**
	 * STS_Woo_Show_Product_Discount_Manager version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * The single instance of the class.
	 *
	 * @var STS_Woo_Show_Product_Discount_Manager
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	
	/**
	 * Main STS_Woo_Show_Product_Discount_Manager Instance.
	 *
	 * Ensures only one instance of STS_Woo_Show_Product_Discount_Manager is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see INSTANTIATE_STS_Woo_Show_Product_Discount_Manager()
	 * @return STS_Woo_Show_Product_Discount_Manager - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function calculate_product_discount( $product_id, $variation_id = 0, $need_max = true ) {
		$discount_percentage = 0;
		$product = wc_get_product( $product_id );
		if( !$product ) {
			return $discount_percentage;
		}
		if( $product->is_on_sale() ) {
			if( $product->product_type == 'variable' ) {
				if( $variation_id ) {
					$variable_product = new WC_Product_Variation( $variation_id );
					if( $variable_product->is_on_sale() ) {
						$regular_price = $variable_product ->regular_price;
						$sales_price = $variable_product ->sale_price;
						$discount_percentage = round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
					}
				}
				else {
					$available_variations = $product->get_available_variations();
					$discount_percentage_array = array();
					for ( $i = 0; $i < count( $available_variations ); ++$i ) {
						$variation_id = $available_variations[$i]['variation_id'];
						$variable_product = new WC_Product_Variation( $variation_id );
						if( $variable_product->is_on_sale() ) {
							$regular_price = $variable_product ->regular_price;
							$sales_price = $variable_product ->sale_price;
							$percentage = round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
							$discount_percentage_array[] = $percentage;
							if ( $percentage > $discount_percentage ) {
								$discount_percentage = $percentage;
							}
						}
					}

					$discount_percentage_array = array_unique( $discount_percentage_array );
					asort( $discount_percentage_array );
					if( count( $discount_percentage_array ) == 1 ) {
						$discount_percentage = $discount_percentage_array[0];
					}
					else if( count( $discount_percentage_array ) > 1 ) {
						$first_discount_percentage = intval( $discount_percentage_array[0] );
						$last_discount_percentage = intval( $discount_percentage_array[count($discount_percentage_array)-1] );
						if( $first_discount_percentage < $last_discount_percentage ) {
							$discount_percentage = $first_discount_percentage. ' - '. $last_discount_percentage;
						}
						else {
							$discount_percentage = $last_discount_percentage. ' - '. $first_discount_percentage;
						}
					}
				}
			}
			else {
				$discount_percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
			}

			$discount_percentage = apply_filters( '', $discount_percentage, $product_id, $variation_id );
			if( $discount_percentage ) {
				$discount_percentage .= '%';
			}
			return $discount_percentage;
			
		}
		
	}
	
}

/**
 * Main instance of STS_Woo_Show_Product_Discount_Manager.
 * @since  1.0.0
 * @return STS_Woo_Show_Product_Discount_Manager
 */
global $sts_woo_show_product_discount_manager;
$sts_woo_show_product_discount_manager = STS_Woo_Show_Product_Discount_Manager::instance();

endif;
?>