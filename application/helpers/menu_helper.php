<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

function get_menu_items() {
	$CI =& get_instance();
	$CI->load->database();
	
	$CI->db->where( 'parent_id', 0 );
	$CI->db->where( 'section', section_check() );
	$CI->db->where( 'portal_id', get_portal_id() );
	$CI->db->where( 'status', '+' );
	$CI->db->order_by( 'sequence' );
	$menu_items = $CI->db->get( 'menu_item' )->result_array();
	
	$current_page = explode( '/', $_SERVER['REQUEST_URI'] );
	array_shift( $current_page );
	$extension	= explode( '/', site_url() );
	if( isset( $extension[3] ) ) {
		$extension = $extension[3];
	} else {
		$extension = '';
	}
	
	$append_links = '';
	foreach( $current_page as $key => $link ) {
		if( is_numeric( $link ) ) {
			unset( $current_page[$key] );
		} else if( $link == $extension ) {
			unset( $current_page[$key] );
		} else if( substr( $link, 0, 1 ) == '?' ) {
			$append_links = '/' . $link;
		}
	}
	
	$menu = '';
	foreach( $menu_items as $attributes ) {
		extract( $attributes );
		
		if( ! access_check( $access_level ) ) {
			continue;
		}
		
		$CI->db->order_by( 'sequence' );
		$CI->db->where( 'status', '+' );
		$children = $CI->db->get_where( 'menu_item', [ 'parent_id' => $menu_item_id ] );
		
		if( $children->num_rows() > 0 ) {
			$active = menu_children_active_check( $current_page, $children->result_array() );
			$menu  .= gen_menu_group( $title, $icon, $children->result_array(), $active, $current_page, $append_links );
		} else {
			$view_split = array_pop( explode( '/', $view ) );
			$active = in_array( $view_split, $current_page ) ? 'active' : '';
			$menu  .= gen_menu_link( $title, $view . $append_links, $active, $icon );
		}
	}
	echo $menu;
}

function gen_menu_group( $title, $icon, $children, $active, $current_page, $append_links = '' ) {
	$open		= $active == 'active' ? 'open' : '';
	
	$group  = '<li class="' . $active . '">';
	$group .= '<a href="javascript:;">';
	$group .= '<i class="fa fa-' . $icon . '"></i>';
	$group .= '<span class="title"> ' . $title . '</span>';
	$group .= '<span class="arrow ' . $open . '"></span></a>';
	$group .=	'<ul class="sub-menu">';
	$group .= gen_menu_children( $children, $current_page, $append_links );
	$group .= '</ul>';
	$group .= '</li>';
	return $group;
}

function gen_menu_children( $menu_items, $current_page, $append_links = '' ) {
	$menu = '';
	foreach( $menu_items as $attributes ) {
		extract( $attributes );
		
		if( ! access_check( $access_level ) ) {
			continue;
		}
		
		$view_split = explode( '/', $view );
		$view_split = array_pop( $view_split );
		
		$active = in_array( $view_split, $current_page ) ? 'active' : '';
		$menu .= gen_menu_link( $title, $view . $append_links, $active, $icon );
	}
	return $menu;
}	

function gen_menu_link( $title, $view, $active = '', $icon = '', $args = [] ) {
	$args['cclass'] 	= isset( $args['cclass'] ) ? $args['cclass'] : '';
	$args['noclose']	= isset( $args['noclose'] ) ? '' : '</li>';
	
	if( $view == '' ) {
		$view = 'javascript:;';
	} else {
		$view = site_url( $view );
	}
	
	$link	 = '<li class="' . $active . ' ' . $args['cclass'] . '">';
	$link	.= '<a href="' . $view . '">';
	if( !empty( $icon ) ) {
		$link .= '<i class="fa fa-' . $icon . '"></i> ';
	}
	$link	.= '<span class="title">' . $title . '</span></a>';
	$link .= $args['noclose'];
	return $link;
}

function menu_children_active_check( $current_page, $views ) {
	foreach( $views as $row ) {
		extract( $row );
		
		$view_split = explode( '/', $view );
		$view_split = array_pop( $view_split );
		if( in_array( $view_split, $current_page)  ) {
			return 'active';
		}
	}
	return '';
}