var Admin_Users_list = function() {
	return {
		init: function() {
			$( '.status' ).on( 'click', function() {		
				status_update( $( this ), 'admin/admin_users/status' );
			});
		}
	}
}();

var Admin_Users_create = function() {
	return {
		init: function() {
			$( '#admin-user-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/admin_users/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Admin_Users_revise = function() {
	return {
		init: function() {			
			$( '#admin-user-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/admin_users/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();