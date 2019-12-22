<?php
class Content_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_content_list($page_id = ''){
		$this->db->select('*');
		$this->db->from('static_content_details');
		if($page_id !='')
			$this->db->where('static_content_details_id', $page_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_content_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'title' 			=> $input['title'],
							'content' 			=> $input['content'],
							'status' 			=> $input['status'],
							'creation_date'		=> (date('Y-m-d H:i:s'))					
						);
		$this->db->insert('static_content_details',$insert_data);
	}

	function active_content($page_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('static_content_details_id', $page_id);
		$this->db->update('static_content_details', $data); 
	}
	
	function inactive_content($page_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('static_content_details_id', $page_id);
		$this->db->update('static_content_details', $data); 
	}
	
	function delete_content($page_id){
		$this->db->where('static_content_details_id', $page_id);
		$this->db->delete('static_content_details'); 
	}
	
	function update_content($update,$page_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'title' 			=> $update['title'],
							'content' 			=> $update['content'],
							'status' 			=> $update['status']					
						);		
		$this->db->where('static_content_details_id', $page_id);
		$this->db->update('static_content_details', $update_data);
	}
}
?>
