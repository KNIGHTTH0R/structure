<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Widgets extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/widgets_model' );
		$this->js = array( 'assets/js/widget_crud_init.js', 'assets/global/plugins/bootstrap-summernote/summernote.min.js' );
		$this->styles = 'assets/global/plugins/bootstrap-summernote/summernote.css';
	}
	
	/** List **/
	public function index() {
		$params = params_array( 'Widgets', 'Widgets <small>list</small>' );
		
		$widget_list = [
			'actions' => [
				'href' => 'widgets/create',
				'icon_text' => 'Create'
			]
		];
		
		$params['list']	       = $this->widgets_model->widget_list();
		$params['widget_list'] = $widget_list;
		$params['scripts']		= [ 'js' => $this->js, 'init' => 'Widget_list' ];
		
		$this->layout->view( 'admin/widgets_view', $params );
	}
	
	/** Create **/
	public function create() {		
		$params = params_array( 'Widgets', 'Widgets <small>create</small>' );
		
		$params['scripts']					= [ 'js' => $this->js, 'init' => 'Widget_create' ];
		$params['styles']						= $this->styles;
		
		$this->layout->view( 'admin/widgets_create_view.php', $params );
	}
	
	/** Insert **/
	public function insert() {
		$insert = $this->widgets_model->widget_insert();
		if( $insert ) {
			echo 's|created Widget|' . site_url( 'admin/widgets' );;
		} else {
			echo 'e|create Widget';
		}
	}
	
	/** Revise **/
	public function revise( $widget_id ) {
		$params = params_array( 'Widgets', 'Widgets <small>revise</small>' );
		
		$widget											= $this->widgets_model->widget_revise( $widget_id );
		$object											= $this->widgets_model->object_params( $widget['object_id'] );
		$params['object']						= gen_ui_object_params( $object['params'] );
		$params['scripts']					= [ 'js' => $this->js, 'init' => 'Widget_revise' ];
		$params['styles']						= $this->styles;
		$params['widget']						= $widget;
		
		$this->layout->view( 'admin/widgets_revise_view.php', $params );
	}
	
	/** Update **/
	public function update() {
		$update = $this->widgets_model->widget_update();
		if( $update ) {
			echo 's|updated Widget|' . site_url( 'admin/widgets' );;
		} else {
			echo 'e|update Widget';
		}
	}
	
	/** Status **/
	public function status() {
		$this->widgets_model->set_status();
	}
	
	/** General **/
	public function get_object_params( $object_id ) {
		$object = $this->widgets_model->object_params( $object_id );
		$object_params = gen_ui_object_params( $object['params'] );
		gen_ui_object_inputs( $object_params );
	}
}