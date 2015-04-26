var Defaults = function() {
	return {
		init: function() {
			var default_menu_items = $( 'a[href="#default-menu-items"]' );
			
			var default_pages_list = $( '#default-pages-list' );
			var default_pages_form = $( '#default-pages-form' );
			
			$( document ).ready( function() {
				$.get( site_url + 'admin/defaults/get_default_pages', function( data ) {
					var inputs = JSON.parse( data );
					var col3 = $( '<div>', { class: 'col-md-3' } );
					
					var column_1 = col3.clone().append( inputs.column_1 );
					var column_2 = col3.clone().append( inputs.column_2 );
					var column_3 = col3.clone().append( inputs.column_3 );
					var column_4 = col3.clone().append( inputs.column_4 );
					
					default_pages_list.append( column_1 );
					default_pages_list.append( column_2 );
					default_pages_list.append( column_3 );
					default_pages_list.append( column_4 );
					
					$( '.make-switch' ).bootstrapSwitch();
				});
			});
			
			default_menu_items.on( 'click', function() {
				//$.get( site_url + 'admin/defaults/get_default_menu_items', function( data ) {
					
				//});
			});
			
			default_pages_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/defaults/update_pages', form_data, function( data ) {
					alert( data );
					gen_toastr( data );
				});
			});
		}
	}
}();