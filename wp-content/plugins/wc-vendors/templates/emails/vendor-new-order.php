<?php
/**
 * Vendor new order email
 *
 * @author WC Vendors
 * @package WooCommerce/Templates/Emails/HTML
 * @version 1.9.9
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$billing_first_name = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_first_name : $order->get_billing_first_name(); 
$billing_last_name  = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_last_name : $order->get_billing_last_name(); 
$billing_email    = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_email : $order->get_billing_email(); 
$billing_phone    = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_phone : $order->get_billing_phone(); 
$order_date     = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->order_date : $order->get_date_created();  

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( 'You have received an order from %s.', 'wcvendors' ), $billing_first_name . ' ' . $billing_last_name ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order, true ); ?>

<h2><?php printf( __( 'Order: %s', 'wcvendors'), $order->get_order_number() ); ?> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order_date ) ), date_i18n( wc_date_format(), strtotime( $order_date ) ) ); ?>)</h2>


<h2><a href="<?php echo esc_url(home_url('/')); ?>dashboard/order/#open-order-details-modal-<?php echo $order->get_order_number(); ?>" >Click here to view your Order.</a></h2>
<p></p>
<p>Thanks You.</p>



<?php do_action( 'woocommerce_email_footer' ); ?>