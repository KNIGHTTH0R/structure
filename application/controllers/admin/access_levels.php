<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Access_levels extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/access_levels_model' );
		
		/** Section Params **/
		$this->js = 'assets/js/admin/access_levels_crud_init.js';
		$this->styles       = '';
		$this->control_item = 'admin/access_levels';
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['access_options']			= get_access_levels();
		$params['list']								= $this->access_levels_model->access_level_list();
		
		$this->layout->view( 'admin/access_levels_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
		$this->layout->view( 'admin/access_levels_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$access_level = $this->access_levels_model->access_level_insert();
		if( $access_level ) {
			echo 's|created Access Level|' . site_url( 'admin/access_levels' );
		} else {
			echo 'f|create Access Level';
		}
	}
	
	/** Revise **/
	public function revise( $access_level_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['access_level']					= $this->access_levels_model->access_level_revise( $access_level_id );
		
		$this->layout->view( 'admin/access_levels_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$access_level = $this->access_levels_model->access_level_update();
		if( $access_level ) {
			echo 's|updated Access Level|' . site_url( 'admin/access_levels' );
		} else {
			echo 'f|update Access Level';
		}
	}
	
	/** Status **/
	public function status() {
		$this->access_levels_model->set_status();
	}
	
	/** Level **/
	public function level() {
		$this->access_levels_model->update_level();
	}
}