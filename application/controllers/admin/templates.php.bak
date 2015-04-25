<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Templates extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/templates_model' );
		
		/** Section Params **/
		$this->js      = 'assets/js/templates_crud_init.js';
		$this->styles  = '';
		$this->control = 'Templates';
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['access_options']			= get_access_levels();
		$params['list']								= $this->templates_model->template_list();
		
		$this->layout->view( 'admin/templates_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->load->model( 'admin/frameworks_model' );		
		$this->page = 'create';
		$params = params_array( $this );
		
		$template_create = array(
			'title' => 'Template Create',
			'title_icon' 	=> 'file-text',
			'body_cclass' => 'form'
		);
		
		$params['framework_list']				= $this->frameworks_model->framework_list();
		$params['template_create']			= $template_create;
		
		$this->layout->view( 'admin/templates_create_view', $params );
	}
	
	/** Insert **/
	public function insert() {
		$template = $this->templates_model->template_insert();
		if( $template ) {
			echo 's|created Template|' . site_url( 'admin/templates' );
		} else {
			echo 'f|create Template';
		}
	}
	
	/** Revise **/
	public function revise( $template_id ) {
		$this->load->model( 'admin/frameworks_model' );		
		$this->page = 'revise';
		$params = params_array( $this );
		
		$template 											= $this->templates_model->template_revise( $template_id );
		$params['positions']						= $this->templates_model->get_positions( $template_id );
		$params['framework']						= $this->frameworks_model->framework_revise( $template['framework_id'] );
		$params['template']							= $template;
		
		$this->layout->view( 'admin/templates_revise_view', $params );
	}
	
	/** Update **/
	public function update() {
		$template = $this->templates_model->template_update();
		if( $template ) {
			echo 's|updated Template|' . site_url( 'admin/templates' );
		} else {
			echo 'f|update Template';
		}
	}
	
	/** Status **/
	public function status() {
		$this->templates_model->set_status();
	}
	
	/** Level **/
	public function level() {
		$this->templates_model->update_level();
	}
}