<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Pages extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/pages_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/pages_crud_init.js';
		$this->styles       = '';
		$this->control_item = 27;
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list']	= $this->pages_model->page_list();
		
		$this->layout->view( 'admin/pages_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$this->layout->view( 'admin/pages_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$page = $this->pages_model->page_insert();
		if( $page ) {
			echo 's|created Page|' . site_url( 'admin/pages' );
		} else {
			echo 'f|create Page';
		}
	}
	
	/** Revise **/
	public function revise( $page_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$page									= $this->pages_model->page_revise( $page_id );
		$params['page'] 				= $page;
		$params['page_params']	= json_decode( $page['params'], TRUE );
		
		$this->layout->view( 'admin/pages_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$page = $this->pages_model->page_update();
		if( $page ) {
			echo 's|updated Page|' . site_url( 'admin/pages' );
		} else {
			echo 'f|update Page';
		}
	}
	
	/** Status **/
	public function status() {
		$this->pages_model->set_status();
	}
}