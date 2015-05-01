<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults extends CI_Controller {	
	function __construct() {
		parent::__construct();
		$this->load->model( 'portal/defaults_model' );
		
		/** Section Params **/
		$this->js           = '';
		$this->styles       = '';
		$this->control_item = 'portal/defaults';
	}
	
	public function index() {
		$this->page = 'options';
		$params = params_array( $this );
		
		$params['pages'] = $this->defaults_model->get_default_pages( $this->input->get( 'portal_id' ) );
		
		$this->layout->view( 'portal/defaults_view', $params, 'default' );
	}
}