var page_content = $( '.page-content' );
var sign_in      = $( '.sign-in' );
var sign_out     = $( '.sign-out' );

function content_resize() {
	var vph = $( window ).height();
	vph = parseInt( vph ) - 145;
	page_content.css({ 'min-height': vph + 'px'});
}

$( document ).ready( function() {
	content_resize();
});

$( window ).resize( function() {
	content_resize();
});

$( '#front-form' ).on( 'submit', function( e ) {
	e.preventDefault();
	var form_data = $( this ).serialize();
	$.post( '/structure/admin/authentication/authenticate_user', form_data, function( data ) {
		gen_toastr( data );
		if( data[0] == 's' ) {
			$( '#front-modal' ).modal( 'hide' );
		}
	});
});

sign_out.on( 'click', function() {
	$.post( '/structure/admin/authentication/logout_user', function() {
		window.location = '/structure/home'; 
	});
});