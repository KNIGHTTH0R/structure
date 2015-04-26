<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Dashboard extends CI_Controller {	
	function __construct() {
		parent::__construct();
		
		/** Section Params **/
		$this->js           = '';
		$this->styles       = '';
		$this->control_item = 'portal/dashboard';
	}
	
	public function index() {
		$this->page = 'dashboard';
		$params = params_array( $this );
		
		$this->layout->view( 'portal/dashboard_view', $params, 'default' );
	}
}