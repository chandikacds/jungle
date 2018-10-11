<?php
add_filter( 'rwmb_meta_boxes', 'rw_register_taxonomy_meta_boxes' );
function rw_register_taxonomy_meta_boxes( $meta_boxes )

{
$prefix = 'rw_';
	$meta_boxes[] = array(
		'title'      => 'Author Information',
		'taxonomies' => 'base_woo_product', // List of taxonomies. Array or string
		'fields' => array(
			// URL
						array(
							'name' => esc_html__( 'Author Website URL', 'your-prefix' ),
							'id'   => "{$prefix}author_url",
							'desc' => esc_html__( 'Enter the Authors website URL', 'your-prefix' ),
							'type' => 'url',
							//'std'  => 'http://google.com',
						),
			
		),
	);




	return $meta_boxes;
}