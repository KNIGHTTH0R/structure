var Widgets_list = function() {
	return {
		init: function() {
			status_update( site_url + 'admin/widgets/status' );
		}
	}
}();

var Widgets_create = function() {
	return {
		init: function() {
			$( '#object_id' ).on( 'change', function() {
				if( $( this ).val() == '' ) {
					return;
				}
				$( '.select2me' ).select2( 'destroy' );
				$.get( site_url + 'admin/widgets/get_object_params/' + $( this ).val(), function( data ) {
					var line_break = $( '<div>', { class: 'col-md-12' } );
					$( '#object-area' ).html( data );
					$( '#object-area' ).prepend( line_break );
					$( '.summernote' ).summernote( { height: 250 } );
					$( '.make-switch' ).bootstrapSwitch();
					$( '.select2me' ).select2();
				});
			});
			
			$( '#widget-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				$( 'textarea' ).val( $( '.summernote' ).code() );
				var form_data = $( this ).serialize();				
				$.post( site_url + 'admin/widgets/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Widgets_revise = function() {
	return {
		init: function() {
			$( document ).ready( function() {
				$( '.summernote' ).summernote( { height: 250 } );
			});
			
			$( '#widget-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				$( 'textarea' ).val( $( '.summernote' ).code() );
				
				var form_data = $( this ).serialize();
				$.post( site_url + 'admin/widgets/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();