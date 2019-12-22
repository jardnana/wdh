<?php
class Users_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     function get_user_list($user_id = ''){
		 
		$this->db->select('u.user_details_id,u.first_name,u.middle_name,u.sure_name,u.user_email,u.user_home_phone,u.user_cell_phone,u.user_account_number,u.user_profile_pic,u.user_status,c.country_id,c.country_name,a.address,a.address_details_id,a.city_name,a.zip_code,a.state_name');
		$this->db->from('user_details u');
		$this->db->join('address_details a', 'a.address_details_id = u.address_details_id');
		$this->db->join('country_details c', 'c.country_id = a.country_id');
		if($user_id !='')
			$this->db->where('user_details_id', $user_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			$data['user_info'] = '';
		}else{
			$data['user_info'] = $query->result();
		}
		if($data['user_info']!=''){
			for($u=0;$u<count($data['user_info']);$u++){
				$data['domain_details'][$u] 	= $this->Users_Model->get_domain_details($data['user_info'][$u]->user_details_id);
				$data['user_type_details'][$u] 	= $this->Users_Model->get_user_type_details($data['user_info'][$u]->user_details_id);
				$data['product_details'][$u] 	= $this->Users_Model->get_product_details($data['user_info'][$u]->user_details_id);
				$data['api_details'][$u] 		= $this->Users_Model->get_api_details($data['user_info'][$u]->user_details_id);
				$data['country_details'][$u] 	= $this->Users_Model->get_country_details($data['user_info'][$u]->user_details_id);
			}
		}
		return $data;	
	}
	function get_all_user_type(){
		$this->db->select('*');
		$this->db->from('user_type');
		$this->db->where(array('status'=>'ACTIVE'));
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return ;
		}else{
			return $query->result();
		}
	
   }
   	function get_all_user_email_by_user_type($user_type){
		$this->db->select('user_details_id,user_email');
		$this->db->from('user_details');
		$this->db->where('user_type_id', $user_type);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return "" ;
		}else{
			return $query->result();
		}
	}
	
	function get_domain_details($user_details_id) {
		$this->db->select('um.domain_details_id, d.domain_name');
		$this->db->from('user_management_details um');
		$this->db->join('domain_details d', 'um.domain_details_id = d.domain_details_id');
		$this->db->distinct();
		$this->db->where('user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_user_type_details($user_details_id) {
		$this->db->select('um.user_type_id, ut.user_type_name');
		$this->db->from('user_management_details um');
		$this->db->join('user_type ut', 'um.user_type_id = ut.user_type_id');
		$this->db->distinct();
		$this->db->where('user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_product_details($user_details_id) {
		$this->db->select('um.product_details_id, p.product_name');
		$this->db->from('user_management_details um');
		$this->db->join('product_details p', 'um.product_details_id = p.product_details_id');
		$this->db->distinct();
		$this->db->where('user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_api_details($user_details_id) {
		$this->db->select('um.api_details_id, a.api_name, a.api_alternative_name');
		$this->db->from('user_management_details um');
		$this->db->join('api_details a', 'um.api_details_id = a.api_details_id');
		$this->db->distinct();
		$this->db->where('user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}

	function get_country_details($user_details_id) {
		$this->db->select('um.product_details_id, c.country_name, c.iso3_code');
		$this->db->from('user_management_details um');
		$this->db->join('country_details c', 'um.country_id = c.country_id');
		$this->db->distinct();
		$this->db->where('user_details_id', $user_details_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function get_all_user_email($user_email) {
		$this->db->select('user_email');
		$this->db->from('user_details');
		if($user_email !='')
			$this->db->where('user_email', $user_email);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return 'NO';
		}else{
			return 'YES';
		}
	}

	function add_users_details($input,$user_profile_name){
		if(!isset($input['user_status']))
			$input['user_status'] = "INACTIVE";
			
		$insert_data_address = array(
								'address' 		=> $input['address'],
								'city_name' 	=> $input['city'],
								'zip_code' 		=> $input['zip_code'],
								'state_name' 	=> $input['state_name'],
								'country_id' 	=> $input['country']					
							);			
		$this->db->insert('address_details',$insert_data_address);
		$address_details_id = $this->db->insert_id();

		$insert_data_user = array(
								'address_details_id' 		=> $address_details_id,
								'user_name' 				=> $input['salution']."-".$input['first_name']."-".$input['middle_name']."-".$input['last_name'],
								'user_email' 				=> $input['email_id'],
								'user_home_phone' 			=> $input['phone_no'],
								'user_cell_phone' 			=> $input['mobile_no'],					
								'user_account_number' 		=> 'PROVAB-'.rand(1,100),					
								'user_profile_pic' 			=> $user_profile_name,					
								'user_status' 				=> $input['user_status'],					
								'user_creation_date_time' 	=> (date('Y-m-d H:i:s'))					
							);			
		$this->db->insert('user_details',$insert_data_user);
		$user_details_id = $this->db->insert_id();
		
		$insert_data_user_login = array(
									'user_details_id' 	=> $user_details_id,
									'user_name' 		=> $input['email_id'],
									'user_password' 	=> "AES_ENCRYPT(".$input['new_password'].",'".SECURITY_KEY."')",
									'admin_pattren' 	=> ''					
								);			
		$this->db->insert('user_login_details',$insert_data_user_login);

		for($d=0;$d<count($input['doamin']);$d++){
			for($u=0;$u<count($input['user_type']);$u++){
				for($p=0;$p<count($input['product']);$p++){
					for($a=0;$a<count($input['api']);$a++){
						$insert_data_user_management = array(
									'user_details_id' 			=> $user_details_id,
									'domain_details_id' 		=> $input['doamin'][$d],
									'user_type_id' 				=> $input['user_type'][$u],
									'product_details_id' 		=> $input['product'][$p],					
									'api_details_id' 			=> $input['api'][$a],				
									'country_id' 				=> '1'				
								);			
						$this->db->insert('user_management_details',$insert_data_user_management);					
					}
				}
			}
		}
	}
	
	function active_users($user_id){
		$data = array(
					'user_status' => 'ACTIVE'
					);
		$this->db->where('user_details_id', $user_id);
		$this->db->update('user_details', $data); 
	}
	
	function inactive_users($user_id){
		$data = array(
					'user_status' => 'INACTIVE'
					);
		$this->db->where('user_details_id', $user_id);
		$this->db->update('user_details', $data); 
	}
	
	function delete_users($user_id){
		$this->db->where('user_details_id', $user_id);
		$this->db->delete('user_login_details');
		
		$this->db->where('user_details_id', $user_id);
		$this->db->delete('user_management_details');
		
		$this->db->where('user_details_id', $user_id);
		$this->db->delete('block_type_details');
		
		$this->db->where('user_details_id', $user_id);
		$this->db->delete('user_details'); 
	}
	
	function update_users($update,$user_id,$user_profile_name){
		if(!isset($update['user_status']))
			$update['user_status'] = "INACTIVE";
			
		$update_data_address = array(
								'address' 		=> $update['address'],
								'city_name' 	=> $update['city'],
								'zip_code' 		=> $update['zip_code'],
								'state_name' 	=> $update['state_name'],
								'country_id' 	=> $update['country']					
							);
		$this->db->where('address_details_id', $update['address_details_id']);
		$this->db->update('address_details', $update_data_address);
		
		$update_data_user = array(
							//	'user_name' 				=> $update['salution']."-".$update['first_name']."-".$update['middle_name']."-".$update['last_name'],
								'first_name' 				=> $update['first_name'],
								'middle_name'				=>$update['middle_name'],
								'sure_name'  				=> $update['last_name'],
								'user_home_phone' 			=> $update['phone_no'],
								'user_cell_phone' 			=> $update['mobile_no'],					
								'user_profile_pic' 			=> $user_profile_name,					
								'user_status' 				=> $update['user_status']					
							);		
		$this->db->where('user_details_id', $user_id);						
		$this->db->update('user_details',$update_data_user);
		
		$this->db->where('user_details_id', $user_id);
		$this->db->delete('user_management_details'); 
		for($d=0;$d<count($update['doamin']);$d++){
			for($u=0;$u<count($update['user_type']);$u++){
				for($p=0;$p<count($update['product']);$p++){
					for($a=0;$a<count($update['api']);$a++){
						$update_data_user_management = array(
									'user_details_id' 			=> $user_id,
									'domain_details_id' 		=> $update['doamin'][$d],
									'user_type_id' 				=> $update['user_type'][$u],
									'product_details_id' 		=> $update['product'][$p],					
									'api_details_id' 			=> $update['api'][$a],
									'country_id' 				=> '1'			
								);	
						$this->db->insert('user_management_details',$update_data_user_management);					
					}
				}
			}
		}
	}
}
?>
