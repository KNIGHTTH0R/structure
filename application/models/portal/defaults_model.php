<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** Default Pages **/
	public function get_default_pages( $portal_id ) {
		return $this->db->get_where( 'page_portal_xref', [ 'portal_id' => $portal_id ] )->result_array();	
	}
	
	/** Default Menu Items **/
	public function get_default_menu_items( $portal_id ) {
		$this->db->order_by( 'sequence' );
		$query = $this->db->get_where( 'fr_menu_item_portal_xref', [ 'portal_id' => $portal_id ] );
		return $query->result_array();
	}
}