var Defaults = function() {
	return {
		init: function() {
			var default_pages = $( '#default-pages' );
			
			var default_pages_list = function() {
				$.get( site_url + 'admin/pages/defaults_list', function( data ) {
					default_pages.html( data );
					$( '.btn-create', default_pages ).attr( 'href', '' );
					gen_ui_datatable( '.page-table' );
				});
			}
			
			var default_pages_create = function() {
				$.get( site_url + 'admin/pages/defaults_create', function( data ) {
					default_pages.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			var default_pages_revise = function( object_ref ) {
				var page_id = $( object_ref ).attr( 'href' ).split( '/' ).pop().split( '?' ).shift();
				$.get( site_url + 'admin/pages/defaults_revise/' + page_id, function( data ) {
					default_pages.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			$( document ).ready( function() {
				default_pages_list();
			});
			
			/** Defaults Page Create **/
			default_pages.on( 'click', '.btn-create', function( e ) {
				e.preventDefault();
				default_pages_create();
			});
			
			/** Defaults Page Insert **/
			default_pages.on( 'submit', '#page-create', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/pages/insert', form_data, function( data ) {
					var results = data.split( '|' )[0];
					
					switch( results ) {
						case 's':
							gen_toastr( results + '|created Page|' );
							default_pages_list();
						break;
						case 'e':
							gen_toastr( results + '|create Page|' );
						break;
					}
				});
			});
			
			/** Defaults Page Revise **/
			default_pages.on( 'click', '.default-revise', function( e ) {
				e.preventDefault();
				default_pages_revise( $( this ) );
			});
			
			/** Defaults Page Update **/
			default_pages.on( 'submit', '#page-revise', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/pages/update', form_data, function( data ) {
					var results = data.split( '|' )[0];
					
					switch( results ) {
						case 's':
							gen_toastr( results + '|updated Page|' );
							default_pages_list();
						break;
						case 'e':
							gen_toastr( results + '|update Page|' );
						break;
					}
				});
			});
			
			/** Defaults Page Cancel **/
			default_pages.on( 'click', '.default', function( e ) {
				e.preventDefault();
				default_pages_list();
			});
			
			status_update( site_url + 'admin/pages/status' );
		}
	}
}();