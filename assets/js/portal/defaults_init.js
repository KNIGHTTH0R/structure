var Defaults = function() {
	return {
		init: function() {
			var portal_id         = $( 'input[name="portal_id"]' ).val();
			var df_page_form      = $( '#df-page-form' );
			var df_menu_item_form = $( '#df-menu-item-form' );
			
			df_page_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/defaults/default_pages_update/' + portal_id, form_data, function( data ) {
					gen_toastr( data );
				});
			});
			
			df_menu_item_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/defaults/default_menu_items_update/' + portal_id, form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();