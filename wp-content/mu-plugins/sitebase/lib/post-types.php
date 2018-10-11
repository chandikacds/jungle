<?php
/*
Plugin Name: PDG Custom Post Types
Description: Set up custom post types for the site
*/
function posts_setup() {
//Register post type

function codex_custom_init() {

    //custom Post Type Brand////////////////
      $customlabels = array(
        'name' => 'Brands',
        'singular_name' => 'product_Brands',
        'add_new' => 'Add New Brand',
        'add_new_item' => 'Add New Brand',
        'edit_item' => 'Edit Brand',
        'new_item' => 'New Brand',
        'all_items' => 'All Brands',
        'view_item' => 'View Brand',
        'search_items' => 'Search your Brand',
        'not_found' =>  'No Brand found',
        'not_found_in_trash' => 'No Brand found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Brands'
      );
        register_post_type(
          'woo_brands', array(
            'labels' => $customlabels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'brands' ),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'menu_icon'=> 'dashicons-admin-users',
            //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
            'supports' => array( 'title', 'thumbnail',),
            //'taxonomies'=> array('post_tag', 'category', )
            )
        );

        //custom Post Type Branches////////////////
          $customlabels = array(
            'name' => 'Model',
            'singular_name' => 'model',
            'add_new' => 'Add New Model',
            'add_new_item' => 'Add New Model',
            'edit_item' => 'Edit Model',
            'new_item' => 'New Model',
            'all_items' => 'All Model',
            'view_item' => 'View Model',
            'search_items' => 'Search your Model',
            'not_found' =>  'No Model found',
            'not_found_in_trash' => 'No Model found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Model'
          );
            register_post_type(
              'woo_model', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'model' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );


//woo_mpn

            //custom Post Type Branches////////////////
          $mpn = array(
            'name' => 'Manufacturer part number',
            'singular_name' => 'mpn',
            'add_new' => 'Add New MPN',
            'add_new_item' => 'Add New MPN',
            'edit_item' => 'Edit MPN',
            'new_item' => 'New MPN',
            'all_items' => 'All MPN',
            'view_item' => 'View MPN',
            'search_items' => 'Search your MPN',
            'not_found' =>  'No MPN found',
            'not_found_in_trash' => 'No MPN found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'MPN'
          );
            register_post_type(
              'woo_mpn', array(
                'labels' => $mpn,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'mpn' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );


              //custom Post Type Branches////////////////
          $customlabels = array(
            'name' => 'Branches',
            'singular_name' => 'branches',
            'add_new' => 'Add New Branch',
            'add_new_item' => 'Add New Branch',
            'edit_item' => 'Edit Branch',
            'new_item' => 'New Branch',
            'all_items' => 'All Branches',
            'view_item' => 'View Branch',
            'search_items' => 'Search your Branch',
            'not_found' =>  'No Branch found',
            'not_found_in_trash' => 'No Branch found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Shop Branches'
          );
            register_post_type(
              'woo_branch', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'branches' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );

                   //custom Post Type Branches////////////////
          $customlabels = array(
            'name' => 'Locations',
            'singular_name' => 'location',
            'add_new' => 'Add New Location',
            'add_new_item' => 'Add New Location',
            'edit_item' => 'Edit Location',
            'new_item' => 'New Location',
            'all_items' => 'All Locations',
            'view_item' => 'View Location',
            'search_items' => 'Search your Location',
            'not_found' =>  'No Location found',
            'not_found_in_trash' => 'No Location found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Locations'
          );
            register_post_type(
              'woo_location', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'location' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );

              //custom Post Type Bank////////////////
          $customlabels = array(
            'name' => 'Bank',
            'singular_name' => 'bank',
            'add_new' => 'Add New Bank',
            'add_new_item' => 'Add New Bank',
            'edit_item' => 'Edit Bank',
            'new_item' => 'New Bank',
            'all_items' => 'All Banks',
            'view_item' => 'View Bank',
            'search_items' => 'Search your Bank',
            'not_found' =>  'No Bank found',
            'not_found_in_trash' => 'No Bank found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Banks'
          );
            register_post_type(
              'woo_bank', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'bank' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );



              //custom sponsor add Bank////////////////
          $customlabels = array(
            'name' => 'sponsor',
            'singular_name' => 'sponsor',
            'add_new' => 'Add New Sponsor advertisement',
            'add_new_item' => 'Add New Sponsor advertisement',
            'edit_item' => 'Edit Sponsor advertisement',
            'new_item' => 'New Sponsor advertisement',
            'all_items' => 'All Sponsor advertisement',
            'view_item' => 'View Sponsor advertisement',
            'search_items' => 'Search your Sponsor advertisement',
            'not_found' =>  'No Sponsor advertisement found',
            'not_found_in_trash' => 'No Sponsor advertisement found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Sponsor Advertisement'
          );
            register_post_type(
              'sponsor', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'sponsor' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );



              //custom Post Type Bank Branches////////////////
          $customlabels = array(
            'name' => 'Bank Branches',
            'singular_name' => 'bankbanch',
            'add_new' => 'Add New Branch',
            'add_new_item' => 'Add New Branch',
            'edit_item' => 'Edit Branch',
            'new_item' => 'New Branch',
            'all_items' => 'All Branch',
            'view_item' => 'View Branch',
            'search_items' => 'Search your Branch',
            'not_found' =>  'No Branch found',
            'not_found_in_trash' => 'No Branch found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Bank Branches'
          );
            register_post_type(
              'woo_bankbanch', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'bankbanch' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );


             //custom Post Type Bank Branches////////////////
          $customlabels = array(
            'name' => 'Services',
            'singular_name' => 'services',
            'add_new' => 'Add New Service',
            'add_new_item' => 'Add New Service',
            'edit_item' => 'Edit Service',
            'new_item' => 'New Service',
            'all_items' => 'All Service',
            'view_item' => 'View Service',
            'search_items' => 'Search your Service',
            'not_found' =>  'No Service found',
            'not_found_in_trash' => 'No Service found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Services'
          );
            register_post_type(
              'woo_services', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'services' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );



               //custom Post Type Address Book////////////////
          $customlabels = array(
            'name' => 'Address Book',
            'singular_name' => 'addressbook',
            'add_new' => 'Add New Address',
            'add_new_item' => 'Add New Address',
            'edit_item' => 'Edit Address',
            'new_item' => 'New Address',
            'all_items' => 'All Addresses',
            'view_item' => 'View Address',
            'search_items' => 'Search your Address',
            'not_found' =>  'No Address found',
            'not_found_in_trash' => 'No Address found in Trash',
            'parent_item_colon' => '',
            'menu_name' => 'Address Book'
          );
            register_post_type(
              'woo_addressbook', array(
                'labels' => $customlabels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'show_in_menu' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'addressbook' ),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position' => null,
                'menu_icon'=> 'dashicons-image-filter',
                //'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
                'supports' => array( 'title', 'thumbnail'),
                //'taxonomies'=> array('post_tag', 'category', )
                )
            );

            

}
add_action( 'init', 'codex_custom_init' );
}

add_action('after_setup_theme', 'posts_setup');


// hook into the init action and call create_types_taxonomies when it fires
add_action( 'init', 'create_types_taxonomies', 0 );

// create the taxonomy
function create_types_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Types', 'taxonomy general name' ),
		'singular_name'     => _x( 'type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search type' ),
		'all_items'         => __( 'All types' ),
		'parent_item'       => __( 'Parent type' ),
		'parent_item_colon' => __( 'Parent type:' ),
		'edit_item'         => __( 'Edit type' ),
		'update_item'       => __( 'Update type' ),
		'add_new_item'      => __( 'Add New type' ),
		'new_item_name'     => __( 'New type Name' ),
		'menu_name'         => __( 'Types' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'base_type', 'with_front' => false),
	);



	register_taxonomy( 'base_type', array( 'base_normal_members' ), $args );


  $labels = array(
		'name'              => _x( 'Author Name', 'taxonomy general name' ),
		'singular_name'     => _x( 'type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search type' ),
		'all_items'         => __( 'All Authors' ),
		'parent_item'       => __( 'Parent Author' ),
		'parent_item_colon' => __( 'Parent Author:' ),
		'edit_item'         => __( 'Edit Author' ),
		'update_item'       => __( 'Update Author' ),
		'add_new_item'      => __( 'Add New Author' ),
		'new_item_name'     => __( 'New Author' ),
		'menu_name'         => __( 'Author Name' ),
	);

	$args = array(
		'hierarchical'      => true,
     'sort' => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'base_woo_product', 'with_front' => false),
	);



	register_taxonomy( 'base_woo_product', array('base_downloads' ), $args );
/*
  $args = array( 'post_type' => 'base_members','orderby' => 'post_title', 'order'=> 'ASC');
  $myposts = get_posts( $args );

   foreach ($myposts  as $post) {
     //var_dump($post); exit;
     wp_insert_term($post->post_title, 'base_product', array('slug' => str_replace(' ', '_', $post->post_title), 'parent'=> 0 ));
   }
*/

}


?>
