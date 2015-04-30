<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

function gen_toastr_msg( $type, $title, $message, $redirect = '' ) {
	echo "$type|$title|$message|$redirect";
}

function gen_form_hidden_input( $field_id, $value ) {
	return '<input type="text" name="' . $field_id . '" id="' . $field_id . '" value="' . $value . '" hidden>';
}

function gen_form_std_wrapper( $label = '', $input ) {	
	$form  = '<div class="form-group">';
	if( $label != 'none' ) {
		$form .= '<label>' . $label . '</label>';
	}
	$form	.= $input;
	$form .= '</div>';
	return $form;
}

function gen_form_inp_wrapper( $label = '', $input, $icon ) {
	$form  = '<div class="form-group">';
	$form .= '<label>' . $label . '</label>';
	$form	.= '<div class="input-group">';
	$form	.= '<span class="input-group-addon">';
	$form	.= '<i class="fa fa-' . $icon . '"></i>';
	$form	.= '</span>';
	$form	.= $input;
	$form .= '</div>';
	$form .= '</div>';
	return $form;
}

function gen_form_inl_wrapper( $label = '', $input ) {
	$form  = '<div class="form-group">';
	$form .= '<label class="col-md-4 control-label">' . $label . '</label>';
	$form	.= '<div class="col-md-8">';
	$form	.= $input;
	$form .= '</div>';
	$form .= '</div>';
	return $form;
}

function gen_form_text( $label, $field_id, $value = '', $params = array(), $wrapper = 'standard', $return = FALSE ) {
	$params['cclass'] 			= isset( $params['cclass'] ) ? $params['cclass'] : '';
	$params['coption'] 			= isset( $params['coption'] ) ? $params['coption'] : '';
	$params['name'] 				= isset( $params['name'] ) ? $params['name'] : $field_id;
	$params['placeholder'] 	= isset( $params['placeholder'] ) ? $params['placeholder'] : $label;
	$params['type'] 				= isset( $params['type'] ) ? $params['type'] : 'text';
	
	if( isset( $params['icon'] ) ) {
		$wrapper = 'input';
	}
	
	$input = '<input type="' . $params['type'] . '" id="' . $field_id . '" name="' . $params['name'] . '" class="form-control ' . $params['cclass'] . '" placeholder="' . $params['placeholder'] . '" value="' . $value . '" ' . $params['coption'] . '>';
	
	switch( $wrapper ) {
		case 'standard':
			if( $return === TRUE ) {
				return gen_form_std_wrapper( $label, $input );
			} else {
				echo gen_form_std_wrapper( $label, $input );
			}
		break;
		case 'inline':
			if( $return === TRUE ) {
				return gen_form_inl_wrapper( $label, $input );
			} else {
				echo gen_form_inl_wrapper( $label, $input );
			}
		break;
		case 'input':
			if( $return === TRUE ) {
				return gen_form_inp_wrapper( $label, $input, $params['icon'] );
			} else {
				echo gen_form_inp_wrapper( $label, $input, $params['icon'] );
			}
		break;
	}
}

function gen_form_select( $label, $field_id, $options, $selected_value = '', $params = array(), $wrapper = 'standard', $return = FALSE ) {
	$params['cclass'] 			= isset( $params['cclass'] ) ? $params['cclass'] : '';
	$params['coption'] 			= isset( $params['coption'] ) ? $params['coption'] : '';
	$params['name'] 				= isset( $params['name'] ) ? $params['name'] : $field_id;
	$params['placeholder'] 	= isset( $params['placeholder'] ) ? $params['placeholder'] : 'Select...';
	$params['type'] 				= isset( $params['type'] ) ? $params['type'] : 'text';
	
	$select	= '<select id="' . $field_id . '" name="' . $params['name'] . '" class="form-control select2me ' . $params['cclass'] . '" data-placeholder="' . $params['placeholder'] . '" ' . $params['coption'] . '>';
	$select .= '<option value=""></option>';
	foreach( $options as $key => $value ) {
		if( $key == $selected_value ) {
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$select .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
	}
	$select .= '</select>';
	
	switch( $wrapper ) {
		case 'standard':
			if( $return === TRUE ) {
				return gen_form_std_wrapper( $label, $select );
			} else {
				echo gen_form_std_wrapper( $label, $select );
			}
		break;
		case 'inline':
			if( $return === TRUE ) {
				return gen_form_inl_wrapper( $label, $select );
			} else {
				echo gen_form_inl_wrapper( $label, $select );
			}
		break;
		case 'input':
			if( $return === TRUE ) {
				return gen_form_inp_wrapper( $label, $select, $params['icon'] );
			} else {
				echo gen_form_inp_wrapper( $label, $select, $params['icon'] );
			}
		break;
	}
}

function gen_form_multi_select( $label, $field_id, $options, $selected_values = array(), $params = array(), $wrapper = 'standard', $return = FALSE ) {
	$params['cclass'] 			= isset( $params['cclass'] ) ? $params['cclass'] : '';
	$params['coption'] 			= isset( $params['coption'] ) ? $params['coption'] : '';
	$params['name'] 				= isset( $params['name'] ) ? $params['name'] : $field_id;
	$params['placeholder'] 	= isset( $params['placeholder'] ) ? $params['placeholder'] : 'Select...';
	$params['type'] 				= isset( $params['type'] ) ? $params['type'] : 'text';
	
	$select	= '<select id="' . $field_id . '" name="' . $params['name'] . '[]" class="form-control select2me ' . $params['cclass'] . '" data-placeholder="' . $params['placeholder'] . '" ' . $params['coption'] . ' multiple>';
	$select .= '<option value=""></option>';
	foreach( $options as $key => $value ) {
		if( array_key_exists( $key, $selected_values ) ) {
			$selected = 'selected';
		} else {
			$selected = '';
		}
		$select .= '<option value="' .$key . '" ' . $selected . '>' . $value . '</option>';
	}
	$select .= '</select>';
	
	switch( $wrapper ) {
		case 'standard':
			if( $return === TRUE ) {
				return gen_form_std_wrapper( $label, $select );
			} else {
				echo gen_form_std_wrapper( $label, $select );
			}
		break;
		case 'inline':
			if( $return === TRUE ) {
				return gen_form_inl_wrapper( $label, $select );
			} else {
				echo gen_form_inl_wrapper( $label, $select );
			}
		break;
		case 'input':
			if( $return === TRUE ) {
				return gen_form_inp_wrapper( $label, $select, $params['icon'] );
			} else {
				echo gen_form_inp_wrapper( $label, $select, $params['icon'] );
			}
		break;
	}
}

function gen_modal_actions() {
	$actions =<<<EOD
		<button type="button" class="btn default" data-dismiss="modal">Close</button>
		<button type="submit" class="btn green">Submit</button>
EOD;
	return $actions;
}



function gen_widget_select( $selected_id = '' ) {
	$widget_options = array();
	
	$CI =& get_instance();
	$CI->load->database();
	
	$CI->db->order_by( 'alias' );
	$query = $CI->db->get( 'widget' );
	
	if( $query->num_rows() > 0 ) {
		foreach( $query->result_array() as $row ) {
			extract( $row );
			
			$widget_options[$widget_id] = $alias;
		}
	}
	
	return gen_form_select( 'Widget', 'widget_id', $widget_options, $selected_id );
}