var Datatables = function() {
	var standard_table = function() {
		if( $( '.standard-table' ).length != 0 ) {
			gen_ui_datatable( '.standard-table' );
		}
	}

	return {
		init: function() {
			standard_table();
		}
	};
}();