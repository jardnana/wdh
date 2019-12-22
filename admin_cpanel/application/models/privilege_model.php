<?php
class Privilege_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_privilege_list($privilege_id = ''){
		$this->db->select('pd.*,dm.dashboard_module_name,dmd.dashboard_module_details_name,rd.role_name');
		$this->db->from('privilege_details pd');
		if($privilege_id !='')
			$this->db->where('privilege_details_id', $privilege_id);
		$this->db->join('role_details rd', 'rd.role_details_id = pd.role_details_id');
		$this->db->join('dashboard_module dm', 'dm.dashboard_module_id = pd.dashboard_module_id');
		$this->db->join('dashboard_module_details dmd', 'dmd.dashboard_module_details_id = pd.dashboard_module_details_id');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function get_module_list($dashboard_module_id = ''){
		$this->db->select('dashboard_module_id,dashboard_module_name');
		$this->db->from('dashboard_module');
		if($dashboard_module_id !='')
			$this->db->where('dashboard_module_id', $dashboard_module_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function get_module_details_list($dashboard_module_details_id = ''){
		$this->db->select('dashboard_module_details_id,dashboard_module_id,dashboard_module_details_name');
		$this->db->from('dashboard_module_details');
		if($dashboard_module_details_id !='')
			$this->db->where('dashboard_module_details_id', $dashboard_module_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function add_privilege_details($input){
		if(!isset($input['privilege_status']))
			$input['privilege_status'] = "INACTIVE";
		$insert_data = array(
							'privilege_name' 				=> $input['privilege_name'],
							'privilege_alternative_name' 	=> $input['privilege_name_alternative'],
							'privilege_username' 			=> $input['privilege_user_name'],
							'privilege_username1' 		=> $input['privilege_user_name1'],
							'privilege_url' 				=> $input['privilege_url'],
							'privilege_url1' 				=> $input['privilege_url1'],
							'privilege_password' 			=> $input['privilege_password'],
							'privilege_credential_type' 	=> $input['privilege_mode'],
							'privilege_status' 			=> $input['privilege_status'],
							'privilege_creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('privilege_details',$insert_data);
	}

	function active_privilege($privilege_id){
		$data = array(
					'privilege_status' => 'ACTIVE'
					);
		$this->db->where('privilege_details_id', $privilege_id);
		$this->db->update('privilege_details', $data); 
	}
	
	function inactive_privilege($privilege_id){
		$data = array(
					'privilege_status' => 'INACTIVE'
					);
		$this->db->where('privilege_details_id', $privilege_id);
		$this->db->update('privilege_details', $data); 
	}
	
	function delete_privilege($privilege_id){
		$this->db->where('privilege_details_id', $privilege_id);
		$this->db->delete('privilege_details'); 
	}
	
	function update_privilege($update,$privilege_id){
		if(!isset($update['privilege_status']))
			$update['privilege_status'] = "INACTIVE";
		$update_data = array(
							'privilege_name' 				=> $update['privilege_name'],
							'privilege_alternative_name' 	=> $update['privilege_name_alternative'],
							'privilege_username' 			=> $update['privilege_user_name'],
							'privilege_username1' 			=> $update['privilege_user_name1'],
							'privilege_url' 				=> $update['privilege_url'],
							'privilege_url1' 				=> $update['privilege_url1'],
							'privilege_password' 			=> $update['privilege_password'],
							'privilege_credential_type' 	=> $update['privilege_mode'],
							'privilege_status' 				=> $update['privilege_status']					
						);
		$this->db->where('privilege_details_id', $privilege_id);
		$this->db->update('privilege_details', $update_data);
	}
}
?>
