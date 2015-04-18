<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Portals extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/portals_model' );
		//$this->js = 'assets/js/access_levels_crud_init.js';
	}
	
	public function index() {
		$params['page_title']					= 'Portals';
		$params['page_header']				= 'Portals <small>list</small>';
		
		$portal_list = array(
			'actions' => array(
				'href' => 'portals/create',
				'icon_text' => 'Create'
			)
		);
		
		$params['portal_list']	= $portal_list;
		$params['list']					= $this->portals_model->portal_list();
		
		//$params['scripts']						= array( 'js' => $this->js, 'init' => 'Access_levels_list' );
		
		$this->layout->view( 'admin/portals_view', $params );
	}
	
	public function create() {		
		$params['page_title']						= 'Access Levels';
		$params['page_header']					= 'Access Level <small>create</small>';
		
		$params['scripts']							= array( 'js' => $this->js, 'init' => 'Access_levels_create' );
		$params['site_url']							= site_url();
		
		$this->layout->view( 'admin/access_levels_create_view', $params );
	}
	
	public function insert() {
		$access_level = $this->access_levels_model->access_level_insert();
		if( $access_level ) {
			echo 's|created Access Level|' . site_url( 'admin/access_levels' );
		} else {
			echo 'f|create Access Level';
		}
	}
	
	public function revise( $access_level_id ) {
		$params['page_title']						= 'Access Levels';
		$params['page_header']					= 'Access Level <small>revise</small>';
		
		$params['access_level']					= $this->access_levels_model->get_access_level( $access_level_id );
		$params['scripts']							= array( 'js' => $this->js, 'init' => 'Access_levels_revise' );
		
		$this->layout->view( 'admin/access_levels_revise_view', $params );
	}
	
	public function update() {
		$access_level = $this->access_levels_model->access_level_update();
		if( $access_level ) {
			echo 's|updated Access Level|' . site_url( 'admin/access_levels' );
		} else {
			echo 'f|update Access Level';
		}
	}
	
	public function status() {
		$this->access_levels_model->set_status();
	}
	
	public function level() {
		$this->access_levels_model->update_level();
	}
}