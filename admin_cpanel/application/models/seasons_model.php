<?php
class Seasons_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    } 
    
    function get_seasons_list($seasons_details_id = ''){
		$this->db->select('*');
		$this->db->from('seasons_details');
		if($seasons_details_id !='')
			$this->db->where('seasons_details_id', $seasons_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function add_seasons($input){	
		if(!isset($input['status']))
			$input['status'] = "ACTIVE";
			$date_array = explode(" - ", $input['season_date_range']);
			
		$insert_data = array(
							'seasons_name' 				=> $input['seasons_name'],
							'season_date_range' 		=> $input['season_date_range'],
							'season_from_date' 			=> date('Y-m-d', strtotime($date_array[0])),
							'season_to_date' 			=> date('Y-m-d', strtotime($date_array[1])),
							'creation_date'				=> (date('Y-m-d H:i:s'))	
						);	
	    try{		
			$this->db->insert('seasons_details',$insert_data);
			$seasons_details_id = $this->db->insert_id();
			$this->General_Model->insert_log('12','add_seasons',json_encode($insert_data),'Adding  Seasons to database','seasons_details','seasons_details_id',$seasons_details_id);
		} catch(Exception $e) {
			return $e;
		}
	}
	
	function inactive_seasons($seasons_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('seasons_details_id', $seasons_details_id);
		$this->db->update('seasons_details', $data);
		$this->General_Model->insert_log('12','inactive_taxrate',json_encode($data),'updating Seasons status to inactive','seasons_details','seasons_details_id',$seasons_details_id);
	}
	
	function active_seasons($seasons_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('seasons_details_id', $seasons_details_id);
		$this->db->update('seasons_details', $data);
		$this->General_Model->insert_log('12','inactive_data',json_encode($data),'updating Seasons status to active','seasons_details','seasons_details_id',$seasons_details_id);
	}
	function delete_seasons($seasons_details_id){
		$this->db->where('seasons_details_id', $seasons_details_id);
		$this->db->delete('seasons_details');
		$this->General_Model->insert_log('12','delete_seasons',json_encode(array()),'deleting  Seasonsax from database','seasons_details','seasons_details_id',$seasons_details_id);
	}
	
	function update_seasons($input,$seasons_details_id){		
		if(!isset($input['status']))
			$input['status'] = "ACTIVE";	
			
			$date_array = explode(" - ", $input['season_date_range']);
			
		$insert_data = array(
							'seasons_name' 				=> $input['seasons_name'],
							'season_date_range' 		=> $input['season_date_range'],
							'season_from_date' 			=> date('Y-m-d', strtotime($date_array[0])),
							'season_to_date' 			=> date('Y-m-d', strtotime($date_array[1])),
						);
	   try{			
			$this->db->where('seasons_details_id', $seasons_details_id);
			$this->db->update('seasons_details', $insert_data);
			$this->General_Model->insert_log('12','update_seasons',json_encode($insert_data),'updating  Seasons house offer to database','seasons_details','seasons_details_id',$seasons_details_id);
		} catch(Exception $e) {
			return $e;
		}
	}
	
	
	
}
