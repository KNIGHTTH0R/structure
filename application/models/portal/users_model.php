<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Users_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** Admin Access Levels **/
	public function portal_access_levels() {
		$access_level_options = [];
		$this->db->where( 'admin_flg IS NULL' );
		$this->db->order_by( 'level', 'DESC' );
		$query = $this->db->get( 'access_level' );
		if( $query->num_rows() > 0 ) {
			$access_level_options = array_column( $query->result_array(), 'title', 'access_level_id' );
		}
		return $access_level_options;
	}
	
	/** List **/
	public function user_list( $portal_id ) {
		$this->db->select( 'u.user_id, u.status, CONCAT( u.first_name, " ", u.last_name ) AS name, a.title AS access_level_title', FALSE );
		$this->db->join( 'access_level AS a', 'a.access_level_id = u.access_level_id', 'LEFT' );
		$this->db->order_by( 'u.status, u.first_name, u.last_name' );
		return $this->db->get_where( 'user AS u', [ 'u.portal_id' => $portal_id ] )->result_array();
	}
	
	/** Insert **/
	public function user_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['entered']		     = date( 'Y-m-d H:i:s' );
		$data['first_name']	     = $this->input->post( 'first_name' );
		$data['last_name']	     = $this->input->post( 'last_name' );
		$data['email']			     = $this->input->post( 'email' );
		$data['username']		     = $this->input->post( 'username' );
		$data['password']		     = password_hash( $this->input->post( 'password' ), PASSWORD_DEFAULT );
		$data['access_level_id'] = $this->input->post( 'access_level_id' );
		$data['portal_id'] 			 = $this->input->post( 'portal_id' );
		
		return $this->db->insert( 'user', $data );
	}
	
	/** Revise **/
	public function user_revise( $user_id ) {
		return $this->db->get_where( 'user', [ 'user_id' => $user_id ] )->row_array();
	}
	
	/** Update **/
	public function user_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['first_name']	= $this->input->post( 'first_name' );
		$data['last_name']	= $this->input->post( 'last_name' );
		$data['email']			= $this->input->post( 'email' );
		$data['username']		= $this->input->post( 'username' );
		if( $this->input->post( 'password' ) ) {
			$data['password']	= password_hash( $this->input->post( 'password' ), PASSWORD_DEFAULT );
		}
		if( $this->input->post( 'access_level_id' ) ) {
			$data['access_level_id'] = $this->input->post( 'access_level_id' );
		}
		
		return $this->db->update( 'user', $data, [ 'user_id' => $this->input->post( 'user_id' ) ] );
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'user', $data, array( 'user_id' => $this->input->post( 'target_id' ) ) );
	}
}