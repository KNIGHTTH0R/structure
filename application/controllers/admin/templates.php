<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Templates extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/templates_model' );
		$this->js = 'assets/js/template_crud_init.js';
	}
	
	public function index() {
		$template_list = array(
			'title' => 'Templates',
			'actions' => array(
				'href' => 'templates/create',
				'icon_text' => 'Create'
			),
			'title_icon' 	=> 'file-text'
		);
		
		$params['access_options']			= get_access_levels();
		$params['template_list']			= $template_list;
		$params['list']								= $this->templates_model->template_list();
		$params['page_title']					= 'Templates';
		$params['page_header']				= 'Templates <small>list</small>';
		$params['scripts']						= array( 'js' => $this->js, 'init' => 'Templates_list' );
		$params['site_url']						= site_url();
		
		$this->layout->view( 'admin/templates_view', $params );
	}
	
	public function create() {
		$this->load->model( 'admin/frameworks_model' );
		
		$template_create = array(
			'title' => 'Template Create',
			'title_icon' 	=> 'file-text',
			'body_cclass' => 'form'
		);
		
		$params['framework_list']				= $this->frameworks_model->framework_list();
		$params['template_create']			= $template_create;
		$params['page_title']						= 'Templates';
		$params['page_header']					= 'Template <small>create</small>';
		$params['scripts']							= array( 'js' => $this->js, 'init' => 'Templates_create' );
		
		$this->layout->view( 'admin/templates_create_view', $params );
	}
	
	public function insert() {
		$template = $this->templates_model->template_insert();
		if( $template ) {
			echo 's|created Template|' . site_url( 'admin/templates' );
		} else {
			echo 'f|create Template';
		}
	}
	
	public function revise( $template_id ) {
		$this->load->model( 'admin/frameworks_model' );		
		
		$params['page_title']						= 'Templates';
		$params['page_header']					= 'Template <small>revise</small>';
		$template 											= $this->templates_model->get_template( $template_id );
		
		$params['positions']						= $this->templates_model->get_positions( $template_id );
		$params['framework']						= $this->frameworks_model->get_framework( $template['framework_id'] );
		$params['template']							= $template;
		$params['scripts']							= array( 'js' => $this->js, 'init' => 'Templates_revise' );
		
		$this->layout->view( 'admin/templates_revise_view', $params );
	}
	
	public function update() {
		$template = $this->templates_model->template_update();
		if( $template ) {
			echo 's|updated Template|' . site_url( 'admin/templates' );
		} else {
			echo 'f|update Template';
		}
	}
	
	public function status() {
		$this->templates_model->set_status();
	}
	
	public function level() {
		$this->templates_model->update_level();
	}
}