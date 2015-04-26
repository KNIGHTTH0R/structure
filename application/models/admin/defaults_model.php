<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function get_default_pages() {
		$this->db->order_by( 'default_view', 'DESC' );
		return $this->db->get_where( 'page', [ 'portal_id' => -1, 'status' => '+' ] )->result_array();
	}
	
	public function update_default_pages() {
		$this->db->update( 'page', [ 'default_view' => 'n' ], [ 'portal_id' => -1 ] );
		
		foreach( $this->input->post( 'page_id' ) as $page_id => $x ) {
			$this->db->update( 'page', [ 'default_view' => 'y' ], [ 'portal_id' => -1, 'page_id' => $page_id ] );
		}
		
		return true;
	}
}