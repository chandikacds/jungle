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
$billing_last_name 	= ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_last_name : $order->get_billing_last_name(); 
$billing_email 		= ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_email : $order->get_billing_email(); 
$billing_phone 		= ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->billing_phone : $order->get_billing_phone(); 
$order_date 		= ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $order->order_date : $order->get_date_created();  

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( 'You have received an order from %s. Their order is as follows:', 'wcvendors' ), $billing_first_name . ' ' . $billing_last_name ); ?></p>

<?php do_action( 'woocommerce_email_before_order_table', $order, true ); ?>

<h2><?php printf( __( 'Order: %s', 'wcvendors'), $order->get_order_number() ); ?> (<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order_date ) ), date_i18n( wc_date_format(), strtotime( $order_date ) ) ); ?>)</h2>

<?php

        
        $_order = new WC_Order( $order->get_order_number() );
   		$line_items = $_order->get_items();
       
      
  


?>

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
                <thead>
                  <tr>
                    <th colspan="2" scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Item', 'wcvendors-pro' ); ?></th>
                     <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php //_e( 'Jungle.lk Commission', 'wcvendors-pro' ); ?></th> 
                    <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Cost', 'wcvendors-pro' ); ?></th>
                    <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Qty', 'wcvendors-pro' ); ?></th>
                    <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Total', 'wcvendors-pro' ); ?></th>

                    <?php
                    if ( ! empty( $order_taxes ) ) :
                      foreach ( $order_taxes as $tax_id => $tax_item ) :
                        $tax_class      = wc_get_tax_class_by_tax_id( $tax_item['rate_id'] );
                        $tax_class_name = isset( $classes_options[ $tax_class ] ) ? $classes_options[ $tax_class ] : __( 'Tax', 'wcvendors-pro' );
                        $column_label   = ! empty( $tax_item['label'] ) ? $tax_item['label'] : __( 'Tax', 'wcvendors-pro' );
                        ?>
                          <th class="line_tax tips" data-tip="<?php
                              echo esc_attr( $tax_item['name'] . ' (' . $tax_class_name . ')' );
                            ?>">
                            <?php echo esc_attr( $column_label ); ?>
                            <input type="hidden" class="order-tax-id" name="order_taxes[<?php echo $tax_id; ?>]" value="<?php echo esc_attr( $tax_item['rate_id'] ); ?>">
                            <a class="delete-order-tax" href="#" data-rate_id="<?php echo $tax_id; ?>"></a>
                          </th>
                        <?php
                      endforeach;
                    endif;
                  ?>
                  </tr>
                </thead>

                  <tbody id="order_line_items">
                  <?php

                    foreach ( $line_items as $item_id => $item ) {

                      $product_id     = !empty( $item['variation_id'] ) ? $item['variation_id'] : $item['product_id'];
                      // Check if this is a variation and get the parent id, this ensures that the correct vendor id is retrieved 
                      if ( get_post_type( $product_id ) === 'product_variation' ) { 
                        $product_id = get_post_field( 'post_parent', $product_id );
                      }

                      $_product       = $order->get_product_from_item( $item );
                      $item_qty       = ( version_compare( WC_VERSION, '2.7', '<' ) ) ? $item->qty : $item->get_quantity(); 
                      $product_commision  = ( $item_qty > 1 ) ? $_order->product_commissions[ $product_id ] / $item_qty : $_order->product_commissions[ $product_id ]; 

                      ?>
                      <tr class="item-id-<?php echo $item_id; ?>">
                        <td class="wcv-order-thumb">
                          <?php if ( $_product ) : ?>
                            <?php echo $_product->get_image( 'shop_thumbnail', array( 'title' => '' ) ); ?>
                          <?php else : ?>
                            <?php echo wc_placeholder_img( 'shop_thumbnail' ); ?>
                          <?php endif; ?>
                        </td>
                        <td class="name">

                          <?php echo ( $_product && $_product->get_sku() ) ? esc_html( $_product->get_sku() ) . ' &ndash; ' : ''; ?>
                          <?php  echo esc_html( $item['name'] ); ?>
                          <br>
                          <?php $productId = $item['product_id']; 
                          echo oderMetaDesc($productId); ?>

                      <?php
                        $list_branch = action_display_branches( $order->get_order_number(), $productId );
                          if(isset($list_branch)){
                            echo $list_branch; 
                        }
                      ?>
                          
                          
                          <div class="view">
                            <?php
                              if ( ! empty( $item[ 'item_meta_array' ] ) ) { 
                                foreach ( $item[ 'item_meta_array' ] as $meta ) {
                                  // Skip hidden core fields
                                  if ( in_array( $meta->key, apply_filters( 'woocommerce_hidden_order_itemmeta', array(
                                    '_qty',
                                    '_tax_class',
                                    '_product_id',
                                    '_variation_id',
                                    '_line_subtotal',
                                    '_line_subtotal_tax',
                                    '_line_total',
                                    '_line_tax',
                                    'method_id', 
                                    'cost', 
                                    '_commission_total', 
                                    'is_wpsls_software', 
                                    '_is_wpsls_software', 
                                    'License Key', 
                                    WC_Vendors::$pv_options->get_option( 'sold_by_label' ), 
                                  ) ) ) ) {
                                    continue;
                                  }

                                  // Skip serialised meta
                                  if ( is_serialized( $meta->value ) ) {
                                    continue;
                                  }

                                  // Get attribute data
                                  if ( taxonomy_exists( wc_sanitize_taxonomy_name( $meta->key ) ) ) {
                                    $term           = get_term_by( 'slug', $meta->value, wc_sanitize_taxonomy_name( $meta->key ) );
                                    $meta->key    = wc_attribute_label( wc_sanitize_taxonomy_name( $meta->key ) );
                                    $meta->value  = isset( $term->name ) ? $term->name : $meta->value;
                                  } else {
                                    $meta->key    = apply_filters( 'woocommerce_attribute_label', wc_attribute_label( $meta->key, $_product ), $meta->key );
                                  }
                                  $metaKey = $meta->key;
                                  if($metaKey != '_tinvwl_wishlist_cart'){
                                    echo  '<strong>' . wp_kses_post( rawurldecode( $meta->key ) ) . '</strong> : ' . wp_kses_post( rawurldecode( $meta->value ) );
                                  }

                                  
                                }
                              }
                            ?>
                          </div>
                        </td>

                        <td class="item_cost" width="1%">
                          <div class="view">
                            <?php //echo wc_price( $product_commision, array( 'currency' => $order_currency ) ); ?>
                          </div>
                        </td> 

                        <td class="item_cost" width="1%">
                          <div class="view">
                            <?php
                              if ( isset( $item['line_total'] ) ) {
                                if ( isset( $item['line_subtotal'] ) && $item['line_subtotal'] != $item['line_total'] ) {
                                  echo '<del>' . wc_price( $order->get_item_subtotal( $item, false, true ), array( 'currency' => $order_currency ) ) . '</del> ';
                                }
                                echo wc_price( $order->get_item_total( $item, false, true ), array( 'currency' => $order_currency ) );
                              }
                            ?>
                          </div>
                        </td>

                        <td class="quantity" width="1%">
                          <div class="view">
                            <?php echo ( isset( $item['qty'] ) ) ? esc_html( $item['qty'] ) : '';  ?>
                          </div>
                        </td>

                        <td class="line_cost" width="1%" data-sort-value="<?php echo esc_attr( isset( $item['line_total'] ) ? $item['line_total'] : '' ); ?>">
                          <div class="view">
                            <?php
                              if ( isset( $item['line_total'] ) ) {
                                if ( isset( $item['line_subtotal'] ) && $item['line_subtotal'] != $item['line_total'] ) {
                                  echo '<del>' . wc_price( $item['line_subtotal'], array( 'currency' => $order_currency ) ) . '</del> ';
                                }
                                echo wc_price( $item['line_total'], array( 'currency' => $order_currency ) );
                              }
                            ?>
                          </div>

                        </td>

                        <?php
                          if ( wc_tax_enabled() ) :
                            $line_tax_data = isset( $item['line_tax_data'] ) ? $item['line_tax_data'] : '';
                            $tax_data      = maybe_unserialize( $line_tax_data );

                            foreach ( $order_taxes as $tax_item ) :
                              $tax_item_id       = $tax_item['rate_id'];
                              $tax_item_total    = isset( $tax_data['total'][ $tax_item_id ] ) ? $tax_data['total'][ $tax_item_id ] : '';
                              $tax_item_subtotal = isset( $tax_data['subtotal'][ $tax_item_id ] ) ? $tax_data['subtotal'][ $tax_item_id ] : '';

                              ?>
                                <td class="line_tax" width="1%">
                                  <div class="view">
                                    <?php
                                      if ( '' != $tax_item_total ) {
                                        if ( isset( $tax_item_subtotal ) && $tax_item_subtotal != $tax_item_total ) {
                                          echo '<del>' . wc_price( wc_round_tax_total( $tax_item_subtotal ), array( 'currency' => $order_currency ) ) . '</del> ';
                                        }

                                        echo wc_price( wc_round_tax_total( $tax_item_total ), array( 'currency' => $order_currency ) );
                                      } else {
                                        echo '&ndash;';
                                      }
                                    ?>
                                  </div>
                                </td>
                              <?php
                            endforeach;
                          endif;
                        ?>
                      </tr>
                  <?php  } ?>
                  </tbody>

                  <tbody class="wcv-order-totals">
                  <tr>
                    <td class="wcv-order-totals-label" colspan="5"><?php _e( 'Shipping', 'wcvendors-pro' ); ?>:</td>
                    <td class="total">
                      <?php global $wcdn; $order = new WC_Order($order->get_order_number());
                        //$order_shipping_total = $order->get_total_shipping(); 
                      $order_shipping_total = sellerShipingCost($order->get_order_number(), get_current_user_id());
                        echo wc_price( $order_shipping_total, array( 'currency' => $order_currency ) ); ?>
                    </td>
                  </tr>

                    <?php if ( wc_tax_enabled() ) : ?>
                      <?php foreach ( $order->get_tax_totals() as $code => $tax ) : ?>
                        <tr>
                          <td class="wcv-order-totals-label" colspan="5"><?php echo $tax->label; ?>:</td>
                          <td class="total"><?php echo wc_price( $_order->total_tax, array( 'currency' => $order_currency ) ); ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>

                    <!--<tr>
                      <td class="wcv-order-totals-label" colspan="5"><?php _e( 'Commission Total', 'wcvendors-pro' ); ?>:</td>
                      <td class="total"><div class="view"><?php echo wc_price( $_order->commission_total, array( 'currency' => $order_currency ) ); ?></div></td>
                    </tr> -->
                    <tr>
                      <td class="wcv-order-totals-label" colspan="5"><?php _e( 'Order Total', 'wcvendors-pro' ); ?>:</td>
                      <td class="total"><div class="view"><?php echo wc_price( $_order->total, array( 'currency' => $order_currency ) ); ?></div></td>
                    </tr>
                  
                    </tbody>
              </table>

<?php do_action('woocommerce_email_after_order_table', $order, true); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, true ); ?>

<h2><?php _e( 'Customer details', 'wcvendors' ); ?></h2>

<?php if ( $billing_email ) : ?>
	<p><strong><?php _e( 'Email:', 'wcvendors' ); ?></strong> <?php echo $billing_email; ?></p>
<?php endif; ?>
<?php if ( $billing_phone ) : ?>
	<p><strong><?php _e( 'Tel:', 'wcvendors' ); ?></strong> <?php echo $billing_phone; ?></p>
<?php endif; ?>

<?php wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>