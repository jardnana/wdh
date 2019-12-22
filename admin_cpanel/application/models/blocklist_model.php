<?php
class Blocklist_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_block_list($block_list_id = ''){
		$this->db->select('block_list_id,block_list_name,block_list_status');
		$this->db->from('block_list');
		if($block_list_id !='')
			$this->db->where('block_list_id', $block_list_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function add_block_list($input){	
		if(!isset($input['block_list_status']))
			$input['block_list_status'] = "INACTIVE";
		$insert_data = array(
							'block_list_name' 			=> $input['block_list_name'],
							'block_list_status' 		=> $input['block_list_status'],
							'creation_date'				=> (date('Y-m-d H:i:s'))					
						);
			
		$this->db->insert('block_list',$insert_data);
	}
	
	function active_block_list($product_id){
		$data = array(
					'block_list_status' => 'ACTIVE'
					);
		$this->db->where('block_list_id', $product_id);
		$this->db->update('block_list', $data); 
	}
	
	function inactive_block_list($product_id){
		$data = array(
					'block_list_status' => 'INACTIVE'
					);
		$this->db->where('block_list_id', $product_id);
		$this->db->update('block_list', $data); 
	}
	
	function delete_block_list($product_id){
		$this->db->where('block_list_id', $product_id);
		$this->db->delete('block_list'); 
	}
	
	function update_block_list($update,$block_list_id){
		if(!isset($update['block_list_status']))
			$update['block_list_status'] = "INACTIVE";
		$update_data = array(
							'block_list_name' 			=> $update['block_list_name'],
							'block_list_status' 		=> $update['block_list_status']				
						);		
		$this->db->where('block_list_id', $block_list_id);
		$this->db->update('block_list', $update_data);
	}    
}
?>
