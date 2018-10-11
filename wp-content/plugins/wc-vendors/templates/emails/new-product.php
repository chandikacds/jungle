<?php if ( !defined( 'ABSPATH' ) ) exit; ?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

	<?php $email_sent = get_post_meta( $post_id, 'wcv_addnew_product_email_sent', true );  ?>
		<?php if(empty($email_sent)){ ?>
	<p><?php printf( __( "Hi there. This is a notification about a new product on %s.", 'wcvendors' ), get_option( 'blogname' ) ); ?></p>

	
		<?php }else{ ?>
			<p><?php printf( __( "Hi there. This is a notification about a update product on %s.", 'wcvendors' ), get_option( 'blogname' ) ); ?></p>

	
	    <?php } ?>

	<p>
		<?php printf( __( "Product title: %s", 'wcvendors' ), $product_name ); ?><br/>
		<?php printf( __( "Submitted by: %s", 'wcvendors' ), $vendor_name ); ?><br/>
		<?php printf( __( "Edit product: %s", 'wcvendors' ), admin_url( 'post.php?post=' . $post_id . '&action=edit' ) ); ?>
		<br/>
	</p>

<?php do_action( 'woocommerce_email_footer' ); ?>