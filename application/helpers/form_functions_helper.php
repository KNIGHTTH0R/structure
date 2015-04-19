<?php

/** Base Functions **/
function gen_input_addon( $input, $addon ) {
	extract( $addon );
	
	$align = isset( $align ) ? $align : 'left';
	$class = isset( $class ) ? $class : 'btn-default';
	
	switch( $type ) {
		case 'button':
		  $inputAddon = '<div class="input-group-btn"><button type="button" class="btn ' . $class . '">' . $option . '</button></div>';
		break;
		case 'dropdown':
		  $inputAddon = '<div class="input-group-btn">' . gen_button_dropdown( 'standard', $dropdown ) . '</div>';
		break;
		case 'icon':
		  $inputAddon = '<span class="input-group-addon"><i class="fa fa-' . $option . '"></i></span>';
		break;
		case 'input':
		  $inputAddon = '<span class="input-group-addon">' . $option . '</span>';
		break;
		case 'segmented':
		  $inputAddon = '<div class="input-group-btn">' . gen_button_dropdown( 'segmented', $dropdown ) . '<button type="button" class="btn ' . $class . '">' . $option . '</button></div>';
		break;
		case 'text':
		  $inputAddon = '<span class="input-group-addon">' . $option . '</span>';
		break;
	}
	
	if( $align == 'left' ) {
		return '<div class="input-group">' . $inputAddon . $input . '</div>';
	} else {
		return '<div class="input-group">' . $input . $inputAddon  . '</div>';
	}
}

function gen_button_dropdown( $type, $dropdown ) {
	switch( $type ) {
		case 'segmented':
		  $text = '';
		break;
		default:
			$text = 'Action';
	}
	$buttonDropdown  = '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' . $text . ' <span class="caret"></span></button>';
	$buttonDropdown .= '<ul class="dropdown-menu" role="menu">';
	
	foreach( $dropdown as $link => $linkText ) {
		$buttonDropdown .= '<li><a href="' . $link . '">' . $linkText . '</a></li>';
	}
	
	$buttonDropdown .= '</ul>';
	return $buttonDropdown;
}

function gen_input_position( $label, $input, $align, $inline = '' ) {
	switch( TRUE ) {
		case ( ! empty( $inline ) ):
		  if( $align == 'left' ) {
		  	$return_input = $label . '<div class="col-md-' . ( 12 - $inline ) . '">' . $input . '</div>';
		  } else {
		  	$return_input = '<div class="col-md-' . ( 12 - $inline ) . '">' . $input . '</div>' . $label;
		  }
		break;
		default:
		  if( $align == 'left' ) {
		  	$return_input = $label . $input;
		  } else {
		  	$return_input = $input . $label;
		  }
	}
	return $return_input;
}

function gen_help_block( $help ) {
	return '<span class="help-block">' . $help . '</span>';
}

function gen_input( $label = '', $field_name, $value = '', $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $field_name;
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	$type        = isset( $type ) ? $type : 'text';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $field_name . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$input = '<input type="' . $type . '" class="form-control ' . $class. '" id="' . $field_name . '" name="' . $name . '" placeholder="' . $placeholder . '" value="' . $value . '" ' . $prop . '>';
	
	if( ! empty( $addon ) ) {
		$input = gen_input_addon( $input, $addon );
	}
	
	if( ! empty( $help ) ) {
		$input = $input . gen_help_block( $help );
	}
	
	$return_input = gen_input_position( $label, $input, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $return_input . '</div>';
	} else {
		echo '<div class="form-group">' . $return_input . '</div>';
	}
}

function gen_select( $label = '', $field_name, $options, $selected_option = '', $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $field_name;
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $field_name . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$select = '<select class="form-control select2me ' . $class. '" id="' . $field_name . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $prop . '>';
	
	$select .= '<option value=""></option>';
	foreach( $options as $option_value => $option_text ) {
		$selected = $option_value == $selected_option ? 'selected' : '';
		$select  .= '<option value="' . $option_value . '" ' . $selected . '>' . $option_text . '</option>';
	}	
	$select .= '</select>';
	
	if( ! empty( $addon ) ) {
		$select = gen_input_addon( $select, $addon );
	}
	
	if( ! empty( $help ) ) {
		$select = $select . gen_help_block( $help );
	}
	
	$return_input = gen_input_position( $label, $select, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $return_input . '</div>';
	} else {
		echo '<div class="form-group">' . $return_input . '</div>';
	}
}

function gen_multi_select( $label = '', $field_name, $options, $selectedValues = [], $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $field_name . '[]';
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $field_name . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$select = '<select class="form-control ' . $class. '" id="' . $field_name . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $prop . ' multiple>';
	
	$select .= '<option value=""></option>';
	foreach( $options as $optionValue => $optionText ) {
		$selected = in_array( $optionValue, $selectedValues ) ? 'selected' : '';
		$select  .= '<option value="' . $optionValue . '" ' . $selected . '>' . $optionText . '</option>';
	}	
	$select .= '</select>';
	
	if( ! empty( $addon ) ) {
		$select = gen_input_addon( $select, $addon );
	}
	
	if( ! empty( $help ) ) {
		$select = $select . gen_help_block( $help );
	}
	
	$return_input = gen_input_position( $label, $select, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $return_input . '</div>';
	} else {
		echo '<div class="form-group">' . $return_input . '</div>';
	}
}

function gen_hidden_input( $field_name, $value, $return = FALSE ) {
	if( $return === TRUE ) {
		return '<input type="text" value="' . $value . '" name="' . $field_name . '" hidden>';
	} else {
		echo '<input type="text" value="' . $value . '" name="' . $field_name . '" hidden>';
	}
}

/** General Form Functions **/
function gen_form_actions( $cancel = '', $params = [] ) {
	$params['submit_text']	= isset( $params['submit_text'] ) ? $params['submit_text'] : 'Submit';
	
	if( $cancel == 'none' ) {
		$cancel = '';
	} else {
		$cancel = '<a href="' . $cancel . '"><button type="button" class="btn default">Cancel</button></a> ';
	}
	
	$actions  = $cancel;
	$actions .= '<button type="submit" class="btn green">' . $params['submit_text'] . '</button>';

	return $actions;
}

function gen_form_entup( $entered, $updated ) {
	$entered = ! empty( $entered ) ? date( 'm/d/Y h:i a', strtotime( $entered ) ) : 'None';
	$updated = ! empty( $updated ) ? date( 'm/d/Y h:i a', strtotime( $updated ) ) : 'None';
	$entered_input 	= gen_input( 'Entered', 'entered', $entered, [ 'prop' => 'disabled' ], TRUE );
	$updated_input	= gen_input( 'Updated', 'updated', $updated, [ 'prop' => 'disabled' ], TRUE );
	
	$entup  = '<h4 class="col-md-12">Record Info</h4>';
	$entup .= '<div class="col-md-6">' . $entered_input .	'</div>';
	$entup .= '<div class="col-md-6">' . $updated_input . '</div>';

	echo $entup;
}

/** Custom Inputs **/
function gen_object_select( $selected_option = '', $args = [], $return = FALSE ) {
	$object_options = [];
	
	$CI =& get_instance();
	$CI->load->database();
	
	$CI->db->order_by( 'title' );
	$query = $CI->db->get( 'object' );
	
	if( $query->num_rows() > 0 ) {
		$object_options = array_column( $query->result_array(), 'title', 'object_id' );
	}
	
	return gen_select( 'Object', 'object_id', $object_options, $selected_option, $args, $return );
}