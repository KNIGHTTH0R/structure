<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Frameworks extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/frameworks_model' );
		$this->js = 'assets/js/framework_crud_init.js';
	}
	
	public function index() {
		$params['page_title']			= 'Frameworks';
		$params['page_header']		= 'Frameworks <small>list</small>';
		
		$framework_list = array(
			'actions' => array(
				'href' => 'frameworks/create',
				'icon_text' => 'Create'
			)
		);
		
		$params['framework_list']	= $framework_list;
		$params['list']						= $this->frameworks_model->framework_list();		
		$params['scripts']				= array( 'js' => $this->js, 'init' => 'Framework_list' );
		
		$this->layout->view( 'admin/frameworks_view', $params );
	}
	
	public function create() {
		$params['page_title']				= 'Framework Create';
		$params['page_header']			= 'Framework <small>create</small>';
		
		$params['scripts']					= array( 'js' => $this->js, 'init' => 'Framework_create' );
		
		$this->layout->view( 'admin/frameworks_create_view.php', $params );
	}
	
	public function revise( $framework_id ) {
		$params['page_title']				= 'Framework Revise';
		$params['page_header']			= 'Framework <small>revise</small>';
		
		$params['framework']				= $this->frameworks_model->get_framework( $framework_id );
		$params['scripts']					= array( 'js' => $this->js, 'init' => 'Framework_revise' );
		
		$this->layout->view( 'admin/frameworks_revise_view.php', $params );
	}
	
	public function insert() {
		$framework = $this->frameworks_model->framework_insert();
		if( $framework ) {
			echo 's|created Framework|' . site_url( 'admin/frameworks' );
		} else {
			echo 'f|create Framework';
		}
	}
	
	public function update() {
		$framework = $this->frameworks_model->framework_update();
		if( $framework ) {
			echo 's|updated Framework|' . site_url( 'admin/frameworks' );
		} else {
			echo 'f|update Framework';
		}
	}
	
	public function status() {
		$this->frameworks_model->set_status();
	}
}