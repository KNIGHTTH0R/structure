<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Authentication_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function authenticate_admin() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$query = $this->db->get_where( 'admin_user', [ 'username' => $this->input->post( 'username' ) ] );
		if( $query->num_rows() > 0 ) {
			extract( $query->row_array() );
			
			if( ! password_verify( $this->input->post( 'password' ), $password ) ) {
				return false;
			}
			
			$session['access_level_id'] = $access_level_id;
			$session['admin_user_id']   = $admin_user_id;
			$session['name']            = $first_name . ' ' . $last_name;
			$session['email']						= $email;
			$session['site_owner_flg']  = $site_owner_flg;
			$session['username']        = $username;
			$session['last_activity']   = strtotime( 'now' );
			
			$this->session->set_userdata( $session );
			return true;
		} else {
			return false;
		}
	}
	
	public function logout_admin() {
		$this->session->sess_destroy();
	}
	
	public function authenticate_user() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$query = $this->db->get_where( 'user', [ 'username' => $this->input->post( 'username' ) ] );
		if( $query->num_rows() > 0 ) {
			extract( $query->row_array() );
			
			if( ! password_verify( $this->input->post( 'password' ), $password ) ) {
				return false;
			}
			
			$session['access_level_id'] = $access_level_id;
			$session['user_id']   		  = $user_id;
			$session['name']            = $first_name . ' ' . $last_name;
			$session['email']						= $email;
			$session['username']        = $username;
			$session['portal_id']       = $portal_id;
			$session['last_activity']   = strtotime( 'now' );
			
			$this->session->set_userdata( $session );
			return true;
		} else {
			return false;
		}
	}
	
	public function logout_user() {
		$this->session->sess_destroy();
	}
}