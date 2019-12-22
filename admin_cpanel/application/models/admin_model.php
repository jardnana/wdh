<?php
class Admin_Model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

     function get_admin_list($admin_id = ''){
		 
		$this->db->select('u.*,c.country_id,c.country_name,a.address,a.address_details_id,a.city_name,a.zip_code,a.state_name,r.role_name');
		$this->db->from('admin_details u');
		$this->db->join('address_details a', 'a.address_details_id = u.address_details_id');
		$this->db->join('country_details c', 'c.country_id = a.country_id');
		$this->db->join('role_details r', 'u.role_details_id = r.role_details_id');
		if($admin_id !='')
			$this->db->where('admin_id', $admin_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			$data['admin_info'] = '';
		}else{
			$data['admin_info'] = $query->result();
		}
		return $data;	
	}

	function get_country_details($admin_id) {
		$this->db->select('um.product_details_id, c.country_name, c.iso3_code');
		$this->db->from('user_management_details um');
		$this->db->join('country_details c', 'um.country_id = c.country_id');
		$this->db->distinct();
		$this->db->where('admin_id', $admin_id);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			return $query->result();
		}
	}
	
	function get_all_user_email($user_email) {
		$this->db->select('user_email');
		$this->db->from('admin_details');
		if($user_email !='')
			$this->db->where('user_email', $user_email);
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return 'NO';
		}else{
			return 'YES';
		}
	}

	function add_admin_details($input,$user_profile_name){
		if(!isset($input['admin_status']))
			$input['admin_status'] = "INACTIVE";
			
		$insert_data_address = array(
								'address' 		=> $input['address'],
								'city_name' 	=> $input['city'],
								'zip_code' 		=> $input['zip_code'],
								'state_name' 	=> $input['state_name'],
								'country_id' 	=> $input['country']					
							);			
		$this->db->insert('address_details',$insert_data_address);
		$address_details_id = $this->db->insert_id();

		$insert_data_admin = array(
								'address_details_id' 		=> $address_details_id,
								'admin_name' 				=> $input['salution']."-".$input['first_name']."-".$input['middle_name']."-".$input['last_name'],
								'admin_email' 				=> $input['email_id'],
								'admin_home_phone' 			=> $input['phone_no'],
								'admin_cell_phone' 			=> $input['mobile_no'],					
								'admin_account_number' 		=> 'PROVAB-'.rand(1,100),					
								'admin_profile_pic' 		=> $user_profile_name,					
								'role_details_id' 			=> $input['role_id'],			
								'admin_status' 				=> $input['admin_status'],					
								'admin_creation_date_time' 	=> (date('Y-m-d H:i:s'))					
							);			
		$this->db->insert('admin_details',$insert_data_admin);
		$admin_id = $this->db->insert_id();
		
		$insert_data_admin_login = array(
									'admin_id' 			=> $admin_id,
									'admin_user_name' 	=> $input['email_id'],
									'admin_password' 	=> "AES_ENCRYPT(".$input['new_password'].",'".SECURITY_KEY."')",
									'admin_pattren' 	=> ''					
								);			
		$this->db->insert('admin_login_details',$insert_data_admin_login);
		$update_sql		= 	"UPDATE admin_login_details SET admin_password  =  AES_ENCRYPT('".$input['new_password']."','".SECURITY_KEY."') WHERE admin_id  =  '$admin_id' ";
		$this->db->query($update_sql);
	}
	
	function active_admin($admin_id){
		$data = array(
					'admin_status' => 'ACTIVE'
					);
		$this->db->where('admin_id', $admin_id);
		$this->db->update('admin_details', $data); 
	}
	
	function inactive_admin($admin_id){
		$data = array(
					'admin_status' => 'INACTIVE'
					);
		$this->db->where('admin_id', $admin_id);
		$this->db->update('admin_details', $data); 
	}
	
	function delete_admin($admin_id){
		$this->db->where('admin_id', $admin_id);
		$this->db->delete('admin_details'); 
	}
	
	function update_admin($update,$admin_id,$user_profile_name){
		//echo '<pre/>';print_r($update);exit;
		if(!isset($update['admin_status']))
			$update['admin_status'] = "INACTIVE";
			
		$update_data_address = array(
								'address' 		=> $update['address'],
								'city_name' 	=> $update['city'],
								'zip_code' 		=> $update['zip_code'],
								'state_name' 	=> $update['state_name'],
								'country_id' 	=> $update['country']					
							);
		$this->db->where('address_details_id', $update['address_id']);
		$this->db->update('address_details', $update_data_address);
		
		$update_data_user = array(
								'admin_name' 				=> $update['salution']."-".$update['first_name']."-".$update['middle_name']."-".$update['last_name'],
								'admin_home_phone' 			=> $update['phone_no'],
								'admin_cell_phone' 			=> $update['mobile_no'],					
								'admin_profile_pic' 			=> $user_profile_name,					
								'admin_status' 				=> $update['admin_status']					
							);		
		$this->db->where('admin_id', $admin_id);						
		$this->db->update('admin_details',$update_data_user);
		
	/*	$this->db->where('admin_id', $admin_id);
		$this->db->delete('user_management_details'); 
		for($d=0;$d<count($update['doamin']);$d++){
			for($u=0;$u<count($update['user_type']);$u++){
				for($p=0;$p<count($update['product']);$p++){
					for($a=0;$a<count($update['api']);$a++){
						$update_data_user_management = array(
									'admin_id' 			=> $admin_id,
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
		}*/
	}
}
?>
