<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Admin_users extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/admin_users_model' );
		
		/** Section Params **/
		$this->js = 'assets/js/admin_users_crud_init.js';
		$this->styles       = '';
		$this->control_item = 'admin/admin_users';
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list'] = $this->admin_users_model->admin_user_list();
		
		$this->layout->view( 'admin/admin_users_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$params['access_level_options']  = $this->admin_users_model->admin_access_levels();
		
		$this->layout->view( 'admin/admin_users_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$access_level = $this->admin_users_model->admin_user_insert();
		if( $access_level ) {
			echo 's|created Admin User|' . site_url( 'admin/admin_users' );
		} else {
			echo 'f|create Admin User';
		}
	}
	
	/** Revise **/
	public function revise( $admin_user_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['admin_user']						 = $this->admin_users_model->admin_user_revise( $admin_user_id );
		$params['access_level_options']  = $this->admin_users_model->admin_access_levels();
		
		$this->layout->view( 'admin/admin_users_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$access_level = $this->admin_users_model->admin_user_update();
		if( $access_level ) {
			echo 's|updated Admin User|' . site_url( 'admin/admin_users' );
		} else {
			echo 'f|update Admin User';
		}
	}
	
	/** Status **/
	public function status() {
		$this->admin_users_model->set_status();
	}
	
	/** Level **/
	public function level() {
		$this->admin_users_model->update_level();
	}
}