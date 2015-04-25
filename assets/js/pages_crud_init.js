var Pages_list = function() {
	return {
		init: function() {
			status_update( site_url + 'admin/pages/status' );
		}
	}
}();

var Pages_create = function() {
	return {
		init: function() {			
			$( '#page-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();				
				$.post( site_url + 'admin/pages/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Pages_revise = function() {
	return {
		init: function() {			
			$( '#page-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/pages/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();