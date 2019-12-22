<?php
class Api_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_api_list($api_id = ''){
		$this->db->select('*');
		$this->db->from('api_details');
		if($api_id !='')
			$this->db->where('api_details_id', $api_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_api_details($input,$api_logo_name){
		if(!isset($input['api_status']))
			$input['api_status'] = "INACTIVE";
		$insert_data = array(
							'api_name' 				=> $input['api_name'],
							'api_alternative_name' 	=> $input['api_name_alternative'],
							'api_logo' 				=> $api_logo_name,
							'api_username' 			=> $input['api_user_name'],
							'api_username1' 		=> $input['api_user_name1'],
							'api_url' 				=> $input['api_url'],
							'api_url1' 				=> $input['api_url1'],
							'api_password' 			=> $input['api_password'],
							'api_credential_type' 	=> $input['api_mode'],
							'api_status' 			=> $input['api_status'],
							'creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('api_details',$insert_data);
	}

	function active_api($api_id){
		$data = array(
					'api_status' => 'ACTIVE'
					);
		$this->db->where('api_details_id', $api_id);
		$this->db->update('api_details', $data); 
	}
	
	function inactive_api($api_id){
		$data = array(
					'api_status' => 'INACTIVE'
					);
		$this->db->where('api_details_id', $api_id);
		$this->db->update('api_details', $data); 
	}
	
	function delete_api($api_id){
		$this->db->where('api_details_id', $api_id);
		$this->db->delete('api_details'); 
	}
	
	function update_api($update,$api_id, $api_logo_name){
		if(!isset($update['api_status']))
			$update['api_status'] = "INACTIVE";
		$update_data = array(
							'api_name' 				=> $update['api_name'],
							'api_alternative_name' 	=> $update['api_name_alternative'],
							'api_logo' 				=> $api_logo_name,
							'api_username' 			=> $update['api_user_name'],
							'api_username1' 		=> $update['api_user_name1'],
							'api_url' 				=> $update['api_url'],
							'api_url1' 				=> $update['api_url1'],
							'api_password' 			=> $update['api_password'],
							'api_credential_type' 	=> $update['api_mode'],
							'api_status' 			=> $update['api_status']					
						);
		$this->db->where('api_details_id', $api_id);
		$this->db->update('api_details', $update_data);
	}
}
?>
