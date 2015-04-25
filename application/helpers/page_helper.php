<?php

function params_array( $mvc ) {
	$page_control_item = isset( $mvc->control_item ) ? $mvc->control_item : '';
	
	if( ! empty( $page_control_item ) ) {
		$CI =& get_instance();
		$query = $CI->db->get_where( 'menu_item', [ 'menu_item_id' => $page_control_item ] );
		extract( $query->row_array() );
	}
	
	$page_section      = isset( $mvc->section ) ? $mvc->section : section_check();
	$page_page         = isset( $mvc->page ) ? $mvc->page : '';
	$page_styles       = isset( $mvc->styles ) ? $mvc->styles : '';
	$page_js           = isset( $mvc->js ) ? $mvc->js : '';
	
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
		$page_init    = str_replace( ' ', '_', $title ) . '_' . strtolower( $page_page );
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
		$page_breadcrumbs = [ $page_section => '#', $title => $view, $page_page => '#' ];
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
		$page_access_level = $access_level;
	} else if( isset( $mvc->access_level ) ) {
		$page_access_level = $mvc->access_level;
	} else {
		$page_access_level = 0;
	}
	
	return [ 'page_access_level' => $page_access_level, 'page_current' => $view, 'page_breadcrumbs' => $page_breadcrumbs, 'page_icon' => $icon, 'page_title' => $page_title, 'page_header' => $page_header, 'styles' => $page_styles, 'scripts' => [ 'js' => $page_js, 'init' => $page_init ] ];
}