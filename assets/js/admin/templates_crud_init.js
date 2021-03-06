var column_resize = function() {
	var count					= 0;
	var targets				= [];
	var heights				= [];
	$( '.framework-preview-column' ).each( function() {
		
		if( $( this ).hasClass( 'column-count-12' ) ) {
			return;
		}
		
		var classes = $( this ).attr( 'class' ).split( " " );
		for( var i = 0; i < classes.length; i++ ) {
			if( classes[i].indexOf( 'column-count' ) >= 0 ) {
				targets.push( $( this ) );
				heights.push( $( this ).height() );
				count += parseFloat( classes[i].split( '-' ).pop() );
			}
		}
	});
	if( count == 12 ) {
		var resize_height = 0;
		for( var i = 0; i < heights.length; i++ ) {
			if( resize_height == 0 ) {
				resize_height = heights[i];
			} else if( heights[i] > resize_height ) {
				resize_height = heights[i];
			}
		}
		for( var i = 0; i < targets.length; i++ ) {
			if( targets[i].css( 'min-height', resize_height ) ) {
				continue;
			}
			targets[i].height( resize_height );
		}
	}
}

var Templates_list = function() {
	return {
		init: function() {
			$( '.status' ).on( 'click', function() {
				status_update( $( this ), 'admin/templates/status' );
			});
		}
	}
}();

var Templates_create = function() {
	return {
		init: function() {
			var framework_wrapper = $( '#framework-wrapper' );
			var template_wrapper	= $( '#template-wrapper' );
			var framework_preview	= $( '#framework-item-preview' );
			var target_column			= '';
			var widget_add        = $( '.widget-add' );
			var widget_add_form		= $( '#widget-add-form' );
			var widget_add_modal  = $( '#widget-add-modal' );
			
			$( '.framework-preview-wrapper' ).on( 'click', function( e ) {
				e.preventDefault();
				
				
				$( '#column_id option' ).not( ':first' ).remove();
				var framework_preview_wrapper = $( this ).html();
				var framework_id							= $( this ).attr( 'id' ).split( '-' ).pop();
				
				framework_wrapper.fadeOut( function() {
					template_wrapper.fadeIn();
					$( '#framework_id' ).select2( 'val', framework_id );
					
					framework_preview.html( framework_preview_wrapper ).slideDown();
					
					var count = 1;
					$( '.column-content', framework_preview ).each( function( i ) {
						if( $( '.list-group-title', this ).text() == 'No Widgets' ) {
							return;
						}
						
						$( '#column_id' ).append( '<option value="' + count + '">' + $( this ).text() + '</option>' );
						count++;
					});
					
					$( ".list-group" ).sortable({
						axis: 'y',
	          opacity: 0.8,
	          tolerance: "pointer",
	          helper: "clone",
	          cursor: "pointer",
	          revert: 250, // animation in milliseconds
	        });
				});
			});
			
			widget_add.on( 'click', function() {
				widget_add_modal.modal( 'show' );
			});
			
			widget_add_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var column				= $( '#column_id' ).val();
				var widget_id 		= $( '#widget_id' ).val();
				var widget_alias	= $( "#widget_id option[value='" + widget_id + "']" ).text();
				$( '#widget-column-' + column + ' ul', framework_preview ).append( '<li id="widget-id-' + widget_id + '" class="list-group-item child-item"><i class="fa fa-sort"></i>' + widget_alias + '<a href="javascript:;" class="fa fa-times pull-right widget-delete"></a></li>' );
				
				//column_resize();
				widget_add_modal.modal( 'hide' );
			});
			
			$( '#framework_id' ).on( 'change', function() {
				if( $( this ).val() == '' ) {
					return;
				}
				
				$.get( site_url + 'admin/templates/framework_item_preview/' + $( this ).val(), function( data ) {
					var sequence_ul = $( '<ul id="sequence-list"></ul>' );
					sequence_ul.append( data );
					framework_preview.html( sequence_ul ).slideDown();
					
					$( ".list-group" ).sortable({
							axis: 'y',
	            opacity: 0.8,
	            tolerance: "pointer",
	            helper: "clone",
	            cursor: "pointer",
	            revert: 250, // animation in milliseconds
	        });
	        
					var count = 1;
					$( '.framework-preview-column', framework_preview ).each( function( i ) {
						if( $( this ).hasClass( 'no-widgets' ) ) {
							return;
						}
						$( '#column_id' ).append( '<option value="' + count + '">' + $( this ).text() + '</option>' );
						count++;
					});
				});
			});
			
			$( '#template-create' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				var template_data = [];
				
				$( '.list-group', framework_preview ).each( function() {
					var column_id = $( this ).parent().attr( 'id' ).split( '-' ).pop();
					$( 'li', this ).each( function( e ) {
						template_data.push( 'position' + '[column_' + column_id + ']' + '[' + e + ']=' + this.id.split( '-' ).pop() );
					});
				});
				
				form_data = form_data + '&' + template_data.join( '&' );
				$.post( site_url + 'admin/templates/insert', form_data, function( data ) {
					gen_toastr( data );
				});
			});
			
			framework_preview.on( 'click', '.widget-delete', function() {
				$( this ).parent().remove();
			});
			
			$( ".form-actions button[type='button']" ).on( 'click', function( e ) {
				e.preventDefault();
				
				template_wrapper.fadeOut( function() {
					framework_wrapper.fadeIn();
					framework_preview.html( '' ).hide();
				});
			});
		}
	}
}();

var Templates_revise = function() {
	return {
		init: function() {
			var framework_wrapper = $( '#framework-wrapper' );
			var template_wrapper	= $( '#template-wrapper' );
			var framework_preview	= $( '#framework-item-preview' );
			var target_column			= '';
			var widget_add        = $( '.widget-add' );
			var widget_add_form		= $( '#widget-add-form' );
			var widget_add_modal  = $( '#widget-add-modal' );
			
			$( document ).ready( function() {
				
				$( ".list-group" ).sortable({
						axis: 'y',
            opacity: 0.8,
            tolerance: "pointer",
            helper: "clone",
            cursor: "pointer",
            revert: 250, // animation in milliseconds
        });
        
        var count = 1;
				$( '.column-content', framework_preview ).each( function( i ) {
					if( $( '.list-group-title', this ).text() == 'No Widgets' ) {
						return;
					}
					
					$( '#column_id' ).append( '<option value="' + count + '">' + $( '.list-group-title', this ).text() + '</option>' );
					count++;
				});
			});
			
			widget_add.on( 'click', function() {
				widget_add_modal.modal( 'show' );
			});
			
			widget_add_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var column				= $( '#column_id' ).val();
				var widget_id 		= $( '#widget_id' ).val();
				var widget_alias	= $( "#widget_id option[value='" + widget_id + "']" ).text();
				$( '#widget-column-' + column + ' ul', framework_preview ).append( '<li id="widget-id-' + widget_id + '" class="list-group-item child-item"><i class="fa fa-sort"></i>' + widget_alias + '<a href="javascript:;" class="fa fa-times pull-right widget-delete"></a></li>' );
				
				widget_add_modal.modal( 'hide' );
			});
			
			framework_preview.on( 'click', '.widget-delete', function() {
				$( this ).parent().remove();
				column_resize();
			});
			
			$( '#template-revise' ).on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				var template_data = [];
				
				$( '.list-group', framework_preview ).each( function() {
					var column_id = $( this ).parent().attr( 'id' ).split( '-' ).pop();
					$( 'li', this ).each( function( e ) {
						template_data.push( 'position' + '[column_' + column_id + ']' + '[' + e + ']=' + this.id.split( '-' ).pop() );
					});
				});
				
				form_data = form_data + '&' + template_data.join( '&' );
				$.post( site_url + 'admin/templates/update', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	}
}();