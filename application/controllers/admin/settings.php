<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Settings extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/settings_model' );
		
		/** Section Params **/
		$this->js           = [ 'assets/js/admin/settings_init.js', 'assets/global/plugins/bootstrap-summernote/summernote.min.js' ];
		$this->styles       = 'assets/global/plugins/bootstrap-summernote/summernote.css';
		$this->control_item = 'admin/settings';
	}
	
	public function index() {
		$params = params_array( $this );
		
		$params['settings']						= $this->settings_model->get_settings();
		
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