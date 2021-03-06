var Defaults = function() {
	return {
		init: function() {
			var default_pages = $( '#default-pages' );
			var default_fr_menu_items = $( '#default-fr-menu-items' );
			
			var default_pages_list = function() {
				$( '.page-table' ).DataTable().destroy();
				$.get( site_url + 'portal/pages/defaults_list', function( data ) {
					default_pages.html( data );
					$( '.btn-create', default_pages ).attr( 'href', '' );
					gen_ui_datatable( '.page-table' );
				});
			}
			
			var default_pages_create = function() {
				$.get( site_url + 'portal/pages/defaults_create', function( data ) {
					default_pages.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			var default_pages_revise = function( object_ref ) {
				var page_id = $( object_ref ).attr( 'href' ).split( '/' ).pop().split( '?' ).shift();
				$.get( site_url + 'portal/pages/defaults_revise/' + page_id, function( data ) {
					default_pages.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			var default_fr_menu_items_list = function() {
				$( '.fr-menu-item-table' ).DataTable().destroy();
				$.get( site_url + 'portal/fr_menu_items/defaults_menu_item_list', function( data ) {
					default_fr_menu_items.html( data );
					$( '.btn-create', default_fr_menu_items ).attr( 'href', '' );
					gen_ui_datatable( '.fr-menu-item-table' );
				});
			}
			
			var default_fr_menu_items_create = function() {
				$.get( site_url + 'portal/fr_menu_items/defaults_menu_item_create', function( data ) {
					default_fr_menu_items.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			var default_fr_menu_items_revise = function( object_ref ) {
				var fr_menu_item_id = $( object_ref ).attr( 'href' ).split( '/' ).pop().split( '?' ).shift();
				$.get( site_url + 'portal/fr_menu_items/defaults_menu_item_revise/' + fr_menu_item_id, function( data ) {
					default_fr_menu_items.html( data );
					$( 'select' ).select2();
					$( '.make-switch' ).bootstrapSwitch();
				});
			}
			
			$( document ).ready( function() {
				default_pages_list();
			});
			
			/** Default Pages List **/
			$( '.default-pages' ).on( 'click', function() {
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
				$.post( site_url + 'portal/pages/insert', form_data, function( data ) {
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
				$.post( site_url + 'portal/pages/update', form_data, function( data ) {
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
			
			/** Defaults Pages Status **/
			default_pages.on( 'click', '.status', function() {
				status_update( $( this ), 'portal/pages/status' );
			});
			
			/** Default Front-End Menu Items List **/
			$( '.default-fr-menu-items' ).on( 'click', function() {
				default_fr_menu_items_list();
			});
			
			/** Default Front-End Menu Items Create **/			
			default_fr_menu_items.on( 'click', '.btn-create', function( e ) {
				e.preventDefault();
				default_fr_menu_items_create();
			});
			
			/** Default Front-End Menu Items Insert **/
			default_fr_menu_items.on( 'submit', '#fr-menu-item-create', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/fr_menu_items/insert', form_data, function( data ) {
					var results = data.split( '|' )[0];
					
					switch( results ) {
						case 's':
							gen_toastr( results + '|created Page|' );
							default_fr_menu_items_list();
						break;
						case 'e':
							gen_toastr( results + '|create Page|' );
						break;
					}
				});
			});
			
			/** Default Front-End Menu Items Revise **/
			default_fr_menu_items.on( 'click', '.default-revise', function( e ) {
				e.preventDefault();
				default_fr_menu_items_revise( $( this ) );
			});
			
			/** Default Front-End Menu Items Update **/
			default_fr_menu_items.on( 'submit', '#fr-menu-item-revise', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'portal/fr_menu_items/update', form_data, function( data ) {
					var results = data.split( '|' )[0];
					
					switch( results ) {
						case 's':
							gen_toastr( results + '|updated Menu Item|' );
							default_fr_menu_items_list();
						break;
						case 'e':
							gen_toastr( results + '|update Menu Item|' );
						break;
					}
				});
			});
			
			/** Defaults Page Cancel **/
			default_fr_menu_items.on( 'click', '.default', function( e ) {
				e.preventDefault();
				default_fr_menu_items_list();
			});
			
			/** Defaults Front-End Menu Items Status **/
			default_fr_menu_items.on( 'click', '.status', function() {
				status_update( $( this ), 'portal/fr_menu_items/status' );
			});
		}
	}
}();