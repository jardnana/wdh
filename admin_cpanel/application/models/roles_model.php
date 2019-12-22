<?php
class Roles_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_roles_list($roles_id = ''){
		$this->db->select('*');
		$this->db->from('role_details');
		if($roles_id !='')
			$this->db->where('role_details_id', $roles_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_roles_details($input,$roles_logo_name){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'role_name' 				=> $input['role_name'],
							'role_logo' 				=> $roles_logo_name,
							'status' 					=> $input['status'],
							'role_creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('role_details',$insert_data);
	}

	function active_roles($roles_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('role_details_id', $roles_id);
		$this->db->update('role_details', $data); 
	}
	
	function inactive_roles($roles_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('role_details_id', $roles_id);
		$this->db->update('role_details', $data); 
	}
	
	function delete_roles($roles_id){
		$this->db->where('role_details_id', $roles_id);
		$this->db->delete('role_details'); 
	}
	
	function update_roles($update,$roles_id, $roles_logo_name){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'role_name' 				=> $update['role_name'],
							'role_logo' 				=> $roles_logo_name,
							'status' 					=> $update['status'],
							'role_modification_date'	=> (date('Y-m-d H:i:s'))					
						);	
		$this->db->where('role_details_id', $roles_id);
		$this->db->update('role_details', $update_data);
	}
}
?>
