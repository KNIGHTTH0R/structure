<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Pages_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function page_list( $portal_id ) {
		$pages 		= [];
		$df_pages = [];
		$this->db->select( 'p.*, t.title AS template_title, al.title AS access_level_title, "fr" AS type', FALSE );
		$this->db->join( 'template AS t', 't.template_id = p.template_id' );
		$this->db->join( 'access_level AS al', 'al.access_level_id = p.access_level_id' );
		$this->db->order_by( 'p.status' );
		$this->db->order_by( 'p.title' );
		$pages = $this->db->get_where( 'page AS p', [ 'portal_id' => $portal_id ] )->result_array();
		
		$this->db->select( '*, "df" AS type', FALSE );
		$query = $this->db->get_where( 'page_portal_xref', [ 'portal_id' => $portal_id ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $key => $row ) {
				extract( $row );
				
				$meta_data = json_decode( $meta_data, TRUE );
				extract( $meta_data );
				
				$this->db->select( 'title AS template_title' );
				$query = $this->db->get_where( 'template', [ 'template_id' => $template_id ] );
				extract( $query->row_array() );
				
				$this->db->select( 'title AS access_level_title' );
				$query = $this->db->get_where( 'access_level', [ 'access_level_id' => $access_level_id ] );
				extract( $query->row_array() );
				
				$df_pages[$key]['title'] 							= $title;
				$df_pages[$key]['alias'] 							= $alias;
				$df_pages[$key]['template_title']     = $template_title;
				$df_pages[$key]['access_level_title'] = $access_level_title;
				$df_pages[$key]['type'] 							= $type;
			}
		}
		return array_merge( $pages, $df_pages );
	}
	
	/** Insert **/
	public function page_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['title']	         = $this->input->post( 'title' );
		$data['template_id']   	 = $this->input->post( 'template_id' );
		$data['access_level_id'] = $this->input->post( 'access_level_id' );		
		$data['alias']					 = $this->input->post( 'alias' );
		$data['entered']         = date( 'Y-m-d H:i:s' );
		$data['portal_id']	   	 = $this->input->post( 'portal_id' );
		
		$this->db->insert( 'page', $data );		
		$page_id = $this->db->insert_id();
		
		if( $this->input->post( 'all_portals' ) ) {
			$this->db->select( 'portal_id' );
			$query = $this->db->get( 'portal' );
			if( $query->num_rows() > 0 ) {
				$meta_data = [
					'status' 					=> '+',
					'title' 					=> $this->input->post( 'title' ),
					'template_id' 		=> $this->input->post( 'template_id' ),
					'access_level_id' => $this->input->post( 'access_level_id' )
				];
				$meta_data = json_encode( $meta_data );
				foreach( $query->result_array() as $row ) {
					extract( $row );
					
					$xrf_data = [ 'meta_data' => $meta_data ];
					$xrf_data['page_id']   = $page_id;
					$xrf_data['portal_id'] = $portal_id;
					$xrf_data['alias']     = $this->input->post( 'alias' );
					
					$this->db->insert( 'page_portal_xref', $xrf_data );
				}
			}
		}
		return true;
	}
	
	/** Revise **/
	public function page_revise( $page_id ) {
		return $this->db->get_where( 'page', [ 'page_id' => $page_id ] )->row_array();
	}
	
	/** Update **/
	public function page_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		   		= date( 'Y-m-d H:i:s' );
		$data['title']	       		= $this->input->post( 'title' );
		$data['template_id']   		= $this->input->post( 'template_id' );
		$data['access_level_id']	= $this->input->post( 'access_level_id' );
		$data['alias']					  = $this->input->post( 'alias' );
		
		return $this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'page_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'target_id' ) ] );
	}
}