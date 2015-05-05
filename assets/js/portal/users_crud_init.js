var Users_list = function() {
	return {
		init: function() {
			$( '.status' ).on( 'click', function() {		
				status_update( $( this ), 'portal/users/status' );
			});
		}
	}
}();

var Users_create = function() {
	return {
		init: function() {
			$( '#user-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/users/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Users_revise = function() {
	return {
		init: function() {			
			$( '#user-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/users/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();