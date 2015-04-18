<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Menu_items extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/menu_items_model' );
		$this->js = 'assets/js/menu_items_crud_init.js';
	}
	
	public function index() {
		$params['page_title']		= 'Menu Item';
		$params['page_header']	= 'Menu Item <small>list</small>';
		$params['scripts']			= array( 'js' => $this->js, 'init' => 'Menu_items_list' );
		
		$menu_item_list = array(
			'actions' => array(
				'href' => 'menu_items/create',
				'icon_text' => 'Create',
				'reorder' => TRUE
			)
		);
		
		$params['access_options']	= get_access_levels();
		$params['menu_item_list']	= $menu_item_list;
		$params['list']						= $this->menu_items_model->menu_item_list( 'ad' );
		
		$this->layout->view( 'admin/menu_items_view', $params );
	}
	
	public function create() {
		$params['page_title']		= 'Menu Item';
		$params['page_header']	= 'Menu Item <small>create</small>';
		$params['scripts']			= array( 'js' => $this->js, 'init' => 'Menu_items_create' );
		

		$params['parent_options']			= $this->menu_items_model->parent_options();
		$params['site_url']						= site_url();
		
		$this->layout->view( 'admin/menu_items_create_view', $params );
	}
	
	public function insert() {
		$menu_item = $this->menu_items_model->menu_item_insert();
		if( $menu_item ) {
			echo 's|created Menu Item|' . site_url( 'admin/menu_items' );
		} else {
			echo 'f|create Menu Item';
		}
	}
	
	public function revise( $menu_item_id ) {
		$params['page_title']					= 'Menu Item';
		$params['page_header']				= 'Menu Item <small>revise</small>';
		$params['scripts']						= array( 'js' => $this->js, 'init' => 'Menu_items_revise' );
		
		$params['menu_item']					= $this->menu_items_model->get_menu_item( $menu_item_id );
		$params['parent_options']			= $this->menu_items_model->parent_options();
		
		$this->layout->view( 'admin/menu_items_revise_view', $params );
	}
	
	public function update() {
		$menu_item = $this->menu_items_model->menu_item_update();
		if( $menu_item ) {
			echo 's|updated Menu Item|' . site_url( 'admin/menu_items' );
		} else {
			echo 'f|update Menu Item';
		}
	}
	
	public function status() {
		$this->menu_items_model->set_status();
	}
	
	public function sequence() {
		$this->menu_items_model->update_sequence();
	}
}