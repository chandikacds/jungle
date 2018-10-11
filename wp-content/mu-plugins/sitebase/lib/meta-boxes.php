<?php
/*
Plugin Name: PDG Metaboxes
Description: Setup metaboxes for the site
*/
/********************* META BOX DEFINITIONS ***********************/



/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'rw_';

global $meta_boxes;

$meta_boxes = array();

//Home page meta boxes//////////////////////////////////////////////////////////////////////////////////
	
$slug = 'woo';
//Testimonial meta boxes

$brand_list = array();

$args = array( 'post_type' => 'woo_brands','orderby' => 'post_title','post_status' => array('publish'), 'order'=> 'ASC', 'posts_per_page' => -1 );
$allbrand = get_posts( $args );



foreach ($allbrand as $key => $post) {
 
    $post_id = $post->ID;
    $brand_list[$post_id]=$post->post_title;
    
}

    

$model_list = array();
$args = array( 'post_type' => 'woo_model','orderby' => 'post_title','post_status' => array('publish'), 'order'=> 'ASC', 'posts_per_page' => -1 );
$allmodel = get_posts( $args );



foreach ($allmodel as $key => $post) {
 
    $post_id = $post->ID;
    $model_list[$post_id]=$post->post_title;
    
}

   


$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'brand-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Product Brand and Model', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'product','page'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				  array(
						   'name'  => esc_html__( 'Select Brand:', 'rwmb' ),
						   'id'    => "wcv_custom_product_brand",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $brand_list,
												 

						),

				   array(
						   'name'  => esc_html__( 'Select Model:', 'rwmb' ),
						   'id'    => "wcv_custom_product_model_number",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $model_list,
												 

						),

					
					
					
));

$term_count_global = array();
add_action('init', 'my_get_woo_cats');
add_action('init', 'my_get_woo_cats2');
function my_get_woo_cats() {
  	global $term_count_global;
    $product_cats_parent = get_terms( array( 'taxonomy' => 'product_cat','hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0) );
   
   global $meta_boxes;


$cat_list = array();
foreach ($product_cats_parent as $key => $value) {
	
	$cat_list[$value->term_id] = $value->name;
}

$prefix = "rw_";
$slug = 'woo';
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'productbarnd-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Brand Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_brands'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Select category:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_productcatbrand",
						   'type'    => 'autocomplete',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $cat_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),

					array(
							'name' => esc_html__( 'Description', 'rwmb' ),
							'desc' => esc_html__( 'Description  for brand', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_brand_description",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),
					
					
					
					
					
));

  
  	
    
}

 
//woo_location

$sluglocation = "location";
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'location-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Location Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_location'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				     array(
							'name' => esc_html__( 'Country', 'rwmb' ),
							'desc' => esc_html__( 'Enter Country code', 'rwmb' ),
							'id'    => "{$prefix}{$sluglocation}_countrycode",
							'type' => 'text',
							
						),
				      array(
							'name' => esc_html__( 'Postcode', 'rwmb' ),
							'desc' => esc_html__( 'Enter Postcode', 'rwmb' ),
							'id'    => "{$prefix}{$sluglocation}_postcodee",
							'type' => 'text',
							'admin_columns' => 'after title',
						),
				       
				        array(
							'name' => esc_html__( 'State', 'rwmb' ),
							'desc' => esc_html__( 'Enter State', 'rwmb' ),
							'id'    => "{$prefix}{$sluglocation}_state",
							'type' => 'text'
						),
						 array(
							'name' => esc_html__( 'Latitude', 'rwmb' ),
							'desc' => esc_html__( 'Enter Latitude', 'rwmb' ),
							'id'    => "{$prefix}{$sluglocation}_latitude",
							'type' => 'text'
						),
						  array(
							'name' => esc_html__( 'Longitude', 'rwmb' ),
							'desc' => esc_html__( 'Enter Longitude', 'rwmb' ),
							'id'    => "{$prefix}{$sluglocation}_longitude",
							'type' => 'text'
						),
														
					
));



$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'productmodal-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Model Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_model'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Select brand:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_modelbrand",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $brand_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),

					array(
							'name' => esc_html__( 'Description', 'rwmb' ),
							'desc' => esc_html__( 'Description  for brand', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_model_description",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),
					
					
					
					
					
));

global $wpdb;
$role = 'vendor';
			$user_data = $wpdb->get_results("SELECT  u1.id AS ID, u1.user_nicename, m1.meta_value AS shop_name
FROM wp_users u1
JOIN wp_usermeta m1 ON (m1.user_id = u1.id AND m1.meta_key = 'pv_shop_name')
JOIN wp_usermeta m2 ON (m2.user_id = u1.id AND m2.meta_key = 'wp_capabilities')
WHERE m2.meta_value LIKE '%$role%'");
		//removed from query	// m1.meta_value LIKE '%$searchq%' AND
$seller_list = array();
foreach( $user_data as $user)
		{	
			$seller_list[$user->ID] = $user->shop_name;
		}
$status_list = array('1' => 'Active','0' =>'Dactive' );
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'productbranch-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Branch Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_branch'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Select seller:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_seller",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $seller_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),
				    array(
							'name' => esc_html__( 'Address', 'rwmb' ),
							'desc' => esc_html__( 'Address  for branch', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_branch_address",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),

					array(
							'name' => esc_html__( 'Description', 'rwmb' ),
							'desc' => esc_html__( 'Description  for brand', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_model_description",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),
					array(
						   'name'  => esc_html__( 'Select Status:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_branch_status",
						   'type'    => 'select',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $status_list,
						  
												 

						),
					
					
					
					
					
));


/* bank meta */

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'bank-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Bank Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_bank'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				   
				   
				   array(
							'name' => esc_html__( 'Bank Code', 'rwmb' ),
							'desc' => esc_html__( 'Enter Bank code', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_bankcode",
							'type' => 'text'
						),
					array(
						   'name'  => esc_html__( 'Select Status:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_bank_status",
						   'type'    => 'select',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $status_list,
						  
												 

						),
					
					
					
					
					
));


$bank_list = array();
$args = array( 'post_type' => 'woo_bank','orderby' => 'post_title','post_status' => array('publish'), 'order'=> 'ASC', 'posts_per_page' => -1 );
$allbanks = get_posts( $args );



foreach ($allbanks as $key => $post) {
 
    $post_id = $post->ID;
    $bank_list[$post_id]=$post->post_title;
    
}

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'bankbranch-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Brach Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'woo_bankbanch'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Select bank:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_bankbranchconnection",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $bank_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),
				   array(
							'name' => esc_html__( 'Branch Code', 'rwmb' ),
							'desc' => esc_html__( 'Enter Branch code', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_branchcode",
							'type' => 'text'
						),
					array(
						   'name'  => esc_html__( 'Select Status:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slug}_branch_status",
						   'type'    => 'select',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $status_list,
						  
												 

						),
					
					
					
					
					
));

function my_get_woo_cats2() {
  	global $term_count_global;
    $product_cats_parent = get_terms( array( 'taxonomy' => 'product_cat','hide_empty' => 0, 'orderby' => 'ASC') );
   
   global $meta_boxes;


$cat_list = array();
foreach ($product_cats_parent as $key => $value) {
	
	$cat_list[$value->term_id] = $value->name;
}

$addType = array();
$addType[1] = 'Link to Products';
$addType[2] = 'Link to Google or Other advertisement code'; 
$addType[3] = 'None Link'; 
/* Sponsor advertisement */
$prefix = "rw_";
$slugnew = 'sponsor_advertisement';
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'sponsor_advertisement-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Sponsor advertisement', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'sponsor'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Choose category:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slugnew}_cat",
						   'type'    => 'autocomplete',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $cat_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),

				    array(
						   'name'  => esc_html__( 'Select Advertisement Type:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slugnew}_type",
						   'type'    => 'select',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $addType,
						  
												 

						),

				    

				    /* array(
							'name' => esc_html__( 'Link', 'rwmb' ),
							'desc' => esc_html__( 'Enter Link', 'rwmb' ),
							'id'    => "{$prefix}{$slug}_link",
							'type' => 'text'
						), */

				     array(
							'name' => esc_html__( 'Prodcut id', 'rwmb' ),
							'desc' => esc_html__( 'If you have more than one product enter comma separated id', 'rwmb' ),
							'id'    => "{$prefix}{$slugnew}_link",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 1,
						),

					array(
							'name' => esc_html__( 'Api Code', 'rwmb' ),
							'desc' => esc_html__( 'Enter API or Google Code', 'rwmb' ),
							'id'    => "{$prefix}{$slugnew}_code",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),
					 array(
							'name' => esc_html__( 'Start Date', 'rwmb' ),
							'desc' => esc_html__( 'Select date & time', 'rwmb' ),
							'id'    => "{$prefix}{$slugnew}_sd",
							'type' => 'date'
						),
					 array(
							'name' => esc_html__( 'End Date', 'rwmb' ),
							'desc' => esc_html__( 'Select date & time', 'rwmb' ),
							'id'    => "{$prefix}{$slugnew}_ed",
							'type' => 'date'
						),
				   
				  
					
					
					
					
					
));


}

//Manual back end paymant process
$methos_list = array('1'=>'Cash','2'=>'Cheque','3'=>'Bank Deposit', '4'=>'Credit Card', '5' => 'Payment on Account', '6'=>'Jungle points');

//Manual back end bank list
// $bank_list = array('1'=>'Sampath Bank PLC','2'=>'Nations Trust Bank PLC','3'=>'Commercial Bank PLC','4'=>'Hatton National Bank PLC', '5' => 'Peoples Bank', '6'=>'Pan Asia Banking Corporation PLC')
$bank_list = array('1'=>' Bank of Ceylon','2'=>'Sampath Bank PLC');



$slugPaymant = "pay";
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'paymantDetails-meta',
	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Payment Details', 'rwmb' ),
	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'shop_order'),
	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',
	// Order of meta box: high (default), low. Optional.
	'priority' => 'low',
	// Auto save: true, false (default). Optional.
	'autosave' => true,
	//'include' => array( 'woo_brands' ),
	// Register this meta box for posts matched below conditions
	//'include' => array('ID'  => array( 4 ),),
	// List of meta fields
	 'fields' => array(
            array(
                'id'     => 'standardPaymantGroup',
                // Group field
                'type'   => 'group',
                // Clone whole group?
                'clone'  => true,
                // Drag and drop clones to reorder them?
                'sort_clone' => true,
	'fields' => array(

				    array(
						   'name'  => esc_html__( 'Select Payment Method:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slugPaymant}_pm",
						   'type'    => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $methos_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),
				      array(
						   'name'  => esc_html__( 'Select Bank:', 'your-prefix' ),
						   'id'    => "{$prefix}{$slugPaymant}_bank",
						   'type'  => 'select_advanced',
						   'clone' => false,
						    // Options of autocomplete, in format 'value' => 'Label'
						    'options' => $bank_list,
						    'validation' => array(
							    'rules'  => array(
							        'field_id' => array(
							            'required'  => true,
							            // More rules here
							        ),
							        // Rules for other fields
							    ),
							)
												 

						),
				    array(
							'name' => esc_html__( 'Payment date', 'rwmb' ),
							'desc' => esc_html__( 'Select date & time', 'rwmb' ),
							'id'    => "{$prefix}{$slugPaymant}_date",
							'type' => 'datetime'
						),
				    array(
						    'name' => 'Full order value',
						    'id'   => "{$prefix}{$slugPaymant}_oderValue",
						    'type' => 'checkbox',
						    'std'  => 0, // 0 or 1
						),
					array(
							'name' => esc_html__( 'Amount Rs.', 'rwmb' ),
							'desc' => esc_html__( 'Enter payment value', 'rwmb' ),
							'id'    => "{$prefix}{$slugPaymant}_amount",
							'type' => 'text'
						),
				   array(
							'name' => esc_html__( 'Reference.', 'rwmb' ),
							'desc' => esc_html__( 'Enter payment reference (Cheque number, account number etc)', 'rwmb' ),
							'id'    => "{$prefix}{$slugPaymant}_reference",
							'type' => 'text'
						),
				   
					 array(
							'name' => esc_html__( 'Description', 'rwmb' ),
							'desc' => esc_html__( 'Enter payment description, (Bank name, branch etc)', 'rwmb' ),
							'id'    => "{$prefix}{$slugPaymant}_description",
							'type' => 'textarea',
							'cols' => 20,
							'rows' => 2,
						),
					 array(
					    'type'       => 'button',
					    'name'       => 'Save Payment',
					    // Button text.
					   // 'std'        => 'Toggle',
					    // Custom HTML attributes.
					    'attributes' => array(
					        'data-section' => 'advanced-section',
					        'class'        => 'jsavepaymant-order button button-primary',
					    ),
					),

					
					
					
					  
					
)))


);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function rw_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $meta_boxes as $meta_box ) {
			if ( isset( $meta_box['only_on'] ) && ! rw_maybe_include( $meta_box['only_on'] ) ) {
				continue;
			}

			new RW_Meta_Box( $meta_box );
		}
	}
}

add_action( 'admin_init', 'rw_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */
function rw_maybe_include( $conditions ) {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN ) {
		return false;
	}

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return true;
	}

	if ( isset( $_GET['post'] ) ) {
		$post_id = $_GET['post'];
	}
	elseif ( isset( $_POST['post_ID'] ) ) {
		$post_id = $_POST['post_ID'];
	}
	else {
		$post_id = false;
	}

	$post_id = (int) $post_id;
	$post    = get_post( $post_id );

	foreach ( $conditions as $cond => $v ) {
		// Catch non-arrays too
		if ( ! is_array( $v ) ) {
			$v = array( $v );
		}

		switch ( $cond ) {
			case 'id':
				if ( in_array( $post_id, $v ) ) {
					return true;
				}
			break;
			case 'parent':
				$post_parent = $post->post_parent;
				if ( in_array( $post_parent, $v ) ) {
					return true;
				}
			break;
			case 'slug':
				$post_slug = (!empty( $post->post_name));
				if ( in_array( $post_slug, $v ) ) {
					return true;
				}
			break;
			case 'template':
				$template = get_post_meta( $post_id, '_wp_page_template', true );
				if ( in_array( $template, $v ) ) {
					return true;
				}
			break;
		}
	}

	// If no condition matched
	return false;
}
?>
