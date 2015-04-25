<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Widgets_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/** List **/
	public function widget_list() {
		$this->db->select( 'w.widget_id, w.status, w.alias, o.title' );
		$this->db->join( 'object AS o', 'o.object_id = w.object_id' );
		$query = $this->db->get( 'widget AS w' );
		return $query->result_array();
	}
	
	/** Insert **/
	public function widget_insert() {
		$this->db->select( 'params' );
		$object_params = $this->db->get_where( 'object', [ 'object_id' => $this->input->post( 'object_id' ) ] )->row_array();
		$object_params = json_decode( $object_params['params'], TRUE );
		$object_params = array_column( $object_params, 'field_name' );
		
		$params_array = [];
		foreach( $object_params as $param ) {
			if( $this->input->post( $param ) ) {
				$params_array[$param] = $this->input->post( $param );
			}
		}

		
		$data['alias'] 			= $this->input->post( 'alias' );
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['object_id'] 	= $this->input->post( 'object_id' );
		$data['params']			= json_encode( $params_array );
		
		return $this->db->insert( 'widget', $data );
	}
	
	/** Revise **/
	public function widget_revise( $widget_id ) {
		$query = $this->db->get_where( 'widget', [ 'widget_id' => $widget_id ] );
		return $query->row_array();
	}
	
	/** Update **/
	public function widget_update() {
		$this->db->select( 'params' );
		$object_params = $this->db->get_where( 'object', [ 'object_id' => $this->input->post( 'object_id' ) ] )->row_array();
		$object_params = json_decode( $object_params['params'], TRUE );
		$object_params = array_column( $object_params, 'field_name' );
		
		$params_array = [];
		foreach( $object_params as $param ) {
			if( $this->input->post( $param ) ) {
				$params_array[$param] = $this->input->post( $param );
			}
		}
		
		$data['alias'] 			= $this->input->post( 'alias' );
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['params']			= json_encode( $params_array );
		
		return $this->db->update( 'widget', $data, [ 'widget_id' => $this->input->post( 'widget_id' ) ] );
	}
	
	/** Status **/
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'widget', $data, [ 'widget_id' => $this->input->post( 'target_id' ) ] );
	}
	
	/** General **/
	public function object_params( $object_id ) {
		$query = $this->db->get_where( 'object', [ 'object_id' => $object_id ] );
		return $query->row_array();
	}
}