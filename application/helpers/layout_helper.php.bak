<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

function add_style( $file ) {
	return '<link href="' . $file . '" rel="stylesheet" type="text/css">';
}

function add_script( $file ) {
	return '<script src="' . $file . '" type="text/javascript"></script>';
}

function gen_styles( $styles = array() ) {	
	$default_styles = '';
	if( !empty( $styles ) && is_array( $styles ) ) {
		foreach( $styles as $file ) {
			$default_styles .= add_style( site_url( $file ) );
		}	
	} else if( !empty( $styles ) ) {
		$default_styles .= add_style( site_url( $styles ) );
	}
	echo $default_styles;
}

function gen_scripts( $scripts = array() ) {
	$default_scripts = '';
	if( !empty( $scripts['js'] ) && is_array( $scripts['js'] ) ) {
		foreach( $scripts['js'] as $file ) {
			$default_scripts .= add_script( site_url( $file ) );
		}	
	} else if( !empty( $scripts['js'] ) ) {
		$default_scripts .= add_script( site_url( $scripts['js'] ) );
	}
	
	switch( section_check() ) {
		case 'ad':
			$section = 'admin';
		break;
		case 'po':
			$section = 'portal';
		break;
		case 'fr':
			$section = 'front';
		break;
	}
	
	$default_scripts .= '<script>';
	$default_scripts .= 'var site_url = "' . site_url() . '";' . "\n";
	$default_scripts .= 'var section = "' . $section . '";' . "\n";
	$default_scripts .= '$( document ).ready( function() {';
	$default_scripts .= 'Metronic.init();';
	$default_scripts .= 'Layout.init();';
	$default_scripts .= 'Datatables.init();';
		
	if( !empty( $scripts['init'] ) && is_array( $scripts['init'] ) ) {
		foreach( $scripts['init'] as $init ) {
			$default_scripts .= $init . '.init();';
		}	
	} else if( !empty( $scripts['init'] ) ) {
		$default_scripts .= $scripts['init'] . '.init();';
	}

	$default_scripts .= '});';
	$default_scripts .= '</script>';
	echo $default_scripts;
}

function gen_page_header( $page_title, $return = FALSE ) {
	if( $page_title == 'none' ) {
		return;
	}
	$title  = '<div class="page-head">';
	$title .= '<div class="page-title">';
	$title .= '<h1>' . $page_title . '</h1>';
	$title .= '</div></div>';
	
	if( $return === FALSE ) {
		echo $title;
	} else if( $return === TRUE ) {
		return $title;
	}	
}

function gen_breadcrumbs( $breadcrumbs, $return = FALSE ) {
	if( $breadcrumbs == 'none' ) {
		return;
	}
	
	switch( section_check() ) {
		case 'ad':
			$dashboard = 'admin';
		break;
		case 'po':
			$dashboard = 'portal';
		break;
		default:
			$dashboard = 'admin';
	}
	
	$section_location = site_url();
	
	$default_breadcrumbs  = '<ul class="page-breadcrumb breadcrumb">';
	$default_breadcrumbs .= '<li>';
	$default_breadcrumbs .= '<a href="/' . $dashboard . '/dashboard">Dashboard</a><i class="fa fa-circle"></i>';
	$default_breadcrumbs .= '</li>' . "\n";	
	
	$count = 1;
	foreach( $breadcrumbs as $title => $link ) {
		$title = ucwords( $title );
		if( $count == 1 && count( $breadcrumbs ) == 1 ) {
			$default_breadcrumbs .= '<li class="active">' . $title . '</li>' . "\n";
		} else if( $title == 'Admin' || $title == 'Portal' ) {
			$default_breadcrumbs .= '<li class="active">' . $title . '<i class="fa fa-circle"></i></li>' . "\n";
		} else if( $count != count( $breadcrumbs ) ) {
			$default_breadcrumbs .= '<li><a href="' . $section_location .  $link . '">' . $title . '</a><i class="fa fa-circle"></i></li>' . "\n";
		} else {
			$default_breadcrumbs .= '<li class="active">' . $title . '</li>' . "\n";
		}
		$count++;
	}
	
	$default_breadcrumbs .= '</ul>';
	
	if( $return === TRUE ) {
		return $default_breadcrumbs;
	} else {
		echo $default_breadcrumbs;
	}
}

function get_access_levels() {
	$access_array = [];
	
	$CI =& get_instance();
	$CI->load->database();
	
	$CI->db->order_by( 'level', 'DESC' );
	$access_levels = $CI->db->get( 'access_level' );
	if( $access_levels->num_rows() > 0 ) {
		$access_array = array_column( $access_levels->result_array(), 'title', 'access_level_id' );
	}
	return $access_array;
}

function section_check( $full = FALSE ) {
	$current_page = explode( '/', $_SERVER['REQUEST_URI'] );
	
	switch( TRUE ) {
		case ( in_array( 'admin', $current_page ) ):
			$section = 'ad';
		break;
		case ( in_array( 'portal', $current_page ) ):
			$section = 'po';
		break;
		case 'fr':
			$section = 'fr';
		break;
	}
	
	if( $full === FALSE ) {
		return $section;
	} else {
		$section_array = [ 'ad' => 'admin', 'po' => 'portal', 'fr' => 'portal' ];
		return $section_array[$section];
	}
}

//Update to use codeigniter methods
function last_activity_check() {
	if( ! isset( $_SESSION['last_activity'] ) ) {
		return;
	} else if( strtotime( '-20 minutes' ) > strtotime( $_SESSION['last_activity'] ) ) {
		session_destroy();
		session_start();
		$_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
	} else {
		$_SESSION['last_activity'] = date( 'Y-m-d H:i:s' );
	}
}

function get_portal_id() {
	$CI =& get_instance();
	return $CI->session->userdata( 'portal_id' ) ? $CI->session->userdata( 'portal_id' ) : -1;
}