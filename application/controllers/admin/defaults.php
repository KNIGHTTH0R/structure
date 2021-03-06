<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model( 'admin/defaults_model' );
		
		/** Section Params **/
		$this->js = 'assets/js/admin/defaults_init.js';
		$this->styles       = '';
		$this->control_item = 'admin/defaults';
	}
	
	/** Settings **/
	public function index() {
		$this->page = 'Settings';
		$this->init = 'Defaults';
		$params = params_array( $this );
		
		$this->layout->view( 'admin/defaults_view', $params );
	}
	
	/** Default Pages **/
	public function get_default_pages() {
		$default_pages = $this->defaults_model->get_default_pages();
		
		$count = 1;
		$column_1 = $column_2 = $column_3 = $column_4 = '';
		
		foreach( $default_pages as $page ) {
			extract( $page );
			
			${'column_' . $count} .= gen_toggle( $title . ' - ' . $alias, $page_id, $default_view, [ 'name' => 'page_id[' . $page_id . ']' ], TRUE );
			if( $count == 4 ) {
				$count = 1;
				continue;
			}
			$count++;
		}
		
		echo json_encode( [ 'column_1' => $column_1, 'column_2' => $column_2, 'column_3' => $column_3, 'column_4' => $column_4 ] );
	}
	
	public function update_pages() {
		$default_pages = $this->defaults_model->update_default_pages();
		if( $default_pages ) {
			echo 's|updated Page Defaults|';
		} else {
			echo 'e|update Page Defaults';
		}
	}
}