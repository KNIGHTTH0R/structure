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
		
		/** Check For Default Page **/
		$df_query = $this->db->get_where( 'page_portal_xref', [ 'portal_id' => get_portal_id(), 'alias' => $this->uri->segment( 1 ) ] );
		
		/** Check For Custom Page **/
		$this->db->select( 'p.page_id, p.access_level_id, p.title, f.file AS view_name' );
		$this->db->join( 'template AS t', 't.template_id = p.template_id' );
		$this->db->join( 'framework AS f', 'f.framework_id = t.framework_id' );
		$this->db->where( 'portal_id', get_portal_id() );
		$this->db->where( 'alias', $this->uri->segment( 1 ) );
		$query = $this->db->get( 'page AS p' );
		
		if( $df_query->num_rows() > 0 ) {
			extract( $df_query->row_array() );
			
			$meta_data = json_decode( $meta_data, TRUE );
			extract( $meta_data );
			
			$this->db->select( 'f.file AS view_name' );
			$this->db->join( 'template AS t', 't.framework_id = f.framework_id' );
			$query = $this->db->get_where( 'framework AS f', [ 't.template_id' => $template_id ] );
			if( $query->num_rows() > 0 ) {
				extract( $query->row_array() );
				
				$params['page_id'] 						= $page_id;
				$params['title']							= $title;	
				$params['page_access_level'] 	= $access_level_id;
				
				$this->layout->view( $view_name, $params );
			}
		} else if( $query->num_rows() > 0 ) {
			extract( $query->row_array() );
				
			$params['page_id'] 						= $page_id;
			$params['title']							= $title;
			$params['page_access_level'] 	= $access_level_id;
			
			$this->layout->view( $view_name, $params );
		} else {
			show_404();
		}
	}
}