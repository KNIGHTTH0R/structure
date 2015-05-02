var Pages_list = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				gen_ui_datatable( '.page-table' );
			});
			
			$( '.status' ).on( 'click', function() {
				status_update( $( this ), 'portal/pages/status' );
			});
		}
	}
}();

var Pages_create = function() {
	return {
		init: function() {			
			$( '#page-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				var form_data = $( this ).serialize();				
				$.post( site_url + 'portal/pages/insert', form_data, function( data ) {
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
				$.post( site_url + 'portal/pages/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();