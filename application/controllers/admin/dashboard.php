<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Dashboard extends CI_Controller {	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {		
		$params = params_array( 'Dashboard', 'Dashboard <small> statistics and more</small>' );
		
		$this->layout->view( 'admin/dashboard_view', $params, 'default' );
	}
}