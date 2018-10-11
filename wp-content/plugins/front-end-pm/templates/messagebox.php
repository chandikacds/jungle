<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo fep_info_output();

if( ! fep_get_user_message_count('total') ) {
	echo "<div class='fep-error'>".apply_filters('fep_filter_messagebox_empty', __("No messages found.", 'front-end-pm'), $action)."</div>";
	return;
}

do_action('fep_display_before_messagebox', $action);
	  
	  	?><div class="fep-messagebox-search-form-div" >
	  		<div class="row">
		  		<div class="col-md-12">
			  		<form id="fep-messagebox-search-form" action="">
						<input type="hidden" name="fepaction" value="messagebox" />
						<input type="search" name="fep-search" class="fep-messagebox-search-form-field" value="<?php isset( $_GET["fep-search"] ) ? esc_attr_e( $_GET["fep-search"] ): ""; ?>" placeholder="<?php _e("Search Messages", "front-end-pm"); ?>"  />
						<input type="hidden" name="feppage" value="1" />
					</form>
		  		</div>
	  		</div>
		</div>
	  	<form class="fep-message-table form" method="post" action="">
		<div class="fep-table fep-action-table">
			<div class="row" style="margin-top: 15px;">
				<div class="fep-bulk-action col-md-4 ">
					<select name="fep-bulk-action">
						<option value=""><?php _e('Bulk action', 'front-end-pm'); ?></option>
						<?php foreach( Fep_Message::init()->get_table_bulk_actions() as $bulk_action => $bulk_action_display ) { ?>
						<option value="<?php echo $bulk_action; ?>"><?php echo $bulk_action_display; ?></option>
						<?php } ?>
					</select>
				</div>
								
				<div class="col-md-3">
					<div class="fep-loading-gif-div"></div>
					<div class="fep-filter">
						<select onchange="if (this.value) window.location.href=this.value">
							<?php foreach( Fep_Message::init()->get_table_filters() as $filter => $filter_display ) { ?>
							<option value="<?php echo esc_url( add_query_arg( array('fep-filter' => $filter, 'feppage' => false ) ) ); ?>" <?php selected($g_filter, $filter);?>><?php echo $filter_display; ?></option>
							<?php } ?>
						</select>
					</div>
					
				</div>
 				<div class="col-md-4">
					<input type="hidden" name="token"  value="<?php echo fep_create_nonce('bulk_action'); ?>"/>
					<button type="submit" class="fep-button" name="fep_action" value="bulk_action"><?php _e('Apply', 'front-end-pm'); ?></button>
				</div>

				<div class="row col-md-12 font-weight-bold text-center" style="margin: 15px;">
					<div class="col-md-3">From</div>
					<div class="col-md-3">Subject</div>
					<div class="col-md-3">Message </div>
					<div class="col-md-3">Date/Time</div>
				</div>
			</div>
		</div>
		<?php if( $messages->have_posts() ) { ?>
		<div id="fep-table" class="fep-table fep-odd-even"><?php
			while ( $messages->have_posts() ) { 
				$messages->the_post(); ?>
					<div id="fep-message-<?php the_ID(); ?>" class="fep-table-row"><div class="row"><?php
					$i=0;
						foreach ( Fep_Message::init()->get_table_columns() as $column => $display ) {
								if($i == 0){
									$col = "col-md-1";
								}else if($i == 1){
									$col = "col-md-1 hide";
								}else if($i == 2){
									$col = "col-md-2";
								}else if($i == 5){
									$col = "col-md-3";
								}else{
									$col = "col-md-3";
								}
								
								$i++; 

							?>
							
							<div class="fep-column fep-column-<?php echo $column; ?> <?php echo $col; ?>"><?php 
								// var_dump(get_column_content($column));
								Fep_Message::init()->get_column_content($column); ?>
								
							</div>
						<?php  } ?>
					</div>
					</div>
				<?php
			} //endwhile
			?></div><?php
			echo fep_pagination( $total_message );
		} else {
			?><div class="fep-error"><?php _e('No messages found. Try different filter.', 'front-end-pm'); ?></div><?php 
		}
		?></form><?php 
	wp_reset_postdata();
