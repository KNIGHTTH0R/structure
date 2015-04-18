<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Settings extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/settings_model' );
		$this->js = 'assets/js/settings_init.js';
	}
	
	public function index() {
		$params['page_title']					= 'Settings';
		$params['page_header']				= 'Settings <small>admin control</small>';
		
		$params['settings']						= $this->settings_model->get_settings();
		$params['scripts']						= array( 'js' => $this->js, 'init' => 'Settings' );
		
		$this->layout->view( 'admin/settings_view', $params );
	}
	
	public function update() {
		$settings = $this->settings_model->update_settings();
		if( $settings ) {
			echo 's|updated Settings|';
		} else {
			echo 'f|update Settings';
		}
	}
}