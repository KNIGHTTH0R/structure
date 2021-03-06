<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Authentication extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'authentication_model' );
		/** Section Params **/
	}
	
	public function index() {
		
		$this->load->view( 'admin/login_view', [] );
	}
	
	public function authenticate_admin() {
		$admin_user = $this->authentication_model->authenticate_admin();
		if( $admin_user ) {
			echo 's|authenticated User|' . site_url( 'admin/dashboard' );
		} else {
			echo 'e|authenticate User|';
		}
	}
	
	public function logout_admin() {
		$this->authentication_model->logout_admin();
		redirect( 'admin/login' );
	}
	
	public function authenticate_user() {
		$user = $this->authentication_model->authenticate_user();
		if( $user ) {
			echo 's|authenticated User|' . site_url( 'home' );
		} else {
			$admin_user = $this->authentication_model->authenticate_admin();
			if( $admin_user ) {
				echo 's|authenticated User|' . site_url( 'home' );
			} else {
				echo 'e|authenticate User|';
			}
		}
	}
	
	public function logout_user() {
		$this->authentication_model->logout_user();
		echo 'here';
	}
}