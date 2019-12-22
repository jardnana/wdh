<?php
class Dashboard_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_admin_details(){
		$provab_admin_id = $this->session->userdata('provab_admin_id');
		$this->db->select('*')->from('admin_details ad')->where('admin_id', $provab_admin_id)->where('admin_status', 'ACTIVE');
		$this->db->join('address_details a', 'a.address_details_id = ad.address_details_id');
		$this->db->join('country_details c', 'c.country_id = a.country_id');
		$query = $this->db->get();
		if ( $query->num_rows > 0 ) {
			return $query->row();	
	    }else{
			return '';	
		}
	}

	public function get_admin_logs_activity(){
		$provab_admin_id 	= $this->session->userdata('provab_admin_id');
		$this->db->select('*')->from('admin_login_tracking_details')->where('admin_id',$provab_admin_id)->order_by('login_tracking_details_time_stamp','desc');
		$query = $this->db->get();	
    	if ( $query->num_rows > 0 ){
			return $query->result();	
	    }else{
			return '';	
		}
    }

    public function get_white_list_ip_details($white_list_ip_id =''){
		$admin_id = $this->session->userdata('provab_admin_id');
		$this->db->select('*')->from('admin_white_iplist')->where('admin_id',$admin_id);
		if($white_list_ip_id !='')
			$this->db->where('admin_white_iplist_id', $white_list_ip_id);
		$query = $this->db->get();	
    	if ( $query->num_rows > 0 ) {
			return $query->result();	
		}else{
			return '';	
		}
	}

	function add_white_list($input){	
		if(!isset($input['status']))
			$input['status'] = "INACTIVE";
		$admin_id = $this->session->userdata('provab_admin_id');
		$insert_data = array(
							'admin_id' 		=> $admin_id,
							'ip_address' 	=> $input['ip_address'],
							'status' 		=> $input['status']
						);
		$this->db->insert('admin_white_iplist',$insert_data);
	}

	function active_white_list_ip($white_list_ip_id){
		$data = array('status' => 'ACTIVE');
		$this->db->where('admin_white_iplist_id', $white_list_ip_id);
		$this->db->update('admin_white_iplist', $data); 
	}
	
	function inactive_white_list_ip($white_list_ip_id){
		$data = array('status' => 'INACTIVE');
		$this->db->where('admin_white_iplist_id', $white_list_ip_id);
		$this->db->update('admin_white_iplist', $data); 
	}
	
	function delete_white_list_ip($white_list_ip_id){
		$this->db->where('admin_white_iplist_id', $white_list_ip_id);
		$this->db->delete('admin_white_iplist'); 
	}

	function update_white_list_ip($update,$white_list_ip_id){
		if(!isset($update['status']))
			$update['status'] = "INACTIVE";
		$update_data = array(
							'ip_address' 	=> $update['ip_address'],
							'status' 		=> $update['status']				
						);
		$this->db->where('admin_white_iplist_id', $white_list_ip_id);
		$this->db->update('admin_white_iplist', $update_data);
	} 
	
	function update_address_details($admin_address_details, $data) {

		$address_details_id = $data['admin_profile_info']->address_details_id;
		$admin_data = array('address' 	=> $admin_address_details['address'],
							 'city_name'=> $admin_address_details['city_name'],
							 'zip_code'	=> $admin_address_details['zip_code'],
							 'state_name'=> $admin_address_details['state_name'],
							 'country_id'=> $admin_address_details['country'] ) ;
         
        try {
        	$this->db->where('address_details_id', $address_details_id);
	        $this->db->update('address_details', $admin_data);
        } catch(Exception $ex) {
            $ex->getMessage();
        }
		
	}

	function update_profile_info($admin_info, $data) {
		$address_details_id = $data['admin_profile_info']->address_details_id;
		$admin_id = $this->session->userdata('provab_admin_id');
		$admin_name = $admin_info['salution']."-".$admin_info['first_name']."-".$admin_info['middle_name']."-".$admin_info['last_name'] ;
		$admin_data = array( 'admin_name' 				=> $admin_name,
							 'admin_email'				=> $admin_info['email'],
							 'address_details_id'		=> $address_details_id ,
							 'admin_home_phone'			=> $admin_info['home_phone'],
							 'admin_cell_phone'			=> $admin_info['cell_phone'],
							 'admin_account_number'		=> $admin_info['account_number'] ) ;
		try {
			$this->db->where('admin_id', $admin_id);
			$this->db->update('admin_details', $admin_data);
		} catch(Exception $ex) {
			 $ex->getMessage();
        }
	}

   
}
