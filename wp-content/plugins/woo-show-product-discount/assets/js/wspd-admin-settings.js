
(function( $ ) {
    $(function() {
         
        // Add Color Picker to all inputs that have 'color-field' class
        $( '.wspd_settings_color_picker' ).wpColorPicker();
         
    });
})( jQuery );

jQuery( document ).ready( function() {

	jQuery( '.wspd_settings_enable_color_picker' ).each( function() {
		if( jQuery( this ).is( ":checked" ) ) {
			jQuery( this ).closest( 'tr' ).next().show();
		}
		else {
			jQuery( this ).closest( 'tr' ).next().hide();
		}
	});
	jQuery( '.wspd_settings_enable_color_picker' ).change( function() {
		if( jQuery( this ).is( ":checked" ) ) {
			jQuery( this ).closest( 'tr' ).next().show();
		}
		else {
			jQuery( this ).closest( 'tr' ).next().hide();
		}
	});
	
});