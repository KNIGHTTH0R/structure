<?php

function params_array( $mvc ) {
	$page_control_item = $mvc->control_item;
	$page_section      = isset( $mvc->section ) ? $mvc->section : section_check();
	$page_page         = isset( $mvc->page ) ? $mvc->page : '';
	$page_styles       = isset( $mvc->styles ) ? $mvc->styles : '';
	$page_js           = isset( $mvc->js ) ? $mvc->js : '';
	
	$CI =& get_instance();
	$CI->db->select( 'mi.*, mi2.title AS parent_title' );
	$CI->db->join( 'menu_item AS mi2', 'mi2.menu_item_id = mi.parent_id', 'left' );
	$query = $CI->db->get_where( 'menu_item AS mi', [ 'mi.view' => $page_control_item ] );
	extract( $query->row_array() );
	
	switch( $page_section ) {
		case 'ad':
			$page_section = 'Admin';
		break;
		case 'po':
			$page_section = 'Portal';
		break;
		default:
			$page_section = 'Admin';
	}
	
	if( ! isset( $mvc->init ) ) {
		if( empty( $page_page ) ) {
			$init_file = str_replace( ' ', '_', $title );
		} else {
			$init_file = str_replace( ' ', '_', $title ) . '_' . strtolower( $page_page );
		}
		$page_init = $init_file;
	} else {
		$page_init = $mvc->init;
	}
	
	if( ! isset( $mvc->page_header ) ) {
		$page_header  = $title . ' <small>' . $page_page . '</small>';
	} else {
		$page_header = $mvc->page_header;
	}
	
	if( ! isset( $mvc->page_title ) ) {
		$page_title = $title . ' ' . $page_page;		
	} else {
		$page_title = $mvc->page_title;
	}
	
	if( ! isset( $mvc->breadcrumbs ) ) {
		if( ! empty( $parent_title ) ) {
			$page_breadcrumbs = [ $page_section => '#', $parent_title => '#', $title => $view ];
			if( ! empty( $page_page ) ) {
				$page_breadcrumbs[$page_page] = '#';
			}
		} else {
			$page_breadcrumbs = [ $page_section => '#', $title => $view ];
		}
	} else {
		$page_breadcrumbs = $mvc->breadcrumbs;
	}
	
	$icon = isset( $icon ) ? $icon : '';
	
	if( ! isset( $view ) && isset( $mvc->view ) ) {
		$view = $mvc->view;
	} else if( ! isset( $view ) ) {
		$view = '';
	}
	
	if( ! isset( $mvc->access_level ) ) {
		$page_access_level_id = $access_level_id;
	} else if( isset( $mvc->access_level ) ) {
		$page_access_level_id = $mvc->access_level;
	} else {
		$page_access_level_id = 0;
	}
	
	return [ 'page_access_level_id' => $page_access_level_id, 'page_current' => $view, 'page_breadcrumbs' => $page_breadcrumbs, 'page_icon' => $icon, 'page_title' => $page_title, 'page_header' => $page_header, 'styles' => $page_styles, 'scripts' => [ 'js' => $page_js, 'init' => $page_init ] ];
}

function access_check( $access_level_id ) {	
	$CI =& get_instance();
	
	$CI->db->select( 'access_level_id, level' );
	$query = $CI->db->get_where( 'access_level', [ 'status' => '+' ] );
	if( $query->num_rows() > 0 ) {
		$access_array = array_column( $query->result_array(), 'level', 'access_level_id' );
	}
	
	if( $CI->session->userdata( 'access_level_id' ) ) {
		if( $CI->session->userdata( 'access_level_id' ) == -1 ) {
			return TRUE;
		} else {
			if( $access_array[$CI->session->userdata( 'access_level_id' )] >= $access_array[$access_level_id] ) {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	} else if( $access_array[$access_level_id] == 0 ) {
		return TRUE;
	} else {
		return FALSE;
	}
}

function last_activity_check() {
	$CI =& get_instance();
	
	if( strtotime( '-20 minutes' ) > $CI->session->userdata( 'last_activity' ) ) {
		$CI->session->set_userdata( [] );
	}
}

function redirect_404() {
		
}