<?php
class Airline_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airline_list($airline_details_id = ''){
		$this->db->select('*');
		$this->db->from('airline_details');
		if($airline_details_id !='')
			$this->db->where('airline_details_id', $airline_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_airline_details($input,$airline_logo_name){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'airline_name' 			=> $input['airline_name'],
							'airline_code' 			=> $input['airline_code'],
							'provider_type' 		=> $input['provider_type'],
							'status' 				=> $input['status'],				
							'added_by'			    => $this->session->userdata('provab_admin_id'),			
							'creation_date'			=> date('Y-m-d H:i:s')
						);			
		$this->db->insert('airline_details',$insert_data);
	}

	function active_airline($airline_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('airline_details_id', $airline_details_id);
		$this->db->update('airline_details', $data); 
	}
	
	function inactive_airline($airline_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('airline_details_id', $airline_details_id);
		$this->db->update('airline_details', $data); 
	}
	
	function delete_airline($airline_details_id){
		$this->db->where('airline_details_id', $airline_details_id);
		$this->db->delete('airline_details'); 
	}
	
	function update_airline($update,$airline_details_id, $airline_logo_name){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'airline_name' 			=> $update['airline_name'],
							'airline_code' 			=> $update['airline_code'],
							'provider_type' 		=> $update['provider_type'],
							'status' 				=> $update['status'],
							'modified_by'			=> $this->session->userdata('provab_admin_id'),			
							'updation_date'			=> date('Y-m-d H:i:s')				
						);
		$this->db->where('airline_details_id', $airline_details_id);
		$this->db->update('airline_details', $update_data);
	}
}
?>
