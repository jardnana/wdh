<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// if (session_status() == PHP_SESSION_NONE){ session_start(); }
session_start();
// error_reporting(0)
class Dashboard extends CI_Controller {	

	public function __construct(){
		parent::__construct();	
		$this->load->model('General_Model');
		$this->load->model('Dashboard_Model');
		$this->load->model('Security_Model');
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
    
	public function index(){
		$data = $this->General_Model->get_home_page_settings();
		$this->load->view('dashboard/index',$data);
	}
		
	public function login_check(){		
		# Response Data Array
		$resp = array();
		// Fields Submitted
		$username = $_POST["username"];
		$password = $_POST["password"];
		// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
		$resp['submitted_data'] = $_POST;
		
		// Login success or invalid login data [success|invalid]
		// Your code will decide if username and password are correct
		$login_status = 'invalid';
		if($username == 'sunil' && $password == 'sunil')
		{
			$login_status = 'success';
		}
		$resp['login_status'] = $login_status;

		// Login Success URL
		if($login_status == 'success')
		{
			// If you validate the user you may set the user cookies/sessions here
				#setcookie("logged_in", "user_id");
				#$_SESSION["logged_user"] = "user_id";
			
			// Set the redirect url after successful login
			$resp['redirect_url'] = site_url().'login/dashboard';
		}
		echo json_encode($resp);
	}
	
	public function dashboard(){
		$data = $this->General_Model->get_home_page_settings();
		$this->load->view('dashboard/index',$data);
	}

	public function forgot_password(){
		$this->load->view('login/forgot_password');
	}
	
	public function logout(){
		redirect('login','refresh');
	}
	
	function logs_activity($status=''){
		$data 						= $this->General_Model->get_home_page_settings();
		$data['status']				= $status;
		// $data['admin_profile_info'] = $this->Dashboard_Model->get_admin_details();
		$data['logs_activity'] 		= $this->Dashboard_Model->get_admin_logs_activity();
		$this->load->view('dashboard/activity_logs',$data);
	}
	
	function change_password($status=''){
		$data 						= $this->General_Model->get_home_page_settings();
		$data['status']				= $status;
		$data['admin_profile_info'] = $this->Dashboard_Model->get_admin_details();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('login/change_password', $data);
	}
	
	function update_password(){
		// echo '<pre/>';print_r($_POST);exit;
		$this->form_validation->set_rules('current_password', 'Old Password', 'required');
		$this->form_validation->set_rules('new_password_text', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Re-Enter Password', 'required');		
		$status = 0;
		if($this->form_validation->run()==FALSE){
			redirect('dashboard/change_password','refresh');
		}else{
			$old_password 			= $this->input->post('current_password');
			$old_password_status 	= $this->Security_Model->check_admin_password($old_password);
			if(trim($this->input->post('new_password_text')) == $this->input->post('confirm_password')){
				if($old_password_status['status'] == 1 ){
					$new_password = trim($this->input->post('new_password_text'));
					if ($this->Security_Model->update_admin_password($new_password)){ $status=1; }else{ $status=0; }
				}else{
				  $status	= 3;
				}
			}else{
				$status	= 4;
			}
			redirect('dashboard/change_password/'.$status,'refresh');
		}
	}

	function settings($status = '',$link = 'ip'){
		$data 						= $this->General_Model->get_home_page_settings();
		$data['status']				= $status;
		$data['link']				= $link;
		$data['admin_profile_info'] = $this->Dashboard_Model->get_admin_details();
		$data['white_list_ip'] 		= $this->Dashboard_Model->get_white_list_ip_details();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('dashboard/settings',$data);
	}
	
	function add_white_list(){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('ip_address','White List IP Address','required');
			if($this->form_validation->run()==TRUE){
				$this->Dashboard_Model->add_white_list($_POST);
				redirect('dashboard/settings','refresh');
			} else {
				$this->load->view('dashboard/add_white_list_ip');
			}
		}else{
			$this->load->view('dashboard/add_white_list_ip');
		}
	}
	function active_white_list_ip($white_list_ip_id){
		if($white_list_ip_id!='')
			$this->Dashboard_Model->active_white_list_ip($white_list_ip_id);
		redirect('dashboard/settings','refresh');
	}
	
	function inactive_white_list_ip($white_list_ip_id){
		if($white_list_ip_id!='')
			$this->Dashboard_Model->inactive_white_list_ip($white_list_ip_id);
		redirect('dashboard/settings','refresh');
	}
	
	function delete_white_list_ip($white_list_ip_id){
		if($white_list_ip_id!='')
			$this->Dashboard_Model->delete_white_list_ip($white_list_ip_id);
		redirect('dashboard/settings','refresh');
	}

	function edit_white_list_ip($white_list_ip_id){
		$data 						= $this->General_Model->get_home_page_settings();
		$data['white_list_ip'] 		= $this->Dashboard_Model->get_white_list_ip_details($white_list_ip_id);
		$this->load->view('dashboard/edit_white_list_ip',$data);
	}
	
	function update_white_list_ip($white_list_ip_id){
		if(count($_POST) > 0){
			$this->form_validation->set_rules('ip_address','White List IP Address','required');
			if($this->form_validation->run()==TRUE){
				$this->Dashboard_Model->update_white_list_ip($_POST,$white_list_ip_id);
				redirect('dashboard/settings','refresh');
			} else {
				redirect('dashboard/edit_white_list_ip/'.$white_list_ip_id,'refresh');
			}	
		}else if($product_id!=''){
			redirect('dashboard/edit_white_list_ip/'.$white_list_ip_id,'refresh');
		}else{
			redirect('dashboard/settings','refresh');
		}
	}

	function profile_info(){
		$data 						= $this->General_Model->get_home_page_settings();
		$data['country'] 			= $this->General_Model->get_country_details();
		$data['admin_profile_info'] = $this->Dashboard_Model->get_admin_details();
		// echo '<pre/>';print_r($data);exit;
		$this->load->view('dashboard/profile_info',$data);
	}
	
	function update_profile_info(){
		if(count($_POST) > 0) {
			$this->form_validation->set_rules('first_name','First Name','required');
			$this->form_validation->set_rules('last_name','Last Name','required');
			$this->form_validation->set_rules('home_phone','Residence Number','required');
			$this->form_validation->set_rules('cell_phone','Contact Mobile Number','required');
			$this->form_validation->set_rules('city_name','City Name','required');
			$this->form_validation->set_rules('state_name','State Name','required');
			$this->form_validation->set_rules('zip_code','Zip Code','required');
			if($this->form_validation->run()==TRUE){
				try {
					$this->General_Model->begin_transaction();
					$data['admin_profile_info'] = $this->Dashboard_Model->get_admin_details();
					$this->Dashboard_Model->update_address_details($_POST, $data);
					$this->Dashboard_Model->update_profile_info($_POST, $data);
					$this->General_Model->commit_transaction();
				} catch(Exception $ex) {
					$this->General_Model->rollback_transaction();
					$ex->getMessage();
				}
			} else {} 
			redirect('dashboard/profile_info','refresh');
		}
		
	}
}
