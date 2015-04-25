<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Pages_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function page_list() {
		$this->db->order_by( 'status' );
		$this->db->order_by( 'title' );
		return $this->db->get( 'page' )->result_array();
	}
	
	/** Insert **/
	public function page_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['entered'] = date( 'Y-m-d H:i:s' );
		$data['title']	 = $this->input->post( 'title' );
		$data['template_id'] = $this->input->post( 'template_id' );
		$data['portal_id']	 = $this->input->post( 'portal_id' );
		$data['access_level']	 = $this->input->post( 'access_level' );
		
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
		
		$data['updated']		   = date( 'Y-m-d H:i:s' );
		$data['title']	       = $this->input->post( 'title' );
		$data['template_id']   = $this->input->post( 'template_id' );
		$data['access_level']	 = $this->input->post( 'access_level' );
		
		return $this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'page_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'page', $data, [ 'page_id' => $this->input->post( 'target_id' ) ] );
	}
}