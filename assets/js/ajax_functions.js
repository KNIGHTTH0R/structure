function gen_toastr( results ) {
	toastr.options = {
	  "closeButton": true,
	  "debug": false,
	  "positionClass": "toast-top-center",
	  "onclick": null,
	  "showDuration": "1000",
	  "hideDuration": "1000",
	  "timeOut": "5000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	results = results.split( '|' );
	switch( results[0] ) {
		case 's':
			toastr.success( 'Successfully ' + results[1], 'Success!' );
			if( results[2].length != 0 ) {
				setTimeout( function(){
					window.location.replace( results[2] );
				}, 1500 );
			}
		break;
		case 'w':
			toastr.warning( results[1], 'Warning!' );
		break;
		case 'e':
			toastr.error( 'Failed to ' + results[1], 'Error!' );
		break;
	}
}

function status_update( processing_file ) {
	$( '.status' ).on( 'click', function() {
		var publish = $( this );
		
		publish.toggleClass( 'fa-spinner fa-spin' );
		
		var target_id = publish.attr( 'data-value' );
		
		var status = publish.hasClass( 'unpublish' ) ? '-' : '+';
		
		var status_data = [
			{ name: 'target_id', value: target_id },
			{ name: 'status', value: status }
		];
		
		$.post( processing_file, status_data, function() {
			setTimeout( function() {
				publish.toggleClass( 'unpublish publish' );
				publish.toggleClass( 'font-green font-grey-cascade' );
				publish.removeClass( 'fa-spinner fa-spin' );
			}, 500 );
		});
	});
}

function gen_spinner( target ) {
	$( target ).prepend( '<a class="fa fa-spinner fa-spin font-green no-decoration loading-spinner"></a>' );			
	setTimeout( function() {
		window.location.reload();
	}, 500 );
}