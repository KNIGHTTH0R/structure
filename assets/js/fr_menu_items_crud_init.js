var Fr_Menu_Items_list = function() {
	return {
		init: function() {
			var portal_id = window.location.search.replace( '?', '' ).split( '=' ).pop();

			$( document ).ready( function() {
				var table = $( '.fr-menu-item-table' ).DataTable({
					"aaSorting": [],
					"aLengthMenu": [
						[ 15, 25, 50, -1 ],
						[ 15, 25, 50, "All" ]
					],
					"iDisplayLength": -1
				});
				$( '.dataTables_length' ).find( 'label' ).prepend( 'Show' );
				$( '.dataTables_length' ).find( 'select' ).select2();
				
				$( "#sequence-list" ).sortable({
						axis: 'y',
						update: function() {
							var post_data = $( this ).sortable( 'serialize' ) + '&portal_id=' + portal_id;
							$.post( site_url + 'portal/fr_menu_items/sequence', post_data );
						},
            opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            cursor: "pointer",
            revert: 250, // animation in milliseconds
        });
        
        $( ".child-list" ).sortable({
						axis: 'y',
						update: function() {
							var post_data = $( this ).sortable( 'serialize' );
							$.post( site_url + 'portal/fr_menu_items/sequence', post_data );
						},
            opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            cursor: "pointer",
            revert: 250, // animation in milliseconds
        });
			});
			
			$( '.reorder' ).on( 'click', function( e ) {
				e.preventDefault();
				
				$( '#menu-item-wrapper' ).fadeOut( function() {
					$( '#list-reorder' ).fadeIn();
				});
			});
			
			$( '#list-reorder' ).on( 'submit', function( e ) {
				e.preventDefault();
				gen_spinner( '#list-reorder' );
			});
			
			$( '.status' ).on( 'click', function() {
				status_update( $( this ), 'portal/fr_menu_items/status' );
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