<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Layout {
	private $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	public function view( $view_name, $params = array(), $layout = 'default' ) {
		$framework_params = $params;
		
		if( isset( $framework_params['page_id'] ) ) {
			$location = 'frameworks/';
			
			$this->CI->db->select( 'o.file, po.column_id, w.params' );
			$this->CI->db->join( 'template AS t', 't.template_id = p.template_id' );
			$this->CI->db->join( 'framework AS f', 'f.framework_id = t.framework_id' );
			$this->CI->db->join( 'column AS c', 'c.framework_id = f.framework_id' );
			$this->CI->db->join( 'position AS po', 'po.framework_id = f.framework_id AND po.template_id = t.template_id' );
			$this->CI->db->join( 'widget AS w', 'w.widget_id = po.widget_id' );
			$this->CI->db->join( 'object AS o', 'o.object_id = w.object_id' );
			$this->CI->db->where( 'p.page_id', $params['page_id'] );
			$this->CI->db->order_by( 'po.column_id' );
			$query = $this->CI->db->get( 'page AS p' );
			
			$target_column 	= '';
			$current_column = '';
			$column_count 	= 1;
			if( $query->num_rows() > 0 ) {
				foreach( $query->result_array() as $row ) {
					extract( $row );
					
					if( empty( $current_column ) ) {
						$current_column = $column_id;
					} else if( $current_column != $column_id ) {
						$framework_params['column_' . $current_column] = $target_column;
						$target_column = '';
						$current_column = $column_id;
					}
					
					$target_column .= $this->CI->load->view( 'objects/' . $file, array( 'params' => $params ), TRUE );
					
					if( $query->num_rows() == $column_count ) {
						$framework_params['column_' . $current_column] = $target_column;
					}
					
					$column_count++;
				}
			}
		} else {
			$location = '';
		}
		
		$framework_params['site_url']		= site_url();
		
		$layout_params['breadcrumbs'] 	= isset( $params['breadcrumbs'] ) ? $params['breadcrumbs'] : '';
		$layout_params['logout_link']		= site_url( 'logout' );
		$layout_params['page_header'] 	= isset( $params['page_header'] ) ? $params['page_header'] : 'Default';
		$layout_params['page_title']		= isset( $params['page_title'] ) ? SITE_TITLE . $params['page_title'] : SITE_TITLE . 'Default';
		$layout_params['styles'] 				= isset( $params['styles'] ) ? $params['styles'] : '';
		$layout_params['scripts']				= isset( $params['scripts'] ) ? $params['scripts'] : '';
		$layout_params['top_menu']			= get_top_menu();
		$layout_params['username'] 			= $this->CI->session->userdata( 'username' );
		$layout_params['view_content']	= $this->CI->load->view( $location . $view_name, $framework_params, TRUE );
		
		$this->CI->load->view( 'layouts/' . $layout . '.php', $layout_params );
	}
}