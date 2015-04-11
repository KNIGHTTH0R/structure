<?php

function genInputAddon( $input, $addon ) {
	extract( $addon );
	
	$align = isset( $align ) ? $align : 'left';
	$class = isset( $class ) ? $class : 'btn-default';
	
	switch( $type ) {
		case 'button':
		  $inputAddon = '<div class="input-group-btn"><button type="button" class="btn ' . $class . '">' . $option . '</button></div>';
		break;
		case 'dropdown':
		  $inputAddon = '<div class="input-group-btn">' . genButtonDropdown( 'standard', $dropdown ) . '</div>';
		break;
		case 'icon':
		  $inputAddon = '<span class="input-group-addon"><i class="fa fa-' . $option . '"></i></span>';
		break;
		case 'input':
		  $inputAddon = '<span class="input-group-addon">' . $option . '</span>';
		break;
		case 'segmented':
		  $inputAddon = '<div class="input-group-btn">' . genButtonDropdown( 'segmented', $dropdown ) . '<button type="button" class="btn ' . $class . '">' . $option . '</button></div>';
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

function genButtonDropdown( $type, $dropdown ) {
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

function genInputPosition( $label, $input, $align, $inline = '' ) {
	switch( TRUE ) {
		case ( ! empty( $inline ) ):
		  if( $align == 'left' ) {
		  	$returnInput = $label . '<div class="col-md-' . ( 12 - $inline ) . '">' . $input . '</div>';
		  } else {
		  	$returnInput = '<div class="col-md-' . ( 12 - $inline ) . '">' . $input . '</div>' . $label;
		  }
		break;
		default:
		  if( $align == 'left' ) {
		  	$returnInput = $label . $input;
		  } else {
		  	$returnInput = $input . $label;
		  }
	}
	return $returnInput;
}

function genHelpBlock( $help ) {
	return '<span class="help-block">' . $help . '</span>';
}

function genInput( $label = '', $fieldName, $value = '', $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $fieldName;
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	$type        = isset( $type ) ? $type : 'text';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $fieldName . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$input = '<input type="' . $type . '" class="form-control ' . $class. '" id="' . $fieldName . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $prop . '>';
	
	if( ! empty( $addon ) ) {
		$input = genInputAddon( $input, $addon );
	}
	
	if( ! empty( $help ) ) {
		$input = $input . genHelpBlock( $help );
	}
	
	$returnInput = genInputPosition( $label, $input, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $returnInput . '</div>';
	} else {
		echo '<div class="form-group">' . $returnInput . '</div>';
	}
}

function genSelect( $label = '', $fieldName, $options, $selectedValue = '', $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $fieldName;
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $fieldName . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$select = '<select class="form-control ' . $class. '" id="' . $fieldName . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $prop . '>';
	
	$select .= '<option value=""></option>';
	foreach( $options as $optionValue => $optionText ) {
		$selected = $optionValue == $selectedValue ? 'selected' : '';
		$select  .= '<option value="' . $optionValue . '" ' . $selected . '>' . $optionText . '</option>';
	}	
	$select .= '</select>';
	
	if( ! empty( $addon ) ) {
		$select = genInputAddon( $select, $addon );
	}
	
	if( ! empty( $help ) ) {
		$select = $select . genHelpBlock( $help );
	}
	
	$returnInput = genInputPosition( $label, $select, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $returnInput . '</div>';
	} else {
		echo '<div class="form-group">' . $returnInput . '</div>';
	}
}

function genMultiSelect( $label = '', $fieldName, $options, $selectedValues = [], $args = [], $return = FALSE ) {
	extract( $args );
	
	/** Input Arguments **/
	$align       = isset( $align ) ? $align : 'left';
	$class       = isset( $class ) ? $class : '';
	$inline      = isset( $inline ) ? $inline : '';
	$name        = isset( $name ) ? $name : $fieldName . '[]';
	$placeholder = isset( $placeholder ) ? $placeholder : $label;
	$prop        = isset( $prop ) ? $prop : '';
	/** End Arguments **/
	
	if( ! empty( $label ) ) {
		$labelClass = isset( $inline ) ? 'col-md-' . $inline : '';
		$label = '<label for="' . $fieldName . '" class="control-label ' . $labelClass . '">' . $label . '</label>';
	}
	
	$select = '<select class="form-control ' . $class. '" id="' . $fieldName . '" name="' . $name . '" placeholder="' . $placeholder . '" ' . $prop . ' multiple>';
	
	$select .= '<option value=""></option>';
	foreach( $options as $optionValue => $optionText ) {
		$selected = in_array( $optionValue, $selectedValues ) ? 'selected' : '';
		$select  .= '<option value="' . $optionValue . '" ' . $selected . '>' . $optionText . '</option>';
	}	
	$select .= '</select>';
	
	if( ! empty( $addon ) ) {
		$select = genInputAddon( $select, $addon );
	}
	
	if( ! empty( $help ) ) {
		$select = $select . genHelpBlock( $help );
	}
	
	$returnInput = genInputPosition( $label, $select, $align, $inline );
	
	if( $return === TRUE ) {
		return '<div class="form-group">' . $returnInput . '</div>';
	} else {
		echo '<div class="form-group">' . $returnInput . '</div>';
	}
}

$dropdownArray = [ '#' => 'Action', '1' => 'Action2' ];
$optionsArray = array_fill( 1, 5, 'apples' );

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<style>
			.form-group input {
				border: none;
				border-radius: 0px;
				box-shadow: none;
				background-image: linear-gradient(#009688,#009688),linear-gradient(#d2d2d2,#d2d2d2);
			  background-size: 0 2px,100% 1px;
			  background-repeat: no-repeat;
			  background-position: center bottom,center calc(100% - 1px);
			  background-color: transparent;
				transition: all 0.3s cubic-bezier(.64,.09,.08,1);
				width: 100%;
			}
			.form-group input:focus {
				background-image: linear-gradient(#009688,#009688),linear-gradient(#d2d2d2,#d2d2d2);
			  background-size: 0 2px,100% 3px;
				//animation: input-highlight 0.5s forwards;
				box-shadow: none;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row" style="margin-top: 50px;">
				<div class="col-md-6">
					<form>
						<h3>Regular Form</h3>
						<?=genInput( 'Plain Text', 'pt', '', [ 'class' => 'input-matd' ] );?>
					</form>
				</div>
			</div>	
		</div>
	</body>
	<script>
		$( '*[data-toggle="popover"' ).popover();	
	</script>
</html>