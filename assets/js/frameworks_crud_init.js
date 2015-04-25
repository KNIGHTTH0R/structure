var Frameworks_list = function() {
	return {
		init: function() {
			status_update( site_url + 'admin/frameworks/status' );
		}
	}
}();

var Frameworks_create = function() {
	return {
		init: function() {
			var add_row 					= $( '.add-row' );
			var framework_create 	= $( '.form-body' );
			var total_columns 		= $( '#total_columns' );
			var framework_form 		= $( '#framework-create-form' );
			var count 						= 1;
			
			add_row.on( 'click', function( e ) {
				e.preventDefault();

				var num_columns = total_columns.select2( 'val' );
				var columns = 12 / num_columns;
				
				framework_create.append( gen_ui_framework_block( columns, num_columns, count ) );
				$( ".make-switch" ).bootstrapSwitch();
				count++;
			});
			
			framework_create.on( 'keyup', 'input', function() {
				var framework_row = $( this ).parents( '.framework-wrapper' );
				$( '.framework-column', framework_row ).each( function() {
					var new_width = $( this ).find( "input[type='text']" ).val();
					if( $( this ).hasClass( 'bg-grey-cararra' ) ) {
						var no_widgets = 'bg-grey-cararra';
					} else {
						var no_widgets = '';
					}
					$( this ).removeAttr( 'class' );
					$( this ).addClass( 'col-md-' + new_width + ' framework-column ' + no_widgets );
				});
			});
			
			framework_create.on( 'click', '.framework-delete', function() {
				var delete_row = $( this ).attr( 'data-value' );
				framework_create.find( '#framework-row-' + delete_row ).remove();
			});
			
			framework_create.on( 'switchChange.bootstrapSwitch', ".make-switch", function() {
				$( this ).parents( '.bg-green' ).toggleClass( 'bg-grey' );
			});
			
			framework_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				$.post( site_url + 'admin/frameworks/insert', $( this ).serialize(), function( data ) {
					gen_toastr( data );
				});
			});
		}
	};
}();

var Frameworks_revise = function() {
	return {
		init: function() {
			$( '#framework-revise-form' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				$.post( site_url + 'admin/frameworks/update', $( this ).serialize(), function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();