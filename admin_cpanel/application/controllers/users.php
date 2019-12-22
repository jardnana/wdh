<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
error_reporting(0);
class Users extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Users_Model');		
		$this->load->model('Product_Model');		
		$this->load->model('Domain_Model');		
		$this->load->model('Usertype_Model');		
		$this->load->model('Promo_Model');		
		$this->load->model('Api_Model');
		$this->load->model('Email_Model');
		$this->load->model('Booking_Model');
		$this->check_admin_login();		
	}

	private function check_admin_login(){
		if($this->session->userdata('provab_admin_logged_in') == ""){
	        redirect('login','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Logged_In"){
			// redirect('dashboard','refresh');
        }else if($this->session->userdata('provab_admin_logged_in') == "Lock_Screen"){
			redirect('login/lock_screen','refresh');
		}
    }
	 
	function users_list(){
		$user 				= $this->General_Model->get_home_page_settings();
		$user['user_list'] 	= $this->Users_Model->get_user_list();
		$user['promo'] = $this->Promo_Model->get_promo();
		// echo '<pre/>';print_r($user['user_list']);exit;
		$this->load->view('users/user_list',$user);
	}

	function add_user(){
		if(count($_POST) > 0){
			// echo '<pre/>';print_r($_POST);print_r($_FILES);exit;
			$user_profile_name = '';
			if(!empty($_FILES['user_profile']['name']))
			{	
				if(is_uploaded_file($_FILES['user_profile']['tmp_name'])) 
				{
					$allowed =  array('gif','png' ,'jpg', 'jpeg');
					$sourcePath = $_FILES['user_profile']['tmp_name'];
					$filename = $_FILES['user_profile']['name'];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					if(in_array($ext,$allowed) ) {
						$img_Name=time().$_FILES['user_profile']['name'];
						$targetPath = "uploads/users/".$img_Name;
						if(move_uploaded_file($sourcePath,$targetPath)){
							$user_profile_name = $img_Name;
						}
					}
				}				
			}
			$this->Users_Model->add_users_details($_POST,$user_profile_name);
			redirect('users/users_list','refresh');
		}else{
			$users 				= $this->General_Model->get_home_page_settings();
			$users['domain'] 	=  $this->Domain_Model->get_domain_list();
			$users['product'] 	=  $this->Product_Model->get_product_list();
			$users['country'] 	=  $this->General_Model->get_country_details();
			$users['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$users['api']		=  $this->Api_Model->get_api_list();
			// echo '<pre/>';print_r($users);exit;
			$this->load->view('users/add_user',$users);
		}
	}

	function check_unique_email($email){
		if($email!=''){
			if(preg_match("/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)){
				$Status 	=	$this->Users_Model->get_all_user_email($email);
				if($Status  == "YES") {
					echo '<span class="nosuccess">This Email Id already Exists, Please Choose diffrent Email Id</span>';exit;
				}else{
					echo '<span class="success" style="color: green;">valid</span>';exit;
				}
			}else{
				echo '<span class="nosuccess">Please Enter the Valid Email Id</span>';exit;
			}
		}else{	
			 echo '<span class="nosuccess">Please Enter the Valid Email Id</span>';exit;
		}
	}
	
	function active_users($user_id){
		$user_id = json_decode(base64_decode($user_id));
		if($user_id != ''){
			$this->Users_Model->active_users($user_id);
		}
		redirect('users/users_list','refresh');
	}
	
	function inactive_users($user_id){
		$user_id = json_decode(base64_decode($user_id));
		if($user_id != ''){
			$this->Users_Model->inactive_users($user_id);
		}
		redirect('users/users_list','refresh');
	}
	
	function delete_users($user_id){
		$user_id = json_decode(base64_decode($user_id));
		if($user_id != ''){
			$this->Users_Model->delete_users($user_id);
		}
		redirect('users/users_list','refresh');
	}
	
	function edit_users($user_id){
		$user_id = json_decode(base64_decode($user_id));
		if($user_id != ''){
			$users 				= $this->General_Model->get_home_page_settings();
			$users['domain'] 	=  $this->Domain_Model->get_domain_list();
			$users['product'] 	=  $this->Product_Model->get_product_list();
			$users['country'] 	=  $this->General_Model->get_country_details();
			$users['user_type']	=  $this->Usertype_Model->get_user_type_list();
			$users['api']		=  $this->Api_Model->get_api_list();
			$users['users'] 	= $this->Users_Model->get_user_list($user_id);
			//echo"<pre/>";print_r($users); exit;
			$this->load->view('users/edit_user',$users);
		} else {
			redirect('users/users_list','refresh');
		}
	}
	
	function update_users($user_id){
		if(count($_POST) > 0){
			$user_id = json_decode(base64_decode($user_id));
			if($user_id != ''){
				$user_profile_name  = $_REQUEST['user_profile_old'];
				if(!empty($_FILES['user_profile']['name'])){	
					if(is_uploaded_file($_FILES['user_profile']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$oldImage = "uploads/api/".$user_profile_name;
						unlink($oldImage);
						$sourcePath = $_FILES['user_profile']['tmp_name'];
						$filename = $_FILES['user_profile']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name	= time().$_FILES['user_profile']['name'];
							$targetPath = "uploads/users/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$user_profile_name = $img_Name;
							}
						}
					}				
				}
				$this->Users_Model->update_users($_POST,$user_id, $user_profile_name);
			}
			redirect('users/users_list','refresh');
		}else if($user_id!=''){
			redirect('users/edit_users/'.$user_id,'refresh');
		}else{
			redirect('users/users_list','refresh');
		}
	}

	function send_email($user_id1){
		$user_id 	= json_decode(base64_decode($user_id1));
		if($user_id != ''){
			$user 				= $this->General_Model->get_home_page_settings();
			$user['user_id1'] 	= $user_id1;
			$user['user_list'] 	= $this->Users_Model->get_user_list($user_id);
			$this->load->view('general/send_email',$user);
		}else{
			redirect('users/users_list','refresh');
		}
	}
	
	function send_mail($user_id1) {
		$user_id 	= json_decode(base64_decode($user_id1));
		if($user_id != ''){
			$user = $this->Users_Model->get_user_list($user_id);
			if(isset($user['user_info'][0]) && $user['user_info'][0] !=''){
				$data['emailid'] 	= $user['user_info'][0]->user_email; 
				$data['firstname'] 	= $user['user_info'][0]->first_name." ".$user['user_info'][0]->middle_name." ".$user['user_info'][0]->sure_name; 
				$data['subject']	= $subject = $this->input->post('subject');
				$data['description']=  $message = $this->input->post('description');
				// echo '<pre/>';print_r($data);exit;
				$this->Email_Model->send_mail_to_user($data);
			}
			redirect('users/users_list', 'refresh');
		}else{
			redirect('users/users_list','refresh');
		}
    }
    
	function send_user_promo($user_id1){
		$user_id 	= json_decode(base64_decode($user_id1));
		$user = $this->General_Model->get_home_page_settings();
		$promo_id = $_POST['promoid']; 
		$user = $this->Users_Model->get_user_list($user_id);

		$promo_value = $this->Promo_Model->get_promo_code_list($promo_id);
		$data['promo_code'] = $promo_value; 
		$data['exp_date'] = date('M j,Y', strtotime($promo_value->exp_date));
		$data['emailid'] = $user['user_info'][0]->user_email; 
		$data['firstname'] = $user['user_info'][0]->first_name." ".$user['user_info'][0]->middle_name." ".$user['user_info'][0]->sure_name; 
		$this->Email_Model->send_promo_to_user($data);
		redirect('users/users_list', 'refresh');
    }
}
