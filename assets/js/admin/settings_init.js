var Settings = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				$( '.summernote' ).summernote( { height: 250 } );
			});
			$( '#settings-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/settings/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
			
			( function( $ ) {
				jQuery.fn.select2options = function( data ) {
					var $elem = this;
					$( 'option:not(:first)', $elem ).remove();
					$.each( data, function( i, val ) {
						$elem.append( $( '<option>', { value: val.id, text: val.text } ) );
					});
				};
			})( jQuery );
			
			$( '#selectme' ).on( 'change', function() {
				switch( $( this ).val() ) {
					case '1':
						var data = [{ id: '1', text: 'Testing again' },{ id: '2', text: 'Testing 2' }];
					break;
					case '2':
						var data = [{ id: '2', text: 'Testing 2' }];
					break;	
				}
				
				
				$( '#testing' ).select2options( data );
			});
		}
	}
}();