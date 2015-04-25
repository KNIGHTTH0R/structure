var Menu_Items_list = function() {
	return {
		init: function() {
			switch( section ) {
				case 'portal':
					var processing = 'admin/' + section;
				break;
				default:
					var processing = 'admin/';
			}
				
			$( document ).ready( function() {
				var table = $( '.menu-item-table' ).DataTable({
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
							var post_data = $( this ).sortable( 'serialize' );
							$.post( site_url + processing + '/menu_items/sequence', post_data );
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
							$.post( site_url + processing + '/menu_items/sequence', post_data );
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
			
			status_update( site_url + section + '/menu_items/status' );
		}
	}
}();

var Menu_Items_create = function() {
	return {
		init: function() {
			$( '#menu-item-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				switch( section ) {
					case 'portal':
						var processing = 'admin/' + section;
					break;
					default:
						var processing = 'admin/';
				}
				
				var form_data = $( this ).serialize();
				$.post( site_url + processing + '/menu_items/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Menu_Items_revise = function() {
	return {
		init: function() {			
			$( '#menu-item-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				switch( section ) {
					case 'portal':
						var processing = 'admin/' + section;
					break;
					default:
						var processing = 'admin/';
				}
				
				var form_data = $( this ).serialize();
				$.post( site_url + processing + '/menu_items/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
			
			status_update( site_url + section + '/menu_items/status' );
		}
	}
}();