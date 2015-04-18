<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Settings_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function get_settings() {
		
		return $this->db->get_where( 'setting', array( 'setting_id' => 1 ) )->row_array();
	}
	
	public function update_settings() {
		$data['site_title']	= $this->input->post( 'site_title' );
		
		return $this->db->update( 'setting', $data, array( 'setting_id' => 1 ) );
	}
}