<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Portals_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function portal_list() {
		$this->db->where( 'portal_id > 0' );
		return $this->db->get( 'portal' )->result_array();
	}
	
	public function portal_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['name']			= $this->input->post( 'name' );
		
		$this->db->insert( 'portal', $data );
		$portal_id = $this->db->insert_id();
		if( $portal_id ) {
			$this->default_menu_items( $portal_id );
			$this->default_pages( $portal_id );
		}
		return $portal_id;
	}
	
	public function default_menu_items( $portal_id ) {
		$this->db->select( 'fr_menu_item_id, title, alias, access_level_id, icon' );
		$query = $this->db->get_where( 'fr_menu_item', [ 'portal_id' => -1, 'status' => '+' ] );
		if( $query->num_rows() > 0 ) {
			$sequence = 1;
			foreach( $query->result_array() as $row ) {
				extract( $row );
				$meta_data = [
					'status' 					=> '+',
					'title' 					=> $title,
					'alias' 					=> $alias,
					'icon' 					  => $icon,
					'access_level_id' => $access_level_id
				];
				$meta_data = json_encode( $meta_data );
				$xrf_data = [ 'meta_data' => $meta_data ];
				$xrf_data['fr_menu_item_id'] = $fr_menu_item_id;
				$xrf_data['portal_id'] 			 = $portal_id;
				$xrf_data['sequence']				 = $sequence;
				
				$this->db->insert( 'fr_menu_item_portal_xref', $xrf_data );
				$sequence++;
			}
		}
	}
	
	public function default_pages( $portal_id ) {
		$this->db->select( 'page_id, template_id, title, alias, access_level_id' );
		$query = $this->db->get_where( 'page', [ 'portal_id' => -1, 'status' => '+' ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $row ) {
				extract( $row );
				$meta_data = [
					'status' 					=> '+',
					'title' 					=> $title,
					'template_id' 		=> $template_id,
					'access_level_id' => $access_level_id
				];
				$meta_data = json_encode( $meta_data );
				$xrf_data = [ 'meta_data' => $meta_data ];
				$xrf_data['page_id']   = $page_id;
				$xrf_data['portal_id'] = $portal_id;
				$xrf_data['alias']     = $alias;
				
				$this->db->insert( 'page_portal_xref', $xrf_data );
			}
		}
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'portal', $data, array( 'portal_id' => $this->input->post( 'target_id' ) ) );
	}
}