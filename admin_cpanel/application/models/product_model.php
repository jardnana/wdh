<?php
class Product_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	function get_product_list($product_id = ''){
		$this->db->select('product_details_id,product_name,product_status');
		$this->db->from('product_details');
		if($product_id !='')
			$this->db->where('product_details_id', $product_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	function add_product($input){	
		if(!isset($input['product_status']))
			$input['product_status'] = "INACTIVE";
		$insert_data = array(
							'product_name' 			=> $input['product_name'],
							'product_status' 		=> $input['product_status'],
							'product_creation_date'	=> (date('Y-m-d H:i:s'))					
						);
			
		$this->db->insert('product_details',$insert_data);
		$product_id = $this->db->insert_id();
		//$this->General_Model->insert_log('2','add_product',json_encode($insert_data),'Adding  Product Details to database','product_details','product_details_id',$product_id);
	}
	
	function active_product($product_id){
		$data = array(
					'product_status' => 'ACTIVE'
					);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $data); 
		$this->General_Model->insert_log('2','active_product',json_encode($data),'updating Product Details status to active','product_details','product_details_id',$product_id);   
	}
	
	function inactive_product($product_id){
		$data = array(
					'product_status' => 'INACTIVE'
					);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $data); 
		//$this->General_Model->insert_log('2','inactive_product',json_encode($data),'updating Product Details status to inactive','product_details','product_details_id',$product_id);
	}
	
	function delete_product($product_id){
		$this->db->where('product_details_id', $product_id);
		$this->db->delete('product_details'); 
		//$this->General_Model->insert_log('2','delete_product',json_encode(array()),'deleting  Product Details from database','product_details','product_details_id',$product_id);
	}
	
	function update_product($update,$product_id){
		if(!isset($update['product_status']))
			$update['product_status'] = "INACTIVE";
		$update_data = array(
							'product_name' 			=> $update['product_name'],
							'product_status' 		=> $update['product_status']				
						);
		$this->db->where('product_details_id', $product_id);
		$this->db->update('product_details', $update_data);
		//$this->General_Model->insert_log('2','update_product',json_encode($update_data),'updating Product Details to database','product_details','product_details_id',$product_id);
	}


	
}
?>
