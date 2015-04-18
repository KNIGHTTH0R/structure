<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

function gen_ui_dashboard_stat( $params = array() ) {
	$params['color'] 			= isset( $params['color'] ) ? $params['color'] : 'blue';
	$params['icon']				= isset( $params['icon'] ) ? $params['icon'] : '';
	$params['details']		= isset( $params['details'] ) ? $params['details'] : '';
	$params['desc']				= isset( $params['desc'] ) ? $params['desc'] : '';
	$params['href']				= isset( $params['href'] ) ? $params['href'] : 'javascript:;';
	$params['link_text']	= isset( $params['link_text'] ) ? $params['link_text'] : 'View More';
	
	$ui_block =<<<EOD
	<div class="dashboard-stat {$params['color']}">
		<div class="visual">
			<i class="fa fa-{$params['icon']}"></i>
		</div>
		<div class="details">
			<div class="number">
				 {$params['details']}
			</div>
			<div class="desc">
				 {$params['desc']}
			</div>
		</div>
		<a class="more" href="{$params['href']}">
			{$params['link_text']} <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
EOD;

	echo $ui_block;
}

function gen_ui_news_stat( $params = array(), $return = FALSE ) {
	$params['title'] 			= isset( $params['title'] ) ? $params['title'] : 'Default';
	$params['sub']				= isset( $params['sub'] ) ? $params['sub'] : 'Default';
	$params['sub_icon']		= isset( $params['sub_icon'] ) ? $params['sub_icon'] : '';
	$params['stat_icon']	= isset( $params['stat_icon'] ) ? $params['stat_icon'] : '';
	$params['href']				= isset( $params['href'] ) ? $params['href'] : 'javascript:;';
	$params['color']			= isset( $params['color'] ) ? $params['color'] : '';
	
	$news_stat =<<<EOD
		<div class="top-news">
			<a href="{$params['href']}" class="btn {$params['color']}">
			<span>
			{$params['title']} </span>
			<em>
			<i class="fa fa-{$params['sub_icon']}"></i>
			{$params['sub']} </em>
			<i class="fa fa-{$params['stat_icon']} top-news-icon"></i>
			</a>
		</div>
EOD;
	if( $return === TRUE ) {
		return $news_stat;
	} else {
		echo $news_stat;
	}
}

function gen_ui_revise_button( $href, $params = array() ) {
	echo '<a class="btn blue-madison btn-xs" href="' . $href . '">Revise</a>';
}

function gen_ui_portlet_open( $title, $icon, $type = '', $params = array(), $return = FALSE ) {
	$params['actions'] 			= isset( $params['actions'] ) ? gen_ui_portlet_actions( $params['actions'] ) : '';
	$params['body_cclass']	= isset( $params['body_cclass'] ) ? $params['body_cclass'] : '';
	$params['title_cclass']	= isset( $params['title_cclass'] ) ? $params['title_cclass'] : 'green';
	
	$portlet =<<<EOD
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-$icon font-{$params['title_cclass']}"></i>
					<span class="caption-subject font-{$params['title_cclass']} bold uppercase">$title</span>
				</div>
				{$params['actions']}
			</div>
			<div class="portlet-body {$params['body_cclass']} $type">
EOD;
	if( $return === TRUE ) {
		return $portlet;
	} else {
		echo $portlet;
	}
}

function gen_ui_portlet_close( $return = FALSE ) {
	$portlet =<<<EOD
			</div>
		</div>
EOD;
	if( $return === TRUE ) {
		return $portlet;
	} else {
		echo $portlet;
	}
}

function gen_ui_modal_open( $params = array() ) {
	$params['modal_id'] = isset( $params['modal_id'] ) ? $params['modal_id'] : '';
	$params['form_id']	= isset( $params['form_id'] ) ? $params['form_id'] : '';
	$params['title']		= isset( $params['title'] ) ? $params['title'] : '';
	
	$modal =<<<EOD
		<div id="{$params['modal_id']}" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<form role="form" id="{$params['form_id']}">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">{$params['title']}</h4>
		      </div>
EOD;
	echo $modal;
}

function gen_ui_modal_close() {
	$modal =<<<EOD
				</form>
			</div>
	  </div>
	</div>
EOD;
	echo $modal;
}

function gen_ui_portlet_actions( $params = array() ) {
	$params['href'] 					= isset( $params['href'] ) ? '<a href="' . $params['href'] . '" data-toggle="modal" class="btn btn-default">' : '';
	$params['icon_text'] 			= isset( $params['icon_text'] ) ? '<i class="fa fa-plus"></i> ' . $params['icon_text'] . '</a>' : '';
	$params['reorder'] 				= isset( $params['reorder'] ) ? '<a href="javascript:;" class="reorder btn btn-default"><i class="fa fa-bars"></i> Reorder</a>' : '';
	
	$actions =<<<EOD
	<div class="actions">
		{$params['reorder']}
		{$params['href']}
		{$params['icon_text']}
		<a href="#" class="btn btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
	</div>
EOD;
return $actions;
}

function gen_ui_date_difference( $start_date, $end_date = '', $format = '%y year(s) %m month(s)', $return_type = 'echo' ) {
	if( $start_date == NULL || $start_date == '0000-00-00' ) {
		return;
	}
	date_default_timezone_set( 'America/New_York' );
	$start_date		= date_create( $start_date );
	$end_date			= empty( $end_date ) ? date_create( 'today' ) : date_create( $end_date );
	$date_diff		= date_diff( $start_date, $end_date );
	if( $return_type == 'echo' ) {
		echo $date_diff->format( $format );
	} else if( $return_type == 'return' ) {
		return $date_diff->format( $format );
	}
}

function gen_ui_badge( $params ) {
	$params['count']		= isset( $params['count'] ) ? $params['count'] : '';
	
	if( isset( $params['popover'] ) ) {
		$params['cclass'] = 'popover';
	} else {
		$params['popover'] 	= '';
		$params['cclass'] 	= '';
	}
	$params['popover']	= isset( $params['popover'] ) ? gen_ui_popover( $params['popover'] ) : '';
	
	if( isset( $params['color'] ) ) {
		$params['color'] = $params['color'];
	} else if( empty( $params['count'] ) || $params['count'] === 0 ) {
		$params['color'] = 'bg-red-thunderbird';
	} else {
		$params['color'] = 'bg-blue-hoki';
	}
	
	$badge = '<span class="badge ' . $params['color'] . ' ' . $params['cclass'] . '" ' . $params['popover']  . '>' . $params['count'] . '</span>';
	return $badge;
}

function gen_ui_popover( $params ) {
	$params['container']	= isset( $params['container'] ) ? $params['container'] : 'body';
	$params['placement']	= isset( $params['placement'] ) ? $params['placement'] : 'top';
	$params['content']		= isset( $params['content'] ) ? $params['content'] : '';
	$params['title']			= isset( $params['title'] ) ? $params['title'] : '';
	
	return 'data-container="' . $params['container'] . '" data-html="true" data-trigger="hover" data-placement="' . $params['placement'] . '" data-content="' . $params['content'] . '" data-original-title="' . $params['title'] . '"';
}

function gen_ui_score_button( $field_class, $data_value, $score_1, $score_2, $return = FALSE ) {
	if( $score_1 == 0 && $score_2 == 0 ) {
		$button_color = 'red';
	} else {
		$button_color = 'green';
	}
	if( $return === TRUE ) {
		return '<button href="#' . $field_class . '" data-toggle="modal" type="button" class="btn btn-xs ' . $button_color . ' ' . $field_class . '" data-value="' . $data_value . '">' . $score_1 . ' : ' . $score_2 . '</button>';
	} else {
		echo '<button href="#' . $field_class . '" data-toggle="modal" type="button" class="btn btn-xs ' . $button_color . ' ' . $field_class . '" data-value="' . $data_value . '">' . $score_1 . ' : ' . $score_2 . '</button>';
	}
}

function gen_ui_list_group_open( $return = FALSE ) {
	if( $return === TRUE ) {
		return '<ul class="list-group">';
	} else {
		echo '<ul class="list-group">';
	}
}

function gen_ui_list_group_close( $return = FALSE ) {
	if( $return === TRUE ) {
		return '</ul>';
	} else {
		echo '</ul>';
	}
}

function gen_ui_status( $publish_id, $status ) {
	switch( $status ) {
		case '+';
			echo '<a class="fa fa-cloud font-green no-decoration unpublish status" href="javascript:;" data-value="' . $publish_id . '"></a>';
		break;
		case '-';
			echo '<a class="fa fa-cloud font-grey-cascade no-decoration publish status" href="javascript:;" data-value="' . $publish_id . '"></a>';
		break;
	}
}

function gen_ui_icon( $icon ) {
	if( empty( $icon ) ) {
		echo '';
	} else {
		echo '<i class="fa fa-' . $icon . ' font-blue-hoki"></i>';
	}
}

function gen_ui_framework_preview( $framework_list = array() ) {
	$framework_preview = '';
	foreach( $framework_list as $framework_item ) {
		$framework_preview .= '<div class="col-md-6">';
		$framework_preview .= '<h4 class="text-center bold">' . $framework_item['title'] . '</h4>';
		$framework_preview .= '<div id="framework-id-' . $framework_item['framework_id'] . '" class="framework-preview-wrapper">';
		$framework_preview .= '<div class="framework-mockup">';
		$framework_preview .= gen_ui_framework_item( $framework_item, array(), TRUE );
		$framework_preview .= '</div></div></div>';
	}
	echo $framework_preview;
}

function gen_ui_framework_item( $framework_item, $position_array = array(), $return = FALSE ) {
	extract( $framework_item );
	
	$mockup_array = array();
	if( strpos( $mockup, '~' ) ) {
		if( strpos( $mockup, '|' ) ) {
			$row = explode( '~', $mockup );
			foreach( $row as $column ) {
				if( strpos( $mockup, '|' ) ) {
					$split_row = explode( '|', $column );
					foreach( $split_row as $split_column ) {
						$mockup_array[] = $split_column;
					}
				} else {
					$mockup_array[] = $column;
				}
			}
		} else {
			$mockup_array = explode( '~', $mockup );
		}
	} else if( strpos( $mockup, '|' ) ) {
		$split_row = explode( '|', $column );
		foreach( $split_row as $split_column ) {
			$mockup_array[] = $split_column;
		}
	} else {
		$mockup_array[] = $mockup;
	}
	
	$framework_preview = '';
	$column_count = 1;
	$break_count	= 0;
	foreach( $mockup_array as $framework ) {
		if( $break_count == 0 ) {
			$framework_preview .= '<div class="row-wrapper">';	
		}
		
		if( strpos( $framework, '*' ) ) {
			$framework = str_replace( '*', '', $framework );
			$framework_preview .= '<div class="column-count-' . $framework . '"><div class="bg-grey column-content"><div class="list-group-title">No Widgets</div></div></div>';
		} else {
			if( !empty( $position_array ) && isset( $position_array['column_id'][$column_count] ) ) {
				$widgets = gen_ui_positions( $position_array['column_id'][$column_count] );
			} else {
				$widgets = gen_ui_positions( array() );
			}
			
			$framework_preview .= '<div class="column-count-' . $framework . '"><div id="widget-column-' . $column_count . '" class="bg-green column-content"><div class="list-group-title">Column ' . $column_count . '</div>' . $widgets . '</div></div>';
			$column_count++;
		}
		$break_count += $framework;
		
		if( $break_count == 12 ) {
			$framework_preview .= '</div>';
			$break_count = 0;
		}
	}
	
	if( $return === TRUE ) {
		return $framework_preview;
	} else {
		return $framework_preview;
	}
}

function gen_ui_positions( $position_array = array() ) {
	$position = '<ul class="list-group ui-sortable">';
	foreach( $position_array as $widget ) {
		extract( $widget );
		$position .= '<li id="widget-id-' . $widget_id . '" class="list-group-item child-item"><i class="fa fa-sort"></i> ' . $alias . '<a href="javascript:;" class="fa fa-times pull-right widget-delete"></a></li>';
	}
	$position .= '</ul>';
	
	return $position;
}

function gen_ui_object_params( $params ) {	
	if( empty( $params ) ) {
		return array();	
	}
	
	$input_options = array();
	if( strpos( $params, '~' ) ) {
		$params_array = explode( '~', $params );
		
		foreach( $params_array as $input_params ) {
			$input_values = explode( '|', $input_params );
			
			foreach( $input_values as $input ) {
				if( strpos( $input, '^!' ) ) {
					$select_options = explode( '^!', $input );
					$select_options = array_combine( $select_options, $select_options );
				} else {
					$select_options = array();
				}
			}
			
			$selected_options = array();
			$input_options[] = array( 'type' => $input_values[0], 'label' => $input_values[1], 'field_name' => $input_values[2], 'select_options' => $select_options );
		}
	} else {
		$input_values = explode( '|', $params );
		
		foreach( $input_values as $input ) {
			if( strpos( $input, '^!' ) ) {
				$select_options = explode( '^!', $input );
				$select_options = array_combine( $select_options, $select_options );
			} else {
				$select_options = array();
			}
		}
		
		$input_options[] = array( 'type' => $input_values[0], 'label' => $input_values[1], 'field_name' => $input_values[2], 'select_options' => $select_options );
	}
	
	return $input_options;
}

function gen_ui_widget_params( $params ) {
	$input_values = array();
	if( strpos( $params, '|' ) ) {
		$params_array = explode( '|', $params );
		
		foreach( $params_array as $values ) {
			if( strpos( $values, '^!' ) ) {
				$selected_values = explode( '^!', $values );				
			} else {
				$selected_values = array( $values );
			}
			
			$selected_values = array_combine( $selected_values, $selected_values );
			$input_values[] = array( 'value' => $values, 'selected_values' => $selected_values );
		}
	} else {
		if( strpos( $params, '^!' ) ) {
			$selected_values = explode( '^!', $input );			
		} else {
			$selected_values = array( $params );
		}
		
		$selected_values = array_combine( $selected_values, $selected_values );
		$input_values[] = array( 'value' => $params, 'selected_values' => $selected_values );
	}
	return $input_values;
}

function gen_ui_object_inputs( $input_options, $input_values = array(), $return = FALSE ) {
	if( empty( $input_options ) ) {
		return;
	}
	
	$inputs = '';
	$count = 0;
	
	foreach( $input_options as $input ) {
		extract( $input );
		
		if( !empty( $input_values ) ) {
			$value 						= $input_values[$count]['value'];
			$selected_values 	= $input_values[$count]['selected_values'];
		} else {
			$value = '';
			$selected_values = array();
		}
		
		switch( $type ) {
			case 'text':
				$inputs .= '<div class="col-md-6">' . gen_form_text( $label, '', $value, array( 'cclass' => 'widget-params' ), 'standard', TRUE ) . '</div>';
			break;
			case 'select':
				$inputs .= '<div class="col-md-6">' . gen_form_select( $label, '', $select_options, $value, array( 'cclass' => 'widget-params' ), 'standard', TRUE ) . '</div>';
			break;
			case 'multi':
				$inputs .= '<div class="col-md-6">' . gen_form_multi_select( $label, '', $select_options, $selected_values, array( 'cclass' => 'widget-params' ), 'standard', TRUE ) . '</div>';
			break;
			case 'toggle':
				$inputs .= '<div class="col-md-6">' . gen_form_toggle( $label, '', $value, array( 'cclass' => 'widget-params' ), TRUE ) . '</div>';
			break;
			case 'wysiwyg':
				$inputs .= '<div class="col-md-12">' . gen_form_wysiwyg( $label, '', $value, TRUE ) . '</div>';
			break;
		}
		$count++;
		
		if( $count %2 == 0 ) {
			$inputs .= '<div class="clearfix"></div>';
		}
	}
	
	if( $return === TRUE ) {
		return $inputs;
	} else {
		echo $inputs;
	}
}