<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Fr_menu_items_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function fr_menu_item_list( $portal_id ) {
		$parents = [];
		$this->db->order_by( 'status' );
		$this->db->order_by( 'sequence' );
		$query = $this->db->get_where( 'fr_menu_item', [ 'parent_id' => 0, 'portal_id' => $portal_id ] );
		if( $query->num_rows() > 0 ) {
			$parents = $query->result_array();
			$count = 0;
			foreach( $parents as $parent ) {
				extract( $parent );
				
				$this->db->order_by( 'sequence' );
				$children = $this->db->get_where( 'fr_menu_item', [ 'parent_id' => $fr_menu_item_id, 'portal_id' => $portal_id ] );
				if( $children->num_rows() > 0 ) {
					$parents[$count]['children_list'] = $children->result_array();
				}
				$count++;
			}
		}
		return $parents;
	}
	
	/** Insert **/
	public function fr_menu_item_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->order_by( 'sequence', 'DESC' );
		$query = $this->db->get_where( 'fr_menu_item', [ 'parent_id' => $this->input->post( 'parent_id' ) ], 1 );
		if( $query->num_rows() > 0 ) {
			extract( $query->row_array() );
			$sequence = $sequence + 1;
		} else {
			$sequence = 1;
		}
		
		$data['entered']			= date( 'Y-m-d H:i:s' );
		$data['portal_id']		= $this->input->post( 'portal_id' );
		$data['title']				= $this->input->post( 'title' );
		$data['alias']				= $this->input->post( 'alias' );
		$data['access_level_id']	= $this->input->post( 'access_level_id' );
		$data['parent_id']		= $this->input->post( 'parent_id' );
		$data['icon']					= $this->input->post( 'icon' );
		$data['sequence']			= $sequence;
		
		return $this->db->insert( 'fr_menu_item', $data );
	}
	
	/** Revise **/
	public function fr_menu_item_revise( $fr_menu_item_id ) {
		return $this->db->get_where( 'fr_menu_item', [ 'fr_menu_item_id' => $fr_menu_item_id ] )->row_array();
	}
	
	/** Update **/
	public function fr_menu_item_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']			= date( 'Y-m-d H:i:s' );
		$data['title']				= $this->input->post( 'title' );
		$data['alias']				= $this->input->post( 'alias' );
		$data['access_level_id']	= $this->input->post( 'access_level_id' );
		$data['parent_id']		= $this->input->post( 'parent_id' );
		$data['icon']					= $this->input->post( 'icon' );
		
		return $this->db->update( 'fr_menu_item', $data, [ 'fr_menu_item_id' => $this->input->post( 'fr_menu_item_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'fr_menu_item', $data, [ 'fr_menu_item_id' => $this->input->post( 'target_id' ) ] );
	}
	
	/** Sequence **/
	public function update_sequence() {
		foreach( $this->input->post( 'fr_menu_item_id' ) as $sequence => $fr_menu_item_id ) {
			$data['sequence'] = $sequence + 1;
			$this->db->update( 'fr_menu_item', $data, [ 'fr_menu_item_id' => $fr_menu_item_id ] );
		}
	}
	
	/** Parent Options **/
	public function parent_options( $portal_id, $exclude_id = '' ) {
		$parent_options = [ '0' => 'None' ];
		
		if( ! empty( $exclude_id ) ) {
			$this->db->where( 'fr_menu_item_id !=', $exclude_id );
		}
		
		$this->db->order_by( 'title' );
		$query = $this->db->get_where( 'fr_menu_item', [ 'parent_id' => 0, 'portal_id' => $portal_id ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $menu_item ) {
				extract( $menu_item );
				
				$parent_options[$fr_menu_item_id] = $title;
			}
		}
		
		return $parent_options;
	}
}