<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Menu_items_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function menu_item_list( $section ) {
		$parents = [];
		$this->db->order_by( 'status' );
		$this->db->order_by( 'sequence' );
		$query = $this->db->get_where( 'menu_item', [ 'parent_id' => 0, 'portal_id' => -1, 'section' => $section ] );
		if( $query->num_rows() > 0 ) {
			$parents = $query->result_array();
			$count = 0;
			foreach( $parents as $parent ) {
				extract( $parent );
				
				$this->db->order_by( 'sequence' );
				$children = $this->db->get_where( 'menu_item', array( 'parent_id' => $menu_item_id, 'portal_id' => -1 ) );
				if( $children->num_rows() > 0 ) {
					$parents[$count]['children_list'] = $children->result_array();
				}
				$count++;
			}
		}
		return $parents;
	}
	
	/** Insert **/
	public function menu_item_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->order_by( 'sequence', 'desc' );
		$query = $this->db->get_where( 'menu_item', [ 'parent_id' => $this->input->post( 'parent_id' ) ], 1 );
		if( $query->num_rows() > 0 ) {
			extract( $query->row_array() );
			$sequence = $sequence + 1;
		} else {
			$sequence = 1;
		}		
		
		$data['status'] 			= '+';
		$data['entered']			= date( 'Y-m-d H:i:s' );
		$data['portal_id']		= -1;
		$data['title']				= $this->input->post( 'title' );
		$data['view']					= $this->input->post( 'view' );
		$data['access_level']	= $this->input->post( 'access_level' );
		$data['parent_id']		= $this->input->post( 'parent_id' );
		$data['section']			= $this->input->post( 'section' );
		$data['icon']					= $this->input->post( 'icon' );
		$data['sequence']			= $sequence;
		
		return $this->db->insert( 'menu_item', $data );
	}
	
	/** Revise **/
	public function menu_item_revise( $menu_item_id ) {
		return $this->db->get_where( 'menu_item', array( 'menu_item_id' => $menu_item_id ) )->row_array();
	}
	
	/** Update **/
	public function menu_item_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']			= date( 'Y-m-d H:i:s' );
		$data['title']				= $this->input->post( 'title' );
		$data['view']					= $this->input->post( 'view' );
		$data['access_level']	= $this->input->post( 'access_level' );
		$data['parent_id']		= $this->input->post( 'parent_id' );
		$data['icon']					= $this->input->post( 'icon' );
		
		return $this->db->update( 'menu_item', $data, [ 'menu_item_id' => $this->input->post( 'menu_item_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'menu_item', $data, array( 'menu_item_id' => $this->input->post( 'target_id' ) ) );
	}
	
	/** Sequence **/
	public function update_sequence() {
		foreach( $this->input->post( 'menu_item_id' ) as $sequence => $menu_item_id ) {
			$data['sequence'] = $sequence + 1;
			$this->db->update( 'menu_item', $data, array( 'menu_item_id' => $menu_item_id ) );
		}
	}
	
	/** Parent Options **/
	public function parent_options( $section, $exclude_id = '' ) {
		$parent_options = [ '0' => 'None' ];
		
		if( ! empty( $exclude_id ) ) {
			$this->db->where( 'menu_item_id !=', $exclude_id );
		}
		
		$this->db->order_by( 'title' );
		$query = $this->db->get_where( 'menu_item', [ 'parent_id' => 0, 'section' => $section ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $menu_item ) {
				extract( $menu_item );
				
				$parent_options[$menu_item_id] = $title;
			}
		}
		
		return $parent_options;
	}
}