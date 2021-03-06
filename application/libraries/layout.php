<?php if ( ! defined('BASEPATH')) exit('No direct scripts access allowed');

class Layout {
	private $CI;
	
	public function __construct() {
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	public function view( $view_name, $view_params = [], $layout = 'default' ) {
		if( ! session_check( $view_params['page_access_level_id'] ) ) {
			if( isset( $view_params['page_id'] ) ) {
				redirect( 'home' );
			} else {
				redirect( 'admin/login' );
			}
		}
		
		$settings = $this->CI->db->get_where( 'setting', [ 'setting_id' => 1 ] )->row_array();
		
		define( 'SITE_TITLE', $settings['site_title'] );
		$location	 			= '';
		$view_directory = 'admin/';
		
		if( ! access_check( $view_params['page_access_level_id'] ) ) {
			if( isset( $view_params['page_id'] ) ) {
				$view_name = get_404_page();
				$view_params['page_id'] = -1;
			} else {
				show_404();
			}
		}
		
		if( isset( $view_params['page_id'] ) ) {
			$location 			= 'frameworks/';
			$view_directory = 'front/';
			
			$this->CI->db->select( 'c.target' );
			$this->CI->db->join( 'template AS t', 't.framework_id = f.framework_id' );
			$this->CI->db->join( 'column AS c', 'c.framework_id = t.framework_id' );
			$this->CI->db->join( 'page AS p', 'p.template_id = t.template_id' );
			$this->CI->db->where( 'p.page_id', $view_params['page_id'] );
			$query = $this->CI->db->get( 'framework AS f' );
			$widgets_array = array_column( $query->result_array(), 'target' );
			$widgets_array = array_fill_keys( $widgets_array, [] );
			
			$this->CI->db->select( 'o.file, c.target, w.params' );
			$this->CI->db->join( 'template AS t', 't.template_id = p.template_id' );
			$this->CI->db->join( 'framework AS f', 'f.framework_id = t.framework_id' );
			$this->CI->db->join( 'column AS c', 'c.framework_id = f.framework_id' );
			$this->CI->db->join( 'position AS po', 'po.column_id = c.column_id AND po.template_id = t.template_id' );
			$this->CI->db->join( 'widget AS w', 'w.widget_id = po.widget_id' );
			$this->CI->db->join( 'object AS o', 'o.object_id = w.object_id' );
			$this->CI->db->where( 'p.page_id', $view_params['page_id'] );
			$this->CI->db->order_by( 'c.target' );
			$this->CI->db->order_by( 'po.sequence' );
			$query = $this->CI->db->get( 'page AS p' );
			
			$column_count 	= 1;
			if( $query->num_rows() > 0 ) {
				foreach( $query->result_array() as $row ) {
					extract( $row );
					$widgets_array[$target][] = [ 'file' => $file, 'params' => $params ];
				}
				
				foreach( $widgets_array as $column ) {
					$target_column = '';
					foreach( $column as $widget ) {
						extract( $widget );
						
						$target_column .= $this->CI->load->view( 'objects/' . $file, [ 'params' => $params ], TRUE );
					}
					$view_params['column_' . $column_count] = $target_column;
					$column_count++;
				}
			}
		}
		
		$layout_params['breadcrumbs'] 	= isset( $view_params['breadcrumbs'] ) ? $view_params['breadcrumbs'] : '';
		$layout_params['page_header'] 	= isset( $view_params['page_header'] ) ? $view_params['page_header'] : 'Default';
		$layout_params['page_title']		= isset( $view_params['page_title'] ) ? SITE_TITLE . ' | ' . $view_params['page_title'] : SITE_TITLE . ' | Default';
		$layout_params['styles'] 				= isset( $view_params['styles'] ) ? $view_params['styles'] : '';
		$layout_params['scripts']				= isset( $view_params['scripts'] ) ? $view_params['scripts'] : '';
		$layout_params['username'] 			= $this->CI->session->userdata( 'username' );
		$layout_params['view_content']	= $this->CI->load->view( $location . $view_name, $view_params, TRUE );
		
		$this->CI->load->view( $view_directory . 'layouts/' . $layout . '.php', $layout_params);
	}
}