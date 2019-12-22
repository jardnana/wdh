<?php
class Security_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    public function admin_ip_track($type){
		$data = array(
					'admin_id' => $this->session->userdata('provab_admin_id'),
					'login_attempt_type' => $type,
					'login_track_details_ip' => $_SERVER['REMOTE_ADDR'],
					'login_track_status_info' => $_SERVER['HTTP_USER_AGENT'],
					'login_track_details_system_info' => $_SERVER['REMOTE_ADDR'].'||'.$_SERVER['REMOTE_PORT']
				);
		$this->db->insert('admin_login_tracking_details', $data);
		return $this->db->insert_id();
    }
   
    public function admin_ip_check(){
		$this->db->select('ip_address')->from('admin_white_iplist')->where('ip_address', $_SERVER['REMOTE_ADDR'])->where('status', 'ACTIVE');
		$query = $this->db->get();	
    	if ( $query->num_rows > 0 ){
				return "ACTIVE";	
		}else{
			$this->db->select('ip_address')->from('admin_white_iplist')->where('ip_address', $_SERVER['REMOTE_ADDR'])->where('status', 'BLOCK');
			$query = $this->db->get();
			if ( $query->num_rows > 0 ){
	     		return "BLOCK";
			}else{
				return "DENIED";	
			}
		}
    }

    public function admin_ip_attempt($track_id){
		$last_track_id	= $track_id;
		$sql 	= "SELECT * FROM admin_login_tracking_details WHERE login_tracking_details_time_stamp >= DATE_SUB(NOW(), INTERVAL 2 HOUR) AND login_attempt_type !='URL'";
		$result = $this->db->query($sql);
		if (!$result->num_rows() || $result->num_rows()== 0){
			$data['row_count']	=	0;
			$data['ins_id']		=	'';
			return $data; 
		}else{
			if($result->num_rows() < 5){
				$data['row_count']	=	$result->num_rows();
				$data['ins_id']		=	'';
				return $data;
			}else{
				$signval 	=  $track_id.'||||'.$_SERVER['REMOTE_ADDR'];
				$signurl 	=  $this->encrypt_string('encrypt',$signval);
				$data 		=  array(
									'signurl' 							=> urlencode($signurl),
									'status' 							=> 0,
									'admin_login_tracking_details_id' 	=> $track_id
							   );
				$this->db->set('expiry_date', 'NOW() + INTERVAL 12 HOUR', FALSE); 
				$this->db->insert('admin_login_retrive', $data);
				
				$ins_id 			= $this->db->insert_id();
				$data 				= array('status ' => 'BLOCK');
				$this->db->update('admin_white_iplist', $data);				

				$data['row_count']	= $result->num_rows();
				$data['ins_id']		= $ins_id;
				return $data; 
			}
		}
	}

	public function check_login_status($username,$password){
		$username	=	mysql_real_escape_string($username);
		$password	=	mysql_real_escape_string($password);
		// $sql 		= 	"SELECT a.admin_id, a.admin_email, a.admin_name,a.admin_account_number,a.admin_profile_pic FROM admin_details a JOIN admin_login_details al on a.admin_id = al.admin_id where al.admin_user_name = '$username' AND al.admin_password  =  AES_ENCRYPT('$password','".SECURITY_KEY."')  AND a.admin_status='ACTIVE'";
		$sql 		= 	"SELECT a.admin_id, a.admin_email, a.admin_name,a.admin_account_number,a.admin_profile_pic FROM admin_details a JOIN admin_login_details al on a.admin_id = al.admin_id where al.admin_user_name = '$username' AND a.admin_status='ACTIVE'";
		// $sql 		= 	"SELECT a.admin_id, a.admin_email, a.admin_name,a.admin_account_number,a.admin_profile_pic FROM admin_details a JOIN admin_login_details al on a.admin_id = al.admin_id where al.admin_user_name = '$username' AND al.admin_password  =  md5('$password')  AND a.admin_status='ACTIVE'";
		$query 		= 	$this->db->query($sql);
		// echo $this->db->last_query();exit;
		if( $query->num_rows > 0 ){
			$data['status']	=	1;
			$data['result']	=	$query->row();
			return $data;	
	    }else{
			$data['status']	=	0;
			$data['result']	=	'';
			return $data;
		}
    }
    public function check_login_status_by_Id($provab_admin_id,$password){
		$provab_admin_id	=	mysql_real_escape_string($provab_admin_id);
		$password			=	mysql_real_escape_string($password);
		$sql 				= 	"SELECT a.admin_id, a.admin_email, a.admin_name,a.admin_account_number,a.admin_profile_pic FROM admin_details a JOIN admin_login_details al on a.admin_id = al.admin_id where al.admin_id = '$provab_admin_id' AND al.admin_password  =  AES_ENCRYPT('$password','".SECURITY_KEY."')  AND a.admin_status='ACTIVE'";
		$query 				= 	$this->db->query($sql);
		if( $query->num_rows > 0 ){
			$data['status']	=	1;
			$data['result']	=	$query->row();
			return $data;	
	    }else{
			$data['status']	=	0;
			$data['result']	=	'';
			return $data;
		}
    }

    function get_previous_url(){
		$this->db->select('url');
		$this->db->from('admin_lock_screen_details');
		$this->db->where('admin_id', $this->session->userdata('provab_admin_id'));
		$this->db->where('provab_admin_session_id', $this->session->userdata('provab_admin_session_id'));
		$this->db->where('status', 'ACTIVE');
		$query=$this->db->get();
		if($query->num_rows() ==''){
			return '';
		}else{
			$result = $query->row();
		}
		$data = array('status' => 'INACTIVE');
		$where = array('admin_id' => $this->session->userdata('provab_admin_id'),'provab_admin_session_id' => $this->session->userdata('provab_admin_session_id'));
		$this->db->where($where);
		$this->db->update('admin_lock_screen_details', $data);
		return $result;
	}
    function insert_lock_screen_details($input){
		$data = array(
					'admin_id' 						=> $this->session->userdata('provab_admin_id'),
					'provab_admin_session_id' 		=> $this->session->userdata('provab_admin_session_id'),
					'user_name' 					=> $this->session->userdata('provab_admin_name'),
					'url'		 					=> $input['current_url'],
					'status'						=> 'ACTIVE',
					'admin_lock_screen_timestamp' 	=> (date('Y-m-d H:i:s'))
				);
		$this->db->insert('admin_lock_screen_details', $data);
		return $this->db->insert_id();
    }

	function encrypt_string($action, $string){
		$output 		= false;
		$encrypt_method = "AES-256-CBC";
		$secret_key 	= SECURITY_KEY;
		$secret_iv 		= 'DFJKIUHJGTUHJUJNJHGUIKSOXUCJDDJDJDJDJDC';
		$key =  substr(hash('sha256', $secret_key), 0, 32); // hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16); // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		if( $action == 'encrypt' ) {
			$output = base64_encode($string); // $output = openssl_encrypt($string, $encrypt_method, $key, $iv);
		}else if( $action == 'decrypt' ){
			$output = base64_decode($string); // $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, $iv);
		}
		return $output;
	}

	public function check_admin_password($password){
		$password 	= mysql_real_escape_string($password);
		$sql 		= "SELECT admin_id,admin_user_name, AES_DECRYPT(admin_password,'".SECURITY_KEY."') as password  FROM admin_login_details WHERE admin_password  =  AES_ENCRYPT('$password','".SECURITY_KEY."') ";
		$query 		= $this->db->query($sql);
		if ( $query->num_rows > 0 ){
			$data['status']	= 1;
			$data['result']	= $query->row();
			return $data;	
	    }else{
			$data['status']	= 0;
			$data['result']	= '';
			return $data;
		}
    }
   
	public function update_admin_password($password){
		$password	=	mysql_real_escape_string($password);
		$admin_id 	= 	$this->session->userdata('provab_admin_id');
		$update_sql	= 	"UPDATE admin_login_details SET admin_password  =  AES_ENCRYPT('$password','".SECURITY_KEY."') WHERE admin_id  =  '$admin_id' ";
		if (  $this->db->query($update_sql) ){
			return true;	
	    }else{
			return false;
		}
	}
   
}
?>
