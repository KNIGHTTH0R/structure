<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Login_model extends CI_Model {
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
}