<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Portals extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/portals_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/admin/portal_crud_init.js';
		$this->styles       = '';
		$this->control_item = 'admin/portals';
	}
	
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list']					= $this->portals_model->portal_list();
		
		$this->layout->view( 'admin/portals_view', $params );
	}
	
	public function insert() {
		$portal = $this->portals_model->portal_insert();
		if( $portal ) {
			echo 's|created Portal|' . site_url( 'portal/dashboard?portal_id=' . $portal );
		} else {
			echo 'f|create Portal';
		}
	}
	
	public function status() {
		$this->access_levels_model->set_status();
	}
}