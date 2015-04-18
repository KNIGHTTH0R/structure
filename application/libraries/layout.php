<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Layout {
	private $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	public function view( $view_name, $view_params = array(), $layout = 'default' ) {
		$settings = $this->CI->db->get_where( 'setting', array( 'setting_id' => 1 ) )->row_array();
		define( 'SITE_TITLE', $settings['site_title'] . ' | ' );
		
		last_activity_check();
		
		$layout_params['breadcrumbs'] 	= isset( $view_params['breadcrumbs'] ) ? $view_params['breadcrumbs'] : '';
		$layout_params['page_header'] 	= isset( $view_params['page_header'] ) ? $view_params['page_header'] : 'Default';
		$layout_params['page_title']		= isset( $view_params['page_title'] ) ? SITE_TITLE . $view_params['page_title'] : SITE_TITLE . 'Default';
		$layout_params['styles'] 				= isset( $view_params['styles'] ) ? $view_params['styles'] : '';
		$layout_params['scripts']				= isset( $view_params['scripts'] ) ? $view_params['scripts'] : '';
		$layout_params['username'] 			= $this->CI->session->userdata( 'username' );
		$layout_params['view_content']	= $this->CI->load->view( $view_name, $view_params, TRUE );
		
		$view_directory = section_check() == 'ad' ? 'admin' : 'front';
		
		switch( section_check() ) {
			case 'ad':
				$view_directory = 'admin';
			break;
			case 'po':
				$view_directory = 'admin';
			break;
			case 'fr':
				$view_directory = 'front';
			break;
		}
		
		$this->CI->load->view( $view_directory . '/layouts/' . $layout . '.php', $layout_params );
	}
}