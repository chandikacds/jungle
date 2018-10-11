<?php
/**
 * Plugin Name: Woo Show Product Discount
 * Plugin URI: http://simplerthansimplest.com/
 * Description: WooCommerce extension to show product discount on shop page as well as on product page. Most importantly provides lots of customization options to give it your unique touch.
 * Version: 1.0.4
 * Author: SimplerThanSimplest
 * Author URI: http://simplerthansimplest.com/
 * Requires at least: 4.0
 * Tested up to: 4.7.2
 *
 * Text Domain: woo-show-product-discount
 * Domain Path: /i18n/languages/
 *
 * @package STS_Woo_Show_Product_Discount
 * @category Core
 * @author SimplerThanSimplest
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'STS_Woo_Show_Product_Discount' ) ) :

/**
 * Main STS_Woo_Show_Product_Discount Class.
 *
 * @class STS_Woo_Show_Product_Discount
 * @version	1.0.1
 */
class STS_Woo_Show_Product_Discount {

	/**
	 * STS_Woo_Show_Product_Discount version.
	 *
	 * @var string
	 */
	public $version = '1.0.1';
	public $sts_site_url = 'http://simplerthansimplest.com/';

	/**
	 * The single instance of the class.
	 *
	 * @var STS_Woo_Show_Product_Discount
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	
	/**
	 * Main STS_Woo_Show_Product_Discount Instance.
	 *
	 * Ensures only one instance of STS_Woo_Show_Product_Discount is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see INSTANTIATE_STS_Woo_Show_Product_Discount()
	 * @return STS_Woo_Show_Product_Discount - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	
	/**
	 * STS_Woo_Show_Product_Discount Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0.0
	 */
	private function init_hooks() {
		add_filter( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_filter( 'plugin_action_links_'.STS_Woo_Show_Product_Discount_PLUGIN_BASENAME, array( $this, 'alter_plugin_action_links' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 5 );
		
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	function admin_footer_text( $footer_text ) {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		$screen = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		if( $screen_id == 'woocommerce_page_wc-settings' && isset($_GET['section']) && $_GET['section'] == 'wspd_settings' ) {
			$footer_text = 'Thanks for using <b>Woo Show Product Discount</b>.';
			$footer_text .= '<br/>';
			$footer_text .= '<a href="'.$this->sts_site_url.'" target="_blank"><strong>Build And Customize More With Us</strong></a>';
		}
		return $footer_text;
	}

	/**
	 * Adding setting link on plugin listing page.
	 */
	function alter_plugin_action_links( $plugin_links ) {
		$settings_link = '<a href="admin.php?page=wc-settings&tab=products&section=wspd_settings">Settings</a>';
		array_unshift( $plugin_links, $settings_link );
		return $plugin_links;
	}
	
	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		include_once( 'global/class-woo-show-product-discount-manager.php' );
		include_once( 'admin/class-woo-show-product-discount-admin-settings.php' );
		include_once( 'frontend/class-woo-show-product-discount-frontend-manager.php' );
		
	}

	/**
	 * Define STS_Woo_Show_Product_Discount Constants.
	 */
	private function define_constants() {
		$this->define( 'STS_Woo_Show_Product_Discount_PLUGIN_FILE', __FILE__ );
		$this->define( 'STS_Woo_Show_Product_Discount_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'STS_Woo_Show_Product_Discount_VERSION', $this->version );
		$this->define( 'STS_Woo_Show_Product_Discount_TEXT_DOMAIN', 'woo-show-product-discount' );
		$this->define( 'STS_Woo_Show_Product_Discount_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'STS_Woo_Show_Product_Discount_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Load Localisation files.
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'WOO_LOGIN_TO_SEE_PRICE_AND_BUY_plugin_locale', get_locale(), STS_Woo_Show_Product_Discount_TEXT_DOMAIN );
		load_textdomain( STS_Woo_Show_Product_Discount_TEXT_DOMAIN, STS_Woo_Show_Product_Discount_PLUGIN_DIR_PATH .'language/'.STS_Woo_Show_Product_Discount_TEXT_DOMAIN.'-' . $locale . '.mo' );
		load_plugin_textdomain( STS_Woo_Show_Product_Discount_TEXT_DOMAIN, false, plugin_basename( dirname( __FILE__ ) ) . '/language' );
	}

}

endif;

/**
 * Main instance of STS_Woo_Show_Product_Discount.
 *
 * Returns the main instance of STS_Woo_Show_Product_Discount to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return STS_Woo_Show_Product_Discount
 */
function instantiate_STS_Woo_Show_Product_Discount() {
	return STS_Woo_Show_Product_Discount::instance();
}

// Global for backwards compatibility.
$GLOBALS['STS_Woo_Show_Product_Discount'] = instantiate_STS_Woo_Show_Product_Discount();
?>