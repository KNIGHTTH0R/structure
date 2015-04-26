<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Widgets extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/widgets_model' );
		
		/** Section Params **/
		$this->js           = [ 'assets/js/widgets_crud_init.js', 'assets/global/plugins/bootstrap-summernote/summernote.min.js' ];
		$this->styles       = 'assets/global/plugins/bootstrap-summernote/summernote.css';
		$this->control_item = 'admin/widgets';
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );
		
		$params['list']	       = $this->widgets_model->widget_list();
		
		$this->layout->view( 'admin/widgets_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this->page = 'create';
		$params = params_array( $this );
		
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
		$this->page = 'revise';
		$params = params_array( $this );

		$widget											= $this->widgets_model->widget_revise( $widget_id );
		$params['object']		        = $this->widgets_model->object_params( $widget['object_id'] );
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
		gen_ui_object_params( $object['params'] );
	}
}