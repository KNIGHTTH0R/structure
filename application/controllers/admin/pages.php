<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Pages extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/pages_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/pages_crud_init.js';
		$this->styles       = '';
		$this->section      = section_check( TRUE );
		
		if( $this->input->get( 'portal_id' ) == -1 ) {
			$this->control_item = 'admin/pages?portal_id=' . $this->input->get( 'portal_id' );
		} else {
			$this->control_item = 'portal/pages';
		}
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list']	     = $this->pages_model->page_list( $this->input->get( 'portal_id' ) );
		$params['portal_id'] = $this->input->get( 'portal_id' );
		$this->layout->view( 'admin/pages_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$params['portal_id'] = $this->input->get( 'portal_id' );
		
		$this->layout->view( 'admin/pages_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$section = $this->input->post( 'portal_id' ) == -1 ? 'admin' : 'portal';
		
		$page = $this->pages_model->page_insert();
		if( $page ) {
			echo 's|created Page|' . site_url( $section . '/pages?portal_id=' . $this->input->post( 'portal_id' ) );
		} else {
			echo 'f|create Page';
		}
	}
	
	/** Revise **/
	public function revise( $page_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['page'] 		 = $this->pages_model->page_revise( $page_id );
		$params['portal_id'] = $this->input->get( 'portal_id' );
		
		$this->layout->view( 'admin/pages_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$section = $this->input->post( 'portal_id' ) == -1 ? 'admin' : 'portal';
		$page = $this->pages_model->page_update();
		if( $page ) {
			echo 's|updated Page|' . site_url( $section . '/pages?portal_id=' . $this->input->post( 'portal_id' ) );
		} else {
			echo 'f|update Page';
		}
	}
	
	/** Status **/
	public function status() {
		$this->pages_model->set_status();
	}
	
	/** Defaults **/
	/** Defaults Page List **/
	public function defaults_list() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list']	     = $this->pages_model->page_list( -1 );
		$params['portal_id'] = -1;
		$this->load->view( 'admin/pages_view', $params );
	}
	
	/** Defaults Create Page **/
	public function defaults_create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$params['portal_id'] = -1;
		
		$this->load->view( 'admin/pages_create_view', $params );
	}
	
	/** Defaults Revise Page **/
	public function defaults_revise( $page_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['page'] 		 = $this->pages_model->page_revise( $page_id );
		$params['portal_id'] = -1;
		
		$this->load->view( 'admin/pages_revise_view', $params );
	}
}