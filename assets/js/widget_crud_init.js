var Widget_list = function() {
	return {
		init: function() {
			status_update( site_url + 'admin/widgets/status' );
		}
	}
}();

var Widget_create = function() {
	return {
		init: function() {
			$( '#object_id' ).on( 'change', function() {
				if( $( this ).val() == '' ) {
					return;
				}
				$( '.select2me' ).select2( 'destroy' );
				$.get( site_url + 'admin/widgets/get_object_params/' + $( this ).val(), function( data ) {
					var line_break = $( '<div>', { class: 'col-md-12', html: '<hr>' } );
					$( '#object-area' ).html( data );
					$( '#object-area' ).prepend( line_break );
					$( '.summernote' ).summernote( { height: 250 } );
					$( '.make-switch' ).bootstrapSwitch();
					$( '.select2me' ).select2();
				});
			});
			
			$( '#widget-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				$( 'text-area' ).val( $( '.summernote' ).code() );
				var params = [];
				$( '.widget-params:not(.select2-container)', this ).each( function() {
					var current_value = $( this ).val().toString();
					if( current_value.indexOf( ',' ) === -1 ) {
						var push_value = current_value;
					} else {
						var push_value = current_value.split( ',' );	
						push_value = push_value.join( '^!' );					
					}
					params.push( push_value );
				});
				params = params.join( '|' );
				var form_data = $( this ).serialize() + '&params=' + params;				
				$.post( site_url + 'admin/widgets/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Widget_revise = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				$( '.summernote' ).summernote( { height: 250 } );
			});
			
			$( '#widget-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				$( 'textarea' ).val( $( '.summernote' ).code() );
				var params = [];
				$( '.widget-params:not(.select2-container)', this ).each( function() {
					var current_value = $( this ).val();
					
					if( current_value === null ) {
						current_value = '';
					} else {
						current_value.toString();
					}
					
					if( current_value.indexOf( ',' ) === -1 ) {
						var push_value = current_value;
					} else {
						var push_value = current_value.split( ',' );	
						push_value = push_value.join( '^!' );					
					}
					
					params.push( push_value );
				});
				params = params.join( '|' );
				var form_data = $( this ).serialize() + '&params=' + params;
				
				$.post( site_url + 'admin/widgets/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();