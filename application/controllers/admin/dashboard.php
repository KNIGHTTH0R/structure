<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Dashboard extends CI_Controller {	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {		
		$params = array(
			'page_title' => 'Dashboard',
			'page_header' => 'Dashboard <small>& statistics</small>'
		);
		
		$this->layout->view( 'admin/dashboard_view', $params, 'default' );
	}
}