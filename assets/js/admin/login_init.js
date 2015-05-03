var Login = function() {
	return {
		init: function() {
			var login_form = $( '#login-form' );
			
			login_form.on( 'submit', function( e ) {
				e.preventDefault();
				
				var form_data = $( this ).serialize();
				$.post( 'login/authenticate_admin', form_data, function( data ) {
					gen_toastr( data );
				});
			});
		}
	};
}();