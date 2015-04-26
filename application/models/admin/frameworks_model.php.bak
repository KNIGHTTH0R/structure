<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Frameworks_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper( 'file' );
	}
	
	/** List **/
	function framework_list() {
		$this->db->order_by( 'status' );
		$this->db->order_by( 'title' );
		$query = $this->db->get( 'framework' );
		return $query->result_array();
	}
	
	/** Insert **/
	function framework_insert() {
		$mockup_array = [];
		$file = str_replace( ' ', '_', strtolower( $this->input->post( 'title' ). '_fr' ) );
		
		$data['status']		= '+';
		$data['entered']	= date( 'Y-m-d H:i:s' );
		$data['title'] 		= $this->input->post( 'title' );
		$data['file']			= $file;
		$this->db->insert( 'framework', $data );
		
		$framework_id = $this->db->insert_id();
		$count = 1;
		
		$file_data = '<div class="row">' . "\n";
		foreach( $this->input->post( 'framework_width' ) as $row => $columns ) {
			foreach( $columns as $column_count => $column ) {
				if( isset( $_POST['allow_widgets'][$row][$column_count] ) ) {
					$mockup_array[$row][] = $column;
					
					$data = [
						'framework_id' => $framework_id,
						'target' => 'column-' . $count
					];
					
					$this->db->insert( 'column', $data );
					
					$variable = '<?=$column_' . $count . ';?>';
					$count++;
				} else {
					$mockup_array[$row][] = $column . '*';
					$variable = '';
				}
				$file_data .= '<div class="col-md-' . $column . '">' . $variable . '</div>'  . "\n";
			}
		}
		$file_data .= '</div>';
		$fh = fopen( APPPATH . 'views/frameworks/' . $file . '.php', 'w' );
		fwrite( $fh, $file_data );
		fclose( $fh );
		
		$mockup_array = array_values( $mockup_array );
		
		$data = [
			'mockup' => json_encode( $mockup_array )
		];
		
		$this->db->update( 'framework', $data, [ 'framework_id' => $framework_id ] );
		return $framework_id;
	}
	
	/** Revise **/
	function framework_revise( $framework_id ) {
		return $this->db->get_where( 'framework', [ 'framework_id' => $framework_id ] )->row_array();
	}
	
	/** Update **/
	function framework_update() {
		$data['title'] = $this->input->post( 'title' );
		
		return $this->db->update( 'framework', $data, [ 'framework_id' => $this->input->post( 'framework_id' ) ] );
	}
	
	/** Status **/
	function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'framework', $data, [ 'framework_id' => $this->input->post( 'target_id' ) ] );
	}
}