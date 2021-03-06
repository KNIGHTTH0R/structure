var Access_Levels_list = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				var table = $( '.access-level-table' ).DataTable({
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
						$.post( site_url + 'admin/access_levels/level', post_data );
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
				
				$( '#access-level-wrapper' ).fadeOut( function() {
					$( '#list-reorder' ).fadeIn();
				});
			});
			
			$( '#list-reorder' ).on( 'submit', function( e ) {
				e.preventDefault();				
				gen_spinner( '#list-reorder' );
			});
			
			$( '.status' ).on( 'click', function() {
				status_update( $( this ), 'admin/access_levels/status' );
			});
		}
	}
}();

var Access_Levels_create = function() {
	return {
		init: function() {			
			$( '#access-level-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/access_levels/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Access_Levels_revise = function() {
	return {
		init: function() {			
			$( '#access-level-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/access_levels/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();