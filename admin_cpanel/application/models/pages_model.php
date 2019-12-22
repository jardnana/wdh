<?php
class Pages_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_pages_list($page_id = ''){
		$this->db->select('*');
		$this->db->from('static_page_details');
		if($page_id !='')
			$this->db->where('static_page_details_id', $page_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_pages_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'page_name' 			=> $input['page_name'],
							'page_content_body' 	=> $input['page_content_body'],
							//'page_content_body_polish' 	=> $input['page_content_body_polish'],
							'page_content_side' 	=> $input['page_content_side'],
							'page_url' 				=> str_replace(" ","-",trim($input['page_name'])),
							'status' 				=> $input['status'],
							'creation_date'			=> (date('Y-m-d H:i:s'))					
						);
		$this->db->insert('static_page_details',$insert_data);
	}

	function active_pages($page_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('static_page_details_id', $page_id);
		$this->db->update('static_page_details', $data); 
	}
	
	function inactive_pages($page_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('static_page_details_id', $page_id);
		$this->db->update('static_page_details', $data); 
	}
	
	function delete_pages($page_id){
		$this->db->where('static_page_details_id', $page_id);
		$this->db->delete('static_page_details'); 
	}
	
	function update_pages($update,$page_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'page_name' 			=> $update['page_name'],
							'page_content_body' 	=> $update['page_content_body'],
							'page_url' 				=> str_replace(" ","-",trim($update['page_url'])),
							'status' 				=> $update['status']					
						);		
		$this->db->where('static_page_details_id', $page_id);
		$this->db->update('static_page_details', $update_data);
	}
}
?>
