<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

/** Admin Menu Item Functions **/
function get_menu_items( $page_current ) {
	$CI =& get_instance();
	$CI->load->database();
	
	$CI->db->where( 'parent_id', 0 );
	$CI->db->where( 'section', section_check() );
	$CI->db->where( 'portal_id', get_portal_id() );
	$CI->db->where( 'status', '+' );
	$CI->db->order_by( 'sequence' );
	$menu_items = $CI->db->get( 'menu_item' )->result_array();
	
	$menu = '';
	foreach( $menu_items as $attributes ) {
		extract( $attributes );
		
		if( ! access_check( $access_level_id ) ) {
			continue;
		}
		
		$CI->db->order_by( 'sequence' );
		$CI->db->where( 'status', '+' );
		$children = $CI->db->get_where( 'menu_item', [ 'parent_id' => $menu_item_id ] );
		
		if( $children->num_rows() > 0 ) {
			$active = menu_children_active_check( $page_current, $children->result_array() );
			$menu  .= gen_menu_group( $title, $icon, $children->result_array(), $active, $page_current );
		} else {
			$active = $view == $page_current ? 'active' : '';
			$menu  .= gen_menu_link( $title, $view, $active, $icon );
		}
	}
	echo $menu;
}

function gen_menu_group( $title, $icon, $children, $active, $page_current ) {
	$open		= $active == 'active' ? 'open' : '';
	
	$group  = '<li class="' . $active . '">';
	$group .= '<a href="javascript:;">';
	$group .= '<i class="fa fa-' . $icon . '"></i>';
	$group .= '<span class="title"> ' . $title . '</span>';
	$group .= '<span class="arrow ' . $open . '"></span></a>';
	$group .=	'<ul class="sub-menu">';
	$group .= gen_menu_children( $children, $page_current );
	$group .= '</ul>';
	$group .= '</li>';
	return $group;
}

function gen_menu_children( $menu_items, $page_current ) {
	$menu = '';
	foreach( $menu_items as $attributes ) {
		extract( $attributes );
		
		if( ! access_check( $access_level_id ) ) {
			continue;
		}
		
		$active = $view ==  $page_current ? 'active' : '';
		$menu .= gen_menu_link( $title, $view , $active, $icon );
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
	
	if( section_check( TRUE ) == 'portal' ) {
		$CI =& get_instance();
		$view = $view . '?portal_id=' . $CI->input->get( 'portal_id' );
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

function menu_children_active_check( $page_current, $views ) {
	foreach( $views as $row ) {
		extract( $row );
		
		$view_split = explode( '/', $view );
		$view_split = array_pop( $view_split );
		if( $view == $page_current ) {
			return 'active';
		}
	}
	return '';
}

/** Front Menu Item Functions **/

function fr_get_menu_items( $page_current ) {
	$CI =& get_instance();
	$CI->load->model( 'portal/fr_menu_items_model' );
	
	$menu_items = $CI->fr_menu_items_model->fr_menu_item_list( get_portal_id() );
	
	$menu = '';
	foreach( $menu_items as $attributes ) {
		extract( $attributes );
		
		if( ! access_check( $access_level_id ) ) {
			continue;
		}
		
		$active = $page_current == $alias ? 'active' : '';
		$menu  .= fr_gen_menu_link( $title, $alias, $active, $icon );
	}
	echo $menu;
}

function fr_gen_menu_link( $title, $view, $active = '', $icon = '', $args = [] ) {
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
	$link	.= '<div class="nav-item">' . $title . '</div></a>';
	$link .= $args['noclose'];
	return $link;
}