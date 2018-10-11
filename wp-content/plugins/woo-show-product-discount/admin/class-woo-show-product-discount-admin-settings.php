<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Woo_Show_Product_Discount_Admin_Settings' ) ) :

/**
 * @class Woo_Show_Product_Discount_Admin_Settings
 * @version	1.0.0
 */
class Woo_Show_Product_Discount_Admin_Settings {
	
	/**
	 * The single instance of the class.
	 *
	 * @var Woo_Show_Product_Discount_Admin_Settings
	 * @since 1.0.0
	 */
	protected static $_instance = null;
	protected $_settings = array();

	
	/**
	 * Main Woo_Show_Product_Discount_Admin_Settings Instance.
	 *
	 * Ensures only one instance of Woo_Show_Product_Discount_Admin_Settings is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Woo_Show_Product_Discount_Admin_Settings()
	 * @return Woo_Show_Product_Discount_Admin_Settings - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	
	/**
	 * Woo_Show_Product_Discount_Admin_Settings Constructor.
	 */
	public function __construct() {
		$this->set_setting_array();
		$this->init_hooks();
	}

	function set_setting_array() {
		 
		$this->_settings = apply_filters( 'woocommerce_products_wspd_settings', array(
				
				/**
				 * Render Setting For Percentage Discount On Shop Page.
				 */
				'wspd_settings_discount_percentage_on_shop_start'	=> array(
					'title'		=> __( 'Show Discount Percentage (%) On Shop Page', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type' 		=> 'title',
					'desc'		=> __( 'Allows to show percentage discount on shop page. You are also free to customize the text. Enter shortcode : {{*wspd_%_discount}} to render percentage discount.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id' 		=> 'wspd_settings_discount_percentage_on_shop_start'
				),

				'wspd_settings_enable_discount_percentage_on_shop'	=> array(
					'title'   => __( 'Show Discount Percentage', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to show discount percentage on shop page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_on_shop',
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_text_on_shop'	=> array(
					'title'       => __( 'Discount Percentage Text', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'Text that will appear on shop page to show discount percentage. You can customize the text as per your need. Enter shortcode : {{*wspd_%_discount}} to render discount percentage.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_text_on_shop',
					'default'     => __( 'Discount : {{*wspd_%_discount}}', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
				),

				'wspd_settings_discount_percentage_position_on_shop'	=>	array(
					'title'    => __( 'Discount Percentage Text Position', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'     => __( 'This controls the position of discount percentage text on shop page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'       => 'wspd_settings_discount_percentage_position_on_shop',
					'default'  => 'discount_percentage_position_after_price',
					'type'     => 'radio',
					'options'  => array(
						'discount_percentage_position_after_price' => __( 'Display Discount Percentage After Price', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
						'discount_percentage_position_before_price' => __( 'Display Discount Percentage Before Price', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					),
					'desc_tip' =>  true,
					'autoload' => false
				),

				'wspd_settings_enable_discount_percentage_color_on_shop'	=> array(
					'title'   => __( 'Set Discount Percentage Text Color', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to set custom color for discount percentage text on shop page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_color_on_shop',
					'class'	  => 'wspd_settings_enable_color_picker',	
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_color_on_shop'		=> array (
					'title'       => __( 'Discount Percentage Text Color', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc' => __( 'Discount will appear in the selected color on shop page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'		=> 'wspd_settings_discount_percentage_color_on_shop',
					'default'     => '#dd0d0d',
					'class'		=> 'wspd_settings_color_picker',
					'css'		=> 'width:80px;',
					'type'		=> 'text',
					'desc_tip'		=> true 
				),

				'wspd_settings_discount_percentage_on_shop_end'	=> array(
					'type' 	=> 'sectionend',
					'id' 	=> 'wspd_settings_discount_percentage_on_shop_end',
				),

				/**
				 * Render Setting For Percentage Discount On Product Page.
				 */
				'wspd_settings_discount_percentage_on_product_start'	=> array(
					'title'		=> __( 'Show Discount Percentage (%) On Product Page', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type' 		=> 'title',
					'desc'		=> __( 'Allows to show percentage discount on product page. You are also free to customize the text. Enter shortcode : {{*wspd_%_discount}} to render percentage discount.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id' 		=> 'wspd_settings_discount_percentage_on_product_start'
				),

				'wspd_settings_enable_discount_percentage_on_product'	=> array(
					'title'   => __( 'Show Discount Percentage', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to show discount percentage on product page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_on_product',
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_text_on_product'	=> array(
					'title'       => __( 'Discount Percentage Text', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'Text that will appear on product page to show discount percentage. You can customize the text as per your need. Enter shortcode : {{*wspd_%_discount}} to render discount percentage.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_text_on_product',
					'default'     => __( '{{*wspd_%_discount}} Off', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
				),

				'wspd_settings_discount_percentage_position_on_product'	=>	array(
					'title'    => __( 'Discount Percentage Text Position', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'     => __( 'This controls the position of discount percentage text on product page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'       => 'wspd_settings_discount_percentage_position_on_product',
					'default'  => 'discount_percentage_position_after_price',
					'type'     => 'radio',
					'options'  => array(
						'discount_percentage_position_after_price' => __( 'Display Discount Percentage After Price', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
						'discount_percentage_position_before_price' => __( 'Display Discount Percentage Before Price', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					),
					'desc_tip' =>  true,
					'autoload' => false
				),

				'wspd_settings_enable_discount_percentage_color_on_product'	=> array(
					'title'   => __( 'Set Discount Percentage Text Color', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to set custom color for discount percentage text on product page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_color_on_product',
					'class'	  => 'wspd_settings_enable_color_picker',	
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_color_on_product'		=> array (
					'title'       => __( 'Color For Description', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc' => __( 'Discount will appear in the selected color on product page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'		=> 'wspd_settings_discount_percentage_color_on_product',
					'default'     => '#dd0d0d',
					'class'		=> 'wspd_settings_color_picker',
					'css'		=> 'width:80px;',
					'type'		=> 'text',
					'desc_tip'		=> true 
				),

				'wspd_settings_discount_percentage_on_product_end'	=> array(
					'type' 	=> 'sectionend',
					'id' 	=> 'wspd_settings_discount_percentage_on_product_end',
				),

				/**
				 * Render Setting For Percentage Discount On Flash Sale section.
				 */
				'wspd_settings_discount_percentage_on_sale_flash_start'	=> array(
					'title'		=> __( 'Show Discount Percentage (%) On Sale Flash Section', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type' 		=> 'title',
					'desc'		=> __( 'Allows to show percentage discount on sale flash section. You are also free to customize the text. Enter shortcode : {{*wspd_%_discount}} to render percentage discount.<br/><strong>Note : </strong> This section will work only if your current theme follows the filter provided by WooCommerce in woocommerce >> template >> sale-flash.php ', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id' 		=> 'wspd_settings_discount_percentage_on_sale_flash_start'
				),

				'wspd_settings_enable_discount_percentage_on_sale_flash'	=> array(
					'title'   => __( 'Show Discount Percentage', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to show discount percentage on sale flash section.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_on_sale_flash',
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_text_on_sale_flash'	=> array(
					'title'       => __( 'Discount Percentage Text', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'Text that will appear on sale flash section to show discount percentage. You can customize the text as per your need. Enter shortcode : {{*wspd_%_discount}} to render discount percentage.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_text_on_sale_flash',
					'default'     => __( '{{*wspd_%_discount}}', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
				),

				'wspd_settings_enable_discount_percentage_color_on_sale_flash'	=> array(
					'title'   => __( 'Set Discount Percentage Text Color', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc'    => __( 'Enable this option to set custom color for discount percentage text on on sale flash section.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_enable_discount_percentage_color_on_sale_flash',
					'class'	  => 'wspd_settings_enable_color_picker',	
					'default' => 'no',
					'type'    => 'checkbox'
				),

				'wspd_settings_discount_percentage_color_on_sale_flash'		=> array (
					'title'       => __( 'Color For Description', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc' => __( 'Discount will appear in the selected color on sale flash section.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'		=> 'wspd_settings_discount_percentage_color_on_sale_flash',
					'default'     => '#dd0d0d',
					'class'		=> 'wspd_settings_color_picker',
					'css'		=> 'width:80px;',
					'type'		=> 'text',
					'desc_tip'		=> true 
				),

				'wspd_settings_discount_percentage_on_sale_flash_end'	=> array(
					'type' 	=> 'sectionend',
					'id' 	=> 'wspd_settings_discount_percentage_on_sale_flash_end',
				),

				/**
				 * Render Setting For Developer Mode.
				 */
				'wspd_settings_discount_percentage_dev_mode_start'	=> array(
					'title'		=> __( 'Developer Mode Settings', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type' 		=> 'title',
					'desc'		=> __( 'Allows to support various theme by rendering custom css when required.<br/><strong>Note : </strong> In case you think there is some css issue, please contact plugin author to use this setting in the best way possible. Otherwise it is meant to be left blank.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id' 		=> 'wspd_settings_discount_percentage_dev_mode_start'
				),

				'wspd_settings_discount_percentage_css_on_shop'	=> array(
					'title'       => __( 'Custom CSS For Shop Page To Support Various Themes', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'CSS that will be used to resolve issue on shop page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_css_on_shop',
					'default'     => __( '', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
					'custom_attributes'		=> array(
						'rows' => '10',
						),
				),

				'wspd_settings_discount_percentage_css_on_product'	=> array(
					'title'       => __( 'Custom CSS For Product Page To Support Various Themes', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'CSS that will be used to resolve issue on product page.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_css_on_product',
					'default'     => __( '', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
					'custom_attributes'		=> array(
						'rows' => '10',
						),
				),

				'wspd_settings_discount_percentage_css_on_sale_flash'	=> array(
					'title'       => __( 'Custom CSS For Sale Flash Section To Support Various Themes', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'type'        => 'textarea',
					'desc' => __( 'CSS that will be used to resolve issue on sale flash section.', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'id'      => 'wspd_settings_discount_percentage_css_on_sale_flash',
					'default'     => __( '', STS_Woo_Show_Product_Discount_TEXT_DOMAIN ),
					'desc_tip'    => true,
					'class'		=> 'input-text wide-input',
					'custom_attributes'		=> array(
						'rows' => '10',
						),
				),

				'wspd_settings_discount_percentage_dev_mode_end'	=> array(
					'type' 	=> 'sectionend',
					'id' 	=> 'wspd_settings_discount_percentage_dev_mode_end',
				),
				
			));
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0.0
	 */
	private function init_hooks() {
		/**
		 * Enqueue Scripts And Styles On Admin Settings Page.
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
		
		/**
		 * Making Section And Render Setting Under WooCommerce>>Settings>>Products.
		 */
		add_action( 'woocommerce_get_sections_products', array( $this, 'add_section_to_woocommerce_products_sections' ), 5 );
		add_filter( 'woocommerce_get_settings_products', array( $this, 'woocommerce_get_settings_products_for_wspd_settings' ), 5, 2 );
		
		/**
		 * Adding Options To Delete On Deactivation.
		 */
		add_filter( 'woo_show_product_discount_alter_options_to_delete', array( $this, 'woo_show_product_discount_alter_options_to_delete' ), 5, 1 );
		
	}

	function enqueue_scripts() {
		$screen = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		if( $screen_id == 'woocommerce_page_wc-settings' && isset($_GET['section']) && $_GET['section'] == 'wspd_settings' ) {
			wp_register_script( 'wspd_admin_settings_script', STS_Woo_Show_Product_Discount_PLUGIN_DIR_URL.'/assets/js/wspd-admin-settings.js', array( 'jquery', 'wp-color-picker' ), STS_Woo_Show_Product_Discount_VERSION, true );
			wp_localize_script( 'wspd_admin_settings_script', 'wspd_admin_settings_params', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
				) );
			wp_enqueue_script( 'wspd_admin_settings_script' );

			wp_register_style( 'wspd_admin_settings_style', STS_Woo_Show_Product_Discount_PLUGIN_DIR_URL.'/assets/css/wspd-admin-settings.css', array(), STS_Woo_Show_Product_Discount_VERSION );
			wp_enqueue_style( 'wspd_admin_settings_style' );
		}
	}

	function add_section_to_woocommerce_products_sections( $sections ) {
		$sections['wspd_settings'] = __( 'Show Product Discount', STS_Woo_Show_Product_Discount_TEXT_DOMAIN );
		return $sections;
	}

	function woocommerce_get_settings_products_for_wspd_settings( $settings, $current_section ) {
		if( $current_section == 'wspd_settings' ) {
			$settings = $this->_settings;
		}
		return $settings;
	}

	function woo_show_product_discount_alter_options_to_delete( $options_to_delete ) {
		$settings = $this->_settings;
		$settings_keys = array_keys($settings);
		$options_to_delete = array_merge( $options_to_delete, $settings_keys );
		return $options_to_delete;
	}

}

endif;

/**
 * Main instance of Woo_Show_Product_Discount_Admin_Settings.
 * @since  1.0.0
 * @return Woo_Show_Product_Discount_Admin_Settings
 */
Woo_Show_Product_Discount_Admin_Settings::instance();
?>