<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Access_levels_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function access_level_list() {
		$this->db->order_by( 'level', 'DESC' );
		return $this->db->get( 'access_level' )->result_array();
	}
	
	public function access_level_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->set( 'level', 'level+1', FALSE );
		$this->db->update( 'access_level' );
		
		$data['status'] 		= '+';
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		$data['level']			= 0;
		
		return $this->db->insert( 'access_level', $data );
	}
	
	public function access_level_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		
		return $this->db->update( 'access_level', $data, array( 'access_level_id' => $this->input->post( 'access_level_id' ) ) );
	}
	
	public function get_access_level( $access_level_id ) {
		return $this->db->get_where( 'access_level', array( 'access_level_id' => $access_level_id ) )->row_array();
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'access_level', $data, array( 'access_level_id' => $this->input->post( 'target_id' ) ) );
	}
	
	public function update_level() {
		$level = count( $this->input->post( 'access_level_id' ) ) - 1;
		foreach( $this->input->post( 'access_level_id' ) as $access_level_id ) {
			$data['level'] = $level;
			$this->db->update( 'access_level', $data, array( 'access_level_id' => $access_level_id ) );
			$level--;
		}
	}
}