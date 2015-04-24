<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Site extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->database();
		date_default_timezone_set( 'America/New_York' );
		session_start();
	}
	
	public function index() {
		last_activity_check();
		$params = array();
		
		$segment_1 = $this->uri->segment( 1 );		
		$segment_2 = $this->uri->segment( 2 );
		$segment_3 = $this->uri->segment( 3 );
		
		$this->db->select( 'p.page_id, f.file AS view_name' );
		$this->db->join( 'template AS t', 't.template_id = p.template_id' );
		$this->db->join( 'framework AS f', 'f.framework_id = t.framework_id' );
		$this->db->where( 'portal_id', get_portal_id() );
		if( !empty( $segment_1 ) ) {
			$this->db->where( 'view', $segment_1 );
			$query = $this->db->get( 'page AS p' );
		} else {
			$this->db->where( 'default_view', 'y' );
			$query = $this->db->get( 'page AS p');
		}
		if( $query->num_rows() > 0 ) {
			extract( $query->result_array()[0] );
			
			$params['page_id'] 		= $page_id;
			$params['segment_2'] 	= $segment_2;
			$params['segment_3'] 	= $segment_3;
		} else {
			show_404();
		}
		
		$this->layout->view( $view_name, $params );
	}
}