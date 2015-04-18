var Settings = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				$( '.summernote' ).summernote( { height: 250 } );
			});
			$( '#settings-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/settings/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();