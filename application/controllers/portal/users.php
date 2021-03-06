<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Users extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'portal/users_model' );
		
		/** Section Params **/
		$this->js = 'assets/js/portal/users_crud_init.js';
		$this->styles       = '';
		$this->control_item = 'portal/users';
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list'] 		 = $this->users_model->user_list( $this->input->get( 'portal_id' ) );
		$params['portal_id'] = $this->input->get( 'portal_id' );
		
		$this->layout->view( 'portal/users_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$params['portal_id'] 						 = $this->input->get( 'portal_id' );
		$params['access_level_options']  = $this->users_model->portal_access_levels();
		
		$this->layout->view( 'portal/users_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$access_level = $this->users_model->user_insert();
		if( $access_level ) {
			echo 's|created User|' . site_url( 'portal/users?portal_id=' . $this->input->post( 'portal_id' ) );
		} else {
			echo 'f|create User';
		}
	}
	
	/** Revise **/
	public function revise( $portal_user_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['portal_id'] 						 = $this->input->get( 'portal_id' );
		$params['user']									 = $this->users_model->user_revise( $portal_user_id );
		$params['access_level_options']  = $this->users_model->portal_access_levels();
		
		$this->layout->view( 'portal/users_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$access_level = $this->users_model->user_update();
		if( $access_level ) {
			echo 's|updated User|' . site_url( 'portal/users?portal_id=' . $this->input->post( 'portal_id' ) );
		} else {
			echo 'f|update User';
		}
	}
	
	/** Status **/
	public function status() {
		$this->users_model->set_status();
	}
	
	/** Level **/
	public function level() {
		$this->users_model->update_level();
	}
}