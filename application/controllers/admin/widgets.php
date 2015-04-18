<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Widgets extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/widgets_model' );
		$this->js = array( 'assets/js/widget_crud_init.js', 'assets/global/plugins/bootstrap-summernote/summernote.min.js' );
		$this->styles = 'assets/global/plugins/bootstrap-summernote/summernote.css';
	}
	
	public function index() {
		$params['page_title'] = 'Widgets';
		$params['page_header']	= 'Widgets <small>list</small>';
		
		$widget_list = array(
			'actions' => array(
				'href' => 'widgets/create',
				'icon_text' => 'Create'
			)
		);
		
		$params['list']	= $this->widgets_model->widget_list();
		$params['widget_list'] = $widget_list;
		$params['scripts']			= array( 'js' => $this->js, 'init' => 'Widget_list' );
		
		$this->layout->view( 'admin/widgets_view', $params );
	}
	
	public function create() {		
		$params['page_title']				= 'Widget Create';
		$params['page_header']			= 'Widget <small>create</small>';
		
		$params['scripts']					= array( 'js' => $this->js, 'init' => 'Widget_create' );
		$params['styles']						= $this->styles;
		
		$this->layout->view( 'admin/widgets_create_view.php', $params );
	}
	
	public function insert() {
		$insert = $this->widgets_model->widget_insert();
		if( $insert ) {
			echo 's|created Widget|' . site_url( 'admin/widgets' );;
		} else {
			echo 'e|create Widget';
		}
	}
	
	public function revise( $widget_id ) {		
		$params['page_title']				= 'Widget Revise';
		$params['page_header']			= 'Widget <small>revise</small>';
		
		$widget											= $this->widgets_model->widget_revise( $widget_id );
		$object											= $this->widgets_model->object_params( $widget['object_id'] );
		$params['object']						= gen_ui_object_params( $object['params'] );
		$params['scripts']					= array( 'js' => $this->js, 'init' => 'Widget_revise' );
		$params['styles']						= $this->styles;
		$params['widget']						= $widget;
		
		$this->layout->view( 'admin/widgets_revise_view.php', $params );
	}
	
	public function update() {
		$update = $this->widgets_model->widget_update();
		if( $update ) {
			echo 's|updated Widget|' . site_url( 'admin/widgets' );;
		} else {
			echo 'e|update Widget';
		}
	}
	
	public function get_object_params( $object_id ) {
		$object = $this->widgets_model->object_params( $object_id );
		$object_params = gen_ui_object_params( $object['params'] );
		gen_ui_object_inputs( $object_params );
	}
	
	public function status() {
		$this->widgets_model->set_status();
	}
}