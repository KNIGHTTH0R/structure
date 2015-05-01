var Defaults = function() {
	return {
		init: function() {
			var portal_id = $( '#portal_id' );
			var df_page_form = $( '#df_page_form' );
			
			df_page_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				alert( 'here' );
			});
		}
	}
}();

var Fr_Menu_Items_create = function() {
	return {
		init: function() {
			$( '#fr-menu-item-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/fr_menu_items/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Fr_Menu_Items_revise = function() {
	return {
		init: function() {			
			$( '#fr-menu-item-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/fr_menu_items/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();