<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Frameworks_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper( 'file' );
	}
	
	function framework_list() {
		$this->db->order_by( 'status' );
		$this->db->order_by( 'title' );
		$query = $this->db->get( 'framework' );
		return $query->result_array();
	}
	
	function framework_insert() {
		$mockup_array = array();
		$file = str_replace( ' ', '_', strtolower( $this->input->post( 'title' ). '_fr' ) );
		
		$data['status']		= '+';
		$data['entered']	= date( 'Y-m-d H:i:s' );
		$data['title'] 		= $this->input->post( 'title' );
		$data['file']			= $file;
		$this->db->insert( 'framework', $data );
		
		$framework_id = $this->db->insert_id();
		$count = 1;
		$file_data = '<div class="row">' . "\n";
		foreach( $_POST as $key => $value ) {
			if( strpos( $key, '-' ) ) {
				$framework = explode( '-', $key );
				if( in_array( 'column', $framework ) ) {
					$column 		= array_pop( $framework );
					$column_num = $framework[2];
					$mockup_array[$column][$column_num]['size'] = $this->input->post( $key );
					
					if( $this->input->post( 'framework-widgets-' . $column_num . '-' . $column ) ) {
						$mockup_array[$column][$column_num]['widgets'] = 'yes';
						$data = array(
							'framework_id' => $framework_id,
							'target' => 'column-' . $count 
						);
						
						$this->db->insert( 'column', $data );
						
						$variable = '<?=$column_' . $count . ';?>';
						$count++;
					} else {
						$variable = '';
					}
					
					$file_data .= '<div class="col-md-' . $this->input->post( $key ) . '">' . $variable . '</div>'  . "\n";
				}
			}
		}
		$file_data .= '</div>' . "\n";
		$fh = fopen( APPPATH . 'views/frameworks/' . $file . '.php', "w" );
		fwrite( $fh, $file_data );
		fclose( $fh );
		
		$mockup = '';
		foreach( $mockup_array as $row ) {
			foreach( $row as $preview ) {
				$widgets = '';
				extract( $preview );
				
				$widget_check = empty( $widgets ) ? '*' : '';
				$mockup .= $size . $widget_check . '|';
			}
			$mockup = rtrim( $mockup, '|' );
			$mockup .= '~';
		}
		
		$mockup = rtrim( $mockup, '~' );
		$data = array(
			'mockup' => $mockup
		);
		
		$this->db->update( 'framework', $data, array( 'framework_id' => $framework_id ) );
		return $framework_id;
	}
	
	function get_framework( $framework_id ) {
		return $this->db->get_where( 'framework', array( 'framework_id' => $framework_id ) )->row_array();
	}
	
	function framework_update() {
		$data['title'] = $this->input->post( 'title' );
		
		return $this->db->update( 'framework', $data, array( 'framework_id' => $this->input->post( 'framework_id' ) ) );
	}
	
	public function set_status() {
		$data['status'] = $this->input->post( 'status' );
		$this->db->update( 'framework', $data, array( 'framework_id' => $this->input->post( 'target_id' ) ) );
	}
}