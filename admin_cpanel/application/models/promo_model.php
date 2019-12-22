<?php
class Promo_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function get_promo_code_list($promo_code_details_id = '', $promo){
		$this->db->select('*');
		$this->db->from('promo_code_details');
		if($promo['supplier_rights'] == 1) {
			$this->db->where('created_by_supplier', $promo['admin_id'] );	
			}
		if($promo_code_details_id !='')
			$this->db->where('promo_code_details_id', $promo_code_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
    function add_promo_code_details($input){
		if(!isset($input['promo_status']))
			$input['promo_status'] = "INACTIVE";
		$insert_data = array(
							'promo_code' 			=> $input['promo_code'],
							'promo_type' 			=> $input['promo_type'],
							'discount' 				=> $input['discount'],
							'exp_date' 				=> date_format(date_create($input['exp_date']), "Y-m-d"),
							'creation_date' 		=> (date('Y-m-d H:i:s')),
							'status' 				=> $input['promo_status']
			
						);	
		if($input['supplier_rights'] == 1 ){
		 $insert_data['created_by_supplier'] =$this->session->userdata('lgm_supplier_admin_id') ;
		} else {
		 $insert_data['created_by_mgmt'] = $this->session->userdata('provab_admin_id') ;
		}						
		 if($input['promo_type'] != 'Promo code by %') {
		   $insert_data['promo_amount'] 	= $input['amount'];
		  }		
		$this->db->insert('promo_code_details',$insert_data);
		$promo_code_details_id = $this->db->insert_id();
		$this->General_Model->insert_log('3','add_promo_code_details',json_encode($insert_data),'Adding  PromoCode Details to database','promo_code_details','promo_code_details_id',$promo_code_details_id);
	}

	function active_promo($promo_code_details_id){
		$data = array(
					'status' => 'ACTIVE'
					);
		$this->db->where('promo_code_details_id', $promo_code_details_id);
		$this->db->update('promo_code_details', $data); 
		$this->General_Model->insert_log('3','active_promo',json_encode($data),'updating  PromoCode Details status to active','promo_code_details','promo_code_details_id',$promo_code_details_id);
	}
	
	function inactive_promo($promo_code_details_id){
		$data = array(
					'status' => 'INACTIVE'
					);
		$this->db->where('promo_code_details_id', $promo_code_details_id);
		$this->db->update('promo_code_details', $data); 
		$this->General_Model->insert_log('3','inactive_promo',json_encode($data),'updating  PromoCode Details status to inactive','promo_code_details','promo_code_details_id',$promo_code_details_id);
	}
	
	function delete_promo($promo_code_details_id){
		$this->db->where('promo_code_details_id', $promo_code_details_id);
		$this->db->delete('promo_code_details'); 
		$this->General_Model->insert_log('3','delete_promo',json_encode(array()),'deleting  PromoCode Details from database','promo_code_details','promo_code_details_id',$promo_code_details_id);
	}
	
	function update_promo($update,$promo_code_details_id){
		if(!isset($update['promo_status']))
			$update['promo_status'] = "INACTIVE";
		$update_data = array(
							'promo_code' 			=> $update['promo_code'],
							'promo_type' 			=> $update['promo_type'],
							'discount' 				=> $update['discount'],
							'exp_date' 				=> date_format(date_create($update['exp_date']), "Y-m-d"),
							'status' 				=> $update['promo_status']					
						);
		 if($update['promo_type'] != 'Promo code by %') {
		   $insert_data['promo_amount'] 	= $update['amount'];
		  }		
		$this->db->where('promo_code_details_id', $promo_code_details_id);
		$this->db->update('promo_code_details', $update_data);
		
		$this->General_Model->insert_log('3','update_promo',json_encode($update_data),'updating  PromoCode Details to database','promo_code_details','promo_code_details_id',$promo_code_details_id);
	}

	function get_user_list()   	{
   
		$this->db->select('user_email')
		->from('user_details');
		$this->db->where('user_type_id', 1);
		$query = $this->db->get();

	      if ( $query->num_rows > 0 ) {
	      
	         return $query->result();
	      }
      		return false;
   }

   function get_agent_list(){
   		$this->db->select('user_email')
		->from('user_details');
		$this->db->where('user_type_id', 2);
		$query = $this->db->get();

	      if ( $query->num_rows > 0 ) {
	      
	         return $query->result();
	      }
      		return false;
   	}

   	function get_all_subscribers(){

   		$this->db->select('email_id')
   		->from('subscriber_details');
   		$query = $this->db->get();

	      if ( $query->num_rows > 0 ) {
	      
	         return $query->result();
	      }
      		return false;
   	}

   	function get_promo(){
   		$this->db->select('*')
   		->from('promo_code_details');
   		$query = $this->db->get();

	      if ( $query->num_rows > 0 ) {
	      
	         return $query->result();
	      }
      		return false;
   	}
}
?>
