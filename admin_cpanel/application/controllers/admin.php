<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
 error_reporting(E_ALL);
class Admin extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Admin_Model');
		$this->load->model('Product_Model');		
		$this->load->model('Domain_Model');		
		$this->load->model('Usertype_Model');		
		$this->load->model('Api_Model');
		$this->load->model('Roles_Model');
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
	 
	function admin_list(){
		$admin 					= $this->General_Model->get_home_page_settings();
		$admin['admin_list'] 	= $this->Admin_Model->get_admin_list();
		// echo '<pre/>';print_r($admin['admin_list']);exit;
		$this->load->view('admin/admin_list',$admin);
	}

	function add_admin(){
		if(count($_POST) > 0){
			// echo '<pre/>';print_r($_POST);print_r($_FILES);exit;
			$admin_profile_name = '';
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('email_id', 'Email ID', 'required');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
			$this->form_validation->set_rules('phone_no', 'Phone Number', 'required');
			$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
			$this->form_validation->set_rules('address', 'Mobile Number', 'required');
			$this->form_validation->set_rules('city', 'Mobile Number', 'required');
			$this->form_validation->set_rules('state_name', 'Mobile Number', 'required');
			$this->form_validation->set_rules('zip_code', 'Mobile Number', 'required');
			if ($this->form_validation->run() == TRUE){
				if(!empty($_FILES['admin_profile']['name'])){	
					if(is_uploaded_file($_FILES['admin_profile']['tmp_name'])) {
						$allowed =  array('gif','png' ,'jpg', 'jpeg');
						$sourcePath = $_FILES['admin_profile']['tmp_name'];
						$filename = $_FILES['admin_profile']['name'];
						$ext = pathinfo($filename, PATHINFO_EXTENSION);
						if(in_array($ext,$allowed) ) {
							$img_Name=time().$_FILES['admin_profile']['name'];
							$targetPath = "uploads/admin/".$img_Name;
							if(move_uploaded_file($sourcePath,$targetPath)){
								$admin_profile_name = $img_Name;
							}
						}
					}				
				}
				$this->Admin_Model->add_admin_details($_POST,$admin_profile_name);
				redirect('admin/admin_list','refresh');
			} else {
				$admin 					=  $this->General_Model->get_home_page_settings();
				$admin['country'] 		=  $this->General_Model->get_country_details();
				$admin['admin_type']	=  $this->Roles_Model->get_roles_list();
				$this->load->view('admin/add_admin',$admin);
			}
			
		}else{
			$admin 					=  $this->General_Model->get_home_page_settings();
			$admin['country'] 		=  $this->General_Model->get_country_details();
			$admin['admin_type']	=  $this->Roles_Model->get_roles_list();
			// echo '<pre/>';print_r($admin);exit;
			$this->load->view('admin/add_admin',$admin);
		}
	}

	function check_unique_email($email){
		if($email!=''){
			if(preg_match("/^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)){
				$Status 	=	$this->Admin_Model->get_all_admin_email($email);
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
	
	function active_admin($admin_id){
		$admin_id = json_decode(base64_decode($admin_id));
		if($admin_id != ''){
			$this->Admin_Model->active_admin($admin_id);
		}
		redirect('admin/admin_list','refresh');
	}
	
	function inactive_admin($admin_id){
		$admin_id = json_decode(base64_decode($admin_id));
		if($admin_id != ''){
			$this->Admin_Model->inactive_admin($admin_id);
		}
		redirect('admin/admin_list','refresh');
	}
	
	function delete_admin($admin_id){
		$admin_id = json_decode(base64_decode($admin_id));
		if($admin_id != ''){
			$this->Admin_Model->delete_admin($admin_id);
		}
		redirect('admin/admin_list','refresh');
	}
	
	function edit_admin($admin_id){
		$admin_id = json_decode(base64_decode($admin_id));
		if($admin_id != ''){
			$admin 				= $this->General_Model->get_home_page_settings();
			$admin['domain'] 	=  $this->Domain_Model->get_domain_list();
			$admin['product'] 	=  $this->Product_Model->get_product_list();
			$admin['country'] 	=  $this->General_Model->get_country_details();
			$admin['admin_type']	=  $this->Roles_Model->get_roles_list();
			$admin['api']		=  $this->Api_Model->get_api_list();
			$admin['admin_list'] 	= $this->Admin_Model->get_admin_list($admin_id);
			 //echo '<pre/>';print_r($admin['admin_list']);exit;
			$this->load->view('admin/edit_admin',$admin);
		} else {
			redirect('admin/admin_list','refresh');
		}
	}
	
	function update_admin($admin_id){
		if(count($_POST) > 0){
			$admin_id = json_decode(base64_decode($admin_id));
			if($admin_id != ''){
				$admin_profile_name  = $_REQUEST['user_profile_old'];
				$this->form_validation->set_rules('first_name', 'First Name', 'required');
				$this->form_validation->set_rules('email_id', 'Email ID', 'required');
				$this->form_validation->set_rules('phone_no', 'Phone Number', 'required');
				$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
				$this->form_validation->set_rules('address', 'Mobile Number', 'required');
				$this->form_validation->set_rules('city', 'Mobile Number', 'required');
				$this->form_validation->set_rules('state_name', 'Mobile Number', 'required');
				$this->form_validation->set_rules('zip_code', 'Mobile Number', 'required');
				if ($this->form_validation->run() == TRUE){
					if(!empty($_FILES['admin_profile']['name'])){	
						if(is_uploaded_file($_FILES['admin_profile']['tmp_name'])) {
							$allowed =  array('gif','png' ,'jpg', 'jpeg');
							$oldImage = "uploads/admin/".$admin_profile_name;
							unlink($oldImage);
							$sourcePath = $_FILES['admin_profile']['tmp_name'];
							$filename = $_FILES['admin_profile']['name'];
							$ext = pathinfo($filename, PATHINFO_EXTENSION);
							if(in_array($ext,$allowed) ) {
								$img_Name	= time().$_FILES['admin_profile']['name'];
								$targetPath = "uploads/admin/".$img_Name;
								if(move_uploaded_file($sourcePath,$targetPath)){
									$admin_profile_name = $img_Name;
								}
							}
						}				
					}
					$this->Admin_Model->update_admin($_POST,$admin_id, $admin_profile_name);
				} else {
					redirect('admin/edit_admin/'.$admin_id,'refresh');
				}
			}
			redirect('admin/admin_list','refresh');
		}else if($admin_id!=''){
			redirect('admin/edit_admin/'.$admin_id,'refresh');
		}else{
			redirect('admin/admin_list','refresh');
		}
	}
}
