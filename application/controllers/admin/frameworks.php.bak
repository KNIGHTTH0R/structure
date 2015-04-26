<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Frameworks extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/frameworks_model' );
		
		/** Section Params **/
		$this->js           = 'assets/js/frameworks_crud_init.js';
		$this->styles       = '';
		$this->control_item = 3;
	}
	
	/** List **/
	public function index() {
		$this->page = 'list';
		$params = params_array( $this );

		$params['list']						= $this->frameworks_model->framework_list();		
		
		$this->layout->view( 'admin/frameworks_view', $params );
	}
	
	/** Create **/
	public function create() {
		$this-> page = 'create';
		$params = params_array( $this );
		
		$this->layout->view( 'admin/frameworks_create_view.php', $params );
	}
	
	/** Insert **/
	public function insert() {
		$framework = $this->frameworks_model->framework_insert();
		if( $framework ) {
			echo 's|created Framework|' . site_url( 'admin/frameworks' );
		} else {
			echo 'f|create Framework';
		}
	}
	
	/** Revise **/
	public function revise( $framework_id ) {
		$this->page = 'revise';
		$params = params_array( $this );
		
		$params['framework']				= $this->frameworks_model->framework_revise( $framework_id );
		
		$this->layout->view( 'admin/frameworks_revise_view.php', $params );
	}
	
	/** Update **/
	public function update() {
		$framework = $this->frameworks_model->framework_update();
		if( $framework ) {
			echo 's|updated Framework|' . site_url( 'admin/frameworks' );
		} else {
			echo 'f|update Framework';
		}
	}
	
	/** Status **/
	public function status() {
		$this->frameworks_model->set_status();
	}
}