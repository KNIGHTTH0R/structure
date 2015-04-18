<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Portals_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function portal_list() {
		return $this->db->get( 'portal' )->result_array();
	}
	
	public function portal_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->set( 'level', 'level+1', FALSE );
		$this->db->update( 'portal' );
		
		$data['status'] 		= '+';
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		$data['level']			= 0;
		
		return $this->db->insert( 'portal', $data );
	}
	
	public function portal_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		
		return $this->db->update( 'portal', $data, array( 'portal_id' => $this->input->post( 'portal_id' ) ) );
	}
	
	public function get_portal( $portal_id ) {
		return $this->db->get_where( 'portal', array( 'portal_id' => $portal_id ) )->row_array();
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'portal', $data, array( 'portal_id' => $this->input->post( 'target_id' ) ) );
	}
	
	public function update_level() {
		$level = count( $this->input->post( 'portal_id' ) ) - 1;
		foreach( $this->input->post( 'portal_id' ) as $portal_id ) {
			$data['level'] = $level;
			$this->db->update( 'portal', $data, array( 'portal_id' => $portal_id ) );
			$level--;
		}
	}
}