<?php
class Footer_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_footer_list($footer_id = ''){
		$this->db->select('*');
		$this->db->from('footer_details');
		if($footer_id !='')
			$this->db->where('footer_details_id', $footer_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_footer_details($input,$footer_logo_name){
		if(!isset($input['footer_status']))
			$input['footer_status'] = "INACTIVE";
		$insert_data = array(
							'footer_name' 				=> $input['footer_name'],
							'footer_icon' 				=> $footer_logo_name,
							'description' 				=> $input['description'],
							'position' 					=> $input['position'],
							'status' 					=> $input['footer_status'],
							'creation_date'				=> (date('Y-m-d H:i:s'))					
						);			
		$this->db->insert('footer_details',$insert_data);
	}

	function active_footer($footer_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('footer_details_id', $footer_id);
		$this->db->update('footer_details', $data); 
	}
	
	function inactive_footer($footer_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('footer_details_id', $footer_id);
		$this->db->update('footer_details', $data); 
	}
	
	function delete_footer($footer_id){
		$this->db->where('footer_details_id', $footer_id);
		$this->db->delete('footer_details'); 
	}
	
	function update_footer($update,$footer_id, $footer_logo_name){
		if(!isset($update['footer_status']))
			$update['footer_status'] = "INACTIVE";
		$update_data = array(
							'footer_name' 				=> $update['footer_name'],
							'footer_icon' 				=> $footer_logo_name,
							'description' 				=> $update['description'],
							'position' 					=> $update['position'],
							'status' 					=> $update['footer_status'],			
						);			
		$this->db->where('footer_details_id', $footer_id);
		$this->db->update('footer_details', $update_data);
	}
}
?>
