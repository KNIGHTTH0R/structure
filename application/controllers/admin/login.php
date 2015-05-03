<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Login extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'login_model' );
		/** Section Params **/
	}
	
	public function index() {
		
		$this->load->view( 'admin/login_view', [] );
	}
	
	public function authenticate_admin() {
		$admin_user = $this->login_model->authenticate_admin();
		if( $admin_user ) {
			echo 'success';
		} else {
			echo 'failure';
		}
	}
}