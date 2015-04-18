<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Widgets_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function widget_list() {
		$query = $this->db->get( 'widget' );
		return $query->result_array();
	}
	
	public function object_params( $object_id ) {
		$query = $this->db->get_where( 'object', array( 'object_id' => $object_id ) );
		return $query->row_array();
	}
	
	public function widget_insert() {		
		$data['alias'] 			= $this->input->post( 'alias' );
		$data['status']			= '+';
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['object_id'] 	= $this->input->post( 'object_id' );
		$data['params']			= $this->input->post( 'params' );
		
		return $this->db->insert( 'widget', $data );
	}
	
	public function widget_revise( $widget_id ) {
		$query = $this->db->get_where( 'widget', array( 'widget_id' => $widget_id ) );
		return $query->row_array();
	}
	
	public function widget_update() {		
		$data['alias'] 			= $this->input->post( 'alias' );
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['params']			= $this->input->post( 'params' );
		
		return $this->db->update( 'widget', $data, array( 'widget_id' => $this->input->post( 'widget_id' ) ) );
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'widget', $data, array( 'widget_id' => $this->input->post( 'target_id' ) ) );
	}
}