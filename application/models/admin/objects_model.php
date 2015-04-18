<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Objects_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	public function object_list() {
		$this->db->order_by( 'title' );
		return $this->db->get( 'object' )->result_array();
	}
	
	public function object_revise( $object_id ) {
		return $this->db->get_where( 'object', array( 'object_id' => $object_id ) )->row_array();
	}
	
	public function object_insert() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$file = str_replace( ' ', '_', strtolower( $this->input->post( 'title' ). '_ob' ) );
		
		$data['status'] 		= '+';
		$data['entered']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		$data['file']				= $file;
		$data['params']			= $this->input->post( 'params' );
		
		$fh = fopen( APPPATH . 'views/objects/' . $file . '.php', "w" );
		fwrite( $fh, '' );
		fclose( $fh );
		
		return $this->db->insert( 'object', $data );
	}
	
	public function access_level_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		
		return $this->db->update( 'access_level', $data, array( 'access_level_id' => $this->input->post( 'access_level_id' ) ) );
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'object', $data, array( 'object_id' => $this->input->post( 'target_id' ) ) );
	}
	
	public function object_update() {
		if( empty( $_POST ) ) {
			return false;
		}
		
		$data['updated']		= date( 'Y-m-d H:i:s' );
		$data['title']			= $this->input->post( 'title' );
		
		return $this->db->update( 'object', $data, array( 'object_id' => $this->input->post( 'object_id' ) ) );
	}
}