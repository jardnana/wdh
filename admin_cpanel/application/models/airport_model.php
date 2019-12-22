<?php
class Airport_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_airport_list($country='',$airport_details_id = ''){
		$this->db->select('*');
		$this->db->from('flight_airport_list');
		if($airport_details_id !='')
			$this->db->where('airport_id', $airport_details_id);
		// $this->db->where('airport_city', 'London');
		$this->db->where('country', str_replace("-"," ",$country));
		// $this->db->limit(1000);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
    function get_country_list(){
		$this->db->select('*');
		$this->db->from('flight_airport_list');
		$this->db->distinct('country');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_airport_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'airport_name' 			=> $input['airport_name'],
							'airport_code' 			=> $input['airport_code'],
							'airport_city' 			=> $input['airport_city'],
							'country' 				=> $input['country'],
							'status' 				=> $input['status']			
						);			
		$this->db->insert('flight_airport_list',$insert_data);
	}

	function active_airport($airport_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('airport_id', $airport_details_id);
		$this->db->update('flight_airport_list', $data); 
	}
	
	function inactive_airport($airport_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('airport_id', $airport_details_id);
		$this->db->update('flight_airport_list', $data); 
	}
	
	function delete_airport($airport_details_id){
		$this->db->where('airport_id', $airport_details_id);
		$this->db->delete('flight_airport_list'); 
	}
	
	function update_airport($update,$airport_details_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'airport_name' 			=> $update['airport_name'],
							'airport_code' 			=> $update['airport_code'],
							'airport_city' 			=> $update['airport_city'],
							'country' 				=> $update['country'],
							'status' 				=> $update['status']				
						);
		$this->db->where('airport_id', $airport_details_id);
		$this->db->update('flight_airport_list', $update_data);
	}
}
?>
