<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Templates_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function template_list() {
		$this->db->order_by( 'status' );
		$this->db->order_by( 'title' );
		return $this->db->get( 'template' )->result_array();
	}
	
	public function template_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['status'] 			= '+';
		$data['entered']			= date( 'Y-m-d H:i:s' );
		$data['framework_id']	= $this->input->post( 'framework_id' );
		$data['title']				= $this->input->post( 'title' );
		
		$this->db->insert( 'template', $data );
		$template_id = $this->db->insert_id();
		
		if( ! $template_id ) {
			return false;
		}
		
		foreach( $_POST['column'] as $column_id => $widget_array ) {		
			$sequence = 1;
			foreach( $widget_array as $widget_id ) {
				$data = array(
					'framework_id'	=> $this->input->post( 'framework_id' ),
					'template_id' 	=> $template_id,
					'widget_id'			=> $widget_id,
					'column_id'			=> $column_id,
					'sequence'			=> $sequence
				);
				
				$this->db->insert( 'position', $data );
				$sequence++;
			}
		}
		
		return $template_id;
	}
	
	public function template_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->delete( 'position', array( 'template_id' => $this->input->post( 'template_id' ) ) );
		
		if( isset( $_POST['column'] ) ) {
			foreach( $_POST['column'] as $column_id => $widget_array ) {		
				$sequence = 1;
				foreach( $widget_array as $widget_id ) {
					$data = array(
						'framework_id'	=> $this->input->post( 'framework_id' ),
						'template_id' 	=> $this->input->post( 'template_id' ),
						'widget_id'			=> $widget_id,
						'column_id'			=> $column_id,
						'sequence'			=> $sequence
					);
					
					$this->db->insert( 'position', $data );
					$sequence++;
				}
			}
		}
		
		$data = array();
		$data['updated']			= date( 'Y-m-d H:i:s' );
		$data['framework_id']	= $this->input->post( 'framework_id' );
		$data['title']				= $this->input->post( 'title' );
		return $this->db->update( 'template', $data, array( 'template_id' => $this->input->post( 'template_id' ) ) );
	}
	
	public function get_template( $template_id ) {
		return $this->db->get_where( 'template', array( 'template_id' => $template_id ) )->row_array();
	}
	
	public function get_positions( $template_id ) {
		$position_array = array();
		$this->db->select( 'p.widget_id, p.column_id, w.alias' );
		$this->db->join( 'widget AS w', 'w.widget_id = p.widget_id', 'inner' );
		$this->db->order_by( 'p.column_id' );
		$this->db->order_by( 'p.sequence' );
		$query = $this->db->get_where( 'position AS p', array( 'template_id' => $template_id ) );
		if( $query->num_rows > 0 ) {
			foreach( $query->result_array() as $row ) {
				extract( $row );
				
				$position_array['column_id'][$column_id][] = array( 'widget_id' => $widget_id, 'alias' => $alias );
			}
		}
		return $position_array;
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'template', $data, array( 'template_id' => $this->input->post( 'target_id' ) ) );
	}
}