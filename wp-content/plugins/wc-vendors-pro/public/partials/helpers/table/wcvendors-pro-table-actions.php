<?php

/**
 * Dashboard action URL 
 *
 * This file is used to display a dashboard action url 
 *
 * @link       http://www.wcvendors.com
 * @since      1.0.0
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/helpers/table
 */

?>

<div class="row-actions row-actions-<?php echo $this->id?>"> 
<?php 
	
	foreach ( $this->actions as $action => $details ) { 

		if ( !empty( $details ) ) { 

			if ( empty( $details['url'] ) ) { 
				if ( $action == 'view' ) { 
					$action_url = get_permalink( $object_id ); 
				} else { 
					$action_url = WCVendors_Pro_Dashboard::get_dashboard_page_url( $this->post_type . '/' . $action . '/' . $object_id );
				} 
			} else { 
				$action_url = $details[ 'url' ];
			} 
		} 

		( ! empty( $details[ 'class' ] ) ) ? $class='class="' .$details[ 'class' ]. '"' : $class = '';
		( ! empty( $details[ 'id' ] ) ) ? $id='id="' .$details[ 'id' ]. '"' : $id = ''; 
		( ! empty( $details[ 'target' ] ) ) ? $target='target="' .$details[ 'target' ]. '"' : $target = ''; 
		$custom = ''; 
		if ( ! empty( $details[ 'custom' ] ) ) { 
			foreach ($details['custom'] as $attr => $value ) {
				$custom .= $attr. '="'. $value .'" '; 
			}

		}

		$productType = checkProductIsSub($object_id);

		
		if($productType == 1 ){
			$author= get_post_field( 'post_author', $object_id );
			
			

			if($details[ 'label' ] == "View" || $details[ 'label' ] == "Edit" ){
				echo '<a href="'. $action_url.'?ospd=1" '.$id.' '.$class.' '.$target.' '.$custom.' >'. $details[ 'label' ].'</a>';
			}
		}else if($productType == 2 ){
			$author= get_post_field( 'post_author', $object_id );
			
			

			if($details[ 'label' ] == "View" || $details[ 'label' ] == "Edit" || $details[ 'label' ] == "Delete" ){
				echo '<a href="'. $action_url.'?ospd=1" '.$id.' '.$class.' '.$target.' '.$custom.' >'. $details[ 'label' ].'</a>';
			}
		}else{
			if($details[ 'label' ] != "Duplicate"){
				echo '<a href="'. $action_url.'" '.$id.' '.$class.' '.$target.' '.$custom.' >'. $details[ 'label' ].'</a>';
			}
			
		}

		 
	} 
?>
</div>

