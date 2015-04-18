function gen_ui_datatable( field_id, return_param ) {
	var return_param = return_param || false;
	
	var table = $( field_id ).DataTable({
		"aaSorting": [],
		"aLengthMenu": [
			[ 15, 25, 50, -1 ],
			[ 15, 25, 50, "All" ]
		]
	});
	$( '.dataTables_length' ).find( 'label' ).prepend( 'Show' );
	$( '.dataTables_length' ).find( 'select' ).select2();
	if( return_param === true ) { 
		return table;
	}
}

function gen_ui_framework_block( columns, num_columns, count ) {
	var framework_wrapper = $( '<div id="framework-row-' + count + '" class="row framework-wrapper" style="margin: 0px;"></div>' );
	var portlet 					= $( '<div class="portlet light bordered"></div>' );
	
	portlet.append( '<div class="portlet-title"></div>' );
	$( '.portlet-title', portlet ).append( '<div class="caption"><span class="caption-subject uppercase bold">Content Row</span></div>' );
	$( '.portlet-title', portlet ).append( '<div class="actions"><a class="btn btn-cicle btn-icon-only btn-default framework-delete" href="javascript:;" data-value="' + count + '"><i class="fa fa-trash"></i></a></div>' );
	portlet.append( '<div class="portlet-body"></div>' );
	$( '.portlet-body', portlet ).append( '<div class="row" style="padding: 15px;"></div>' );
	
	for( var i = 0; i < num_columns; i++ ) {
		var framework_column = $( '<div class="col-md-' + columns + ' framework-row"></div>' );
		framework_column.append( '<div class="bg-green"></div>' );
		
		var widget_input 	= '<div class="form-group"><label class="control-label col-md-3">Allow Widgets?</label><div class="col-md-9"><input type="checkbox" class="make-switch" data-size="small" name="framework-widgets-' + i + '-' + count + '" value="y" checked /></div></div>';
		var width_input		= '<div class="form-group"><label class="control-label col-md-3">Column Width</label><div class="col-md-9"><input class="form-control input-small" type="text" name="framework-column-' + i + '-' + count + '" value="' + columns + '" /></div></div>';
		$( '.bg-green', framework_column ).append( widget_input );
		$( '.bg-green', framework_column ).append( width_input );
		$( '.portlet-body .row', portlet ).append( framework_column );
	}
	
	framework_wrapper.append( portlet );
	return framework_wrapper;
}

function gen_ui_object_params_options() {
	var form_group					= $( '<div>', { class: 'form-group' } );
	
	var label_input					= form_group.clone().append( $( '<input>', { type: 'text', class: 'form-control object-params', placeholder: 'Label' } ) );
	var variable_input			= form_group.clone().append( $( '<input>', { type: 'text', class: 'form-control object-params', placeholder: 'Variable Name' } ) );
	var select							= form_group.clone().append( $( '<input>', { type: 'text', class: 'form-control object-params params-select', placeholder: 'Select...' } ) );
	var params_wrapper			= $( '<div>', { class: 'params-wrapper' } );
	var add_button					= $( '<button>', { type: 'button', class: 'btn blue add-params', text: 'Add More' } );
	
	var column_1						= $( '<div>', { class: 'col-md-4' } ).append( select );
	var column_2						= $( '<div>', { class: 'col-md-3' } ).append( label_input );
	var column_3						= $( '<div>', { class: 'col-md-3' } ).append( variable_input );				
	var column_4						= $( '<div>', { class: 'col-md-2' } ).append( add_button );
	
	params_wrapper.append( column_1 );
	params_wrapper.append( column_2 );
	params_wrapper.append( column_3 );
	params_wrapper.append( column_4 );
	
	return params_wrapper;
}