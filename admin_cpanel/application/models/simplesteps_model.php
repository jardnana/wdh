<?php
class Simplesteps_Model extends CI_Model {
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = 'aeb28412707b836f2fd98e6e7ddb2a6057b4fcd3099811a94d1b88bed742f45b';
	
    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_steps($step_id = ''){
		$this->db->select('*');
        $this->db->from('service_details');
        if($step_id!=''){
			$this->db->where('service_details_id',$step_id);
		}
        $query = $this->db->get();
        if ($query->num_rows() == '') {
            return '';
        } else {
            return $query->result();
        }
	}
	
	function add_step_details($input, $image){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'service_title' 			=>  $input['step_title'],
							'service_image' 			=>  $image,
							'service_description' 		=>	$input['full_desc'],
							'status' 					=>  $input['status'],
							'creation_date' 			=> (date('Y-m-d H:i:s'))
						);			
		$this->db->insert('service_details',$insert_data);
	}
	
	function active_step($step_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('service_details_id', $step_id);
		$this->db->update('service_details', $data); 
	}
	function inactive_step($step_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('service_details_id', $step_id);
		$this->db->update('service_details', $data); 
	}
	function delete_step($step_id){
		$this->db->where('service_details_id', $step_id);
		$this->db->delete('service_details'); 
	}
    function update_step($update,$step_id, $banner_logo_name){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'service_title' => $update['step_title'],
							'service_image' => $banner_logo_name,
							'service_description' =>	$update['full_desc'],
							'status' => $update['status'],
							'creation_date' => (date('Y-m-d H:i:s'))				
						);				
		$this->db->where('service_details_id', $step_id);
		$this->db->update('service_details', $update_data);
	}
	
}
?>
