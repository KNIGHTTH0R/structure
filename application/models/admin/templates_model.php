<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Templates_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function template_list() {
		$this->db->order_by( 'status' );
		$this->db->order_by( 'title' );
		return $this->db->get( 'template' )->result_array();
	}
	
	/** Insert **/
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
		
		if( isset( $_POST['position'] ) ) {
			foreach( $_POST['position'] as $target => $widgets ) {		
				$sequence = 1;
				$this->db->select( 'column_id' );
				$query = $this->db->get_where( 'column', [ 'framework_id' => $this->input->post( 'framework_id' ), 'target' => $target ] );
				extract( $query->row_array() );
				foreach( $widgets as $widget_id ) {
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
		}
		
		return $template_id;
	}
	
	/** Revise **/
	public function template_revise( $template_id ) {
		return $this->db->get_where( 'template', array( 'template_id' => $template_id ) )->row_array();
	}
	
	/** Update **/
	public function template_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$this->db->delete( 'position', array( 'template_id' => $this->input->post( 'template_id' ) ) );
		
		if( isset( $_POST['position'] ) ) {
			foreach( $_POST['position'] as $target => $widgets ) {		
				$sequence = 1;
				$this->db->select( 'column_id' );
				$query = $this->db->get_where( 'column', [ 'framework_id' => $this->input->post( 'framework_id' ), 'target' => $target ] );
				extract( $query->row_array() );
				foreach( $widgets as $widget_id ) {
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
	
	/** Template Widget Positions **/
	public function get_positions( $template_id ) {
		$position_array = [];
		$this->db->select( 'p.widget_id, c.target, w.alias' );
		$this->db->join( 'widget AS w', 'w.widget_id = p.widget_id', 'inner' );
		$this->db->join( 'column AS c', 'c.column_id = p.column_id' );
		$this->db->order_by( 'p.column_id' );
		$this->db->order_by( 'p.sequence' );
		$query = $this->db->get_where( 'position AS p', [ 'template_id' => $template_id ] );
		if( $query->num_rows > 0 ) {
			foreach( $query->result_array() as $row ) {
				extract( $row );
				
				$position_array[$target][] = [ 'widget_id' => $widget_id, 'alias' => $alias ];
			}
		}
		return $position_array;
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'template', $data, array( 'template_id' => $this->input->post( 'target_id' ) ) );
	}
}