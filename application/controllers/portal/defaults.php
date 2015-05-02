<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'portal/defaults_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/portal/defaults_init.js';
		$this->styles       = '';
		$this->control_item = 'portal/defaults';
	}
	
	/** Defaults **/
	public function index() {
		$params = params_array( $this );
		
		$params['menu_items'] = $this->defaults_model->default_menu_items_revise( $this->input->get( 'portal_id' ) );
		$params['pages']      = $this->defaults_model->default_pages_revise( $this->input->get( 'portal_id' ) );
		$params['portal_id']  = $this->input->get( 'portal_id' );
		
		$this->layout->view( 'portal/defaults_view', $params, 'default' );
	}
	
	/** Pages Update**/
	public function default_pages_update( $portal_id ) {
		$page = $this->defaults_model->default_pages_update( $portal_id );
		if( $page ) {
			echo 's|updated Default Pages|';
		} else {
			echo 'f|update Default Pages';
		}
	}
	
	/** Menu Items Update **/
	public function default_menu_items_update( $portal_id ) {
		$page = $this->defaults_model->default_menu_items_update( $portal_id );
		if( $page ) {
			echo 's|updated Default Menu Items|';
		} else {
			echo 'f|update Default Menu Items';
		}
	}
}