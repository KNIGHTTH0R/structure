<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Objects extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/objects_model' );
		$this->js = 'assets/js/objects_crud_init.js';
	}
	
	public function index() {
		$params = params_array( 'Objects', 'Objects <small>list</small>' );
		
		$object_list = [
			'actions' => [
				'href' => 'objects/create',
				'icon_text' => 'Create'
			]
		];
		
		$params['object_list']		= $object_list;
		$params['list']						= $this->objects_model->object_list();
		$params['scripts']				= [ 'js' => $this->js, 'init' => 'Objects_list' ];
		
		$this->layout->view( 'admin/objects_view', $params );
	}
	
	public function create() {
		$params = params_array( 'Objects', 'Objects <small>create</small>' );
		
		$params['scripts'] = [ 'js' => $this->js, 'init' => 'Objects_create' ];
		
		$this->layout->view( 'admin/objects_create_view', $params );
	}
	
	public function insert() {
		$object = $this->objects_model->object_insert();
		if( $object ) {
			echo 's|created Object|' . site_url( 'admin/objects' );
		} else {
			echo 'f|create Object';
		}
	}
	
	public function revise( $object_id ) {
		$params = params_array( 'Objects', 'Objects <small>revise</small>' );
		
		$object										= $this->objects_model->object_revise( $object_id );
		$params['object']					= $object;
		$params['object_params']	= gen_ui_object_params( $object['params'] );
		$params['scripts']				= [ 'js' => $this->js, 'init' => 'Objects_revise' ];
		
		$this->layout->view( 'admin/objects_revise_view', $params );
	}
	
	public function update() {
		$object = $this->objects_model->object_update();
		if( $object ) {
			echo 's|updated Object|' . site_url( 'admin/objects' );
		} else {
			echo 'f|update Object';
		}
	}
	
	public function status() {
		$this->objects_model->set_status();
	}
}