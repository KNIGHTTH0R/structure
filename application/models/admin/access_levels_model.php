<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Access_levels_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function access_level_list() {
		$this->db->select( "access_level_id, status, title, level, IF( admin_flg = 'y', 'checked', '' ) AS admin_flg", FALSE );
		$this->db->order_by( 'level', 'DESC' );
		return $this->db->get( 'access_level' )->result_array();
	}
	
	/** Insert **/
	public function access_level_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->set( 'level', 'level + 1', FALSE );
		$this->db->update( 'access_level' );
		
		$data['status'] 		= '+';
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		$data['level']			= 0;
		$data['admin_flg']  = $this->input->post( 'admin_flg' ) ? 'y' : 'n';
		
		return $this->db->insert( 'access_level', $data );
	}
	
	/** Revise **/
	public function access_level_revise( $access_level_id ) {
		return $this->db->get_where( 'access_level', [ 'access_level_id' => $access_level_id ] )->row_array();
	}
	
	/** Update **/
	public function access_level_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		$data['admin_flg']  = $this->input->post( 'admin_flg' ) ? 'y' : 'n';
		
		return $this->db->update( 'access_level', $data, [ 'access_level_id' => $this->input->post( 'access_level_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'access_level', $data, [ 'access_level_id' => $this->input->post( 'target_id' ) ] );
	}
	
	/** Sequence **/
	public function update_level() {
		$level = count( $this->input->post( 'access_level_id' ) ) - 1;
		foreach( $this->input->post( 'access_level_id' ) as $access_level_id ) {
			$data['level'] = $level;
			$this->db->update( 'access_level', $data, [ 'access_level_id' => $access_level_id ] );
			$level--;
		}
	}
}