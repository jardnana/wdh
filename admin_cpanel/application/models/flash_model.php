<?php
class Flash_Model extends CI_Model {
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    function get_flash_list($flash_id = ''){
		$this->db->select('*');
		$this->db->from('flash_details');
		if($flash_id !='')
			$this->db->where('flash_details_id', $flash_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_flash_details($input,$flash_logo_name){
		if(!isset($input['flash_status']))
			$input['flash_status'] = "INACTIVE";
		$insert_data = array(
							'flash_title' 				=> $input['flash_title'],
							'flash_type' 				=> $input['flash_type'],
							'city_name' 				=> $input['city_name'],
							'description' 				=> $input['description'],
							'duration'	 				=> $input['duration'],
							'status' 					=> $input['flash_status'],
							'creation_date'				=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('flash_details',$insert_data);
	}

	function active_flash($flash_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('flash_details_id', $flash_id);
		$this->db->update('flash_details', $data); 
	}
	
	function inactive_flash($flash_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('flash_details_id', $flash_id);
		$this->db->update('flash_details', $data); 
	}
	
	function delete_flash($flash_id){
		$this->db->where('flash_details_id', $flash_id);
		$this->db->delete('flash_details'); 
	}
	
	function update_flash($update,$flash_id, $flash_logo_name){
		if(!isset($update['flash_status']))
			$update['flash_status'] = "INACTIVE";
		$update_data = array(
							'flash_title' 				=> $update['flash_title'],
							'flash_type' 				=> $update['flash_type'],
							'city_name' 				=> $update['city_name'],
							'description' 				=> $update['description'],
							'duration'	 				=> $update['duration'],
							'status' 					=> $update['flash_status']			
						);			
		$this->db->where('flash_details_id', $flash_id);
		$this->db->update('flash_details', $update_data);
	}
}
?>
