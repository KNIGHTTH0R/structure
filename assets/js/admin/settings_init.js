var Settings = function() {
	return {
		init: function() {
			
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