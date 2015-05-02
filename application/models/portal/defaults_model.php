<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Defaults_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** Default Pages **/
	public function default_pages_revise( $portal_id ) {
		$this->db->order_by( 'meta_data' );
		return $this->db->get_where( 'page_portal_xref', [ 'portal_id' => $portal_id ] )->result_array();
	}
	
	/** Default Pages Update **/
	public function default_pages_update( $portal_id ) {
		foreach( $this->input->post( 'page_id' ) as $page_id => $meta_data ) {
			$meta_data['status'] = isset( $meta_data['status'] ) ? '+' : '-';
			
			$data['alias']     = $this->input->post( 'alias' )[$page_id];
			$data['meta_data'] = json_encode( $meta_data );
			
			$this->db->update( 'page_portal_xref', $data, [ 'page_id' => $page_id, 'portal_id' => $portal_id ] );
		}
		return true;
	}
	
	/** Default Menu Items **/
	public function default_menu_items_revise( $portal_id ) {
		$this->db->order_by( 'sequence' );
		$query = $this->db->get_where( 'fr_menu_item_portal_xref', [ 'portal_id' => $portal_id ] );
		return $query->result_array();
	}
	
	/** Default Menu Items Update **/
	public function default_menu_items_update( $portal_id ) {
		foreach( $this->input->post( 'fr_menu_item_id' ) as $fr_menu_item_id => $meta_data ) {
			$meta_data['status'] = isset( $meta_data['status'] ) ? '+' : '-';
			
			$data['meta_data'] = json_encode( $meta_data );
			$this->db->update( 'fr_menu_item_portal_xref', $data, [ 'fr_menu_item_id' => $fr_menu_item_id, 'portal_id' => $portal_id ] );
		}
		return true;
	}
}