<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if($_REQUEST['reset-link-sent']){
	wc_print_notices();
wc_print_notice( __( 'Password reset code has been sent your phone.', 'woocommerce' ) );

?>

<div class="row">

<div class="col-sm-12 col-md-4 ml-md-auto mr-md-auto" style="padding-bottom: 50px;">

	

<div id="errormessage"></div>
		
<form class="woocommerce-form woocommerce-form-login login" action="" method="post">

	

		
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username">Enter 4 digit password pin code <span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="activation_pin" id="activation_pin" required="" value="">
				<input type="hidden" class="" name="phone_user_login" id="phone_user_login"  value="<?php echo $_REQUEST['reset-link-sent']; ?>">
			</p>
			
			<p class="form-row">
								<input type="button" class="phonepasswordreset" id="resetpaswordpin" name="login" value="Reset Password">
				
			</p>
			<p class="woocommerce-LostPassword lost_password">
			
			 <a href="/my-account/lost-password/" class="link_custom">Lost your pin Code? Resend!</a>
			</p>

		
			
		

		</form>

		
		 
</div>
</div>


<?php

}else{

wc_print_notices();
wc_print_notice( __( 'Password reset email has been sent.', 'woocommerce' ) );
?>

<p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ); ?></p>

<?php } ?>