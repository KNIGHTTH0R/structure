var Objects_list = function() {
	return {
		init: function() {
			status_update( site_url + 'admin/objects/status' );
		}
	}
}();

var Objects_create = function() {
	return {
		init: function() {
			var file 								= $( '#file' );
			var params_container		= $( '#params-container' );
			var options							= [{ id: 'text', text: 'Text Input' }, { id: 'select', text: 'Select' }, { id: 'multi', text: 'Multi-Select' },{ id: 'toggle', text: 'Toggle Switch' }, { id: 'wysiwyg', text: 'WYSIWYG' }];
			
			$( document ).ready( function() {
				params_container.append( gen_ui_object_params_options() );
				$( '.params-select', params_container ).select2({ data: options });
			});
			
			params_container.on( 'click', '.add-params', function() {
				$( this ).text( 'Remove' ).toggleClass( 'blue add-params remove-params red' );
				
				$( '.params-select' ).select2( 'destroy' );
				params_container.append( gen_ui_object_params_options() );
				$( '.params-select', params_container ).select2({ data: options });
			});
			
			params_container.on( 'click', '.remove-params', function() {
				$( this ).parents( '.params-wrapper' ).remove();
			});
			
			params_container.on( 'change', '.params-select', function() {
				$( this ).parents( '.params-wrapper' ).find( '.params-tags' ).parents( '.col-md-10' ).remove();
				if( $( this ).val() == '' || $( this ).val() == 'text' || $( this ).val() == 'toggle' || $( this ).val() == 'wysiwyg' ) {
					return;
				}
				
				$( '.params-tags' ).select2( 'destroy' );
			$( this ).parents( '.params-wrapper' ).append( $( '<div>', { class: 'col-md-10' } ).append( $( '<div>', { class: 'form-group' } ) .append( $( '<input>', { class: 'form-control object-params params-tags', placeholder: 'Enter new options...' } ) ) ) );
				$( '.params-tags' ).select2({ tags: [] });
			});
			
			file.on( 'change', function() {
				if( $( this ).val() == '' ) {
					return;
				}
				
				$( '#param-container' ).html( '' );
			});
					
			$( '#object-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var object_params = [];
				var params = [];
				$( '.params-wrapper', params_container ).each( function() {
					params = [];
					$( '.object-params', this ).each( function() {
						if( $( this ).val() == '' ) {
							return;
						}
						
						if( $( this ).val().indexOf( ',' ) ) {
							var push_value = $( this ).val().split( ',' );
							push_value = push_value.join( '^!' );
						} else {
							var push_value = $( this ).val();
						}
						params.push( push_value );
					});
					params = params.join( '|' );
					object_params.push( params );
				});
				object_params = object_params.join( '~' );
				var form_data = $( this ).serialize() + '&params=' + object_params;
				$.post( site_url + 'admin/objects/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();

var Objects_revise = function() {
	return {
		init: function() {			
			$( '#object-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var object_params = [];
				var params = [];
				params = [];
				$( '.widget-params', this ).each( function() {
					
					if( $( this ).val().indexOf( ',' ) ) {
						var push_value = $( this ).val().split( ',' );
						push_value = push_value.join( '^!' );
					} else {
						var push_value = $( this ).val();
					}
					params.push( push_value );
				});
				params = params.join( '|' );
				object_params.push( params );
				object_params = object_params.join( '~' );
				var form_data = $( this ).serialize() + '&params=' + object_params;
				$.post( site_url + 'admin/objects/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();