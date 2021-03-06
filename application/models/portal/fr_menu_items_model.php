<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Fr_menu_items_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function fr_menu_item_list( $portal_id ) {
		$fr_menu_item_array = [];
		$count = 0;
		$this->db->select( 'fr.*, a.title AS access_level_title, "fr" AS type', FALSE );
		$this->db->join( 'access_level AS a', 'a.access_level_id = fr.access_level_id' );
		$this->db->order_by( 'fr.sequence' );
		$query = $this->db->get_where( 'fr_menu_item AS fr', [ 'fr.parent_id' => 0, 'fr.portal_id' => $portal_id ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $parent_item ) {
				$fr_menu_item_array[$count] = $parent_item;
				
				$this->db->select( 'fr.*, a.title AS access_level_title, "fr" AS type', FALSE );
				$this->db->join( 'access_level AS a', 'a.access_level_id = fr.access_level_id' );
				$this->db->order_by( 'fr.sequence' );
				$children = $this->db->get_where( 'fr_menu_item AS fr', [ 'fr.parent_id' => $parent_item['fr_menu_item_id'], 'fr.portal_id' => $portal_id ] );
				if( $children->num_rows() > 0 ) {
					$fr_menu_item_array[$count]['children'] = $children->result_array();
				}
				$count++;
			}
		}
		
		$this->db->select( '*, "df" AS type', FALSE );
		$query = $this->db->get_where( 'fr_menu_item_portal_xref', [ 'portal_id' => $portal_id ] );
		if( $query->num_rows() > 0 ) {
			foreach( $query->result_array() as $fr_menu_item ) {
				extract( $fr_menu_item );
				$meta_data = json_decode( $meta_data, TRUE );
				extract( $meta_data );
				
				$this->db->select( 'title AS access_level_title' );
				$query = $this->db->get_where( 'access_level', [ 'access_level_id' => $access_level_id ] );
				extract( $query->row_array() );
				
				$fr_menu_item_array[$count]['fr_menu_item_id'] = $fr_menu_item_id;
				$fr_menu_item_array[$count]['title'] = $title;
				$fr_menu_item_array[$count]['alias'] = $alias;
				$fr_menu_item_array[$count]['icon'] = $icon;
				$fr_menu_item_array[$count]['sequence'] = $sequence;
				$fr_menu_item_array[$count]['access_level_id'] = $access_level_id;
				$fr_menu_item_array[$count]['access_level_title'] = $access_level_title;
				$fr_menu_item_array[$count]['status'] = $status;
				$fr_menu_item_array[$count]['type'] = $type;
				$count++;
			}	
		}
		
		function sequence_sort( $a, $b ) {
			return $a['sequence'] - $b['sequence'];
		}
		
		usort( $fr_menu_item_array, "sequence_sort" );
		return $fr_menu_item_array;
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
		
		$data['entered']					= date( 'Y-m-d H:i:s' );
		$data['portal_id']				= $this->input->post( 'portal_id' );
		$data['title']						= $this->input->post( 'title' );
		$data['alias']						= $this->input->post( 'alias' );
		$data['access_level_id']	= $this->input->post( 'access_level_id' );
		$data['parent_id']				= $this->input->post( 'parent_id' );
		$data['icon']							= $this->input->post( 'icon' );
		$data['sequence']					= $sequence;
		
		$this->db->insert( 'fr_menu_item', $data );
		$fr_menu_item_id = $this->db->insert_id();
		
		if( $this->input->post( 'all_portals' ) ) {
			$this->db->select( 'portal_id' );
			$query = $this->db->get( 'portal' );
			if( $query->num_rows() > 0 ) {
				$meta_data = [
					'status' 					=> '+',
					'title' 					=> $this->input->post( 'title' ),
					'alias' 					=> $this->input->post( 'alias' ),
					'icon' 					  => $this->input->post( 'icon' ),
					'access_level_id' => $this->input->post( 'access_level_id' )
				];
				$meta_data = json_encode( $meta_data );
				foreach( $query->result_array() as $row ) {
					extract( $row );
					
					$this->db->select( 'sequence AS fr_sequence' );
					$this->db->order_by( 'sequence DESC' );
					$query = $this->db->get_where( 'fr_menu_item', [ 'portal_id' => $portal_id ], 1 );
					if( $query->num_rows() > 0 ) {
						extract( $query->row_array() );
					} else {
						$fr_sequence = 0;
					}
					
					$this->db->select( 'sequence AS df_sequence' );
					$this->db->order_by( 'sequence DESC' );
					$query = $this->db->get_where( 'fr_menu_item_portal_xref', [ 'portal_id' => $portal_id ], 1 );
					if( $query->num_rows() > 0 ) {
						extract( $query->row_array() );
					} else {
						$df_sequence = 0;
					}
					
					if( $fr_sequence > $df_sequence ) {
						$sequence = $fr_sequence + 1;
					} else {
						$sequence = $df_sequence + 1;
					}
					
					$xrf_data = [ 'meta_data' => $meta_data ];
					$xrf_data['fr_menu_item_id'] = $fr_menu_item_id;
					$xrf_data['portal_id'] 			 = $portal_id;
					$xrf_data['sequence']				 = $sequence;
					$this->db->insert( 'fr_menu_item_portal_xref', $xrf_data );
				}
			}
		}
		
		return $fr_menu_item_id;
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
		$sequence = 1;
		if( $this->input->post( 'fr_menu_item_id' ) ) {
			foreach( $this->input->post( 'fr_menu_item_id' ) as $fr_menu_item_id ) {
				$data['sequence'] = $sequence;
				$this->db->update( 'fr_menu_item', $data, [ 'fr_menu_item_id' => $fr_menu_item_id ] );
				$sequence++;
			}
		}
		
		if( $this->input->post( 'df_menu_item_id' ) ) {
			foreach( $this->input->post( 'df_menu_item_id' ) as $df_menu_item_id ) {
				$data['sequence'] = $sequence;
				$this->db->update( 'fr_menu_item_portal_xref', $data, [ 'fr_menu_item_id' => $df_menu_item_id, 'portal_id' => $this->input->post( 'portal_id' ) ] );
				$sequence++;
			}
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