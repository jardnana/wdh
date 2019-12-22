<?php
class Payment_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_payment_api_list($payment_api_id = ''){
		$this->db->select('*');
		$this->db->from('payment_api_details');
		if($payment_api_id !='')
			$this->db->where('payment_api_details_id', $payment_api_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_payment_api_details($input,$api_logo_name){
		if(!isset($input['api_status']))
			$input['api_status'] = "INACTIVE";
		$insert_data = array(
							'api_name' 				=> $input['api_name'],
							'api_alternative_name' 	=> $input['api_name_alternative'],
							'api_logo' 				=> $api_logo_name,
							'api_username' 			=> $input['api_user_name'],
						//	'api_username1' 		=> $input['api_user_name1'],
							'api_url' 				=> $input['api_url'],
						//	'api_url1' 				=> $input['api_url1'],
						//	'api_password' 			=> $input['api_password'],
						//	'fixed_charge' 			=> $input['fixed_charge'],
						//	'percentage_charge' 	=> $input['percentage_charge'],
							'api_credential_type' 	=> $input['api_mode'],
							'api_status' 			=> $input['api_status'],
							'creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('payment_api_details',$insert_data);
	}

	function active_payment_api($payment_api_id){
		$data = array(
					'api_status' => 'ACTIVE'
					);
		$this->db->where('payment_api_details_id', $payment_api_id);
		$this->db->update('payment_api_details', $data); 
	}
	
	function inactive_payment_api($payment_api_id){
		$data = array(
					'api_status' => 'INACTIVE'
					);
		$this->db->where('payment_api_details_id', $payment_api_id);
		$this->db->update('payment_api_details', $data); 
	}
	
	function delete_payment_api($payment_api_id){
		$this->db->where('payment_api_details_id', $payment_api_id);
		$this->db->delete('payment_api_details'); 
	}
	
	function update_payment_api($update,$api_id, $api_logo_name){
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
							'fixed_charge' 			=> $update['fixed_charge'],
							'percentage_charge' 	=> $update['percentage_charge'],
							'api_credential_type' 	=> $update['api_mode'],
							'api_status' 			=> $update['api_status']					
						);
		$this->db->where('payment_api_details_id', $api_id);
		$this->db->update('payment_api_details', $update_data);
	}
}
?>
