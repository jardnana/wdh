<?php
class Subscriber_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_subscriber_list($subscriber_details_id = ''){
		$this->db->select('*');
		$this->db->from('subscriber_details');
		if($subscriber_details_id !='')
			$this->db->where('subscriber_details_id', $subscriber_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_subscriber_details($input){
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$insert_data = array(
							'email_id' 				=> $input['email_id'],
							'status' 				=> $input['status'],
							'creation_date'	=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('subscriber_details',$insert_data);
		$subscriber_details_id = $this->db->insert_id();
		//$this->General_Model->insert_log('12','add_subscriber_details',json_encode($insert_data),'Adding  Subscriber Details to database','subscriber_details','subscriber_details_id',$subscriber_details_id);
	}

	function active_subscriber($subscriber_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('subscriber_details_id', $subscriber_details_id);
		$this->db->update('subscriber_details', $data);
		//$this->General_Model->insert_log('12','active_subscriber',json_encode($data),'updating Subscriber Details status to active','subscriber_details','subscriber_details_id',$subscriber_details_id); 
	}
	
	function inactive_subscriber($subscriber_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('subscriber_details_id', $subscriber_details_id);
		$this->db->update('subscriber_details', $data); 
		//$this->General_Model->insert_log('12','inactive_subscriber',json_encode($data),'updating Subscriber Details status to inactive','subscriber_details','subscriber_details_id',$subscriber_details_id);
	}
	
	function delete_subscriber($subscriber_details_id){
		$this->db->where('subscriber_details_id', $subscriber_details_id);
		$this->db->delete('subscriber_details'); 
		//$this->General_Model->insert_log('12','delete_subscriber',json_encode(array()),'deleting  Subscriber Details from database','subscriber_details','subscriber_details_id',$subscriber_details_id);
	}
	
	function update_subscriber($update,$subscriber_details_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'email_id' 			=> $update['email_id'],
							'status' 			=> $update['status']				
						);
		$this->db->where('subscriber_details_id', $subscriber_details_id);
		$this->db->update('subscriber_details', $update_data);
		$this->db->update('subscriber_details', $update_data);
		//$this->General_Model->insert_log('12','update_subscriber',json_encode($update_data),'updating Subscriber Details to database','subscriber_details','subscriber_details_id',$subscriber_details_id);
	}
}
?>
