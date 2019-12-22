<?php
class Country_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_country_list($country_id = ''){
		$this->db->select('*');
		$this->db->from('country_details');
		if($country_id !='')
			$this->db->where('country_id', $country_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_country_details($input,$country_logo_name){
		if(!isset($input['country_status']))
			$input['country_status'] = "INACTIVE";
		$insert_data = array(
							'iso_code' 			=> $input['iso_code'],
							'iso3_code' 		=> $input['iso3_code'],
							'country_name' 		=> $input['country_name'],
							'iso_numeric' 		=> $input['iso_numeric'],
							'phone_code' 		=> $input['phone_code'],
							'currency_name' 	=> $input['currency_name'],
							'currency_code' 	=> $input['currency_code'],
							'currency_symbol' 	=> $input['currency_symbol'],
							'country_flag' 		=> $country_logo_name,
							'country_status' 	=> $input['country_status'],
							'creation_date'		=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('country_details',$insert_data);
	}

	function active_country($country_id){
		$data = array(
					'country_status' => 'ACTIVE'
					);
		$this->db->where('country_id', $country_id);
		$this->db->update('country_details', $data); 
	}
	
	function inactive_country($country_id){
		$data = array(
					'country_status' => 'INACTIVE'
					);
		$this->db->where('country_id', $country_id);
		$this->db->update('country_details', $data); 
	}
	
	function delete_country($country_id){
		$this->db->where('country_id', $country_id);
		$this->db->delete('country_details'); 
	}
	
	function update_country($update,$country_id, $country_logo_name){
		if(!isset($update['country_status']))
			$update['country_status'] = "INACTIVE";
		$update_data = array(
							'iso_code' 			=> $update['iso_code'],
							'iso3_code' 		=> $update['iso3_code'],
							'country_name' 		=> $update['country_name'],
							'iso_numeric' 		=> $update['iso_numeric'],
							'phone_code' 		=> $update['phone_code'],
							'currency_name' 	=> $update['currency_name'],
							'currency_code' 	=> $update['currency_code'],
							'currency_symbol' 	=> $update['currency_symbol'],
							'country_flag' 		=> $country_logo_name,
							'country_status' 	=> $update['country_status']				
						);			
		$this->db->where('country_id', $country_id);
		$this->db->update('country_details', $update_data);
	}
}
?>
