<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Pages_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function page_list( $portal_id ) {
		$this->db->select( 'p.*, t.title AS template_title, al.title AS access_level_title' );
		$this->db->join( 'template AS t', 't.template_id = p.template_id' );
		$this->db->join( 'access_level AS al', 'al.access_level_id = p.access_level_id' );
		$this->db->order_by( 'p.status' );
		$this->db->order_by( 'p.title' );
		return $this->db->get_where( 'page AS p', [ 'portal_id' => $portal_id ] )->result_array();
	}
	
	/** Insert **/
	public function page_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['entered']       = date( 'Y-m-d H:i:s' );
		$data['title']	       = $this->input->post( 'title' );
		$data['template_id']   = $this->input->post( 'template_id' );
		$data['portal_id']	   = $this->input->post( 'portal_id' );
		$data['access_level']	 = $this->input->post( 'access_level_id' );
		$data['alias']					 = $this->input->post( 'alias' );
		if( $this->input->post( 'default_view' ) ) {
			$data['default_view'] = 'y';
		} else {
			$data['default_view'] = 'n';
		}
		
		return $this->db->insert( 'page', $data );
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
		if( $this->input->post( 'default_view' ) ) {
			$data['default_view'] = 'y';
		} else {
			$data['default_view'] = 'n';
		}
		
		return $this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'page_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'target_id' ) ] );
	}
}