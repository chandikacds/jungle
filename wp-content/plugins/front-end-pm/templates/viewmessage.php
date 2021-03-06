<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$i = 0;

if( $messages->have_posts() ) {
	wp_enqueue_script( 'fep-replies-show-hide' );
	if( fep_get_option( 'block_other_users', 1 ) ){
		wp_enqueue_script( 'fep-block-unblock-script');
	}
	$hide_read = apply_filters( 'fep_filter_hide_message_initially_if_read', true );
	?>
	<div class="fep-message"><?php
		while ( $messages->have_posts() ) {
			$i++;
			
			$messages->the_post();
			$read_class = ( $hide_read && fep_is_read() ) ? ' fep-hide-if-js' : '';
			$content_class = array();
			$content_class[] = 'fep-message-content';
			$content_class[] = 'fep-message-content-' . get_the_ID();
			//$content_class[] = 'fep-message-content-author-' . get_the_author_meta('ID');
			$per_mgs_class = array();
			$per_mgs_class[] = 'fep-per-message';
			$per_mgs_class[] = 'fep-per-message-' . get_the_ID();
			//$per_mgs_class[] = 'fep-per-message-' . get_the_author_meta('ID');
			
			if( get_current_user_id() == get_the_author_meta('ID') ){
				$content_class[] = 'fep-message-content-own';
				$per_mgs_class[] = 'fep-per-message-own';
			}
			if( fep_is_user_admin( get_the_author_meta('ID') ) ){
				$content_class[] = 'fep-message-content-admin';
				$per_mgs_class[] = 'fep-per-message-admin';
			}
			if( $hide_read && fep_is_read() ){
				$content_class[] = 'fep-hide-if-js';
				//$per_mgs_class[] = 'fep-hide-if-js';
			}
			
			
			fep_make_read(); 
			fep_make_read( true ); ?>
			
				<?php if( $i === 1 ){

					$participants = fep_get_participants( get_the_ID() );
					$par = array();
					foreach( $participants as $participant ) {
												
						if( get_current_user_id() != $participant && fep_get_option( 'block_other_users', 1 ) ){
							$block_unblock_text = fep_is_user_blocked_for_user( get_current_user_id(), $participant ) ? __("Unblock", "front-end-pm") : __("Block", "front-end-pm");
							$par[] = fep_user_name( $participant ) . '(<a href="#" class="fep_block_unblock_user" data-user_id="' . $participant . '">'. $block_unblock_text . '</a>)';
						} else {
							$par[] = fep_user_name( $participant );
						}
					} ?>
				<div class="fep-per-message fep-per-message-top fep-per-message-<?php the_ID(); ?>">
					<br><div class="fep-message-title-heading"><b>Subject : </b>  <?php the_title(); ?></div>
					<div class="fep-message-title-heading participants"><b>To : </b> <?php echo apply_filters( 'fep_filter_display_participants', implode( ', ', $par ), $par, $participants ); ?></div><br>
					<div class="fep-message-toggle-all fep-align-right" >
						<h6><b><?php _e("Toggle Messages", 'front-end-pm'); ?></b></h6>
					</div>
				</div>

				<?php } ?>
			<div id="fep-message-<?php the_ID(); ?>" class="<?php echo fep_sanitize_html_class( $per_mgs_class ); ?>">

				<div class="fep-message-title fep-message-title-<?php the_ID(); ?>">
					
					<div class="author"><b>From : </b><?php echo fep_user_name( get_the_author_meta('ID') ); ?></div>
					<div class="date"><b>Date & Time : </b><?php the_time(); ?>

						<p class="arrow"><button>&#x25BC;<B > View Message</B></button> </p>

					</div>
				</div>
				<div class="<?php echo fep_sanitize_html_class( $content_class ); ?>">
					<b>Message : </b><?php the_content(); ?>
					
					<?php if( $i === 1 ){
						do_action ( 'fep_display_after_parent_message' );
					} else {
						do_action ( 'fep_display_after_reply_message' );
					} ?>
					<?php do_action ( 'fep_display_after_message', $i ); ?>
				</div>
			</div><?php
		} ?>
	</div><?php
	wp_reset_postdata();
	
	include( fep_locate_template( 'reply_form.php') );
	
} else {
	echo "<div class='fep-error'>".__("You do not have permission to view this message!", 'front-end-pm')."</div>";
}