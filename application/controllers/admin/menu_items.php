<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Menu_items extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/menu_items_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/menu_items_crud_init.js';		
		$this->styles       = '';
		$this->control_item = 8;
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['access_options']	= get_access_levels();
		$params['list']						= $this->menu_items_model->menu_item_list( section_check() );
		
		$this->layout->view( 'admin/menu_items_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );		

		$params['parent_options']			= $this->menu_items_model->parent_options();
		
		$this->layout->view( 'admin/menu_items_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$menu_item = $this->menu_items_model->menu_item_insert();
		if( $menu_item ) {
			echo 's|created Menu Item|' . site_url( 'admin/menu_items' );
		} else {
			echo 'f|create Menu Item';
		}
	}
	
	/** Revise **/
	public function revise( $menu_item_id ) {
		$this->page = 'revise';
		$params = params_array( $this );	
		
		$params['menu_item']					= $this->menu_items_model->get_menu_item( $menu_item_id );
		$params['parent_options']			= $this->menu_items_model->parent_options();
		
		$this->layout->view( 'admin/menu_items_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$menu_item = $this->menu_items_model->menu_item_update();
		if( $menu_item ) {
			echo 's|updated Menu Item|' . site_url( 'admin/menu_items' );
		} else {
			echo 'f|update Menu Item';
		}
	}
	
	/** Status **/
	public function status() {
		$this->menu_items_model->set_status();
	}
	
	/** Sequence **/
	public function sequence() {
		$this->menu_items_model->update_sequence();
	}
}